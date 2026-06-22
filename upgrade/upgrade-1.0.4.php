<?php
/**
 * Zeyvro Meta Counter — upgrade-1.0.4
 *
 * @author    Zeyvro
 * @copyright 2026 Zeyvro
 * @license   AFL-3.0
 */
if (!defined('_PS_VERSION_')) {
    exit;
}

/**
 * v1.0.4 — PS9 compatibility: ps_versions_compliancy max bumped to 9.99.99.
 * Sin cambios de BD ni tabs (módulo sin BO controller).
 * Idempotente: re-ejecutar es inocuo.
 */
function upgrade_module_1_0_4($module)
{
    $module->clearAllCaches();
    return true;
}
