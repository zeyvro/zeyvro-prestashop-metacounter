<?php
/**
 * Upgrade 1.1.7: declara compatibilidad hasta PrestaShop 9.2.0.
 *
 * @author    Zeyvro <hello@zeyvro.com>
 * @copyright 2026 Zeyvro
 * @license   https://opensource.org/licenses/AFL-3.0 AFL-3.0
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

/**
 * Upgrade to version 1.1.7
 * Summary: no schema or configuration changes (PHP only). Idempotent.
 */
function upgrade_module_1_1_7(Module $module): bool
{
    return true;
}
