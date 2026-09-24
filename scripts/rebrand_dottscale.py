#!/usr/bin/env python3
"""Rebrand the Allomate template chrome to DottScale."""

from pathlib import Path
import re
import shutil

ROOT = Path("/Users/mab/Zee/Projects/dottscale")
SITE = ROOT / "site"

LOGO_IMG = (
    '<img src="/images/dottscale-logo-alt.png" alt="DottScale" '
    'width="200" height="58">'
)
FOOTER_LOGO = (
    '<img src="/images/dottscale-logo-alt.png" alt="DottScale" '
    'class="w-auto h-[34px] sm:h-[40px] mb-4">'
)

REPLACEMENTS = [
    ("Allomate Solutions", "DottScale"),
    ("allomate-logo-w.svg", "dottscale-logo-alt.png"),
    ("connect@allomate.com", "contact@dottscale.com"),
    ("+1 775 441 7755", "+1 (512) 564-8959"),
    ("https://www.facebook.com/allomatesolutions/", "https://www.facebook.com/dottscalee/"),
    ("www.facebook.com/allomatesolutions/", "www.facebook.com/dottscalee/"),
    ("https://www.twitter.com/allomatesol/", "https://www.pinterest.com/dottscale"),
    ("www.twitter.com/allomatesol/", "www.pinterest.com/dottscale"),
    ("https://www.linkedin.com/company/allomatesolutions/", "https://www.linkedin.com/company/dottscale/"),
    ("www.linkedin.com/company/allomatesolutions/", "www.linkedin.com/company/dottscale/"),
    ("https://www.instagram.com/allomatesol", "https://www.instagram.com/dottscale"),
    ("www.instagram.com/allomatesol", "www.instagram.com/dottscale"),
    ("https://www.behance.net/allomatesol", "https://www.pinterest.com/dottscale"),
    ("www.behance.net/allomatesol", "www.pinterest.com/dottscale"),
    ("https://www.clutch.co/profile/allomate-solutions", "https://www.facebook.com/dottscalee/"),
    ("www.clutch.co/profile/allomate-solutions", "www.facebook.com/dottscalee/"),
    ("Plot# 875, Khayaban-e-Firdousi, Block R-1, Johar Town Lahore.", "Austin, Texas, United States"),
    ("1st Floor, Daftarkhwan | Downtown, Gulberg Lahore Pakistan.", "Austin, Texas, United States"),
    ("Sharjah Media City (Shams), Al Messaned, Al Bataeh, Sharjah, United Arab Emirates.", "Get In Touch +1 (512) 564-8959"),
    ('title-menu mb-2.5 font-primary text-base font-normal tracking-[2.5px]">Pakistan',
     'title-menu mb-2.5 font-primary text-base font-normal tracking-[2.5px]">Austin'),
    ('title-menu mb-2.5 font-primary text-base font-normal tracking-[2.5px]">Dubai',
     'title-menu mb-2.5 font-primary text-base font-normal tracking-[2.5px]">Contact'),
    ("aria-label=\"Twitter\"", "aria-label=\"Pinterest\""),
    ("aria-label=\"Behance\"", "aria-label=\"Pinterest\""),
    ("aria-label=\"Clutch\"", "aria-label=\"Facebook\""),
    ("cms.allomate.com", "dottscale.com"),
]

COLOR_REPLACEMENTS = [
    ("#FFB237a1", "#212529a1"),
    ("#FFB2373b", "#2125293b"),
    ("#FFB237", "#212529"),
    ("#f12300", "#FFB237"),
    ("#F12300", "#FFB237"),
    ("#09173763", "#212529a3"),
]


def apply_colors(text: str) -> str:
    for old, new in COLOR_REPLACEMENTS:
        text = text.replace(old, new)
    return text


def replace_logos(html: str) -> str:
    html = re.sub(
        r'(<a href="[^"]*"\s+title="(?:Allomate Solutions|DottScale)"\s+class="mil-logo">)\s*<svg[\s\S]*?</svg>\s*(</a>)',
        rf"\1\n        {LOGO_IMG}\n    \2",
        html,
    )
    html = re.sub(
        r'<svg class="w-auto h-\[34px\] sm:h-\[40px\] mb-4"[\s\S]*?</svg>',
        FOOTER_LOGO,
        html,
        count=1,
    )
    return html


def replace_brand_name(html: str) -> str:
    html = html.replace("Allomate Solutions", "DottScale")
    html = re.sub(
        r"(?<![\w./-])Allomate(?![\w.-]*\.(?:webp|png|jpg|jpeg|svg|gif))",
        "DottScale",
        html,
    )
    return html


def rebrand_html(html: str) -> str:
    html = replace_logos(html)
    html = replace_brand_name(html)
    for old, new in REPLACEMENTS:
        html = html.replace(old, new)
    html = apply_colors(html)
    html = html.replace("/images/favicon.ico", "/images/favicon-32.png")
    html = html.replace('type="image/x-icon"', 'type="image/png"')
    html = html.replace('type="image/svg"', 'type="image/png"')
    return html


def main() -> None:
    html_files = sorted(SITE.rglob("*.html"))
    changed = 0
    for path in html_files:
        original = path.read_text(encoding="utf-8")
        updated = rebrand_html(original)
        if updated != original:
            path.write_text(updated, encoding="utf-8")
            changed += 1
            print(f"updated {path.relative_to(ROOT)}")
    print(f"rebranded {changed}/{len(html_files)} html files")


if __name__ == "__main__":
    main()
