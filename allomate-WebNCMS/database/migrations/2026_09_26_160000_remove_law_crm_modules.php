<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Remove leftover Khan Law CRM modules from DottScale CMS:
 * Intake Form, Workflow, Case Files, Municipality, Bulk Update, Historical Data.
 */
class RemoveLawCrmModules extends Migration
{
    private array $menuMatchers = [
        'intake',
        'workflow',
        'case file',
        'case-file',
        'casefile',
        'municipality',
        'bulk update',
        'bulk-update',
        'bulk_update',
        'historical',
    ];

    private array $tables = [
        // Intake
        'intake_form_meeting_assignment',
        'intake_form_meetings',
        'intake_form_logs',
        'intake_form_inputs',
        'intake_form_witness',
        'intake_form_types',
        'intake_aps_documents',
        'intake_poanwills',
        'intake_post_sale_address',
        'intake_forms',
        'client_intake_form_ids_documents',
        'client_intake_form_documents',
        'client_intake_form',
        // Workflow
        'workflow_process_notifications_content',
        'workflow_process_notifications',
        'workflow_process_sub_activites',
        'workflow_process_statues',
        'workflow_process_folders',
        'workflow_sub_activites',
        // Case files
        'case_file_detail_sub_tasks',
        'casefile_detail_documents',
        'casefile_executed_documents',
        'casefile_activity_reminder',
        'casefile_transaction_details',
        'casefile_transactions',
        'casefile_invoices',
        'case_file_details',
        // Municipality
        'municipality_data',
        'municipality_departments',
        // Historical
        'historical_records',
    ];

    public function up()
    {
        $this->purgeMenuAndRights();
        $this->dropTables();
    }

    public function down()
    {
        // Destructive cleanup — not reversible.
    }

    private function purgeMenuAndRights(): void
    {
        if (!Schema::hasTable('controllers')) {
            return;
        }

        $query = DB::table('controllers');
        $query->where(function ($q) {
            foreach ($this->menuMatchers as $needle) {
                $like = '%' . $needle . '%';
                $q->orWhere('parent_module', 'like', $like)
                    ->orWhere('made_up_name', 'like', $like)
                    ->orWhere('sub_module', 'like', $like)
                    ->orWhere('controller', 'like', $like);
            }
        });

        $controllers = $query->pluck('controller')->filter()->unique()->values()->all();
        $ids = DB::table('controllers')
            ->where(function ($q) {
                foreach ($this->menuMatchers as $needle) {
                    $like = '%' . $needle . '%';
                    $q->orWhere('parent_module', 'like', $like)
                        ->orWhere('made_up_name', 'like', $like)
                        ->orWhere('sub_module', 'like', $like)
                        ->orWhere('controller', 'like', $like);
                }
            })
            ->pluck('id')
            ->all();

        if (Schema::hasTable('access_rights') && !empty($controllers)) {
            DB::table('access_rights')->whereIn('controller_right', $controllers)->delete();
        }

        if (!empty($ids)) {
            DB::table('controllers')->whereIn('id', $ids)->delete();
        }
    }

    private function dropTables(): void
    {
        Schema::disableForeignKeyConstraints();
        try {
            foreach ($this->tables as $table) {
                Schema::dropIfExists($table);
            }
        } finally {
            Schema::enableForeignKeyConstraints();
        }
    }
}
