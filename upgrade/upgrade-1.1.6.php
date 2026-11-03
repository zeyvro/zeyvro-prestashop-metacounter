<?php
/**
 * Upgrade 1.1.6: el tipo de objeto de addLog() solo lleva letras (PS 8.0.x rechaza el guion bajo).
 *
 * @author    Zeyvro <hello@zeyvro.com>
 * @copyright 2026 Zeyvro
 * @license   https://opensource.org/licenses/AFL-3.0 AFL-3.0
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

/**
 * Upgrade to version 1.1.6
 * Summary: no schema or configuration changes (PHP only). Idempotent.
 */
function upgrade_module_1_1_6(Module $module): bool
{
    return true;
}
