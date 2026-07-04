<?php
if (!defined('_PS_VERSION_')) {
    exit;
}

/**
 * v1.1.2 — Tanda Trait Fase B4: ZeyvroModuleTrait actualizado al canon FULL
 * unificado (_shared/ZeyvroModuleTrait.php, sha256 1c0a27c2...). Gana
 * renderZeyvroAds() con feed remoto + i18n; sin cambios de BD ni tabs
 * (módulo sin BO controller). Idempotente: re-ejecutar es inocuo.
 */
function upgrade_module_1_1_2($module)
{
    $module->clearAllCaches();

    return true;
}
