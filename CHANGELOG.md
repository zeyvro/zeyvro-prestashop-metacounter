# Changelog

## 1.0.5 — 2026-06-22

### Corregido (Validator Verified+)
- **REQUIREMENTS**: `config.xml` description alineada con `$this->description` del .php. `composer.json`: `"prepend-autoloader": false` añadido.
- **COMPATIBILITY**: `TabCore::$active` — tres asignaciones `= 1` → `= true` en `classes/ZeyvroModuleTrait.php` (L84, L135, L144).
- **LICENSES**: cabeceras `@author/@copyright/@license MIT` añadidas a 10 ficheros (`index.php` raíz + 5 subdirectorios + `upgrade-1.0.2.php` + `upgrade-1.0.3.php` + `upgrade-1.0.4.php` + `views/js/meta-counter.js` + `views/css/meta-counter.css`).
- **STANDARDS**: `.php-cs-fixer.dist.php` (ruleset PS oficial `@Symfony`) aplicado; 11 ficheros fijados. Barreras irreducibles documentadas: `blank_line_after_opening_tag=>false` + `no_alternative_syntax=>false`.

### Añadido
- `upgrade-1.0.5.php`: idempotente, solo limpieza de cachés.
- `.php-cs-fixer.dist.php`: ruleset oficial PS para Standards.

## 1.0.4 — 2026-06-22

### Cambiado
- `ps_versions_compliancy['max']`: `'8.99.99'` → `'9.99.99'` — BLOCKER PS9 eliminado. El módulo ahora instala y desinstala limpio en PS 9.0 y 9.1.
- Verificado en harness Docker: PS9.0/PHP8.4 ✅ · PS9.1/PHP8.4 ✅ · PS8.2/PHP8.1 regresión ✅. 0 Fatal/Deprecated del módulo en ninguna versión.

### Añadido
- `upgrade-1.0.4.php`: idempotente, limpieza de cachés.

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
