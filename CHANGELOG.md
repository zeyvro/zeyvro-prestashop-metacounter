# Changelog

## 1.1.6 - 2026-11-03

### Corregido (ES)
- `PrestaShopLogger::addLog()` usa un tipo de objeto solo con letras: PS 8.0.x rechazaba el guion bajo y el registro fallaba.
- Upgrade 1.1.6 sin cambios de esquema ni de configuración.

## 1.1.5 — 2026-09-28

### Corregido (ES)
- **Desaparecía el contador de caracteres nativo de PrestaShop en otros formularios del BO.** La regla CSS que oculta el contador nativo (el que cuenta contra el `maxlength` de la base de datos, 128 / 512) se aplicaba en todo el BO, no solo a los campos meta. En PrestaShop 8.2 quitaba, por ejemplo, el contador del mensaje en la ficha del pedido (máx. 1200), sin poner otro. Ahora solo se oculta en los campos `meta_title` / `meta_description` donde el módulo pone su contador SEO; el resto de contadores nativos se ven igual que sin el módulo.
- **Compatibilidad anunciada:** `ps_versions_compliancy` pasa de `9.99.99` a `9.1.3`, la versión más alta probada. El README decía «8.0 – 8.x»; ahora dice lo mismo que el módulo: 8.0 – 9.1.
- `upgrade/upgrade-1.1.5.php`: sin cambios de esquema. Invalida en OPcache solo los ficheros `.php` del módulo y limpia la caché del módulo. Idempotente.

### Fixed (EN)
- **PrestaShop's native character counter disappeared on other Back Office forms.** The CSS rule hiding the native counter (the one counting against the database `maxlength`, 128 / 512) applied to the whole Back Office, not only to the meta fields. On PrestaShop 8.2 it removed, for example, the order-message counter on the order page (max 1200) without replacing it. It is now hidden only on the `meta_title` / `meta_description` fields where the module shows its SEO counter; every other native counter looks as it does without the module.
- **Declared compatibility:** `ps_versions_compliancy` goes from `9.99.99` to `9.1.3`, the highest tested version. The README said "8.0 – 8.x"; it now matches the module: 8.0 – 9.1.
- `upgrade/upgrade-1.1.5.php`: no schema change. It invalidates only the module's own `.php` files in OPcache and clears the module cache. Idempotent.

## 1.1.4 — 2026-09-12

### Corregido (ES)
- **Aviso falso al actualizar desde el BO en PrestaShop 9.1.** Al subir el ZIP de una versión nueva, PS 9.1 puede responder «No se han hecho actualizaciones… El módulo zeyvrometacounter no se puede actualizar ahora mismo» aunque la actualización sí se haya hecho (base de datos y código en la versión nueva). Causa: el auto-upgrade del módulo (`runAutoUpgrade()`, en el constructor) ejecutaba los `upgrade/*.php` dentro de la misma petición en la que PS 9.1 los vuelve a ejecutar; el core los ve ya cargados, los marca como duplicados (`classes/module/Module.php`, `runUpgradeModule()`) y devuelve error.
- `runAutoUpgrade()` ya no hace nada en las peticiones de gestión de módulos del BO (rutas `/improve/modules/…`: subir el ZIP, «Actualizar»), donde PrestaShop ejecuta él mismo los scripts. En el resto de páginas del BO sigue funcionando igual: PS 9.0.0 no aplica los scripts al subir el ZIP y es el auto-upgrade el que lo cubre.
- `upgrade/upgrade-1.1.4.php`: sin cambios de esquema. Invalida en OPcache solo los ficheros `.php` del módulo (nunca la caché de toda la tienda) y limpia la caché del módulo. Idempotente.
- **Al actualizar a esta versión desde una anterior**, PrestaShop 9.1 todavía puede mostrar ese aviso: en esa subida el servidor ejecuta aún el código de la versión que tenías instalada. **La actualización se ha realizado.** Desde la 1.1.4, las siguientes actualizaciones ya no lo muestran.

### Fixed (EN)
- **False warning when upgrading from the Back Office on PrestaShop 9.1.** When uploading the ZIP of a new version, PS 9.1 may answer "No update has been applied… Module zeyvrometacounter cannot be updated this time" even though the upgrade has been applied (database and code on the new version). Cause: the module's auto-upgrade (`runAutoUpgrade()`, in the constructor) ran the `upgrade/*.php` scripts inside the same request in which PS 9.1 runs them again; the core finds them already loaded, flags them as duplicates (`classes/module/Module.php`, `runUpgradeModule()`) and returns an error.
- `runAutoUpgrade()` now does nothing on Back Office module-management requests (`/improve/modules/…` routes: ZIP upload, "Upgrade"), where PrestaShop runs the scripts itself. It keeps working on every other Back Office page: PS 9.0.0 does not apply the scripts when the ZIP is uploaded and the auto-upgrade covers that.
- `upgrade/upgrade-1.1.4.php`: no schema change. It invalidates only the module's own `.php` files in OPcache (never the whole shop's cache) and clears the module cache. Idempotent.
- **When upgrading to this version from an older one**, PrestaShop 9.1 may still show that warning: during that upload the server still runs the code of the version you had installed. **The upgrade has been applied.** From 1.1.4 on, later upgrades no longer show it.

