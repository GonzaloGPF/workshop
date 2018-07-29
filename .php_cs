<?php

/**
 * Config for PHP-CS-Fixer ver2
 */
$rules = [
    '@PSR2' => true,
    // addtional rules
    'array_syntax' => ['syntax' => 'short'],
    'no_multiline_whitespace_before_semicolons' => true,
    'no_short_echo_tag' => true,
    'no_unused_imports' => true,
    'not_operator_with_successor_space' => true,
];

$excludes = [
    // add exclude project directory
    'node_modules',
    'vendor',
    'public',
    'tests',
    'storage',
    'report'
];

$finder = PhpCsFixer\Finder::create()
    ->exclude($excludes)
    ->in(__DIR__)
    ->name('*.php')
    ->notName('*.blade.php')
    ->notName('README.md')
    ->notName('*.xml')
    ->notName('*.yml')
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return PhpCsFixer\Config::create()
    ->setRules($rules)
    ->setFinder($finder);