<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SeedDottscaleAdminMenu extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('controllers')) {
            return;
        }

        $items = [
            ['controller' => 'index', 'made_up_name' => 'Dashboard', 'parent_module' => 'Dashboard', 'sub_module' => 'Dashboard', 'sub_module_priority' => 1, 'parent_module_priority' => 1],
            ['controller' => 'organization', 'made_up_name' => 'Organization', 'parent_module' => 'Organization', 'sub_module' => 'Organization', 'sub_module_priority' => 1, 'parent_module_priority' => 2],
            ['controller' => 'profile', 'made_up_name' => 'Profile', 'parent_module' => 'Organization', 'sub_module' => 'Profile', 'sub_module_priority' => 2, 'parent_module_priority' => 2],
            ['controller' => 'portfolios', 'made_up_name' => 'Portfolios', 'parent_module' => 'Service Areas', 'sub_module' => 'Portfolios', 'sub_module_priority' => 1, 'parent_module_priority' => 3],
            ['controller' => 'blog-categories', 'made_up_name' => 'Blog Categories', 'parent_module' => 'Blogs', 'sub_module' => 'Categories', 'sub_module_priority' => 1, 'parent_module_priority' => 4],
            ['controller' => 'add-blog', 'made_up_name' => 'Add Blog', 'parent_module' => 'Blogs', 'sub_module' => 'Add New', 'sub_module_priority' => 2, 'parent_module_priority' => 4],
            ['controller' => 'blogs', 'made_up_name' => 'Blogs', 'parent_module' => 'Blogs', 'sub_module' => 'List', 'sub_module_priority' => 3, 'parent_module_priority' => 4],
            ['controller' => 'leads', 'made_up_name' => 'Leads', 'parent_module' => 'Leads', 'sub_module' => 'Leads', 'sub_module_priority' => 1, 'parent_module_priority' => 5],
            ['controller' => 'subscriptions', 'made_up_name' => 'Subscriptions', 'parent_module' => 'Leads', 'sub_module' => 'Subscriptions', 'sub_module_priority' => 2, 'parent_module_priority' => 5],
            ['controller' => 'contact-us', 'made_up_name' => 'Contact Us', 'parent_module' => 'Website Pages', 'sub_module' => 'Contact Us', 'sub_module_priority' => 1, 'parent_module_priority' => 7],
            ['controller' => 'faqs', 'made_up_name' => 'FAQs', 'parent_module' => 'Website Pages', 'sub_module' => 'FAQs', 'sub_module_priority' => 2, 'parent_module_priority' => 7],
            ['controller' => 'privacy-policy', 'made_up_name' => 'Privacy Policy', 'parent_module' => 'Website Pages', 'sub_module' => 'Privacy Policy', 'sub_module_priority' => 3, 'parent_module_priority' => 7],
            ['controller' => 'terms-of-use', 'made_up_name' => 'Terms of Use', 'parent_module' => 'Website Pages', 'sub_module' => 'Terms of Use', 'sub_module_priority' => 4, 'parent_module_priority' => 7],
            ['controller' => 'reviews-list', 'made_up_name' => 'Testimonials', 'parent_module' => 'Website Pages', 'sub_module' => 'Testimonials', 'sub_module_priority' => 5, 'parent_module_priority' => 7],
            ['controller' => 'left-menu', 'made_up_name' => 'Left Menu', 'parent_module' => 'Website Pages', 'sub_module' => 'Left Menu', 'sub_module_priority' => 6, 'parent_module_priority' => 7],
            ['controller' => 'right-menu', 'made_up_name' => 'Right Menu', 'parent_module' => 'Website Pages', 'sub_module' => 'Right Menu', 'sub_module_priority' => 7, 'parent_module_priority' => 7],
            ['controller' => 'footer-content', 'made_up_name' => 'Footer', 'parent_module' => 'Website Pages', 'sub_module' => 'Footer', 'sub_module_priority' => 8, 'parent_module_priority' => 7],
            ['controller' => 'theme-config-css', 'made_up_name' => 'Theme CSS', 'parent_module' => 'Website Pages', 'sub_module' => 'Theme CSS', 'sub_module_priority' => 9, 'parent_module_priority' => 7],
        ];

        $nextId = ((int) DB::table('controllers')->max('id')) + 1;

        foreach ($items as $item) {
            $exists = DB::table('controllers')->where('controller', $item['controller'])->exists();
            if ($exists) {
                DB::table('controllers')->where('controller', $item['controller'])->update([
                    'made_up_name' => $item['made_up_name'],
                    'parent_module' => $item['parent_module'],
                    'sub_module' => $item['sub_module'],
                    'sub_module_priority' => $item['sub_module_priority'],
                    'parent_module_priority' => $item['parent_module_priority'],
                    'show_in_sidebar' => 1,
                    'show_in_sub_menu' => 1,
                ]);
                continue;
            }

            DB::table('controllers')->insert([
                'id' => $nextId++,
                'controller' => $item['controller'],
                'made_up_name' => $item['made_up_name'],
                'parent_module' => $item['parent_module'],
                'sub_module' => $item['sub_module'],
                'sub_module_priority' => $item['sub_module_priority'],
                'parent_module_priority' => $item['parent_module_priority'],
                'show_in_sidebar' => 1,
                'show_in_sub_menu' => 1,
                'admin_right' => 0,
                'sub_menu_icon' => 'activity-icon.svg',
                'logo' => 'dashboard-icon.svg',
            ]);
        }
    }

    public function down()
    {
        // Keep seeded rows; they are CMS menu data.
    }
}
