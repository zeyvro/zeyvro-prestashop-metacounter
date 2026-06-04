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

class Zeyvrometacounter extends Module
{
    public function __construct()
    {
        $this->name = 'zeyvrometacounter';
        $this->tab = 'seo';
        $this->version = '1.0.1';
        $this->author = 'Zeyvro';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = ['min' => '8.0.0', 'max' => '8.99.99'];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Zeyvro Meta Counter');
        $this->description = $this->l('Adds an SEO-oriented character counter (60 for meta_title, 160 for meta_description) to PrestaShop backoffice forms. Hides the native counter on the V2 product page to avoid duplication.');
        $this->confirmUninstall = $this->l('Uninstall Zeyvro Meta Counter?');
    }

    public function install(): bool
    {
        return parent::install()
            && $this->registerHook('actionAdminControllerSetMedia');
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
}
