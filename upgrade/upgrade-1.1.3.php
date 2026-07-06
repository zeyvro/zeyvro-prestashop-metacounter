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
 * v1.1.3 — canon ZeyvroModuleTrait.php reformateado a estandar oficial PS
 * (llaves, zvTabIdFromClassName) + config cs-fixer a 1 barrera. Sin cambios
 * de BD ni de tabs. Idempotente: re-ejecutar es inocuo.
 */
function upgrade_module_1_1_3($module)
{
    $module->clearAllCaches();

    return true;
}
