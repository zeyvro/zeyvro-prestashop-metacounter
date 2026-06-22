<?php
/**
 * Zeyvro Meta Counter — upgrade-1.0.5
 *
 * @author    Zeyvro
 * @copyright 2026 Zeyvro
 * @license   MIT
 */
if (!defined('_PS_VERSION_')) {
    exit;
}

/**
 * v1.0.5 — Validator Verified+: Requirements/Compatibility/Licenses/Standards polish.
 * Sin cambios de BD ni tabs (módulo sin BO controller).
 * Idempotente: re-ejecutar es inocuo.
 */
function upgrade_module_1_0_5($module)
{
    $module->clearAllCaches();

    return true;
}
