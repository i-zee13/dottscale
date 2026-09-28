<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

/**
 * Seed DottScale dummy CMS content: blog categories, blogs (with SEO + images),
 * FAQs, testimonials, contact_us, and client logos.
 */
class SeedDottscaleDummyContent extends Migration
{
    public function up()
    {
        $this->ensureBlogsSchema();
        $this->ensureClientLogoFiles();
        $this->seedBlogCategories();
        $this->seedBlogs();
        $this->seedFaqs();
        $this->seedTestimonials();
        $this->seedContactUs();
        $this->seedClientLogos();
        $this->refreshHomeImages();
    }

    public function down()
    {
        // Keep seeded content; do not wipe production-edited data.
    }

    private function ensureBlogsSchema(): void
    {
        if (!Schema::hasTable('blogs')) {
            return;
        }

        if (!Schema::hasColumn('blogs', 'short_description')) {
            Schema::table('blogs', function ($table) {
                $table->text('short_description')->nullable();
            });
        }
        if (!Schema::hasColumn('blogs', 'tags')) {
            Schema::table('blogs', function ($table) {
                $table->string('tags', 500)->nullable();
            });
        }
        if (!Schema::hasColumn('blogs', 'after_header_image')) {
            Schema::table('blogs', function ($table) {
                $table->string('after_header_image', 500)->nullable();
            });
        }
        if (!Schema::hasColumn('blogs', 'page_meta_tags')) {
            Schema::table('blogs', function ($table) {
                $table->longText('page_meta_tags')->nullable();
            });
        }
        if (!Schema::hasColumn('blogs', 'meta_og_image')) {
            Schema::table('blogs', function ($table) {
                $table->string('meta_og_image', 500)->nullable();
            });
        }
        if (!Schema::hasColumn('blogs', 'blog_type')) {
            Schema::table('blogs', function ($table) {
                $table->unsignedTinyInteger('blog_type')->nullable()->default(2);
            });
        }
        if (!Schema::hasColumn('blogs', 'published')) {
            Schema::table('blogs', function ($table) {
                $table->string('published', 10)->nullable()->default('1');
            });
        }
        if (!Schema::hasColumn('blogs', 'blog_category_id')) {
            Schema::table('blogs', function ($table) {
                $table->unsignedBigInteger('blog_category_id')->nullable();
            });
        }
    }

    private function onlyExisting(string $table, array $payload): array
    {
        $filtered = [];
        foreach ($payload as $column => $value) {
            if (Schema::hasColumn($table, $column)) {
                $filtered[$column] = $value;
            }
        }

        return $filtered;
    }

    private function seo(string $title, string $description, string $keywords): string
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

