<?php

$finder = (new PhpCsFixer\Finder())
    ->in([
        __DIR__ . \DIRECTORY_SEPARATOR . 'src' . \DIRECTORY_SEPARATOR,
        __DIR__ . \DIRECTORY_SEPARATOR . 'tests' . \DIRECTORY_SEPARATOR,
    ])
;

return (new PhpCsFixer\Config())
    ->setParallelConfig(PhpCsFixer\Runner\Parallel\ParallelConfigFactory::detect())
    ->setRules(
        [
            '@Symfony'                              => true,
            '@Symfony:risky'                        => true,
            'no_unreachable_default_argument_value' => false,
            'heredoc_to_nowdoc'                     => false,
            'phpdoc_annotation_without_dot'         => false,
            'strict_comparison'                     => true,
            'concat_space'                          => [
                'spacing' => 'one',
            ],
            'binary_operator_spaces' => [
                'default' => 'align_single_space_minimal',
            ],
            'array_indentation'           => true,
            'blank_line_before_statement' => [
                'statements' => [
                    'return',
                    'continue',
                    'exit',
                    'for',
                    'foreach',
                    'declare',
                    'if',
                    'return',
                    'throw',
                    'break',
                ],
            ],
            'yoda_style'                                       => true,
            'no_superfluous_phpdoc_tags'                       => true,
            'combine_consecutive_issets'                       => true,
            'combine_consecutive_unsets'                       => true,
            'method_chaining_indentation'                      => true,
            'php_unit_test_case_static_method_calls'           => ['call_type' => 'this'],
            'single_line_throw'                                => false,
            'nullable_type_declaration_for_default_null_value' => true,
            'protected_to_private'                             => false,
            'trailing_comma_in_multiline'                      => ['elements' => ['arrays', 'match', 'parameters']],
        ]
    )
    ->setRiskyAllowed(true)
    ->setFinder($finder)
;
