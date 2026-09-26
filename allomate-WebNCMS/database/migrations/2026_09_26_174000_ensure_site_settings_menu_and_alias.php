<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Ensure Site Settings menu works:
 * - Fix any controllers.controller slug that points to missing /admin/Admin
 * - Ensure a site_settings menu row exists
 * (Route alias /admin/Admin is also registered in web.php)
 */
class EnsureSiteSettingsMenuAndAlias extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('controllers')) {
            return;
        }

        // Broader fix: any exact Admin slug (case variants / whitespace)
        DB::table('controllers')
            ->whereRaw("TRIM(controller) IN ('Admin', 'admin', 'ADMIN')")
            ->update(['controller' => 'site_settings']);

        // Also fix by label
        DB::table('controllers')
            ->where(function ($q) {
                $q->where('made_up_name', 'like', '%Site Setting%')
                    ->orWhere('sub_module', 'like', '%Site Setting%')
                    ->orWhere('parent_module', 'like', '%Site Setting%');
            })
            ->where(function ($q) {
                $q->whereNull('controller')
                    ->orWhere('controller', '')
                    ->orWhereRaw("TRIM(controller) IN ('Admin', 'admin', 'ADMIN')")
                    ->orWhere('controller', 'like', '%Admin%');
            })
            ->update(['controller' => 'site_settings']);

        // If Site Settings parent exists but has no usable child link, ensure one row
        $hasSiteSettingsSlug = DB::table('controllers')
            ->where('controller', 'site_settings')
            ->exists();

        if (!$hasSiteSettingsSlug) {
            $parent = DB::table('controllers')
                ->where('parent_module', 'like', '%Site Setting%')
                ->orderBy('id')
                ->first();

            $nextId = ((int) DB::table('controllers')->max('id')) + 1;

            DB::table('controllers')->insert([
                'id' => $nextId,
                'controller' => 'site_settings',
                'made_up_name' => 'Site Settings',
                'parent_module' => $parent->parent_module ?? 'Site Settings',
                'sub_module' => 'Site Settings',
                'sub_module_priority' => 1,
                'parent_module_priority' => $parent->parent_module_priority ?? 99,
                'show_in_sidebar' => 1,
                'show_in_sub_menu' => 1,
                'admin_right' => 0,
                'sub_menu_icon' => $parent->sub_menu_icon ?? 'activity-icon.svg',
                'logo' => $parent->logo ?? 'dashboard-icon.svg',
            ]);
        }
    }

    public function down()
    {
        // Keep site_settings slug; do not revert to broken Admin.
    }
}
