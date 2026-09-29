<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Replace remaining Allomate branding in org/user display names.
 */
class ReplaceAllomateBrandingWithDottscale extends Migration
{
    public function up()
    {
        if (Schema::hasTable('organization')) {
            $cols = ['name', 'company_name', 'organization_name', 'title'];
            foreach ($cols as $col) {
                if (!Schema::hasColumn('organization', $col)) {
                    continue;
                }
                DB::table('organization')
                    ->where($col, 'like', '%Allomate%')
                    ->update([$col => DB::raw("REPLACE(`{$col}`, 'Allomate', 'DottScale')")]);
            }
        }

        if (Schema::hasTable('users') && Schema::hasColumn('users', 'name')) {
            DB::table('users')
                ->where('name', 'like', '%Allomate%')
                ->update(['name' => DB::raw("REPLACE(`name`, 'Allomate', 'DottScale')")]);
        }
    }

    public function down()
    {
        // Keep DottScale branding.
    }
}