    private function ensureClientLogoFiles(): void
    {
        $map = [
            'danpak.png' => 'danpak.png',
            'shahi.jpg' => 'shahi.jpg',
            'spencer.png' => 'spencer.png',
            'orichem.png' => 'orichem.png',
            'logo-savoz.png' => 'logo-savoz.png',
            'finewater.png' => 'finewater.png',
        ];

        $destDir = storage_path('app/public/client_logos');
        if (!File::isDirectory($destDir)) {
            File::makeDirectory($destDir, 0755, true);
        }

        // Staging often serves public_html/storage directly
        $publicStorage = public_path('storage/client_logos');
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

    private function seedBlogCategories(): void
    {
        if (!Schema::hasTable('blog_categories')) {
            return;
        }

        $categories = [
            ['service_name' => 'Local SEO', 'publish' => '1'],
            ['service_name' => 'Google Ads', 'publish' => '1'],
            ['service_name' => 'Web Design', 'publish' => '1'],
            ['service_name' => 'Digital Marketing', 'publish' => '1'],
        ];

        foreach ($categories as $cat) {
            $exists = DB::table('blog_categories')->where('service_name', $cat['service_name'])->exists();
            if ($exists) {
                DB::table('blog_categories')->where('service_name', $cat['service_name'])->update([
                    'publish' => '1',
                    'updated_at' => now(),
                ]);
            } else {
                $row = $cat + ['created_at' => now(), 'updated_at' => now()];
                if (Schema::hasColumn('blog_categories', 'created_by')) {
                    $row['created_by'] = 1;
                }
                DB::table('blog_categories')->insert($row);
            }
        }
    }

    private function categoryId(string $name): ?int
    {
        if (!Schema::hasTable('blog_categories')) {
            return null;
        }
        $id = DB::table('blog_categories')->where('service_name', $name)->value('id');
        return $id ? (int) $id : null;
    }

    private function seedBlogs(): void
    {
        if (!Schema::hasTable('blogs')) {
            return;
        }

        $blogs = [
            [
                'title' => 'Local SEO Checklist for Service Businesses in 2026',
                'slug' => 'local-seo-checklist-for-service-businesses-2026',
                'tags' => 'local SEO, Google Business Profile, map pack, DottScale',
                'blog_date' => '2026-09-01',
                'short_description' => 'A practical local SEO checklist to rank in the Google Map Pack and turn nearby searches into real calls.',
                'after_header_image' => '/images/blog-01.jpg',
                'category' => 'Local SEO',
                'keywords' => 'local SEO, Google Business Profile, map pack, service business SEO',
                'details' => '<p>Local customers search with intent. When someone types “plumber near me” or “roof repair Austin,” they are ready to call.</p><p>DottScale helps contractors, clinics, and home-service brands win those searches with Google Business Profile optimization, citation cleanup, review velocity, and location pages that convert.</p><h2>What to fix first</h2><ul><li>Complete and verify your Google Business Profile</li><li>Match NAP data across directories</li><li>Publish service + city pages with proof and CTAs</li><li>Ask happy customers for fresh 5-star reviews</li></ul><p>Done right, local SEO becomes a steady pipeline—not a one-time campaign.</p>',
            ],
            [
                'title' => 'Google Ads That Bring Buyers, Not Just Clicks',
                'slug' => 'google-ads-that-bring-buyers-not-just-clicks',
                'tags' => 'Google Ads, PPC, lead generation, DottScale',
                'blog_date' => '2026-09-08',
                'short_description' => 'How DottScale structures Google Ads campaigns so every click has a chance to become a booked job or consultation.',
                'after_header_image' => '/images/blog-02.jpg',
                'category' => 'Google Ads',
                'keywords' => 'Google Ads, PPC, lead generation, search campaigns',
                'details' => '<p>Paid search works when intent, messaging, and landing pages align. Clicks alone are not success—calls and booked jobs are.</p><p>We build tight keyword groups, honest ad copy, conversion-focused landing pages, and weekly budget rules so waste drops and qualified leads rise.</p><h2>Our paid search playbook</h2><ul><li>Separate brand, service, and competitor intent</li><li>Send traffic to pages built for one offer</li><li>Track calls, forms, and booked appointments</li><li>Pause losers fast; scale winners weekly</li></ul>',
            ],
            [
                'title' => 'Website Design That Turns Visitors Into Leads',
                'slug' => 'website-design-that-turns-visitors-into-leads',
                'tags' => 'web design, conversion, UX, DottScale',
                'blog_date' => '2026-09-15',
                'short_description' => 'Fast, mobile-first websites designed for clarity, trust, and conversion—not just looks.',
                'after_header_image' => '/images/blog-03.jpg',
                'category' => 'Web Design',
                'keywords' => 'website design, conversion rate, mobile-first, lead generation websites',
                'details' => '<p>A beautiful site that confuses visitors is still a failed site. DottScale designs pages around one job: get the next call or form submit.</p><p>That means clear headlines, proof above the fold, fast load times on mobile, and CTAs that match the offer.</p><h2>Conversion essentials</h2><ul><li>Hero that states who you help and how</li><li>Trust signals: reviews, badges, before/after proof</li><li>Click-to-call and short forms on every key page</li><li>Core Web Vitals and mobile usability checks</li></ul>',
            ],
            [
                'title' => 'Reputation Management: Win Trust Before the First Call',
                'slug' => 'reputation-management-win-trust-before-the-first-call',
                'tags' => 'reputation management, reviews, brand trust, DottScale',
                'blog_date' => '2026-09-20',
                'short_description' => 'More 5-star reviews and smarter reply workflows so customers choose you first.',
                'after_header_image' => '/images/blog-detail-001.jpg',
                'category' => 'Digital Marketing',
                'keywords' => 'reputation management, Google reviews, online reputation, customer trust',
                'details' => '<p>Most buyers read reviews before they call. A thin or ignored profile quietly loses jobs to competitors.</p><p>We install simple review ask flows, response templates, and monitoring so your best customers become your best marketing.</p>',
            ],
            [
                'title' => 'Social Media That Supports SEO and Sales',
                'slug' => 'social-media-that-supports-seo-and-sales',
                'tags' => 'social media marketing, SEO, content, DottScale',
                'blog_date' => '2026-09-24',
                'short_description' => 'Consistent social presence that reinforces local rankings and keeps your brand visible between searches.',
                'after_header_image' => '/images/blog-hero-img.jpg',
                'category' => 'Digital Marketing',
                'keywords' => 'social media marketing, local SEO content, Facebook Instagram marketing',
                'details' => '<p>Social is not a vanity metric when it feeds proof, offers, and local relevance back into your SEO and ads.</p><p>DottScale plans content calendars around services, seasons, and review highlights—so every post supports growth.</p>',
            ],
            [
                'title' => 'How US Local Businesses Scale With DottScale',
                'slug' => 'how-us-local-businesses-scale-with-dottscale',
                'tags' => 'DottScale, local business growth, digital marketing agency',
                'blog_date' => '2026-09-26',
                'short_description' => 'From Austin to nationwide service brands—how we combine SEO, ads, and web to grow revenue without long contracts.',
                'after_header_image' => '/images/blogs/featured-img-listing-1504x550.webp',
                'category' => 'Digital Marketing',
                'keywords' => 'DottScale, local business marketing, Austin digital agency, grow local leads',
                'details' => '<p>Great operators often have the same problem: excellent service, weak online visibility.</p><p>We close that gap with local SEO, Google Ads, conversion-focused websites, and reputation systems—measured by calls and revenue, not vanity charts.</p>',
            ],
        ];

        foreach ($blogs as $blog) {
            $categoryId = $this->categoryId($blog['category']);
            $title = 'DottScale | ' . $blog['title'];
            $payload = $this->onlyExisting('blogs', [
                'title' => $blog['title'],
                'slug' => $blog['slug'],
                'tags' => $blog['tags'],
                'blog_date' => $blog['blog_date'],
                'short_description' => $blog['short_description'],
                'blog_details' => $blog['details'],
                'after_header_image' => $blog['after_header_image'],
                'image' => $blog['after_header_image'],
                'page_meta_tags' => $this->seo($title, $blog['short_description'], $blog['keywords']),
                'blog_category_id' => $categoryId,
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

    private function seedFaqs(): void
    {
        if (!Schema::hasTable('faqs')) {
            return;
        }

        $faqs = [
            [
                'question' => 'What services does DottScale offer?',
                'answer' => '<p>We provide local SEO, Google Business Profile optimization, website design, Google Ads, social media marketing, reputation management, and related digital growth services for local businesses.</p>',
            ],
            [
                'question' => 'Do you work with businesses outside Austin?',
                'answer' => '<p>Yes. We support local service businesses across the United States. Strategies are tailored to each market and service category.</p>',
            ],
            [
                'question' => 'How soon can we see results from local SEO?',
                'answer' => '<p>Some Google Business Profile improvements show within weeks. Competitive map-pack rankings usually take consistent work over a few months. We share clear milestones so progress is measurable.</p>',
            ],
            [
                'question' => 'Are there long contracts?',
                'answer' => '<p>We focus on clear scopes and results—not vague lock-ins. Engagement details are confirmed before work starts so expectations stay transparent.</p>',
            ],
            [
                'question' => 'Can DottScale rebuild our website and run ads together?',
                'answer' => '<p>Absolutely. Web, SEO, and ads work best as one system. We align landing pages, tracking, and campaigns so traffic converts into calls and booked jobs.</p>',
            ],
            [
                'question' => 'How do we get started?',
                'answer' => '<p>Contact us via the website form or email contact@dottscale.com. We review your visibility, competition, and goals, then propose a practical growth plan.</p>',
            ],
        ];

        foreach ($faqs as $faq) {
            $exists = DB::table('faqs')->where('question', $faq['question'])->exists();
            $row = $this->onlyExisting('faqs', [
                'faq_type' => 1,
                'page_id' => null,
                'question' => $faq['question'],
                'answer' => $faq['answer'],
                'status' => 1,
                'created_by' => 1,
                'updated_at' => now(),
            ]);
            if ($exists) {
                DB::table('faqs')->where('question', $faq['question'])->update($row);
            } else {
                if (Schema::hasColumn('faqs', 'created_at')) {
                    $row['created_at'] = now();
                }
                DB::table('faqs')->insert($row);
            }
        }
    }

    private function seedTestimonials(): void
    {
        if (!Schema::hasTable('testimonials')) {
            return;
        }

        $items = [
            [
                'author_name' => 'Jordan Miles',
                'author_description' => 'Owner, Miles Roofing',
                'review_content' => 'DottScale got us into the Google Map Pack in our main service cities. Calls are steadier and we finally know which ads pay for themselves.',
                'rating' => 5,
            ],
            [
                'author_name' => 'Priya Shah',
                'author_description' => 'Clinic Manager, Bright Smile Dental',
                'review_content' => 'Our new site loads fast on mobile and the booking form actually converts. The SEO updates brought patients who already trust the brand.',
                'rating' => 5,
            ],
            [
                'author_name' => 'Marcus Lee',
                'author_description' => 'Founder, Lee Home Services',
                'review_content' => 'Clear reporting, no jargon, and a team that treats our growth like their own. Reputation and Google Ads work finally feel connected.',
                'rating' => 5,
            ],
            [
                'author_name' => 'Elena Ortiz',
                'author_description' => 'Marketing Lead, CleanPro Austin',
                'review_content' => 'From Google Business Profile cleanup to weekly content, DottScale made our digital presence look as professional as our field crews.',
                'rating' => 5,
            ],
        ];

        foreach ($items as $item) {
            $exists = DB::table('testimonials')->where('author_name', $item['author_name'])->exists();
            $row = $this->onlyExisting('testimonials', $item + [
                'review_type' => 1,
                'status' => 1,
                'created_by' => 1,
                'updated_at' => now(),
            ]);
            if ($exists) {
                DB::table('testimonials')->where('author_name', $item['author_name'])->update($row);
            } else {
                if (Schema::hasColumn('testimonials', 'created_at')) {
                    $row['created_at'] = now();
                }
                DB::table('testimonials')->insert($row);
            }
        }
    }

    private function seedContactUs(): void
    {
        if (!Schema::hasTable('contact_us')) {
            return;
        }

        $meta = json_encode([
            [
                'meta_name_author' => 'author',
                'meta_name_keywords' => 'keyword',
                'meta_name_description' => 'description',
                'meta_content_author' => 'DottScale',
                'meta_content_keywords' => 'DottScale contact, digital marketing Austin, local SEO agency',
                'meta_content_description' => 'Contact DottScale for local SEO, Google Ads, websites, and digital marketing that grows real leads.',
                'meta_og_title' => 'Contact DottScale | Digital Growth Partner',
                'meta_og_description' => 'Talk with DottScale about SEO, ads, and websites built to grow local service businesses.',
            ],
        ]);

        $payload = $this->onlyExisting('contact_us', [
            'heading_one' => 'Let’s Grow Your Local Visibility',
            'heading_two' => 'Tell us about your business. We’ll map the fastest path to more calls, bookings, and revenue.',
            'page_meta_tags' => $meta,
            'created_by' => 1,
            'updated_at' => now(),
        ]);

        if (DB::table('contact_us')->count() > 0) {
            DB::table('contact_us')->orderBy('id')->limit(1)->update($payload);
        } else {
            if (Schema::hasColumn('contact_us', 'created_at')) {
                $payload['created_at'] = now();
            }
            DB::table('contact_us')->insert($payload);
        }
    }

    private function seedClientLogos(): void
    {
        if (!Schema::hasTable('client_logos')) {
            return;
        }

        $logos = [
            ['sequence' => 1, 'name' => 'Danpak', 'logo' => 'client_logos/danpak.png', 'alt_text' => 'Danpak logo'],
            ['sequence' => 2, 'name' => 'Shahi', 'logo' => 'client_logos/shahi.jpg', 'alt_text' => 'Shahi logo'],
            ['sequence' => 3, 'name' => 'Spencer', 'logo' => 'client_logos/spencer.png', 'alt_text' => 'Spencer logo'],
            ['sequence' => 4, 'name' => 'Orichem', 'logo' => 'client_logos/orichem.png', 'alt_text' => 'Orichem logo'],
            ['sequence' => 5, 'name' => 'Savoz', 'logo' => 'client_logos/logo-savoz.png', 'alt_text' => 'Savoz logo'],
            ['sequence' => 6, 'name' => 'Fine Water', 'logo' => 'client_logos/finewater.png', 'alt_text' => 'Fine Water logo'],
        ];

        foreach ($logos as $logo) {
            $exists = DB::table('client_logos')->where('name', $logo['name'])->exists();
            $row = $this->onlyExisting('client_logos', $logo + [
                'created_by' => 1,
                'updated_at' => now(),
                'created_at' => now(),
            ]);
            if ($exists) {
                unset($row['created_at']);
                DB::table('client_logos')->where('name', $logo['name'])->update($row);
            } else {
                DB::table('client_logos')->insert($row);
            }
        }
    }

    private function refreshHomeImages(): void
    {
        if (!Schema::hasTable('home')) {
            return;
        }

        $update = [];
        if (Schema::hasColumn('home', 'desktop_img')) {
            $update['desktop_img'] = '/images/hero-img01.webp';
        }
        if (Schema::hasColumn('home', 'tab_img')) {
            $update['tab_img'] = '/images/hero-img1440.webp';
        }
        if (Schema::hasColumn('home', 'mobile_img')) {
            $update['mobile_img'] = '/images/main-bg-mobile.webp';
        }
        if ($update) {
            DB::table('home')->update($update);
        }
    }
}
