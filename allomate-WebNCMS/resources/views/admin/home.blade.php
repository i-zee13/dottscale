@extends('layouts.app')
@section('content')

@php
    $hasData = !empty($data);
    $imgUrl = function ($path) {
        if (empty($path)) {
            return '';
        }
        if (str_starts_with($path, 'http') || str_starts_with($path, '/')) {
            return $path;
        }
        return '/storage/' . ltrim($path, '/');
    };
    $stats = $stats ?? [];
    $whyItems = $whyItems ?? [];
    $aboutList = $aboutList ?? [];
    $processItems = $processItems ?? [];
    $proofItems = $proofItems ?? [];
    $industries = $industries ?? [];
    $visibilityList = $visibilityList ?? [];
    $sectionOrder = $sectionOrder ?? [
        'hero' => 1, 'stats' => 2, 'services' => 3, 'why' => 4, 'about' => 5,
        'process' => 6, 'proof' => 7, 'industries' => 8, 'visibility' => 9, 'cta' => 10,
    ];
    $prio = function ($key) use ($sectionOrder) {
        return (int) ($sectionOrder[$key] ?? 1);
    };
    $defaultSchema = json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'ProfessionalService',
        'name' => 'Dott Scale',
        'url' => 'https://staging.dottscale.com',
        'description' => 'Digital marketing agency in Austin, TX — SEO, ads, websites, and reputation built to grow local businesses.',
        'areaServed' => 'Austin, TX',
        'telephone' => '+1 (512) 564-8959',
        'email' => 'contact@dottscale.com',
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    $meta_structure_tags = !empty($meta_structure_tags) ? $meta_structure_tags : $defaultSchema;
    while (count($stats) < 4) { $stats[] = ['value' => '', 'label' => '']; }
    while (count($whyItems) < 6) { $whyItems[] = ['title' => '', 'text' => '']; }
    while (count($aboutList) < 8) { $aboutList[] = ''; }
    while (count($processItems) < 4) { $processItems[] = ['n' => '', 'title' => '', 'text' => '']; }
    while (count($proofItems) < 2) { $proofItems[] = ['client' => '', 'title' => '', 'text' => '', 'stats' => [['value' => '', 'label' => ''], ['value' => '', 'label' => '']]]; }
    while (count($industries) < 7) { $industries[] = ''; }
    while (count($visibilityList) < 5) { $visibilityList[] = ''; }
@endphp

<div class="row mt-2 mb-3">
    <div class="col-lg-6 col-md-6 col-sm-6">
        <h2 class="_head01">Home <span>Page Management</span></h2>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
        <ol class="breadcrumb">
            <li><a href="javascript:void(0);"><span>Website Pages</span></a></li>
            <li><span>Home</span></li>
        </ol>
    </div>
</div>

