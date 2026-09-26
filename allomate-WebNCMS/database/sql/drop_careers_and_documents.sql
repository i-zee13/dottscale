-- Remove Careers + Documents menus and related tables
-- Preferred:
-- /opt/alt/php81/usr/bin/php artisan migrate --path=database/migrations/2026_09_26_170000_remove_careers_and_documents_modules.php --force

SET FOREIGN_KEY_CHECKS = 0;

DELETE FROM `access_rights`
WHERE `controller_right` IN (
    SELECT `controller` FROM (
        SELECT `controller` FROM `controllers`
        WHERE
            LOWER(COALESCE(`parent_module`, '')) REGEXP 'career|job|application|document'
            OR LOWER(COALESCE(`made_up_name`, '')) REGEXP 'career|job|application|document'
            OR LOWER(COALESCE(`sub_module`, '')) REGEXP 'career|job|application|document'
            OR LOWER(COALESCE(`controller`, '')) REGEXP 'career|job|application|document'
    ) AS t
);

DELETE FROM `controllers`
WHERE
    LOWER(COALESCE(`parent_module`, '')) REGEXP 'career|job|application|document'
    OR LOWER(COALESCE(`made_up_name`, '')) REGEXP 'career|job|application|document'
    OR LOWER(COALESCE(`sub_module`, '')) REGEXP 'career|job|application|document'
    OR LOWER(COALESCE(`controller`, '')) REGEXP 'career|job|application|document';

DROP TABLE IF EXISTS `application_forms`;
DROP TABLE IF EXISTS `careers`;

DROP TABLE IF EXISTS `file_document_assignment`;
DROP TABLE IF EXISTS `file_document_placeholders`;
DROP TABLE IF EXISTS `file_sub_documents`;
DROP TABLE IF EXISTS `file_documents`;
DROP TABLE IF EXISTS `generate_document_tabs_assignment`;
DROP TABLE IF EXISTS `generate_document_tabs`;
DROP TABLE IF EXISTS `document_verifications`;
DROP TABLE IF EXISTS `documents_list`;
DROP TABLE IF EXISTS `document_types`;
DROP TABLE IF EXISTS `document_type`;
DROP TABLE IF EXISTS `client_documents`;
DROP TABLE IF EXISTS `customer_documents`;
DROP TABLE IF EXISTS `static_mapped_table_document`;
DROP TABLE IF EXISTS `prompt_document_types`;

SET FOREIGN_KEY_CHECKS = 1;
