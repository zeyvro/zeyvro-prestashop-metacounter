<?php
/**
 * Zeyvro Meta Counter — upgrade-1.0.3
 *
 * @author    Zeyvro
 * @copyright 2026 Zeyvro
 * @license   MIT
 */
if (!defined('_PS_VERSION_')) {
    exit;
}

/**
 * v1.0.3 — Retrofit ZeyvroModuleTrait: base común de código.
 * Sin cambios de BD ni tabs (módulo sin BO controller).
 * Idempotente: re-ejecutar es inocuo.
 */
function upgrade_module_1_0_3($module)
{
    $module->clearAllCaches();

    return true;
}
