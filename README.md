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

---

<!-- ZV-FICHA-MEDIDA:INI -->
## Ficha técnica — ✅ MEDIDA DEL CÓDIGO 2026-09-03

> Todo lo de esta sección sale de leer el código de la versión **1.1.3** en disco.
> Fichero principal: `zeyvrometacounter.php`.

### Qué hace (respaldado por el código)

- Inyecta CSS+JS en el backoffice mediante `hookActionAdminControllerSetMedia`.
- El JS anade un contador de caracteres bajo cada campo `meta_title` y `meta_description`.
- **Solapamiento medido:** `zeyvro_admintweaks` embarca una copia casi identica de este mismo `meta-counter.js` y tambien la carga.

### Hooks

| Hook registrado | Método que lo implementa |
|---|---|
| `actionAdminControllerSetMedia` | `hookActionAdminControllerSetMedia()` |

### Ajustes de configuración (nombre exacto de la clave)

| Clave `Configuration::` | Para qué |
|---|---|
| `ZEYVROMETACOUNTER_VERSION` | version instalada, para la auto-actualizacion desde `upgrade/` |
| `ZEYVRO_PROMO_FEED_CACHE` | cache del feed de cards promocionales Zeyvro (la pone el trait compartido) |
| `ZEYVRO_PROMO_FEED_TS` | timestamp de ese cache (trait compartido) |

### Compatibilidad, licencia y motor de licencia

| Dato | Valor medido |
|---|---|
| `ps_versions_compliancy` | `'min' => '8.0.0', 'max' => '9.99.99'` |
| Licencia | MIT (`@license https://opensource.org/licenses/MIT`), fichero `LICENSE` presente |
| `ZV_LICENSE_TYPE` | `'free'` |
| `LICENSE_ENABLED` | no declarada |
| Motor de licencia LemonSqueezy | **No** |
| `ZeyvroModuleTrait` | `use ZeyvroModuleTrait` - aporta menu padre Zeyvro, tab hijo, auto-reparacion de tabs y cards promocionales |
| Tab en el menú Zeyvro | No crea tab: `ZV_TAB_CLASS` declarada pero **vacia** |
| `ZV_ADS_VARIANT` | `free` |

### Estructura relevante

- `views/js/meta-counter.js` (2.883 B)
- `views/css/meta-counter.css`
- `upgrade/` - 10 scripts, de 1.0.2 a 1.1.3

### Afirmaciones que el código SÍ respalda

> Lista de contraste para auditar contenido de marketing. Si una afirmación no está aquí, el código no la respalda.

- Anade contador de caracteres a `meta_title` y `meta_description` en el backoffice.
- No crea tablas: 0 usos de `_DB_PREFIX_`.
- Su unica clave propia de configuracion es `ZEYVROMETACOUNTER_VERSION` (control de version, no un ajuste de usuario).
- **No tiene pantalla de ajustes configurables**: no hay controlador admin ni tab propio.
- Sin motor de licencia (`ZV_LICENSE_TYPE='free'`).
- Declara PS 8.0.0 -> 9.99.99.

### No deducible del código

- Los umbrales 60/160 y los colores viven en el JS/CSS, no en `Configuration::` - no son ajustables por el comerciante sin editar ficheros.
<!-- ZV-FICHA-MEDIDA:FIN -->
