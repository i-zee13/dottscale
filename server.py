#!/usr/bin/env python3
"""Local clone of allomate.com — static pages + JSON APIs."""

from __future__ import annotations

import json
from http.server import ThreadingHTTPServer, SimpleHTTPRequestHandler
from pathlib import Path
from urllib.parse import urlparse

ROOT = Path(__file__).resolve().parent / "site"
PORT = 5173

API_FILES = {
    "/get-client-logos": "get-client-logos.json",
    "/get-portfolios-latest": "get-portfolios-latest.json",
    "/get-client-reviews": "get-client-reviews.json",
    "/get-latest-blogs": "get-latest-blogs.json",
    "/get-team-members": "get-team-members.json",
    "/get-careers-positions": "get-careers-positions.json",
    "/get-portfolios": "get-portfolios.json",
    "/get-all-blogs": "get-all-blogs.json",
}


class Handler(SimpleHTTPRequestHandler):
    def __init__(self, *args, **kwargs):
        super().__init__(*args, directory=str(ROOT), **kwargs)

    def log_message(self, fmt: str, *args) -> None:
        print("[%s] %s" % (self.log_date_time_string(), fmt % args))

    def _json(self, payload, status: int = 200) -> None:
        body = json.dumps(payload).encode("utf-8")
        self.send_response(status)
        self.send_header("Content-Type", "application/json; charset=utf-8")
        self.send_header("Content-Length", str(len(body)))
        self.send_header("Cache-Control", "no-cache")
        self.end_headers()
        self.wfile.write(body)

    def _file_json(self, name: str) -> None:
        path = ROOT / "api" / name
        if not path.exists():
            self._json({"status": "error", "message": "missing"}, 404)
            return
        data = path.read_bytes()
        self.send_response(200)
        self.send_header("Content-Type", "application/json; charset=utf-8")
        self.send_header("Content-Length", str(len(data)))
        self.end_headers()
        self.wfile.write(data)

    def _try_html(self, path: str) -> bool:
        candidates = []
        if path in ("", "/"):
            candidates.append(ROOT / "index.html")
        else:
            rel = path.lstrip("/")
            candidates.extend(
                [
                    ROOT / rel,
                    ROOT / f"{rel}.html",
                    ROOT / rel / "index.html",
                ]
            )
        for candidate in candidates:
            if candidate.is_file():
                self.path = "/" + str(candidate.relative_to(ROOT)).replace("\\", "/")
                super().do_GET()
                return True
        return False

    def do_GET(self) -> None:
        parsed = urlparse(self.path)
        path = parsed.path.rstrip("/") or "/"
        if path in API_FILES:
            self._file_json(API_FILES[path])
            return
        if path == "/get-all-faqs":
            self._json({"faqs": []})
            return
        if path == "/get-works":
            self._json({"works": []})
            return
        if path == "/get-clients-review":
            self._json({"review_record": []})
            return
        ext = Path(path).suffix.lower()
        static_exts = {
            ".css",
            ".js",
            ".png",
            ".jpg",
            ".jpeg",
            ".webp",
            ".svg",
            ".ico",
            ".woff",
            ".woff2",
            ".ttf",
            ".webm",
            ".mp4",
            ".json",
            ".gif",
            ".map",
        }
        if ext in static_exts:
            super().do_GET()
            return
        if self._try_html(path):
            return
        super().do_GET()

    def do_POST(self) -> None:
        parsed = urlparse(self.path)
        path = parsed.path
        length = int(self.headers.get("Content-Length", "0") or 0)
        if length:
            self.rfile.read(length)
        if path == "/save-contact":
            self._json({"status": "success", "msg": "Thanks. We will get back to you shortly."})
            return
        if path == "/get-all-faqs":
            self._json({"faqs": []})
            return
        self._json({"status": "success"})


def main() -> None:
    if not ROOT.exists():
        raise SystemExit(f"Missing site folder: {ROOT}")
    server = ThreadingHTTPServer(("127.0.0.1", PORT), Handler)
    print(f"Allomate clone running at http://127.0.0.1:{PORT}")
    print("Open that URL and click the top-right menu button to see the overlay.")
    try:
        server.serve_forever()
    except KeyboardInterrupt:
        print("\nStopped.")


if __name__ == "__main__":
    main()
