<?php

namespace App\Console\Commands;

use App\Models\Home;
use Illuminate\Console\Command;

class SeedHomePage extends Command
{
    protected $signature = 'home:seed-dottscale {--fresh : Delete existing home rows before insert}';

    protected $description = 'Seed DottScale home page content (copied from frontend home) into the home table';

    public function handle(): int
    {
        $payload = $this->homePayload();

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
                ],
            ]),
            'meta_og_image' => null,
        ];
    }
}
