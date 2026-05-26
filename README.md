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

Part of the Zeyvro catalog — plugins and modules for WordPress and PrestaShop. [zeyvro.com](https://zeyvro.com)

---

## Español

Módulo para PrestaShop 8. Añade un contador de caracteres orientado a SEO bajo cada campo `meta_title` y `meta_description` del backoffice.

- Objetivo `meta_title`: 60 caracteres (límite habitual de truncación de Google).
- Objetivo `meta_description`: 160 caracteres.
- Formato del contador: `SEO: 42 / 60`.
- Código de colores: verde si quedan más de 10 caracteres, ámbar si quedan 10 o menos, rojo si se supera el objetivo.
- Oculta el contador nativo de PrestaShop en la página de producto V2, que usa el `maxlength` de BD (128 / 512) y no es útil para SEO.

### Instalación

Backoffice → Módulos → Subir un módulo → arrastra el zip → Instalar.

### Compatibilidad

PrestaShop 8.0 – 8.x. Funciona en Productos, Categorías, Fabricantes, Proveedores, páginas CMS — cualquier formulario del backoffice cuyos campos meta usen `meta_title` / `meta_description` en su `name` o `id`.

### Desinstalar

Backoffice → Módulos → busca "Zeyvro Meta Counter" → Desinstalar. Sin tablas, sin rastro.

### Soporte

Incidencias y solicitudes de funcionalidades exclusivamente vía GitHub Issues. Sin soporte por email, teléfono ni chat.

### Licencia

MIT — ver fichero LICENSE.

---

Parte del catálogo Zeyvro — plugins y módulos para WordPress y PrestaShop. [zeyvro.com](https://zeyvro.com)
