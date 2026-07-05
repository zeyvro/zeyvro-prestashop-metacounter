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

function upgrade_module_1_1_0(Module $module): bool
{
    try {
        // v1.1.0 — Canonical NOTICE OF LICENSE header + generator-pattern cleanup.
        // No BD changes. Idempotent: re-running is harmless.
        if (function_exists('opcache_reset')) {
            @opcache_reset();
        }
        @Tools::clearSmartyCache();
        @Media::clearCache();

        return true;
    } catch (Exception $e) {
        PrestaShopLogger::addLog(
            'zeyvrometacounter upgrade-1.1.0 error: ' . $e->getMessage(),
            3, null, 'zeyvrometacounter', 0, true
        );

        return true;
    }
}
