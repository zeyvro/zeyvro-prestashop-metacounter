# FUNCIONES — zeyvrometacounter 1.1.5

- Fecha: 2026-09-28 (Code, sesión de la 1.1.5)
- Medido en: el código de la rama `feature/v1.1.5` de este repo, el mismo que empaqueta `build-module-zip.py` en `C:\Dev\releases\zeyvrometacounter\1.1.5\`.
- Líneas: `fichero:inicio-fin`. Sin fichero = `zeyvrometacounter.php`.
- Índice: paso 4 de la vuelta funcional sobre la 1.1.4 (9 funciones, FALLO de R2). En la 1.1.5 cambian F5 (el CSS solo oculta el contador nativo donde está el contador SEO) y la compatibilidad anunciada (max `9.1.3`, :34), y entra `upgrade/upgrade-1.1.5.php` en F7.

| ID | Función | Dónde | Qué hace |
|---|---|---|---|
| F1 | Cargar CSS y JS en el BO | `install` :49-53 (registro del hook :52) · `hookActionAdminControllerSetMedia` :60-68 (addCSS :66, addJS :67) | En cada página del BO con controlador, enlaza `views/css/meta-counter.css` y `views/js/meta-counter.js`. El método de la clase tapa el del trait (`classes/ZeyvroModuleTrait.php:261-268`). |
| F2 | Contador SEO 60 / 160 | `views/js/meta-counter.js` límites :11-12 · `classify` :14-26 · `findFields` :27-33 · `attach` :34-64 (texto :51, colores :52-59) · `scan` :65-76 | Bajo cada campo cuyo `name` o `id` lleva `meta_title` (60) o `meta_description` (160) pone un `<small class="zv-meta-counter">` justo detrás del campo con «SEO: n / max», que se actualiza al escribir. |
| F3 | Campos que llegan tarde | `views/js/meta-counter.js:78-80` | Un MutationObserver vuelve a escanear cuando cambia el DOM (pestaña SEO de la ficha de producto V2). |
| F4 | Colores | `views/css/meta-counter.css:9-19` | Verde con más de 10 libres, ámbar con 10 o menos, rojo al pasarse. |
| F5 | Ocultar el contador nativo solo en meta_* | `views/css/meta-counter.css:21-27` (selector :25) | **1.1.5:** oculta el `.input-group-append` del widget nativo solo si le precede el `.zv-meta-counter` de F2, es decir, en los campos meta_title / meta_description. El resto de contadores nativos del BO (p. ej. el mensaje de la ficha del pedido) se ven. |
| F6 | Instalación y desinstalación | `install` :49-53 · `uninstall` :55-58 | Registra el hook; desinstalar es `parent::uninstall()`. Sin tablas ni configuración propia; queda `ZEYVROMETACOUNTER_VERSION` si la escribió F7. |
| F7 | Auto-upgrade | constructor :43-46 · `runAutoUpgrade` :72-146 (sella :133 y :134-137) · `isModuleManagerRequest` :153-158 · `upgrade/upgrade-1.0.2.php` … `upgrade-1.1.5.php` (1.1.5: `upgrade_module_1_1_5` :22-52, OPcache solo del módulo :24-48, `clearAllCaches` :49) | Fuera de `/improve/modules/`, ejecuta los `upgrade-*.php` pendientes hasta la versión de `config.xml` y sella la versión en `configuration` y `module`. |
| F8 | Bloqueo de PHP directo | `.htaccess:7-10` y `:15-17` · guarda `_PS_VERSION_` en los `.php` | Un `.php` del módulo pedido por URL no se ejecuta. |
| F9 | Textos del BO en español | `translations/es.php:15-19` | Nombre, descripción, confirmación de desinstalar y los 2 textos del banner del trait. |

No alcanzable en este módulo: `renderZeyvroAds` (`classes/ZeyvroModuleTrait.php:367`); no hay `getContent` y `config.xml:10` es `is_configurable 0`.
