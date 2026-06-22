<?php
/**
 * Zeyvro Meta Counter — upgrade-1.0.2
 *
 * @author    Zeyvro
 * @copyright 2026 Zeyvro
 * @license   MIT
 */
if (!defined('_PS_VERSION_')) {
    exit;
}
function upgrade_module_1_0_2($module)
{
    $module->clearAllCaches();

    return true;
}
