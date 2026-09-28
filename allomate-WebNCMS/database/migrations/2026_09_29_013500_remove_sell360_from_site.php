<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Remove SELL360 Sales Platform from menus / CMS controllers.
 */
class RemoveSell360FromSite extends Migration
{
    public function up()
    {
        if (Schema::hasTable('controllers')) {
            $slugs = [
                'sell360-sales-platform',
                'sell360',
                'SELL360',
                'sell-360',
            ];

            $query = DB::table('controllers')->where(function ($q) use ($slugs) {
                foreach ($slugs as $slug) {
                    $q->orWhere('controller', $slug)
                        ->orWhere('controller', 'like', '%' . $slug . '%');
                }
                $q->orWhere('made_up_name', 'like', '%SELL360%')
                    ->orWhere('made_up_name', 'like', '%Sell360%')
                    ->orWhere('made_up_name', 'like', '%sell360%')
                    ->orWhere('sub_module', 'like', '%SELL360%')
                    ->orWhere('sub_module', 'like', '%sell360%');
            });

            $controllers = $query->pluck('controller')->filter()->unique()->values()->all();
            $ids = DB::table('controllers')->where(function ($q) use ($slugs) {
                foreach ($slugs as $slug) {
                    $q->orWhere('controller', $slug)
                        ->orWhere('controller', 'like', '%' . $slug . '%');
                }
                $q->orWhere('made_up_name', 'like', '%SELL360%')
                    ->orWhere('made_up_name', 'like', '%Sell360%')
                    ->orWhere('made_up_name', 'like', '%sell360%')
                    ->orWhere('sub_module', 'like', '%SELL360%')
                    ->orWhere('sub_module', 'like', '%sell360%');
            })->pluck('id')->all();

            if (Schema::hasTable('access_rights') && !empty($controllers)) {
                DB::table('access_rights')->whereIn('controller_right', $controllers)->delete();
            }

            if (!empty($ids)) {
                DB::table('controllers')->whereIn('id', $ids)->delete();
            }
        }

        if (Schema::hasTable('footer_content')) {
            $rows = DB::table('footer_content')->get();
            foreach ($rows as $row) {
                $updated = false;
                $menu = $row->footer_menu ?? null;
                if (!$menu) {
                    continue;
                }
                $decoded = json_decode($menu, true);
                if (!is_array($decoded)) {
                    continue;
                }
                $filtered = array_values(array_filter($decoded, function ($item) use (&$updated) {
                    $url = strtolower((string) ($item['url'] ?? ''));
                    $title = strtolower((string) ($item['title'] ?? ''));
                    if (str_contains($url, 'sell360') || str_contains($title, 'sell360') || str_contains($title, 'sell 360')) {
                        $updated = true;
                        return false;
                    }
                    return true;
                }));
                if ($updated) {
                    DB::table('footer_content')->where('id', $row->id)->update([
                        'footer_menu' => json_encode($filtered),
                    ]);
                }
            }
        }
    }

    public function down()
    {
        // Intentionally empty — do not restore SELL360.
    }
}
