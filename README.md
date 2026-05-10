# Zeyvro Meta Counter

PrestaShop 8 module. Adds an SEO-oriented character counter under every `meta_title` and `meta_description` field in the backoffice.

- `meta_title` target: 60 characters (Google's typical truncation point).
- `meta_description` target: 160 characters.
- Counter format: `SEO: 42 / 60`.
- Color coding: green when more than 10 chars left, amber when 10 or fewer remain, red when over the target.
- Hides PrestaShop's native counter on the V2 product page, which uses the DB `maxlength` (128 / 512) and is not useful for SEO.

## Installation

Backoffice → Modules → Upload a module → drop the zip → Install.

## Compatibility

PrestaShop 8.0 – 8.x. Works on Products, Categories, Manufacturers, Suppliers, CMS pages — any backoffice form whose meta fields use `meta_title` / `meta_description` in their `name` or `id`.

## Uninstall

Backoffice → Modules → search "Zeyvro Meta Counter" → Uninstall. No tables, no leftovers.

## Roadmap

- v1.1.0 — Spanish + French translations via PrestaShop's native i18n.
- v1.2.0 — Configurable targets per shop (configuration page).

## Support

Issues and feature requests via GitHub Issues only. No email, phone or chat support.

## License

MIT — see LICENSE file.

---

Part of the Zeyvro catalog — plugins and modules for WordPress and PrestaShop. zeyvro.com
