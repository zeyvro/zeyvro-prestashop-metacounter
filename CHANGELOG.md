# Changelog

## 1.0.0 — 2026-05-10

- Initial public release.
- Adds character counter under `meta_title` (target 60) and `meta_description` (target 160) in PrestaShop backoffice.
- Color-coded counter using Zeyvro palette: green / amber (≤10 chars left) / red (over target).
- Hides PrestaShop native counter in V2 product form (`.js-text-with-length-counter .input-group-append`) to avoid duplication.
- Registered hook: `actionAdminControllerSetMedia`. No DB tables, no overrides.
- MutationObserver to handle the lazy-loaded SEO tab in the V2 product form.
