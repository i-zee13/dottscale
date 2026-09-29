<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class DottscaleCmsSeeder
{
    public static function run(): void
    {
        self::ensurePortfolioFiles();
        self::seedServices();
        self::seedPortfolios();
        self::seedAbout();
        self::seedBlogCategoriesAndPosts();
        self::seedControllersMenu();
    }

    public static function onlyExisting(string $table, array $payload): array
    {
        $filtered = [];
        foreach ($payload as $column => $value) {
            if (Schema::hasColumn($table, $column)) {
                $filtered[$column] = $value;
            }
        }

        return $filtered;
    }

    public static function seo(string $title, string $description, string $keywords): string
    {
        return json_encode([
            'page_title' => $title,
            'meta_content_author' => 'DottScale',
            'meta_tag_name' => 'DottScale',
            'meta_keywords' => $keywords,
            'meta_description' => $description,
            'meta_og_title' => $title,
            'meta_og_description' => $description,
            'meta_structure_tags' => '',
            'is_indexable' => '1',
            'is_followable' => '1',
            'meta_og_image' => null,
        ]);
    }

    private static function ensurePortfolioFiles(): void
    {
        $map = [
            'khan-law.png' => 'khan-law.png',
            'anamkhan.jpg' => 'anamkhan.jpg',
            'vapesuite.jpg' => 'vapesuite.jpg',
            'bni.svg' => 'bni.svg',
            'work-img-001.jpg' => 'work-img-001.jpg',
            'work-img-002.jpg' => 'work-img-002.jpg',
            'work-img-003.jpg' => 'work-img-003.jpg',
        ];

        $destDir = storage_path('app/public/portfolios');
        if (!File::isDirectory($destDir)) {
            File::makeDirectory($destDir, 0755, true);
        }

        $publicStorage = public_path('storage/portfolios');
        if (!File::isDirectory($publicStorage)) {
            File::makeDirectory($publicStorage, 0755, true);
        }

        foreach ($map as $srcName => $destName) {
            $src = public_path('images/' . $srcName);
            if (!File::exists($src)) {
                continue;
            }
            File::copy($src, $destDir . '/' . $destName);
            File::copy($src, $publicStorage . '/' . $destName);
        }
    }

    private static function seedServices(): void
    {
        if (!Schema::hasTable('services')) {
            return;
        }

        $services = [
            [
                'service_name' => 'Website Design & Development',
                'slug' => 'website-design-development',
                'description' => 'Fast, conversion-focused websites built to turn visitors into calls.',
                'icon' => '/cms-uploads/mobile-app.svg',
                'route' => 'services/web-and-mobile-development',
                'sort_order' => 1,
            ],
            [
                'service_name' => 'Local SEO',
                'slug' => 'local-seo',
                'description' => 'Rank higher in Google Search and Maps for the terms your customers use.',
                'icon' => '/cms-uploads/chart.svg',
                'route' => 'services/enterprise-solutions',
                'sort_order' => 2,
            ],
            [
                'service_name' => 'PPC Advertising',
                'slug' => 'ppc-advertising',
                'description' => 'Google and Meta Ads managed for cost-per-lead, not just clicks.',
                'icon' => '/cms-uploads/cube.svg',
                'route' => 'services/mvp-design-and-development',
                'sort_order' => 3,
            ],
            [
                'service_name' => 'Social Media Marketing',
                'slug' => 'social-media-marketing',
                'description' => 'Consistent content and management that builds trust before the call.',
                'icon' => '/cms-uploads/teamwork.svg',
                'route' => 'services/dedicated-teams',
                'sort_order' => 4,
            ],
            [
                'service_name' => 'Graphic Design & Branding',
                'slug' => 'graphic-design-branding',
                'description' => 'A visual identity that looks credible the moment someone lands on it.',
                'icon' => '/cms-uploads/warranty.svg',
                'route' => 'services/quality-assurance',
                'sort_order' => 5,
            ],
            [
                'service_name' => 'Google Business Profile',
                'slug' => 'google-business-profile',
                'description' => 'Optimization, ranking, and ongoing management of your GBP listing.',
                'icon' => '/cms-uploads/chart.svg',
                'route' => 'services/enterprise-solutions',
                'sort_order' => 6,
            ],
            [
                'service_name' => 'Reputation Management',
                'slug' => 'reputation-management',
                'description' => 'More reviews, better ratings, and a cleaner presence across platforms.',
                'icon' => '/cms-uploads/warranty.svg',
                'route' => 'services/quality-assurance',
                'sort_order' => 7,
            ],
            [
                'service_name' => 'AI Automation',
                'slug' => 'ai-automation',
                'description' => 'Automated lead follow-up, customer service, and workflow systems.',
                'icon' => '/cms-uploads/artificial-intelligence.svg',
                'route' => 'services/ai-and-automation',
                'sort_order' => 8,
            ],
        ];

        foreach ($services as $svc) {
            $row = self::onlyExisting('services', $svc + [
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'updated_at' => now(),
            ]);
            $exists = DB::table('services')->where('service_name', $svc['service_name'])->exists();
            if ($exists) {
                unset($row['created_by']);
                DB::table('services')->where('service_name', $svc['service_name'])->update($row);
            } else {
                if (Schema::hasColumn('services', 'created_at')) {
                    $row['created_at'] = now();
                }
                DB::table('services')->insert($row);
            }
        }
    }

    private static function seedPortfolios(): void
    {
        if (!Schema::hasTable('portfolios')) {
            return;
        }

        $items = [
            [
                'portfolio_name' => 'Khan Law',
                'page_route' => 'our-work/khan-law',
                'page_title' => 'Khan Law',
                'thumbnail' => 'portfolios/khan-law.png',
            ],
            [
                'portfolio_name' => 'Vape Suite',
                'page_route' => 'our-work/vape-suite',
                'page_title' => 'Vape Suite',
                'thumbnail' => 'portfolios/vapesuite.jpg',
            ],
            [
                'portfolio_name' => 'Bni Inks',
                'page_route' => 'our-work/bni-inks',
                'page_title' => 'Bni Inks',
                'thumbnail' => 'portfolios/bni.svg',
            ],
            [
                'portfolio_name' => 'Source Code Academia',
                'page_route' => 'our-work/source-code-academia',
                'page_title' => 'Source Code Academia',
                'thumbnail' => 'portfolios/work-img-002.jpg',
            ],
            [
                'portfolio_name' => 'Green Earth Recycling',
                'page_route' => 'our-work/green-earth-recyling',
                'page_title' => 'Green Earth Recycling',
                'thumbnail' => 'portfolios/work-img-003.jpg',
            ],
        ];

        // Prefer anamkhan if khan-law.png missing
        if (!File::exists(storage_path('app/public/portfolios/khan-law.png'))
            && File::exists(storage_path('app/public/portfolios/anamkhan.jpg'))) {
            $items[0]['thumbnail'] = 'portfolios/anamkhan.jpg';
        }
        if (!File::exists(storage_path('app/public/portfolios/bni.svg'))
            && File::exists(storage_path('app/public/portfolios/work-img-001.jpg'))) {
            $items[2]['thumbnail'] = 'portfolios/work-img-001.jpg';
        }

        foreach ($items as $item) {
            $row = self::onlyExisting('portfolios', $item + [
                'status' => 1,
                'is_slider_show' => 1,
                'categories' => null,
                'created_by' => 1,
                'updated_by' => 1,
                'updated_at' => now(),
            ]);
            $exists = DB::table('portfolios')->where('page_route', $item['page_route'])->exists();
            if ($exists) {
                unset($row['created_by']);
                DB::table('portfolios')->where('page_route', $item['page_route'])->update($row);
            } else {
                if (Schema::hasColumn('portfolios', 'created_at')) {
                    $row['created_at'] = now();
                }
                DB::table('portfolios')->insert($row);
            }
        }
    }

    private static function seedAbout(): void
    {
        if (!Schema::hasTable('abouts')) {
            return;
        }

        $values = [
            [
                'title' => 'Clarity',
                'text' => 'We cut through complexity. Every solution is built to make work easier, not harder.',
                'icon' => '/cms-uploads/60530ab46fdb6959ecf07aa8778a1201579f7a6e/magic.svg',
            ],
            [
                'title' => 'Trust',
                'text' => 'Partnerships last when they are grounded in honesty, transparency, and reliability.',
                'icon' => '/cms-uploads/43a92a814547fb60b29fe301bd94c1e8f7302757/protection-(1).svg',
            ],
            [
                'title' => 'Impact',
                'text' => 'Technology is only as good as the results it delivers. We measure success in growth, efficiency, and lasting change.',
                'icon' => '/cms-uploads/ebf906a4a27643ae60e03cf3bf8cb86200fbfd59/line-chart.svg',
            ],
            [
                'title' => 'Evolution',
                'text' => 'We never stand still. We learn, adapt, and scale alongside our clients so their systems stay future ready.',
                'icon' => '/cms-uploads/25198f4fc413e36379b256627c34aeca15f998b1/sync.svg',
            ],
        ];

        $payload = self::onlyExisting('abouts', [
            'heading_1' => 'We Build What Moves Business Forward',
            'heading_2' => 'Since 2017, we’ve partnered with businesses to build platforms that unlock growth, improve efficiency, and reshape the way they work.',
            'cta_text' => 'Start Your Transformation',
            'story_eyebrow' => 'Our story',
            'story_heading' => 'How DottScale Came to Life',
            'story_p1' => 'DottScale was born from a simple idea. Technology should make business simpler, not more complicated. In 2017 we saw companies struggling with heavy systems, scattered processes, and missed opportunities. We knew there was a better path forward. One where digital transformation meant real impact, not just talk.',
            'story_p2' => 'From the start our focus has been on building platforms that remove friction, unlock growth, and give businesses clarity. Every product we deliver is shaped by that belief and backed by the promise that we will stay to support, improve, and scale. That is how we continue to help businesses move forward with confidence.',
            'belief_title' => 'Belief',
            'belief_text' => 'We believe technology should serve people and make work feel effortless.',
            'direction_title' => 'Direction',
            'direction_text' => 'We design and build systems that deliver measurable results in growth, efficiency, and decision making.',
            'promise_title' => 'Promise',
            'promise_text' => 'We remain partners long after launch, ensuring your technology keeps creating value as your business evolves.',
            'values_intro' => 'What guides us isn’t just code. It’s the principles that shape how we work, how we build, and how we partner with every client.',
            'values_json' => json_encode($values),
            'page_meta_tags' => json_encode([
                [
                    'meta_name_author' => 'author',
                    'meta_name_keywords' => 'keyword',
                    'meta_name_description' => 'description',
                    'meta_content_author' => 'DottScale',
                    'meta_content_keywords' => 'DottScale, about us, digital marketing Austin',
                    'meta_content_description' => 'DottScale helps local businesses get found on Google and grow with SEO, Google Ads, websites, and social media marketing.',
                    'meta_og_title' => 'About Us | DottScale',
                    'meta_og_description' => 'We Build What Moves Business Forward',
                ],
            ]),
            'meta_og_image' => null,
            'created_by' => 1,
            'updated_by' => 1,
            'updated_at' => now(),
        ]);

        if (DB::table('abouts')->count() > 0) {
            unset($payload['created_by']);
            DB::table('abouts')->orderBy('id')->limit(1)->update($payload);
        } else {
            if (Schema::hasColumn('abouts', 'created_at')) {
                $payload['created_at'] = now();
            }
            DB::table('abouts')->insert($payload);
        }
    }

    private static function seedBlogCategoriesAndPosts(): void
    {
        if (!Schema::hasTable('blog_categories')) {
            return;
        }

        $categories = [
            'Website Design & Development',
            'Local SEO',
            'PPC Advertising',
            'Social Media Marketing',
            'Graphic Design & Branding',
            'Google Business Profile',
            'Reputation Management',
            'AI Automation',
        ];

        foreach ($categories as $name) {
            $exists = DB::table('blog_categories')->where('service_name', $name)->exists();
            if ($exists) {
                DB::table('blog_categories')->where('service_name', $name)->update([
                    'publish' => '1',
                    'updated_at' => now(),
                ]);
            } else {
                $row = ['service_name' => $name, 'publish' => '1', 'created_at' => now(), 'updated_at' => now()];
                if (Schema::hasColumn('blog_categories', 'created_by')) {
                    $row['created_by'] = 1;
                }
                DB::table('blog_categories')->insert($row);
            }
        }

        if (!Schema::hasTable('blogs')) {
            return;
        }

        $blogs = [
            [
                'title' => 'Why Conversion-Focused Web Design Beats Pretty Pages',
                'slug' => 'conversion-focused-web-design-beats-pretty-pages',
                'category' => 'Website Design & Development',
                'tags' => 'web design, conversion, DottScale',
                'blog_date' => '2026-09-10',
                'short_description' => 'How DottScale builds websites that turn Austin visitors into booked calls.',
                'after_header_image' => '/images/blog-01.jpg',
                'keywords' => 'website design Austin, conversion websites, web development',
                'details' => '<p>Pretty is not enough. DottScale designs sites around one job: get the next call or form submit.</p><p>Clear headlines, proof above the fold, and mobile-first CTAs turn traffic into revenue.</p>',
            ],
            [
                'title' => 'Map Pack Rankings for Local Service Brands',
                'slug' => 'map-pack-rankings-for-local-service-brands',
                'category' => 'Local SEO',
                'tags' => 'local SEO, map pack, GBP',
                'blog_date' => '2026-09-12',
                'short_description' => 'Practical steps to win the Google Map Pack in competitive local markets.',
                'after_header_image' => '/images/blog-02.jpg',
                'keywords' => 'local SEO, Google Map Pack, Google Business Profile',
                'details' => '<p>Local intent searches convert. We fix NAP, optimize GBP, and publish service+city pages that rank.</p>',
            ],
            [
                'title' => 'PPC Campaigns Built for Cost Per Lead',
                'slug' => 'ppc-campaigns-built-for-cost-per-lead',
                'category' => 'PPC Advertising',
                'tags' => 'Google Ads, Meta Ads, PPC',
                'blog_date' => '2026-09-14',
                'short_description' => 'Structure Google and Meta Ads so every click has a chance to become a booked job.',
                'after_header_image' => '/images/blog-03.jpg',
                'keywords' => 'PPC advertising, Google Ads, Meta Ads, lead generation',
                'details' => '<p>Tight keyword groups, honest ad copy, and conversion landing pages cut waste fast.</p>',
            ],
            [
                'title' => 'Social Content That Supports SEO and Sales',
                'slug' => 'social-content-that-supports-seo-and-sales',
                'category' => 'Social Media Marketing',
                'tags' => 'social media, content calendar',
                'blog_date' => '2026-09-16',
                'short_description' => 'Consistent social presence that reinforces local rankings between searches.',
                'after_header_image' => '/images/blog-detail-001.jpg',
                'keywords' => 'social media marketing, Facebook Instagram, local SEO content',
                'details' => '<p>Content calendars around services, seasons, and reviews keep the brand visible.</p>',
            ],
            [
                'title' => 'Brand Identity That Wins Trust Instantly',
                'slug' => 'brand-identity-that-wins-trust-instantly',
                'category' => 'Graphic Design & Branding',
                'tags' => 'branding, graphic design',
                'blog_date' => '2026-09-18',
                'short_description' => 'Visual systems that look credible the moment someone lands on your site.',
                'after_header_image' => '/images/blog-detail-002.jpg',
                'keywords' => 'graphic design, branding, brand identity',
                'details' => '<p>Logo, color, and layout choices that signal professionalism before the first sentence.</p>',
            ],
            [
                'title' => 'Google Business Profile Optimization Checklist',
                'slug' => 'google-business-profile-optimization-checklist',
                'category' => 'Google Business Profile',
                'tags' => 'GBP, Google Business Profile',
                'blog_date' => '2026-09-20',
                'short_description' => 'Complete GBP setup and ongoing management that drives map visibility.',
                'after_header_image' => '/images/blog-detail-003.jpg',
                'keywords' => 'Google Business Profile, GBP optimization, local listings',
                'details' => '<p>Photos, categories, posts, and review velocity keep your listing competitive.</p>',
            ],
            [
                'title' => 'Review Systems That Protect Your Reputation',
                'slug' => 'review-systems-that-protect-your-reputation',
                'category' => 'Reputation Management',
                'tags' => 'reviews, reputation',
                'blog_date' => '2026-09-22',
                'short_description' => 'Ask flows and reply workflows so customers choose you first.',
                'after_header_image' => '/images/blog-hero-img.jpg',
                'keywords' => 'reputation management, Google reviews, online reputation',
                'details' => '<p>More 5-star reviews and smarter replies turn trust into booked jobs.</p>',
            ],
            [
                'title' => 'AI Automation for Lead Follow-Up',
                'slug' => 'ai-automation-for-lead-follow-up',
                'category' => 'AI Automation',
                'tags' => 'AI, automation, workflows',
                'blog_date' => '2026-09-25',
                'short_description' => 'Automate lead follow-up, customer service, and workflow systems.',
                'after_header_image' => '/images/blog-hero-img-002.jpg',
                'keywords' => 'AI automation, lead follow-up, workflow automation',
                'details' => '<p>Speed-to-lead wins deals. Automations keep every inquiry answered without burnout.</p>',
            ],
        ];

        foreach ($blogs as $blog) {
            $categoryId = DB::table('blog_categories')->where('service_name', $blog['category'])->value('id');
            $title = 'DottScale | ' . $blog['title'];
            $payload = self::onlyExisting('blogs', [
                'title' => $blog['title'],
                'slug' => $blog['slug'],
                'tags' => $blog['tags'],
                'blog_date' => $blog['blog_date'],
                'short_description' => $blog['short_description'],
                'blog_details' => $blog['details'],
                'after_header_image' => $blog['after_header_image'],
                'image' => $blog['after_header_image'],
                'page_meta_tags' => self::seo($title, $blog['short_description'], $blog['keywords']),
                'blog_category_id' => $categoryId ? (int) $categoryId : null,
                'blog_type' => 2,
                'published' => '1',
                'meta_og_image' => null,
                'user_id' => 1,
                'created_by' => 1,
                'updated_at' => now(),
            ]);

            $existing = DB::table('blogs')->where('slug', $blog['slug'])->first();
            if ($existing) {
                DB::table('blogs')->where('id', $existing->id)->update($payload);
            } else {
                if (Schema::hasColumn('blogs', 'created_at')) {
                    $payload['created_at'] = now();
                }
                DB::table('blogs')->insert($payload);
            }
        }
    }

    private static function seedControllersMenu(): void
    {
        if (!Schema::hasTable('controllers')) {
            return;
        }

        $items = [
            [
                'controller' => 'website-services',
                'made_up_name' => 'Website Services',
                'parent_module' => 'Website Pages',
                'sub_module' => 'Services',
                'sub_module_priority' => 0,
                'parent_module_priority' => 7,
            ],
            [
                'controller' => 'about-us',
                'made_up_name' => 'About Us',
                'parent_module' => 'Website Pages',
                'sub_module' => 'About Us',
                'sub_module_priority' => 0,
                'parent_module_priority' => 7,
            ],
            [
                'controller' => 'home',
                'made_up_name' => 'Home Page',
                'parent_module' => 'Website Pages',
                'sub_module' => 'Home',
                'sub_module_priority' => 0,
                'parent_module_priority' => 7,
            ],
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
}
