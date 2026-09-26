-- Remove Business Contacts last 3 sub-items:
-- Jurisdiction, Land Registry Offices, Legal Persons
-- Preferred:
-- /opt/alt/php81/usr/bin/php artisan migrate --path=database/migrations/2026_09_26_172000_remove_jurisdiction_land_registry_legal_persons.php --force

DELETE FROM `access_rights`
WHERE `controller_right` IN (
    SELECT `controller` FROM (
        SELECT `controller` FROM `controllers`
        WHERE
            LOWER(COALESCE(`parent_module`, '')) REGEXP 'jurisdiction|land.?registry|legal.?person'
            OR LOWER(COALESCE(`made_up_name`, '')) REGEXP 'jurisdiction|land.?registry|legal.?person'
            OR LOWER(COALESCE(`sub_module`, '')) REGEXP 'jurisdiction|land.?registry|legal.?person'
            OR LOWER(COALESCE(`controller`, '')) REGEXP 'jurisdiction|land.?registry|legal.?person'
    ) AS t
);

DELETE FROM `controllers`
WHERE
    LOWER(COALESCE(`parent_module`, '')) REGEXP 'jurisdiction|land.?registry|legal.?person'
    OR LOWER(COALESCE(`made_up_name`, '')) REGEXP 'jurisdiction|land.?registry|legal.?person'
    OR LOWER(COALESCE(`sub_module`, '')) REGEXP 'jurisdiction|land.?registry|legal.?person'
    OR LOWER(COALESCE(`controller`, '')) REGEXP 'jurisdiction|land.?registry|legal.?person';
