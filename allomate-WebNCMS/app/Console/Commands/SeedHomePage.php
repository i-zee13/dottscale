<?php

namespace App\Console\Commands;

use App\Models\Home;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class SeedHomePage extends Command
{
    protected $signature = 'home:seed-dottscale {--fresh : Delete existing home rows before insert}';

    protected $description = 'Seed DottScale home page content (copied from frontend home) into the home table';

    public function handle(): int
    {
        $payload = array_filter(
            $this->homePayload(),
            fn ($_, $col) => Schema::hasColumn('home', $col),
            ARRAY_FILTER_USE_BOTH
        );

        if ($this->option('fresh')) {
            Home::query()->delete();
            $this->warn('Existing home rows deleted.');
        }

        $home = Home::query()->first();
        if ($home) {
            $home->fill($payload);
            $home->updated_by = $home->updated_by ?: 1;
            $home->save();
            $this->info('Home page content updated (id: ' . $home->id . ').');
        } else {
            $payload['created_by'] = 1;
            $payload['updated_by'] = 1;
            $home = Home::create($payload);
            $this->info('Home page content inserted (id: ' . $home->id . ').');
        }

        $this->line('heading_1: ' . $home->heading_1);
        $this->line('large_heading: ' . $home->large_heading);

        return self::SUCCESS;
    }

    private function homePayload(): array
    {
        // Exact copy from resources/views/frontend/home.blade.php (+ SEO sections)
        return [
            'heading_1' => 'Digital Marketing Agency in Austin, TX',
            'heading_2' => 'We help businesses grow through SEO, web development, paid advertising, social media, reputation management, branding, and AI automation.',
            'desktop_img' => '/images/hero-img01.webp',
            'tab_img' => '/images/hero-img1440.webp',
            'mobile_img' => '/images/main-bg-mobile.webp',
            'large_heading' => 'Digital marketing for businesses in Austin, TX',
            'paragraph' => "Austin's business market is crowded and search-driven — customers decide who to call largely based on who shows up first in Google Search and Maps. We build that visibility from the ground up: a Google Business Profile that ranks, a website that converts once someone clicks, and a reputation that holds up under scrutiny. Local SEO and paid advertising work together so you're found in the moment someone's ready to hire, and every channel feeds a website built to close the deal, not just collect a visit.",
            'award_heading' => 'Learn More About Us',
            'award_img' => '/images/testimonials-img.png',
            'hero_cta_primary' => 'Get a Free Strategy Call',
            'hero_cta_secondary' => 'Get Started',
            'stats_json' => json_encode([
                ['value' => '40+', 'label' => 'Businesses helped'],
                ['value' => '5+', 'label' => 'Years of experience'],
                ['value' => '120+', 'label' => 'Projects completed'],
                ['value' => '4.9★', 'label' => 'Average client rating'],
            ]),
            'services_eyebrow' => 'What we do',
            'services_heading' => 'Digital marketing services for Austin businesses',
            'why_eyebrow' => 'Why Dott Scale',
            'why_heading' => 'A growth partner, not just another marketing agency',
            'why_json' => json_encode([
                ['title' => 'Strategy before execution', 'text' => 'We map the plan before we touch a single ad or page.'],
                ['title' => 'Data-driven decisions', 'text' => 'Every move is backed by numbers, not guesswork.'],
                ['title' => 'SEO, paid, and web working together', 'text' => 'Channels are built to reinforce each other, not compete.'],
                ['title' => 'Transparent reporting', 'text' => "You'll always know what's working and what isn't."],
                ['title' => 'Conversion-focused approach', 'text' => "Traffic that doesn't turn into calls isn't the goal."],
                ['title' => 'Scalable systems', 'text' => 'Built to grow with you, from one market to many.'],
            ]),
            'about_eyebrow' => 'Local to Austin',
            'about_list_json' => json_encode([
                'Austin market positioning', 'Local search visibility', 'Google Business Profile', 'Search engine optimization',
                'Paid advertising', 'Website conversion', 'Reputation management', 'Local customer acquisition',
            ]),
            'process_eyebrow' => 'Process',
            'process_heading' => 'How we grow your business',
            'process_json' => json_encode([
                ['n' => '01', 'title' => 'Discover', 'text' => 'Understand your business, market, competitors, and goals.'],
                ['n' => '02', 'title' => 'Build', 'text' => 'Website, SEO foundations, campaigns, branding, and systems.'],
                ['n' => '03', 'title' => 'Optimize', 'text' => 'Use data to improve rankings, traffic, leads, and conversions.'],
                ['n' => '04', 'title' => 'Scale', 'text' => 'Expand the strategies and channels that are proving out.'],
            ]),
            'proof_eyebrow' => 'Proof',
            'proof_heading' => 'Results that speak for themselves',
            'proof_json' => json_encode([
                [
                    'client' => 'V-Fix Phone Repair — Berkeley, CA',
                    'title' => 'From invisible on Maps to booked walk-ins',
                    'text' => 'A local SEO and GBP overhaul rebuilt visibility for a phone repair shop competing against national chains.',
                    'stats' => [['value' => '↑', 'label' => 'Local rankings'], ['value' => '↑', 'label' => 'GBP calls']],
                ],
                [
                    'client' => 'Client name — Industry, City',
                    'title' => 'Result headline goes here',
                    'text' => 'One or two lines on the problem and the strategy used to solve it.',
                    'stats' => [['value' => '—', 'label' => 'Organic traffic'], ['value' => '—', 'label' => 'Leads']],
                ],
            ]),
            'industries_eyebrow' => 'Who we work with',
            'industries_heading' => 'Industries we serve',
            'industries_json' => json_encode([
                'Home Services', 'Professional Services', 'Local Businesses', 'E-commerce', 'Healthcare', 'Real Estate', 'B2B',
            ]),
            'visibility_eyebrow' => 'Local visibility',
            'visibility_heading' => 'Get found where Austin customers are searching',
            'visibility_list_json' => json_encode([
                'Google Search & Maps rankings', 'Google Business Profile optimization', 'Reviews and reputation signals',
                'Local citations and listings', 'Local landing pages built to convert',
            ]),
            'visibility_cta_text' => 'See our Local SEO service',
            'visibility_cta_link' => 'services/local-seo',
            'visibility_card_title' => 'Dott Scale',
            'visibility_card_subtitle' => 'Austin, Texas',
            'visibility_card_rating' => '★★★★★ 4.9 on Google · 40+ reviews',
            'cta_heading' => 'Ready to grow your business?',
            'cta_paragraph' => "Tell us about your business and we'll map out where the fastest wins are.",
            'cta_primary_text' => 'Book Your Free Strategy Call',
            'cta_secondary_text' => 'Explore Our Services',
            'sections_order_json' => json_encode([
                'hero' => 1, 'stats' => 2, 'services' => 3, 'why' => 4, 'about' => 5,
                'process' => 6, 'proof' => 7, 'industries' => 8, 'visibility' => 9, 'cta' => 10,
            ]),
            'page_meta_tags' => json_encode([
                [
                    'meta_name_author' => 'author',
                    'meta_name_keywords' => 'keyword',
                    'meta_name_description' => 'description',
                    'meta_content_author' => 'Dott Scale',
                    'meta_content_keywords' => 'Dott Scale, digital marketing agency Austin, local SEO, Google Ads, web design, Austin TX',
                    'meta_content_description' => 'We help businesses grow through SEO, web development, paid advertising, social media, reputation management, branding, and AI automation.',
                    'meta_og_title' => 'Dott Scale — Digital Marketing Agency in Austin, TX',
                    'meta_og_description' => 'Digital marketing agency in Austin, TX — SEO, ads, websites, and reputation built to grow local businesses.',
                    'meta_structure_tags' => json_encode([
                        '@context' => 'https://schema.org',
                        '@type' => 'ProfessionalService',
                        'name' => 'Dott Scale',
                        'url' => 'https://staging.dottscale.com',
                        'description' => 'Digital marketing agency in Austin, TX — SEO, ads, websites, and reputation built to grow local businesses.',
                        'areaServed' => 'Austin, TX',
                        'telephone' => '+1 (512) 564-8959',
                        'email' => 'contact@dottscale.com',
                    ], JSON_UNESCAPED_SLASHES),
                ],
            ]),
            'meta_og_image' => null,
        ];
    }
}
