<?php
/**
 * Zeyvro Meta Counter — character counter for meta_title and meta_description in PrestaShop backoffice.
 *
 * @author    Zeyvro
 * @copyright 2026 Zeyvro
 * @license   MIT
 */
if (!defined('_PS_VERSION_')) {
    exit;
}

require_once __DIR__ . '/classes/ZeyvroModuleTrait.php';

class Zeyvrometacounter extends Module
{
    use ZeyvroModuleTrait;

    public const ZV_TAB_CLASS = '';        // sin tab visible — módulo sin BO controller
    public const ZV_TAB_NAME = '';
    public const ZV_TAB_ICON = '';
    public const ZV_ADS_VARIANT = 'free';
    public const ZV_SCHEMA_TABV = 'A';
    public const ZV_SCHEMA_KEY = 'ZEYVROMETACOUNTER_TABV';

    public function __construct()
    {
        $this->name = 'zeyvrometacounter';
        $this->tab = 'seo';
        $this->version = '1.0.5';
        $this->author = 'Zeyvro';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = ['min' => '8.0.0', 'max' => '9.99.99'];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Zeyvro Meta Counter');
        $this->description = $this->l('Adds an SEO-oriented character counter (60 for meta_title, 160 for meta_description) to PrestaShop backoffice forms. Hides the native counter on the V2 product page to avoid duplication.');
        $this->confirmUninstall = $this->l('Uninstall Zeyvro Meta Counter?');

        // §7.1 — Auto-upgrade al subir ZIP por BO
        if (defined('_PS_ADMIN_DIR_') && !defined('ZEYVROMETACOUNTER_UPGRADING')) {
            $this->runAutoUpgrade();
        }
    }

    public function install(): bool
    {
        $ok = parent::install()
            && $this->registerHook('actionAdminControllerSetMedia');
        if ($ok) {
            $this->clearAllCaches();
        }

        return $ok;
    }

    public function uninstall(): bool
    {
        return parent::uninstall();
    }

    public function hookActionAdminControllerSetMedia($params)
    {
        $controller = $this->context->controller;
        if (!is_object($controller)) {
            return;
        }
        $controller->addCSS($this->_path . 'views/css/meta-counter.css');
        $controller->addJS($this->_path . 'views/js/meta-counter.js');
    }

    // ─── AUTO-UPGRADE §7.1 ───────────────────────────────────────────────────

    private function runAutoUpgrade(): void
    {
        try {
            $installed = (string) Configuration::get('ZEYVROMETACOUNTER_VERSION');
            if (!$installed || !preg_match('/^\d+\.\d+\.\d+$/', $installed)) {
                $installed = (string) Db::getInstance()->getValue(
                    'SELECT `version` FROM `' . _DB_PREFIX_ . 'module`
                     WHERE `name` = "zeyvrometacounter"'
                );
            }
            if (!$installed || !preg_match('/^\d+\.\d+\.\d+$/', $installed)) {
                return;
            }
            $xmlPath = dirname(__FILE__) . '/config.xml';
            if (!file_exists($xmlPath)) {
                return;
            }
            $xml = @simplexml_load_file($xmlPath);
            if (!$xml) {
                return;
            }
            $target = (string) $xml->version;
            if (!preg_match('/^\d+\.\d+\.\d+$/', $target)) {
                return;
            }
            if (version_compare($installed, $target, '>=')) {
                return;
            }
            define('ZEYVROMETACOUNTER_UPGRADING', true);
            $scripts = glob(dirname(__FILE__) . '/upgrade/upgrade-*.php');
            if ($scripts) {
                usort($scripts, function ($a, $b) {
                    $va = preg_replace('/.*upgrade-(.+)\.php$/', '$1', $a);
                    $vb = preg_replace('/.*upgrade-(.+)\.php$/', '$1', $b);

                    return version_compare($va, $vb);
                });
                foreach ($scripts as $script) {
                    $sv = preg_replace('/.*upgrade-(.+)\.php$/', '$1', $script);
                    if (version_compare($sv, $installed, '>') && version_compare($sv, $target, '<=')) {
                        include_once $script;
                        $fn = 'upgrade_module_' . str_replace('.', '_', $sv);
                        if (function_exists($fn) && !$fn($this)) {
                            PrestaShopLogger::addLog(
                                'zeyvrometacounter: upgrade script ' . $sv . ' failed',
                                3, null, 'zeyvrometacounter', 0, true
                            );

                            return;
                        }
                    }
                }
            }
            Configuration::updateValue('ZEYVROMETACOUNTER_VERSION', $target);
            Db::getInstance()->execute(
                'UPDATE `' . _DB_PREFIX_ . 'module` SET `version` = "' . pSQL($target) . '"
                 WHERE `name` = "zeyvrometacounter"'
            );
            $this->clearAllCaches();
        } catch (Throwable $t) {
            PrestaShopLogger::addLog(
                'zeyvrometacounter auto-upgrade error: ' . $t->getMessage(),
                3, null, 'zeyvrometacounter', 0, true
            );
        }
    }
}