<div class="row">
    <form id="form" enctype="multipart/form-data" class="">
        @csrf
        <input type="hidden" value="{{ $hasData ? $data->id : '' }}" name="id">

        {{-- Hero Section --}}
        <div class="col-12 mb-30">
            <div class="card">
                <div class="header d-flex justify-content-between align-items-center flex-wrap">
                    <h2 class="mb-0">Hero <span>Section</span></h2>
                    <div class="form-inline mt-2 mt-md-0">
                        <label class="mr-2 mb-0 font12">Priority</label>
                        <input type="number" min="1" class="form-control" style="width:90px" name="section_priority[hero]" value="{{ $prio('hero') }}">
                    </div>
                </div>
                <div class="body">
                    <div id="floating-label">
                        <div class="form-wrap p-0">
                            <div class="row">
                                <div class="col-md-12 PB-10">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Hero Heading *</label>
                                        <input type="text" class="form-control req" name="heading_1"
                                            placeholder="We Build Digital Systems That Grow Businesses"
                                            value="{{ $hasData ? $data->heading_1 : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-12 PB-10">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Hero Paragraph *</label>
                                        <textarea class="proTextarea req" rows="4" name="heading_2"
                                            placeholder="From FMCG to PropTech to eCommerce...">{{ $hasData ? $data->heading_2 : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 PB-10">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Primary CTA Text</label>
                                        <input type="text" class="form-control" name="hero_cta_primary"
                                            value="{{ $hasData ? ($data->hero_cta_primary ?? 'Get a Free Strategy Call') : 'Get a Free Strategy Call' }}">
                                    </div>
                                </div>
                                <div class="col-md-6 PB-10">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Secondary CTA Text</label>
                                        <input type="text" class="form-control" name="hero_cta_secondary"
                                            value="{{ $hasData ? ($data->hero_cta_secondary ?? 'Get Started') : 'Get Started' }}">
                                    </div>
                                </div>

                                <div class="col-md-4 PB-10">
                                    <div class="form-wrap p-0">
                                        <label class="font13 mb-5">Desktop Banner (1504 x 579) *</label>
                                        <input type="hidden" name="hidden_desktop_img"
                                            value="{{ $hasData ? $data->desktop_img : '' }}">
                                        <input type="file" name="desktop_img" class="dropify"
                                            data-old_input="hidden_desktop_img"
                                            data-default-file="{{ $imgUrl($hasData ? $data->desktop_img : '') }}"
                                            accept="image/*"
                                            data-allowed-file-extensions="jpg png jpeg JPEG webp WEBP"
                                            data-min-width="1503" data-max-width="1505"
                                            data-min-height="578" data-max-height="580" />
                                    </div>
                                </div>

                                <div class="col-md-4 PB-10">
                                    <div class="form-wrap p-0">
                                        <label class="font13 mb-5">Tablet Banner (1024 x 394) *</label>
                                        <input type="hidden" name="hidden_tab_img"
                                            value="{{ $hasData ? $data->tab_img : '' }}">
                                        <input type="file" name="tab_img" class="dropify"
                                            data-old_input="hidden_tab_img"
                                            data-default-file="{{ $imgUrl($hasData ? $data->tab_img : '') }}"
                                            accept="image/*"
                                            data-allowed-file-extensions="jpg png jpeg JPEG webp WEBP"
                                            data-min-width="1023" data-max-width="1025"
                                            data-min-height="393" data-max-height="395" />
                                    </div>
                                </div>

                                <div class="col-md-4 PB-10">
                                    <div class="form-wrap p-0">
                                        <label class="font13 mb-5">Mobile Banner (480 x 768) *</label>
                                        <input type="hidden" name="hidden_mobile_img"
                                            value="{{ $hasData ? $data->mobile_img : '' }}">
                                        <input type="file" name="mobile_img" class="dropify"
                                            data-old_input="hidden_mobile_img"
                                            data-default-file="{{ $imgUrl($hasData ? $data->mobile_img : '') }}"
                                            accept="image/*"
                                            data-allowed-file-extensions="jpg png jpeg JPEG webp WEBP"
                                            data-min-width="479" data-max-width="481"
                                            data-min-height="767" data-max-height="769" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- About Section --}}
        <div class="col-12 mb-30">
            <div class="card">
                <div class="header d-flex justify-content-between align-items-center flex-wrap">
                    <h2 class="mb-0">About <span>Section</span></h2>
                    <div class="form-inline mt-2 mt-md-0">
                        <label class="mr-2 mb-0 font12">Priority</label>
                        <input type="number" min="1" class="form-control" style="width:90px" name="section_priority[about]" value="{{ $prio('about') }}">
                    </div>
                </div>
                <div class="body">
                    <div id="floating-label">
                        <div class="form-wrap p-0">
                            <div class="row">
                                <div class="col-md-6 PB-10">
                                    <div class="form-group">
                                        <label class="control-label mb-10">Eyebrow</label>
                                        <input type="text" class="form-control" name="about_eyebrow"
                                            value="{{ $hasData ? ($data->about_eyebrow ?? 'Local to Austin') : 'Local to Austin' }}">
                                    </div>
                                </div>
                                <div class="col-md-6 PB-10">
                                    <div class="form-group">
                                        <label class="control-label mb-10">About Heading *</label>
                                        <input type="text" class="form-control req" name="large_heading"
                                            placeholder="Driven by Real Business Impact"
                                            value="{{ $hasData ? $data->large_heading : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-12 PB-10">
                                    <label class="font12">About Paragraph *</label>
                                    <textarea class="proTextarea req" rows="5" name="paragraph"
                                        placeholder="We are not here to sell code...">{{ $hasData ? $data->paragraph : '' }}</textarea>
                                </div>
                                <div class="col-md-12 PB-10">
                                    <label class="font12">About List Items</label>
                                    <div class="row">
                                        @foreach($aboutList as $i => $item)
                                        <div class="col-md-6 PB-10">
                                            <input type="text" class="form-control" name="about_list[{{ $i }}]" value="{{ is_array($item) ? ($item['label'] ?? '') : $item }}">
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-6 PB-10">
                                    <div class="form-group">
                                        <label class="control-label mb-10">CTA Button Text *</label>
                                        <input type="text" class="form-control req" name="award_heading"
                                            placeholder="Learn More About Us"
                                            value="{{ $hasData ? $data->award_heading : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6 PB-10">
                                    <div class="form-wrap p-0">
                                        <label class="font13 mb-5">About Image (1000 x 1000) *</label>
                                        <input type="hidden" name="hidden_award_img"
                                            value="{{ $hasData ? $data->award_img : '' }}">
                                        <input type="file" name="award_img" class="dropify"
                                            data-old_input="hidden_award_img"
                                            data-default-file="{{ $imgUrl($hasData ? $data->award_img : '') }}"
                                            accept="image/*"
                                            data-allowed-file-extensions="jpg png jpeg JPEG webp WEBP"
                                            data-min-width="999" data-max-width="1001"
                                            data-min-height="999" data-max-height="1001" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Stats --}}
        <div class="col-12 mb-30">
            <div class="card">
                <div class="header d-flex justify-content-between align-items-center flex-wrap">
                    <h2 class="mb-0">Stats <span>Section</span></h2>
                    <div class="form-inline mt-2 mt-md-0">
                        <label class="mr-2 mb-0 font12">Priority</label>
                        <input type="number" min="1" class="form-control" style="width:90px" name="section_priority[stats]" value="{{ $prio('stats') }}">
                    </div>
                </div>
                <div class="body">
                    <div class="row">
                        @foreach($stats as $i => $stat)
                        <div class="col-md-3 PB-10">
                            <div class="form-group">
                                <label class="control-label mb-10">Stat {{ $i + 1 }} Value</label>
                                <input type="text" class="form-control" name="stats[{{ $i }}][value]" value="{{ $stat['value'] ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-10">Stat {{ $i + 1 }} Label</label>
                                <input type="text" class="form-control" name="stats[{{ $i }}][label]" value="{{ $stat['label'] ?? '' }}">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Services intro --}}
        <div class="col-12 mb-30">
            <div class="card">
                <div class="header d-flex justify-content-between align-items-center flex-wrap">
                    <h2 class="mb-0">Services <span>Section Intro</span></h2>
                    <div class="form-inline mt-2 mt-md-0">
                        <label class="mr-2 mb-0 font12">Priority</label>
                        <input type="number" min="1" class="form-control" style="width:90px" name="section_priority[services]" value="{{ $prio('services') }}">
                    </div>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-md-4 PB-10">
                            <div class="form-group">
                                <label class="control-label mb-10">Eyebrow</label>
                                <input type="text" class="form-control" name="services_eyebrow" value="{{ $hasData ? ($data->services_eyebrow ?? 'What we do') : 'What we do' }}">
                            </div>
                        </div>
                        <div class="col-md-8 PB-10">
                            <div class="form-group">
                                <label class="control-label mb-10">Heading</label>
                                <input type="text" class="form-control" name="services_heading" value="{{ $hasData ? ($data->services_heading ?? '') : '' }}">
                            </div>
                        </div>
                        <div class="col-md-12"><p class="text-muted mb-0">Service cards are managed under <strong>Website Services</strong>.</p></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Why --}}
        <div class="col-12 mb-30">
            <div class="card">
                <div class="header d-flex justify-content-between align-items-center flex-wrap">
                    <h2 class="mb-0">Why <span>Dott Scale</span></h2>
                    <div class="form-inline mt-2 mt-md-0">
                        <label class="mr-2 mb-0 font12">Priority</label>
                        <input type="number" min="1" class="form-control" style="width:90px" name="section_priority[why]" value="{{ $prio('why') }}">
                    </div>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-md-4 PB-10">
                            <div class="form-group">
                                <label class="control-label mb-10">Eyebrow</label>
                                <input type="text" class="form-control" name="why_eyebrow" value="{{ $hasData ? ($data->why_eyebrow ?? '') : '' }}">
                            </div>
                        </div>
                        <div class="col-md-8 PB-10">
                            <div class="form-group">
                                <label class="control-label mb-10">Heading</label>
                                <input type="text" class="form-control" name="why_heading" value="{{ $hasData ? ($data->why_heading ?? '') : '' }}">
                            </div>
                        </div>
                        @foreach($whyItems as $i => $item)
                        <div class="col-md-6 PB-10">
                            <div class="form-group">
                                <label class="control-label mb-10">Card {{ $i + 1 }} Title</label>
                                <input type="text" class="form-control" name="why[{{ $i }}][title]" value="{{ $item['title'] ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-10">Card {{ $i + 1 }} Text</label>
                                <textarea class="form-control" rows="2" name="why[{{ $i }}][text]">{{ $item['text'] ?? '' }}</textarea>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Process --}}
        <div class="col-12 mb-30">
            <div class="card">
                <div class="header d-flex justify-content-between align-items-center flex-wrap">
                    <h2 class="mb-0">Process <span>Section</span></h2>
                    <div class="form-inline mt-2 mt-md-0">
                        <label class="mr-2 mb-0 font12">Priority</label>
                        <input type="number" min="1" class="form-control" style="width:90px" name="section_priority[process]" value="{{ $prio('process') }}">
                    </div>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-md-4 PB-10">
                            <div class="form-group">
                                <label class="control-label mb-10">Eyebrow</label>
                                <input type="text" class="form-control" name="process_eyebrow" value="{{ $hasData ? ($data->process_eyebrow ?? '') : '' }}">
                            </div>
                        </div>
                        <div class="col-md-8 PB-10">
                            <div class="form-group">
                                <label class="control-label mb-10">Heading</label>
                                <input type="text" class="form-control" name="process_heading" value="{{ $hasData ? ($data->process_heading ?? '') : '' }}">
                            </div>
                        </div>
                        @foreach($processItems as $i => $item)
                        <div class="col-md-6 PB-10">
                            <div class="form-group">
                                <label class="control-label mb-10">Step {{ $i + 1 }} Number</label>
                                <input type="text" class="form-control" name="process[{{ $i }}][n]" value="{{ $item['n'] ?? str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-10">Step {{ $i + 1 }} Title</label>
                                <input type="text" class="form-control" name="process[{{ $i }}][title]" value="{{ $item['title'] ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-10">Step {{ $i + 1 }} Text</label>
                                <textarea class="form-control" rows="2" name="process[{{ $i }}][text]">{{ $item['text'] ?? '' }}</textarea>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Proof --}}
        <div class="col-12 mb-30">
            <div class="card">
                <div class="header d-flex justify-content-between align-items-center flex-wrap">
                    <h2 class="mb-0">Proof <span>Section</span></h2>
                    <div class="form-inline mt-2 mt-md-0">
                        <label class="mr-2 mb-0 font12">Priority</label>
                        <input type="number" min="1" class="form-control" style="width:90px" name="section_priority[proof]" value="{{ $prio('proof') }}">
                    </div>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-md-4 PB-10">
                            <div class="form-group">
                                <label class="control-label mb-10">Eyebrow</label>
                                <input type="text" class="form-control" name="proof_eyebrow" value="{{ $hasData ? ($data->proof_eyebrow ?? '') : '' }}">
                            </div>
                        </div>
                        <div class="col-md-8 PB-10">
                            <div class="form-group">
                                <label class="control-label mb-10">Heading</label>
                                <input type="text" class="form-control" name="proof_heading" value="{{ $hasData ? ($data->proof_heading ?? '') : '' }}">
                            </div>
                        </div>
                        @foreach($proofItems as $i => $item)
                        <div class="col-md-6 PB-10">
                            <div class="form-group">
                                <label class="control-label mb-10">Case {{ $i + 1 }} Client</label>
                                <input type="text" class="form-control" name="proof[{{ $i }}][client]" value="{{ $item['client'] ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-10">Case {{ $i + 1 }} Title</label>
                                <input type="text" class="form-control" name="proof[{{ $i }}][title]" value="{{ $item['title'] ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-10">Case {{ $i + 1 }} Text</label>
                                <textarea class="form-control" rows="3" name="proof[{{ $i }}][text]">{{ $item['text'] ?? '' }}</textarea>
                            </div>
                            @php $pStats = $item['stats'] ?? [['value'=>'','label'=>''],['value'=>'','label'=>'']]; @endphp
                            @foreach(array_slice(array_pad($pStats, 2, ['value'=>'','label'=>'']), 0, 2) as $si => $ps)
                            <div class="row">
                                <div class="col-md-6 PB-10">
                                    <input type="text" class="form-control" name="proof[{{ $i }}][stats][{{ $si }}][value]" placeholder="Stat value" value="{{ $ps['value'] ?? '' }}">
                                </div>
                                <div class="col-md-6 PB-10">
                                    <input type="text" class="form-control" name="proof[{{ $i }}][stats][{{ $si }}][label]" placeholder="Stat label" value="{{ $ps['label'] ?? '' }}">
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Industries --}}
        <div class="col-12 mb-30">
            <div class="card">
                <div class="header d-flex justify-content-between align-items-center flex-wrap">
                    <h2 class="mb-0">Industries <span>Section</span></h2>
                    <div class="form-inline mt-2 mt-md-0">
                        <label class="mr-2 mb-0 font12">Priority</label>
                        <input type="number" min="1" class="form-control" style="width:90px" name="section_priority[industries]" value="{{ $prio('industries') }}">
                    </div>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-md-4 PB-10">
                            <div class="form-group">
                                <label class="control-label mb-10">Eyebrow</label>
                                <input type="text" class="form-control" name="industries_eyebrow" value="{{ $hasData ? ($data->industries_eyebrow ?? '') : '' }}">
                            </div>
                        </div>
                        <div class="col-md-8 PB-10">
                            <div class="form-group">
                                <label class="control-label mb-10">Heading</label>
                                <input type="text" class="form-control" name="industries_heading" value="{{ $hasData ? ($data->industries_heading ?? '') : '' }}">
                            </div>
                        </div>
                        @foreach($industries as $i => $label)
                        <div class="col-md-4 PB-10">
                            <input type="text" class="form-control" name="industries[{{ $i }}]" value="{{ is_array($label) ? ($label['label'] ?? '') : $label }}" placeholder="Industry {{ $i + 1 }}">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Local visibility --}}
        <div class="col-12 mb-30">
            <div class="card">
                <div class="header d-flex justify-content-between align-items-center flex-wrap">
                    <h2 class="mb-0">Local <span>Visibility</span></h2>
                    <div class="form-inline mt-2 mt-md-0">
                        <label class="mr-2 mb-0 font12">Priority</label>
                        <input type="number" min="1" class="form-control" style="width:90px" name="section_priority[visibility]" value="{{ $prio('visibility') }}">
                    </div>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-md-4 PB-10">
                            <div class="form-group">
                                <label class="control-label mb-10">Eyebrow</label>
                                <input type="text" class="form-control" name="visibility_eyebrow" value="{{ $hasData ? ($data->visibility_eyebrow ?? '') : '' }}">
                            </div>
                        </div>
                        <div class="col-md-8 PB-10">
                            <div class="form-group">
                                <label class="control-label mb-10">Heading</label>
                                <input type="text" class="form-control" name="visibility_heading" value="{{ $hasData ? ($data->visibility_heading ?? '') : '' }}">
                            </div>
                        </div>
                        @foreach($visibilityList as $i => $item)
                        <div class="col-md-6 PB-10">
                            <input type="text" class="form-control" name="visibility_list[{{ $i }}]" value="{{ is_array($item) ? ($item['label'] ?? '') : $item }}" placeholder="List item {{ $i + 1 }}">
                        </div>
                        @endforeach
                        <div class="col-md-6 PB-10">
                            <div class="form-group">
                                <label class="control-label mb-10">CTA Text</label>
                                <input type="text" class="form-control" name="visibility_cta_text" value="{{ $hasData ? ($data->visibility_cta_text ?? '') : '' }}">
                            </div>
                        </div>
                        <div class="col-md-6 PB-10">
                            <div class="form-group">
                                <label class="control-label mb-10">CTA Link</label>
                                <input type="text" class="form-control" name="visibility_cta_link" value="{{ $hasData ? ($data->visibility_cta_link ?? '') : '' }}">
                            </div>
                        </div>
                        <div class="col-md-4 PB-10">
                            <div class="form-group">
                                <label class="control-label mb-10">Card Title</label>
                                <input type="text" class="form-control" name="visibility_card_title" value="{{ $hasData ? ($data->visibility_card_title ?? '') : '' }}">
                            </div>
                        </div>
                        <div class="col-md-4 PB-10">
                            <div class="form-group">
                                <label class="control-label mb-10">Card Subtitle</label>
                                <input type="text" class="form-control" name="visibility_card_subtitle" value="{{ $hasData ? ($data->visibility_card_subtitle ?? '') : '' }}">
                            </div>
                        </div>
                        <div class="col-md-4 PB-10">
                            <div class="form-group">
                                <label class="control-label mb-10">Card Rating Text</label>
                                <input type="text" class="form-control" name="visibility_card_rating" value="{{ $hasData ? ($data->visibility_card_rating ?? '') : '' }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bottom CTA --}}
        <div class="col-12 mb-30">
            <div class="card">
                <div class="header d-flex justify-content-between align-items-center flex-wrap">
                    <h2 class="mb-0">Bottom <span>CTA</span></h2>
                    <div class="form-inline mt-2 mt-md-0">
                        <label class="mr-2 mb-0 font12">Priority</label>
                        <input type="number" min="1" class="form-control" style="width:90px" name="section_priority[cta]" value="{{ $prio('cta') }}">
                    </div>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-md-12 PB-10">
                            <div class="form-group">
                                <label class="control-label mb-10">Heading</label>
                                <input type="text" class="form-control" name="cta_heading" value="{{ $hasData ? ($data->cta_heading ?? '') : '' }}">
                            </div>
                        </div>
                        <div class="col-md-12 PB-10">
                            <div class="form-group">
                                <label class="control-label mb-10">Paragraph</label>
                                <textarea class="proTextarea" rows="3" name="cta_paragraph">{{ $hasData ? ($data->cta_paragraph ?? '') : '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6 PB-10">
                            <div class="form-group">
                                <label class="control-label mb-10">Primary Button</label>
                                <input type="text" class="form-control" name="cta_primary_text" value="{{ $hasData ? ($data->cta_primary_text ?? '') : '' }}">
                            </div>
                        </div>
                        <div class="col-md-6 PB-10">
                            <div class="form-group">
                                <label class="control-label mb-10">Secondary Button</label>
                                <input type="text" class="form-control" name="cta_secondary_text" value="{{ $hasData ? ($data->cta_secondary_text ?? '') : '' }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Meta Content --}}
        <div class="col-12 mb-30">
            <div class="card">
                <div class="header">
                    <h2>SEO <span>Meta Details</span></h2>
                </div>
                <div class="body">
                    <div id="floating-label">
                        <div class="form-wrap p-0">
                            <div class="row">
                                <input type="hidden" id="meta_name_author" value="author" name="meta_name_author">
                                <input type="hidden" id="meta_name_keywords" value="keyword" name="meta_name_keywords">
                                <input type="hidden" id="meta_name_description" value="description" name="meta_name_description">
                                <div class="col-md-4 PB-10">
                                    <label class="font12">Meta Content (Author)</label>
                                    <textarea class="proTextarea" rows="2" id="meta_content_author" name="meta_content_author">{{ @$meta_content_author }}</textarea>
                                </div>
                                <div class="col-md-4 PB-10">
                                    <label class="font12">Meta Content (Keywords)</label>
                                    <textarea class="proTextarea" rows="2" id="meta_content_keywords" name="meta_content_keywords">{{ @$meta_content_keywords }}</textarea>
                                </div>
                                <div class="col-md-4 PB-10">
                                    <label class="font12">Meta Content (Description)</label>
                                    <textarea class="proTextarea" rows="2" id="meta_content_description" name="meta_content_description">{{ @$meta_content_description }}</textarea>
                                </div>
                                <div class="col-md-4 PB-10">
                                    <label class="font12">OG Title</label>
                                    <textarea class="proTextarea" rows="2" id="meta_og_title" name="meta_og_title">{{ @$meta_og_title }}</textarea>
                                </div>
                                <div class="col-md-8 PB-10">
                                    <label class="font12">OG Description</label>
                                    <textarea class="proTextarea" rows="2" id="meta_og_description" name="meta_og_description">{{ @$meta_og_description }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-wrap p-0">
                                        <label class="font13 mb-5">OG Image (1200 x 630)</label>
                                        <input type="hidden" name="hidden_og_image" value="{{ $hasData ? $data->meta_og_image : '' }}">
                                        <input type="file" id="meta_og_image" name="meta_og_image" class="dropify"
                                            data-old_input="hidden_og_image"
                                            data-default-file="{{ $imgUrl($hasData ? $data->meta_og_image : '') }}"
                                            accept="image/*"
                                            data-allowed-file-extensions="jpg png jpeg JPEG webp WEBP"
                                            data-min-width="1199" data-max-width="1201"
                                            data-min-height="629" data-max-height="631" />
                                    </div>
                                </div>
                                <div class="col-md-12 PB-10">
                                    <label class="font12">Schema / Structured Data (JSON-LD)</label>
                                    <textarea class="form-control" rows="10" id="meta_structure_tags" name="meta_structure_tags" placeholder='{"@context":"https://schema.org","@type":"ProfessionalService",...}'>{{ $meta_structure_tags }}</textarea>
                                    <small class="text-muted">Paste valid JSON-LD. Shown in page &lt;head&gt; as application/ld+json.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 text-center PT-15">
            <button type="button" class="btn btn-primary mr-2 save_form">Save</button>
        </div>
    </form>
</div>

@endsection
@push('js')
<script src="{{ asset('js/custom/home.js') }}"></script>
@endpush
