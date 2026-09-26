-- Fix missing PRIMARY KEY + AUTO_INCREMENT on integer `id` columns.
-- Run this on dottbfyw_staging in phpMyAdmin.
-- In phpMyAdmin set delimiter to $$ before running, then set it back to ;

DROP PROCEDURE IF EXISTS fix_all_primary_keys$$

CREATE PROCEDURE fix_all_primary_keys()
BEGIN
  DECLARE done INT DEFAULT 0;
  DECLARE tname VARCHAR(64);
  DECLARE coltype VARCHAR(128);
  DECLARE col_extra VARCHAR(128);
  DECLARE pk_count INT;
  DECLARE pk_on_id INT;

  DECLARE cur CURSOR FOR
    SELECT c.TABLE_NAME, c.COLUMN_TYPE, IFNULL(c.EXTRA, '')
    FROM information_schema.COLUMNS c
    INNER JOIN information_schema.TABLES t
      ON t.TABLE_SCHEMA = c.TABLE_SCHEMA
     AND t.TABLE_NAME = c.TABLE_NAME
    WHERE c.TABLE_SCHEMA = DATABASE()
      AND t.TABLE_TYPE = 'BASE TABLE'
      AND c.COLUMN_NAME = 'id'
      AND c.DATA_TYPE IN ('tinyint', 'smallint', 'mediumint', 'int', 'bigint');

  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

  OPEN cur;
  read_loop: LOOP
    FETCH cur INTO tname, coltype, col_extra;
    IF done = 1 THEN
      LEAVE read_loop;
    END IF;

    SELECT COUNT(*) INTO pk_count
    FROM information_schema.TABLE_CONSTRAINTS
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = tname
      AND CONSTRAINT_TYPE = 'PRIMARY KEY';

    SELECT COUNT(*) INTO pk_on_id
    FROM information_schema.KEY_COLUMN_USAGE
    WHERE TABLE_SCHEMA = DATABASE()
      AND TABLE_NAME = tname
      AND CONSTRAINT_NAME = 'PRIMARY'
      AND COLUMN_NAME = 'id';

    SET @sql = NULL;

    IF pk_count = 0 THEN
      SET @sql = CONCAT(
        'ALTER TABLE `', tname, '` ADD PRIMARY KEY (`id`), MODIFY `id` ', coltype, ' NOT NULL AUTO_INCREMENT'
      );
    ELSEIF pk_on_id > 0 AND col_extra NOT LIKE '%auto_increment%' THEN
      SET @sql = CONCAT(
        'ALTER TABLE `', tname, '` MODIFY `id` ', coltype, ' NOT NULL AUTO_INCREMENT'
      );
    END IF;

    IF @sql IS NOT NULL THEN
      PREPARE stmt FROM @sql;
      EXECUTE stmt;
      DEALLOCATE PREPARE stmt;
    END IF;
  END LOOP;
  CLOSE cur;
END$$

CALL fix_all_primary_keys()$$
DROP PROCEDURE IF EXISTS fix_all_primary_keys$$
