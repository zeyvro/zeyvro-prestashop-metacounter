<?php
/**
 * Zeyvro PrestaShop Module
 *
 * @author    Zeyvro <admin@zeyvro.com>
 * @copyright 2026 Zeyvro
 * @license   https://opensource.org/licenses/MIT  MIT License
 */
if (!defined('_PS_VERSION_')) {
    exit;
}

/**
 * v1.1.5 — el CSS solo oculta el contador nativo en los campos meta_* con contador SEO; max 9.1.3.
 *
 * Sin cambios de esquema. Como la 1.1.4: invalida en OPcache solo los .php del propio módulo,
 * para que la siguiente petición sirva ya la clase principal nueva. NUNCA opcache_reset(): vaciaría la caché
 * de toda la tienda. Si no puede, lo anota en el log de PrestaShop y la actualización sigue.
 *
 * Idempotente: re-ejecutarlo es inocuo.
 */
function upgrade_module_1_1_5($module)
{
    if (filter_var(ini_get('opcache.enable'), FILTER_VALIDATE_BOOLEAN)) {
        $ok = function_exists('opcache_invalidate');
        if ($ok) {
            try {
                $files = new RecursiveIteratorIterator(
                    new RecursiveDirectoryIterator(_PS_MODULE_DIR_ . 'zeyvrometacounter/', FilesystemIterator::SKIP_DOTS)
                );
                foreach ($files as $file) {
                    if ($file->isFile() && strtolower($file->getExtension()) === 'php'
                        && !@opcache_invalidate($file->getPathname(), true)
                    ) {
                        $ok = false;
                    }
                }
            } catch (Throwable $e) {
                $ok = false;
            }
        }
        if (!$ok) {
            PrestaShopLogger::addLog(
                'zeyvrometacounter upgrade 1.1.5: OPcache not invalidated, the server may still serve the old code',
                2, null, 'zeyvrometacounter', 0, true
            );
        }
    }
    $module->clearAllCaches();

    return true;
}
