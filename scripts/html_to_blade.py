#!/usr/bin/env python3
"""Split scraped HTML into Laravel Blade layout + page views."""
from __future__ import annotations

import re
from html import unescape
from pathlib import Path

SITE = Path("/Users/mab/Zee/Projects/dottscale/site")
CMS = Path("/Users/mab/Zee/Projects/dottscale/allomate-WebNCMS")
VIEWS = CMS / "resources" / "views"
LAYOUT_DIR = VIEWS / "layouts" / "Frontend"
PARTIALS = LAYOUT_DIR / "partials"
FRONTEND = VIEWS / "frontend"

SKIP_PAGES = {"home"}  # same markup as site/index.html


def extract(html: str, pattern: str, flags=re.S) -> str:
    match = re.search(pattern, html, flags)
    if not match:
        raise ValueError(f"Pattern not found: {pattern[:80]}")
    return match.group(1).strip()


def meta_content(html: str, name: str) -> str:
    match = re.search(
        rf'<meta name="{name}" content="([^"]*)"',
        html,
        re.I,
    )
    return unescape(match.group(1)) if match else ""


def og_content(html: str, prop: str) -> str:
    match = re.search(
        rf'<meta property="{prop}" content="([^"]*)"',
        html,
        re.I,
    )
    return unescape(match.group(1)) if match else ""


def page_map() -> list[tuple[str, Path]]:
    pages = []
    for html_path in sorted(SITE.rglob("index.html")):
        rel = html_path.relative_to(SITE).parent
        key = "" if rel == Path(".") else str(rel)
        if key == "home":
            continue
        view = "home" if key == "" else key
        if view in ("career", "our-work"):
            view = f"{view}/index"
        pages.append((view, html_path))
    return pages


def write(path: Path, contents: str) -> None:
    path.parent.mkdir(parents=True, exist_ok=True)
    path.write_text(contents.rstrip() + "\n", encoding="utf-8")
    print(f"wrote {path.relative_to(CMS)}")


def main() -> None:
    source = (SITE / "index.html").read_text(encoding="utf-8", errors="replace")

    menu = extract(
        source,
        r'(<div class="mil-menu-frame.*?</div>\s*</div>\s*</div>)',
    )
    header = extract(source, r'(<header id="top-header".*?</header>)')
    footer = extract(source, r'(<footer\b.*?</footer>)')
    scripts = extract(
        source,
        r'(<script src="/js/frontend/jquery-3.4.0.min.js".*?)</body>',
    )
    bg = extract(
        source,
        r'(<img src="/images/hero-img01\.webp.*?<div class="overlay first all-page"></div>)',
    )
    org_input = extract(source, r'(<input type="hidden"[^>]*id="organization-detail"[^>]*>)')
    app_url = extract(source, r'(<input type="hidden"[^>]*id="app_url"[^>]*>)')
    page_id = extract(source, r'(<input type="hidden"[^>]*id="pagebuilder_page_id"[^>]*>)')

    # Keep public-root paths (/css /js /images). Blade @ in CDN urls is escaped via @verbatim.

    write(PARTIALS / "menu.blade.php", "@verbatim\n" + menu + "\n@endverbatim\n")
    write(PARTIALS / "header.blade.php", "@verbatim\n" + header + "\n@endverbatim\n")
    write(PARTIALS / "footer.blade.php", "@verbatim\n" + footer + "\n@endverbatim\n")
    write(PARTIALS / "scripts.blade.php", "@verbatim\n" + scripts + "\n@endverbatim\n")

    layout = r'''<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>@yield('title', 'DottScale')</title>
    <meta name="description" content="@yield('meta_description', 'DottScale')">
    <meta name="keywords" content="@yield('meta_keywords', '')">
    <meta name="article:publisher" content="www.facebook.com/dottscalee/">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="robots" content="index, follow">
    <meta property="og:description" content="@yield('og_description', '')">
    <meta property="og:type" content="website">
    <meta property="og:image:alt" content="DottScale">
    <meta property="og:image:type" content="image/png">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/dottscale-logo-alt.png') }}">
    <meta property="og:image:height" content="1000">
    <meta property="og:image:width" content="1000">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="@yield('title', 'DottScale')">
    <meta name="twitter:description" content="@yield('og_description', '')">
    <meta name="twitter:image" content="{{ asset('images/dottscale-logo-alt.png') }}">

    <script type="application/ld+json">{"@@context":"https://schema.org","@@type":"WebPage","url":"{{ url()->current() }}"}</script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="shortcut icon" href="{{ asset('images/favicon-32.png') }}" type="image/png">
    <link rel="icon" href="{{ asset('images/favicon-32.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/frontend/dottscale.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    @stack('head')
</head>
<body class="relative font-secondary bg-primary">
''' + bg + '''

    <div id="notifDiv"></div>
    <div class="overlay first all-page"></div>

    @include('layouts.Frontend.partials.menu')
    @include('layouts.Frontend.partials.header')

    <main>
        <input type="hidden" value="{{ url('/') }}" id="app_url">
''' + "        " + page_id + "\n        " + org_input + '''

        @yield('content')
    </main>

    @include('layouts.Frontend.partials.footer')
    @include('layouts.Frontend.partials.scripts')
    @stack('scripts')
</body>
</html>
'''
    write(LAYOUT_DIR / "app.blade.php", layout)

    for view, html_path in page_map():
        html = html_path.read_text(encoding="utf-8", errors="replace")
        main = extract(html, r"<main>(.*?)</main>")
        # Drop chrome hidden inputs; they live in the layout.
        main = re.sub(
            r'<input type="hidden"[^>]*id="(?:app_url|pagebuilder_page_id|organization-detail)"[^>]*>',
            "",
            main,
        )
        title = extract(html, r"<title>(.*?)</title>", flags=re.I | re.S)
        description = meta_content(html, "description")
        keywords = meta_content(html, "keywords")
        og_description = og_content(html, "og:description") or description

        blade = f"""@extends('layouts.Frontend.app')

@section('title')
{title.strip()}
@endsection

@section('meta_description')
{description}
@endsection

@section('meta_keywords')
{keywords}
@endsection

@section('og_description')
{og_description}
@endsection

@section('content')
@verbatim
{main.strip()}
@endverbatim
@endsection
"""
        write(FRONTEND / f"{view}.blade.php", blade)


if __name__ == "__main__":
    main()
