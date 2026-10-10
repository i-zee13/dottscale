<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Add CMS fields for all home page sections currently hardcoded in the blade.
 */
class AddHomePageSectionCmsFields extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('home')) {
            return;
        }

        Schema::table('home', function (Blueprint $table) {
            $cols = [
                'stats_json' => 'longText',
                'services_eyebrow' => 'string',
                'services_heading' => 'string',
                'why_eyebrow' => 'string',
                'why_heading' => 'string',
                'why_json' => 'longText',
                'about_eyebrow' => 'string',
                'about_list_json' => 'longText',
                'process_eyebrow' => 'string',
                'process_heading' => 'string',
                'process_json' => 'longText',
                'proof_eyebrow' => 'string',
                'proof_heading' => 'string',
                'proof_json' => 'longText',
                'industries_eyebrow' => 'string',
                'industries_heading' => 'string',
                'industries_json' => 'longText',
                'visibility_eyebrow' => 'string',
                'visibility_heading' => 'string',
                'visibility_list_json' => 'longText',
                'visibility_cta_text' => 'string',
                'visibility_cta_link' => 'string',
                'visibility_card_title' => 'string',
                'visibility_card_subtitle' => 'string',
                'visibility_card_rating' => 'string',
                'cta_heading' => 'string',
                'cta_paragraph' => 'text',
                'cta_primary_text' => 'string',
                'cta_secondary_text' => 'string',
                'hero_cta_primary' => 'string',
                'hero_cta_secondary' => 'string',
            ];

            foreach ($cols as $name => $type) {
                if (Schema::hasColumn('home', $name)) {
                    continue;
                }
                if ($type === 'longText') {
                    $table->longText($name)->nullable();
                } elseif ($type === 'text') {
                    $table->text($name)->nullable();
                } else {
                    $table->string($name, 500)->nullable();
                }
            }
        });

        $this->seedDefaults();
    }

    public function down()
    {
        // Keep columns.
    }

    private function seedDefaults(): void
    {
        $payload = [
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
                'Austin market positioning',
                'Local search visibility',
                'Google Business Profile',
                'Search engine optimization',
                'Paid advertising',
                'Website conversion',
                'Reputation management',
                'Local customer acquisition',
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
                    'stats' => [
                        ['value' => '↑', 'label' => 'Local rankings'],
                        ['value' => '↑', 'label' => 'GBP calls'],
                    ],
                ],
                [
                    'client' => 'Client name — Industry, City',
                    'title' => 'Result headline goes here',
                    'text' => 'One or two lines on the problem and the strategy used to solve it.',
                    'stats' => [
                        ['value' => '—', 'label' => 'Organic traffic'],
                        ['value' => '—', 'label' => 'Leads'],
                    ],
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
                'Google Search & Maps rankings',
                'Google Business Profile optimization',
                'Reviews and reputation signals',
                'Local citations and listings',
                'Local landing pages built to convert',
            ]),
            'visibility_cta_text' => 'See our Local SEO service',
            'visibility_cta_link' => 'services/enterprise-solutions',
            'visibility_card_title' => 'Dott Scale',
            'visibility_card_subtitle' => 'Austin, Texas',
            'visibility_card_rating' => '★★★★★ 4.9 on Google · 40+ reviews',
            'cta_heading' => 'Ready to grow your business?',
            'cta_paragraph' => "Tell us about your business and we'll map out where the fastest wins are.",
            'cta_primary_text' => 'Book Your Free Strategy Call',
            'cta_secondary_text' => 'Explore Our Services',
            'hero_cta_primary' => 'Get a Free Strategy Call',
            'hero_cta_secondary' => 'Get Started',
            'updated_at' => now(),
        ];

        $filtered = [];
        foreach ($payload as $col => $val) {
            if (Schema::hasColumn('home', $col)) {
                $filtered[$col] = $val;
            }
        }

        if (empty($filtered) || DB::table('home')->count() === 0) {
            return;
        }

        DB::table('home')->orderBy('id')->limit(1)->update($filtered);
    }
}
