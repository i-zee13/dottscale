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
            'heading_1' => 'We Build Digital Systems That Grow Businesses',
            'heading_2' => "From FMCG to PropTech to eCommerce. Outcomes, not buzzwords.\nOur work replaces inefficiency with clarity. Complexity with control. Ideas with working systems.",
            'desktop_img' => 'media/Allomate-Cover-image02_1755588868.webp',
            'tab_img' => 'media/Allomate-Cover-image02_1755588868.webp',
            'mobile_img' => 'media/new-banner-image-mobile02_1755588914.webp',
            'large_heading' => 'Driven by Real Business Impact',
            'paragraph' => 'We are not here to sell code. We are here to solve problems that matter. Since 2017, we have built systems that fuel growth, improve efficiency, and redefine how businesses operate across FMCG, PropTech, eCommerce, and law.',
            'award_heading' => 'Learn More About Us',
            'award_img' => '/images/testimonials-img.png',
            'page_meta_tags' => json_encode([
                [
                    'meta_name_author' => 'author',
                    'meta_name_keywords' => 'keyword',
                    'meta_name_description' => 'description',
                    'meta_content_author' => 'DottScale',
                    'meta_content_keywords' => 'enterprise software, web development, mobile apps, MVP, AI, automation, DottScale',
                    'meta_content_description' => 'DottScale builds enterprise software, web & mobile apps, MVPs, AI and automation. Driving growth, efficiency, and digital transformation.',
                    'meta_og_title' => 'DottScale | Business Transformation Through Tech',
                    'meta_og_description' => 'DottScale helps businesses move forward with enterprise software, web & mobile apps, AI, automation, and dedicated teams. Results, not buzzwords.',
                ],
            ]),
            'meta_og_image' => null,
        ];
    }
}
