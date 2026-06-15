# Changelog

## 1.0.3 — 2026-06-15

### Añadido
- **Retrofit ZeyvroModuleTrait (Fase 2):** `use ZeyvroModuleTrait` con 6 constantes (`ZV_TAB_CLASS=''`, `ZV_ADS_VARIANT='free'`, `ZV_SCHEMA_KEY='ZEYVROMETACOUNTER_TABV'`). Módulo sin BO controller — sin tab visible.
- `classes/ZeyvroModuleTrait.php`: base común verbatim de `_shared/`. Incluye guard `trait_exists` para coexistir con otros módulos Zeyvro instalados simultáneamente.
- `upgrade-1.0.3.php`: idempotente, solo limpieza de cachés.

### Cambiado
- `clearAllCaches()` delegado al trait (eliminado del módulo).
- `runAutoUpgrade()` catch `\Exception` → `\Throwable` (compatibilidad PHP 8.0).

## 1.0.2 — 2026-06-13

### Añadido
- §7.1 Auto-upgrade al subir ZIP por BO: `runAutoUpgrade()` en `__construct()` — detecta versión instalada vía `ZEYVROMETACOUNTER_VERSION` / tabla `ps_module`, lee destino de `config.xml`, ejecuta upgrade scripts intermedios en orden semver, actualiza BD automáticamente.
- §2.1 `clearAllCaches()`: OPcache + Smarty + CCC + autoload. `try/catch \Throwable` (PHP 8.0 safe).
- Creado `upgrade/` directory con `upgrade-1.0.2.php` (antes inexistente).

## 1.0.1 — 2026-06-04
### Fixed
- `install()` y `uninstall()`: añadido return type `: bool` para coincidir con `Module` (PHPStan).

## 1.0.0 — 2026-05-10

- Initial public release.
- Adds character counter under `meta_title` (target 60) and `meta_description` (target 160) in PrestaShop backoffice.
- Color-coded counter using Zeyvro palette: green / amber (≤10 chars left) / red (over target).
- Hides PrestaShop native counter in V2 product form (`.js-text-with-length-counter .input-group-append`) to avoid duplication.
- Registered hook: `actionAdminControllerSetMedia`. No DB tables, no overrides.
- MutationObserver to handle the lazy-loaded SEO tab in the V2 product form.