## 1.1.3 — 2026-07-06

### Cambiado
- `classes/ZeyvroModuleTrait.php`: canon reformateado al estándar oficial PS (llaves, `zvTabIdFromClassName`), sha256 `f51419f3441b7d17e233ba6d8873bfbb32f3a847909d3f748035586077be7d61` (antes `1c0a27c2...`, formato `if/endif`). Validado 9/9 VERDE en el Validator oficial para el módulo hermano `zeyvro_producttabs` (run 3744711).
- `.php-cs-fixer.dist.php`: config simplificada a la clase oficial `PrestaShop\CodingStandards\CsFixer\Config` con un único override (`blank_line_after_opening_tag => false`); ya no excluye el trait del Finder (el canon nuevo ya está en formato oficial, cs-fixer no lo re-modifica).
- Sin cambios de comportamiento ni de base de datos. Pendiente de que el Validator oficial confirme 9/9 antes de publicar esta versión.

## 1.1.2 — 2026-07-04

### Cambiado
- **Tanda Trait Fase B4 — canon FULL unificado:** `classes/ZeyvroModuleTrait.php` reemplazado por copia VERBATIM del canon `_shared/ZeyvroModuleTrait.php` (sha256 `1c0a27c234f7e82f012f83fc8a98d62f0189626e17df87c181ee35ba12a59119`). Gana `renderZeyvroAds()` con feed remoto + caché 12h + i18n (antes: sin banner en absoluto — tier LEAN). Sin cambio de comportamiento en `installBase()`/`uninstallBase()`/`ensureTabs()` (módulo sin BO controller, `ZV_TAB_CLASS=''`).
- `ZV_LICENSE_TYPE = 'free'` declarado (requerido por el builder, fail-closed).
- `translations/es.php` creado (no existía): catálogo de las 5 cadenas `l()` reales del módulo (3 propias + 2 del banner heredado del canon).

## 1.1.1 — 2026-06-23

### Fixed
- **Security / .htaccess raíz**: el `.htaccess` anterior usaba `Require all denied` (Apache 2.4) y `Deny from all` (Apache 2.2) de forma global, bloqueando todos los ficheros del módulo, incluidos `views/css/*.css` y `views/js/*.js`. Con CCC desactivado Apache servía directamente esos assets → HTTP 403. Se reemplaza por `Options -Indexes` (impide listado de directorio) + `<FilesMatch "\.php$">` (bloquea solo ejecución directa de PHP). Assets estáticos se sirven con 200.

### Added
- `upgrade/upgrade-1.1.1.php`: script de upgrade idempotente (limpieza de caché).

---

## 1.1.0 — 2026-06-23

### Cambiado
- **Cabecera canónica NOTICE OF LICENSE** (bloque MIT largo: NOTICE OF LICENSE + URL + `@author Zeyvro <admin@zeyvro.com>` + `@copyright` + `@license URL`) aplicada a todos los `.php` del módulo (principal, classes, upgrade/*, views/index.php, todos los index.php de seguridad). Elimina el bloque de 1 línea `@license MIT` anterior que causaba Licenses > 0 en el Validator.
- **`.php-cs-fixer.dist.php`**: `phpdoc_to_comment => true` (actualizado desde `false` — el fixer preserva el primer `/**` de cada fichero; corregido tras validación real turnstile v1.1.3).
- **Upgrade scripts 1.0.2–1.0.6**: reemplazado `$module->clearAllCaches()` por llamadas PS directas (`opcache_reset` + `Tools::clearSmartyCache` + `Media::clearCache`) siguiendo el patrón del gold template.
- **index.php de seguridad**: guard `_PS_VERSION_` añadido a `classes/index.php` (faltaba); todos los index.php ahora tienen cabecera canónica + guard + redirect.

### Añadido
- `upgrade-1.1.0.php`: idempotente, limpieza de cachés.

## 1.0.6 — 2026-06-22

### Corregido (Validator Verified+)
- **LICENSES**: `classes/index.php` — docblock `/*` → `/**` (el Validator exige estilo docblock para file comment). EOL normalizado a LF puro en todos los `.php`/`.js`/`.css`.
- **OPTIMIZATIONS**: `classes/ZeyvroModuleTrait.php` — mixed line endings (CRLF+LF) eliminados; ahora LF uniforme.
- **STANDARDS**: `zeyvrometacounter.php` normalizado de CRLF a LF (los 142 findings eran las 142 líneas CRLF). `.php-cs-fixer.dist.php` actualizado: barrera `phpdoc_to_comment=>false` añadida para proteger `/**` en index.php.

### Añadido
- `upgrade-1.0.6.php`: idempotente, limpieza de cachés.

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
