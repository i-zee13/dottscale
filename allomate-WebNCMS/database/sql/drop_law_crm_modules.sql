-- Remove leftover Khan Law CRM modules from DottScale staging/production DB.
-- Modules: Intake Form, Workflow, Case Files, Municipality, Bulk Update, Historical Data
-- Preferred: /opt/alt/php81/usr/bin/php artisan migrate --path=database/migrations/2026_09_26_160000_remove_law_crm_modules.php --force

SET FOREIGN_KEY_CHECKS = 0;

-- Sidebar / access rights (controllers table drives dynamic admin menu)
DELETE FROM `access_rights`
WHERE `controller_right` IN (
    SELECT `controller` FROM (
        SELECT `controller` FROM `controllers`
        WHERE
            LOWER(COALESCE(`parent_module`, '')) REGEXP 'intake|workflow|case.?file|casefile|municipality|bulk.?update|historical'
            OR LOWER(COALESCE(`made_up_name`, '')) REGEXP 'intake|workflow|case.?file|casefile|municipality|bulk.?update|historical'
            OR LOWER(COALESCE(`sub_module`, '')) REGEXP 'intake|workflow|case.?file|casefile|municipality|bulk.?update|historical'
            OR LOWER(COALESCE(`controller`, '')) REGEXP 'intake|workflow|case.?file|casefile|municipality|bulk.?update|historical'
    ) AS t
);

DELETE FROM `controllers`
WHERE
    LOWER(COALESCE(`parent_module`, '')) REGEXP 'intake|workflow|case.?file|casefile|municipality|bulk.?update|historical'
    OR LOWER(COALESCE(`made_up_name`, '')) REGEXP 'intake|workflow|case.?file|casefile|municipality|bulk.?update|historical'
    OR LOWER(COALESCE(`sub_module`, '')) REGEXP 'intake|workflow|case.?file|casefile|municipality|bulk.?update|historical'
    OR LOWER(COALESCE(`controller`, '')) REGEXP 'intake|workflow|case.?file|casefile|municipality|bulk.?update|historical';

-- Intake
DROP TABLE IF EXISTS `intake_form_meeting_assignment`;
DROP TABLE IF EXISTS `intake_form_meetings`;
DROP TABLE IF EXISTS `intake_form_logs`;
DROP TABLE IF EXISTS `intake_form_inputs`;
DROP TABLE IF EXISTS `intake_form_witness`;
DROP TABLE IF EXISTS `intake_form_types`;
DROP TABLE IF EXISTS `intake_aps_documents`;
DROP TABLE IF EXISTS `intake_poanwills`;
DROP TABLE IF EXISTS `intake_post_sale_address`;
DROP TABLE IF EXISTS `intake_forms`;
DROP TABLE IF EXISTS `client_intake_form_ids_documents`;
DROP TABLE IF EXISTS `client_intake_form_documents`;
DROP TABLE IF EXISTS `client_intake_form`;

-- Workflow
DROP TABLE IF EXISTS `workflow_process_notifications_content`;
DROP TABLE IF EXISTS `workflow_process_notifications`;
DROP TABLE IF EXISTS `workflow_process_sub_activites`;
DROP TABLE IF EXISTS `workflow_process_statues`;
DROP TABLE IF EXISTS `workflow_process_folders`;
DROP TABLE IF EXISTS `workflow_sub_activites`;

-- Case Files
DROP TABLE IF EXISTS `case_file_detail_sub_tasks`;
DROP TABLE IF EXISTS `casefile_detail_documents`;
DROP TABLE IF EXISTS `casefile_executed_documents`;
DROP TABLE IF EXISTS `casefile_activity_reminder`;
DROP TABLE IF EXISTS `casefile_transaction_details`;
DROP TABLE IF EXISTS `casefile_transactions`;
DROP TABLE IF EXISTS `casefile_invoices`;
DROP TABLE IF EXISTS `case_file_details`;

-- Municipality
DROP TABLE IF EXISTS `municipality_data`;
DROP TABLE IF EXISTS `municipality_departments`;

-- Historical Data
DROP TABLE IF EXISTS `historical_records`;

SET FOREIGN_KEY_CHECKS = 1;
