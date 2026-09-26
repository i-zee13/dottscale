<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Replace Allomate-copied SEO title/description with unique DottScale copy.
 * Old title matched Allomate ("Business Transformation Through Tech") in browser history.
 */
class UpdateDottscaleSeoAwayFromAllomate extends Migration
{
    private const TITLE = 'DottScale | Boost Your Digital Impact';
    private const META_DESCRIPTION = 'DottScale helps local businesses get found on Google and grow with SEO, Google Ads, websites, and social media marketing.';
    private const OG_DESCRIPTION = 'Your technology success partner for local SEO, paid ads, web design, and digital marketing that drives real leads.';
    private const KEYWORDS = 'DottScale, local SEO, Google Ads, digital marketing, web development, social media marketing, reputation management';

    public function up()
    {
        if (Schema::hasTable('organization') && Schema::hasColumn('organization', 'page_meta_tags')) {
            DB::table('organization')->update([
                'page_meta_tags' => json_encode([
                    'page_title' => self::TITLE,
                    'meta_description' => self::META_DESCRIPTION,
                    'meta_og_title' => self::TITLE,
                    'meta_og_description' => self::OG_DESCRIPTION,
                    'meta_keywords' => self::KEYWORDS,
                    'meta_og_image' => '/images/dottscale-logo-alt.png',
                    'is_indexable' => '1',
                    'is_followable' => '1',
                ]),
            ]);
        }

        if (Schema::hasTable('home') && Schema::hasColumn('home', 'page_meta_tags')) {
            $homeMeta = json_encode([
                [
                    'meta_name_author' => 'author',
                    'meta_name_keywords' => 'keyword',
                    'meta_name_description' => 'description',
                    'meta_content_author' => 'DottScale',
                    'meta_content_keywords' => self::KEYWORDS,
                    'meta_content_description' => self::META_DESCRIPTION,
                    'meta_og_title' => self::TITLE,
                    'meta_og_description' => self::OG_DESCRIPTION,
                ],
            ]);

            DB::table('home')->update(['page_meta_tags' => $homeMeta]);
        }
    }

    public function down()
    {
        // Intentionally empty — do not restore Allomate-copied SEO.
    }
}
