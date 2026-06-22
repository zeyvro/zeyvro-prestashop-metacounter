<?php
/**
 * Zeyvro Meta Counter — upgrade-1.0.6
 *
 * @author    Zeyvro
 * @copyright 2026 Zeyvro
 * @license   MIT
 */
if (!defined('_PS_VERSION_')) {
    exit;
}

/**
 * v1.0.6 — Validator Verified+: Licenses 0 (docblock /** en index.php + EOL LF uniforme).
 * Sin cambios de BD ni tabs. Idempotente: re-ejecutar es inocuo.
 */
function upgrade_module_1_0_6($module)
{
    $module->clearAllCaches();

    return true;
}
