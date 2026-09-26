<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Fix Site Settings menu link: /admin/Admin (404) → /admin/site_settings
 */
class FixSiteSettingsControllerSlug extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('controllers')) {
            return;
        }

        DB::table('controllers')
            ->where(function ($q) {
                $q->where('controller', 'Admin')
                    ->orWhere('controller', 'admin')
                    ->orWhere('made_up_name', 'like', '%Site Setting%')
                    ->orWhere('sub_module', 'like', '%Site Setting%')
                    ->orWhere('parent_module', 'like', '%Site Setting%');
            })
            ->update([
                'controller' => 'site_settings',
            ]);
    }

    public function down()
    {
        if (!Schema::hasTable('controllers')) {
            return;
        }

        DB::table('controllers')
            ->where('controller', 'site_settings')
            ->where(function ($q) {
                $q->where('made_up_name', 'like', '%Site Setting%')
                    ->orWhere('sub_module', 'like', '%Site Setting%')
                    ->orWhere('parent_module', 'like', '%Site Setting%');
            })
            ->update([
                'controller' => 'Admin',
            ]);
    }
}
