<?php
/**
 * php-cs-fixer config — zeyvrometacounter
 * Ruleset: PrestaShop official (prestashop/php-dev-tools CsFixer\Config).
 * Equivalent to @Symfony + overrides documented in prestashop/php-dev-tools src/CsFixer/Config.php.
 *
 * Run: php-cs-fixer fix --config .php-cs-fixer.dist.php
 *      php-cs-fixer fix --config .php-cs-fixer.dist.php --dry-run --diff
 */

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = Finder::create()
    ->in(__DIR__)
    ->exclude(['vendor', 'node_modules', '_dist', 'translations'])
    ->name('*.php')
    ->notName('*.phtml');

return (new Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        'concat_space' => ['spacing' => 'one'],
        'cast_spaces' => ['space' => 'single'],
        'error_suppression' => [
            'mute_deprecation_error' => false,
            'noise_remaining_usages' => false,
            'noise_remaining_usages_exclude' => [],
        ],
        'function_to_constant' => false,
        'visibility_required' => ['elements' => ['property', 'method']],
        'no_alias_functions' => false,
        'phpdoc_summary' => false,
        'phpdoc_align' => ['align' => 'left'],
        'protected_to_private' => false,
        'psr_autoloading' => false,
        'self_accessor' => false,
        'yoda_style' => false,
        'non_printable_character' => true,
        'no_superfluous_phpdoc_tags' => false,
        // phpdoc_to_comment: convierte /** no-estructurales a /* ordinario.
        // PHP CS Fixer 3.x preserva el primer /** (file-header/licencia) de cada
        // fichero; solo convierte /** secundarios no estructurales. Licenses sigue
        // en 0. Validado Validator real 2026-06-23 (turnstile v1.1.3).
        'phpdoc_to_comment' => true,
        //
        // ── BARRERAS IRREDUCIBLES — contradicciones del propio Validator PS ──────
        //
        // blank_line_after_opening_tag=false OBLIGATORIO.
        // El Validator exige "There must be no blank lines before the file comment"
        // (cabecera /** licencia */ pegada a <?php). Habilitar esta regla rompería
        // Licenses 0→N. Standards residuales por blank_line son IRREDUCIBLES.
        'blank_line_after_opening_tag' => false,
        //
        // no_alternative_syntax=false OBLIGATORIO.
        // Convertiría if/endif a {}. El parser estático del Validator PS detecta
        // `trait X {}` solo dentro de if(...):...endif; en ZeyvroModuleTrait.php.
        // Habilitarla rompe Requirements.
        'no_alternative_syntax' => false,
    ])
    ->setFinder($finder);
