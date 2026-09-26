<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Remove Careers + Documents admin modules (menu + tables).
 */
class RemoveCareersAndDocumentsModules extends Migration
{
    private array $menuMatchers = [
        'career',
        'careers',
        'jobs',
        'application',
        'applications',
        'document',
        'documents',
    ];

    private array $tables = [
        // Careers
        'application_forms',
        'careers',
        // Documents (law CRM leftovers)
        'file_document_assignment',
        'file_document_placeholders',
        'file_sub_documents',
        'file_documents',
        'generate_document_tabs_assignment',
        'generate_document_tabs',
        'document_verifications',
        'documents_list',
        'document_types',
        'document_type',
        'client_documents',
        'customer_documents',
        'static_mapped_table_document',
        'prompt_document_types',
    ];

    public function up()
    {
        $this->purgeMenuAndRights();
        $this->dropTables();
    }

    public function down()
    {
        // Destructive — not reversible.
    }

    private function purgeMenuAndRights(): void
    {
        if (!Schema::hasTable('controllers')) {
            return;
        }

        $controllers = DB::table('controllers')
            ->where(function ($q) {
                foreach ($this->menuMatchers as $needle) {
                    $like = '%' . $needle . '%';
                    $q->orWhere('parent_module', 'like', $like)
                        ->orWhere('made_up_name', 'like', $like)
                        ->orWhere('sub_module', 'like', $like)
                        ->orWhere('controller', 'like', $like);
                }
            })
            ->pluck('controller')
            ->filter()
            ->unique()
            ->values()
            ->all();

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
