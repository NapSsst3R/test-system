<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->notPath(['tests/_support/_generated', 'tests/_output', 'tests/bin'])
    ->exclude(['bin', 'public', 'templates', 'vendor', 'var']);

return (new PhpCsFixer\Config())
    ->setRules([
        '@PhpCsFixer' => true,
        '@PHP81Migration' => true,
        'phpdoc_add_missing_param_annotation' => ['only_untyped' => true],
        'php_unit_test_class_requires_covers' => false,
        'php_unit_internal_class' => false,
        'array_syntax' => ['syntax' => 'short'],
        'phpdoc_align' => ['align' => 'left'],
        'cast_spaces' => ['space' => 'none'],
        'phpdoc_var_without_name' => false,
        'single_blank_line_at_eof' => true,
        'no_spaces_around_offset' => false,
        'phpdoc_to_comment' => false,
        'phpdoc_annotation_without_dot' => false,
        'phpdoc_summary' => true,
        'no_alternative_syntax' => true,
        'no_superfluous_elseif' => false,
        'no_unneeded_curly_braces' => false,
        'ordered_class_elements' => true,
        'phpdoc_trim_consecutive_blank_line_separation' => false,
        'multiline_whitespace_before_semicolons' => ['strategy' => 'no_multi_line'],
        'no_superfluous_phpdoc_tags' => ['allow_mixed' => true, 'allow_unused_params' => false],
        'phpdoc_no_empty_return' => false,
        'concat_space' => ['spacing' => 'one'],
        'increment_style' => ['style' => 'pre'],
        'semicolon_after_instruction' => false,
        'single_line_comment_style' => false,
        'echo_tag_syntax' => ['format' => 'short', 'shorten_simple_statements_only' => true],
        'blank_line_before_statement' => [
            'statements' => [
                'break', 'case', 'continue', 'declare', 'default', 'exit', 'goto',
                'return', 'switch', 'throw', 'try',
            ],
        ],
        // risky
        'protected_to_private' => false,
        'dir_constant' => true,
        'ereg_to_preg' => true,
        'logical_operators' => true,
        'strict_comparison' => true,
        'is_null' => true,
        'modernize_types_casting' => true,
        'no_alias_functions' => true,
        'no_homoglyph_names' => true,
        'non_printable_character' => true,
        'error_suppression' => true,
        'fopen_flag_order' => true,
        'random_api_migration' => true,
        'set_type_to_cast' => true,
        'declare_strict_types' => true,
    ])
    ->setFinder($finder);
