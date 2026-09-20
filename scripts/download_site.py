#!/usr/bin/env python3
"""Download Allomate pages and referenced local assets, rewrite URLs for local serving."""

from __future__ import annotations

import json
import os
import re
import time
import urllib.error
import urllib.parse
import urllib.request
from pathlib import Path

ROOT = Path("/Users/mab/Zee/Projects/dottscale/site")
ORIGIN = "https://allomate.com"
UA = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36"

PAGES = [
    "/",
    "/about-us",
    "/our-team",
    "/sell360-sales-platform",
    "/the-next-horizon",
    "/blogs",
    "/career",
    "/contact-us",
    "/our-work",
    "/home",
    "/services/enterprise-solutions",
    "/services/ai-and-automation",
    "/services/mvp-design-and-development",
    "/services/web-and-mobile-development",
    "/services/quality-assurance",
    "/services/dedicated-teams",
    "/our-work/khan-law",
    "/our-work/vape-suite",
    "/our-work/bni-inks",
    "/our-work/source-code-academia",
    "/our-work/green-earth-recyling",
    "/our-work/psl",
    "/terms-of-use",
    "/privacy-policy",
    "/sitemap",
    "/career/full-stack-developer",
]

EXTRA_ASSETS = [
    "/images/menu-arrow.svg",
    "/images/awards-image01.webp",
    "/images/awards-image02.webp",
    "/images/awards-image03.webp",
    "/storage/media/red-arrow_1755666140.png",
    "/css/frontend/mCSB_buttons.png",
]


def fetch(url: str, dest: Path | None = None, retries: int = 3) -> bytes | None:
    req = urllib.request.Request(url, headers={"User-Agent": UA, "Accept": "*/*"})
    for attempt in range(retries):
        try:
            with urllib.request.urlopen(req, timeout=60) as resp:
                data = resp.read()
            if dest:
                dest.parent.mkdir(parents=True, exist_ok=True)
                dest.write_bytes(data)
            return data
        except Exception as exc:
            print(f"  fail {url} ({exc}) retry {attempt + 1}")
            time.sleep(0.6 * (attempt + 1))
    return None


def page_to_file(path: str) -> Path:
    if path in ("/", ""):
        return ROOT / "index.html"
    clean = path.strip("/")
    return ROOT / clean / "index.html"


def rewrite_html(html: str) -> str:
    html = html.replace("https://allomate.com/", "/")
    html = html.replace("https://allomate.com", "")
    html = html.replace('href="/css/', 'href="/css/')
    html = html.replace(
        "https://cms.allomate.com/uploads/e6f492f1e3b7c54131d197d8b4b1dc86a28dadbc/Allomate---Home---Page.webp",
        "/cms-uploads/Allomate---Home---Page.webp",
    )
    html = html.replace(
        "https://cms.allomate.com/uploads/44bf53a346406449689d875733e3b98f4ed3cc02/VR-Image.webp",
        "/cms-uploads/VR-Image.webp",
    )
    html = html.replace(
        "https://cms.allomate.com/uploads/8b6e9067bf308500c5d8ecd582d6bb5caa0052fd/chart.svg",
        "/cms-uploads/chart.svg",
    )
    html = html.replace(
        "https://cms.allomate.com/uploads/31926f5213490ce03af6bb2d08e519d9343cd961/mobile-app.svg",
        "/cms-uploads/mobile-app.svg",
    )
    html = html.replace(
        "https://cms.allomate.com/uploads/6a70291da1d3d8ff601ee36b250cb295818fb50a/cube.svg",
        "/cms-uploads/cube.svg",
    )
    html = html.replace(
        "https://cms.allomate.com/uploads/74b055df2b2dae1e041a62225c696b635498a14e/warranty.svg",
        "/cms-uploads/warranty.svg",
    )
    html = html.replace(
        "https://cms.allomate.com/uploads/2adf5e4ffb34a58e7e72d6c3736172d1ea2fab32/artificial-intelligence.svg",
        "/cms-uploads/artificial-intelligence.svg",
    )
    html = html.replace(
        "https://cms.allomate.com/uploads/e3f7b7cc6a117135c27e5ff565dc5d958ddcacb2/teamwork.svg",
        "/cms-uploads/teamwork.svg",
    )
    # Prevent original unused mobile-menu script from throwing and looking noisy
    html = html.replace(
        'menuToggle.addEventListener("click", () => {',
        'if (menuToggle) menuToggle.addEventListener("click", () => {',
    )
    html = html.replace(
        'openModal.addEventListener("click", function () {',
        'if (openModal) openModal.addEventListener("click", function () {',
    )
    html = html.replace(
        'closeModal.addEventListener("click", function () {',
        'if (closeModal) closeModal.addEventListener("click", function () {',
    )
    html = html.replace(
        'modal.addEventListener("click", function (event) {',
        'if (modal) modal.addEventListener("click", function (event) {',
    )
    return html


def collect_local_paths(html: str) -> set[str]:
    paths = set()
    for match in re.findall(r'(?:src|href|poster)=["\']([^"\']+)["\']', html, flags=re.I):
        if match.startswith("/images/") or match.startswith("/storage/") or match.startswith("/css/") or match.startswith("/js/"):
            paths.add(match.split("?")[0])
    return paths


def collect_from_json() -> set[str]:
    paths = set()
    api_dir = ROOT / "api"
    if not api_dir.exists():
        return paths
    blob = ""
    for f in api_dir.glob("*.json"):
        blob += f.read_text(encoding="utf-8", errors="ignore")
    for match in re.findall(r'(/storage/[^"\\]+|storage/[^"\\]+)', blob):
        p = match if match.startswith("/") else "/" + match.replace("\\/", "/")
        p = p.replace("\\/", "/")
        paths.add(p.split("?")[0])
    for match in re.findall(r'"logo"\s*:\s*"(client_logos/[^"]+)"', blob):
        paths.add("/storage/" + match)
    for match in re.findall(r'"(thumbnail|logo)"\s*:\s*"(portfolios/[^"]+)"', blob):
        paths.add("/storage/" + match[1])
    return paths


def main() -> None:
    ROOT.mkdir(parents=True, exist_ok=True)
    needed = set(EXTRA_ASSETS)
    needed |= collect_from_json()

    for page in PAGES:
        url = ORIGIN + page
        dest = page_to_file(page)
        print(f"PAGE {page} -> {dest}")
        data = fetch(url, dest)
        if not data:
            continue
        html = data.decode("utf-8", errors="replace")
        html = rewrite_html(html)
        dest.write_text(html, encoding="utf-8")
        needed |= collect_local_paths(html)

    for path in sorted(needed):
        if path.endswith("/") or path.endswith(".html"):
            continue
        dest = ROOT / path.lstrip("/")
        if dest.exists() and dest.stat().st_size > 0:
            continue
        print(f"ASSET {path}")
        fetch(ORIGIN + path, dest)

    print("Done.")


if __name__ == "__main__":
    main()
