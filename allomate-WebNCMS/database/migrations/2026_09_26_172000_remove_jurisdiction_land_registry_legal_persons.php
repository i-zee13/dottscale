<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Remove Business Contacts sub-items:
 * Jurisdiction, Land Registry Offices, Legal Persons
 * (menu-only leftovers from law CRM — no CMS controllers exist).
 */
class RemoveJurisdictionLandRegistryLegalPersons extends Migration
{
    private array $menuMatchers = [
        'jurisdiction',
        'land registry',
        'land-registry',
        'land_registry',
        'legal person',
        'legal-person',
        'legal_person',
        'legal persons',
    ];

    public function up()
    {
        if (!Schema::hasTable('controllers')) {
            return;
        }

        $rows = DB::table('controllers')
            ->where(function ($q) {
                foreach ($this->menuMatchers as $needle) {
                    $like = '%' . $needle . '%';
                    $q->orWhere('parent_module', 'like', $like)
                        ->orWhere('made_up_name', 'like', $like)
                        ->orWhere('sub_module', 'like', $like)
                        ->orWhere('controller', 'like', $like);
                }
            })
            ->get(['id', 'controller']);

        $controllers = $rows->pluck('controller')->filter()->unique()->values()->all();
        $ids = $rows->pluck('id')->all();

        if (Schema::hasTable('access_rights') && !empty($controllers)) {
            DB::table('access_rights')->whereIn('controller_right', $controllers)->delete();
        }

        if (!empty($ids)) {
            DB::table('controllers')->whereIn('id', $ids)->delete();
        }
    }

    public function down()
    {
        // Destructive — not reversible.
    }
}
