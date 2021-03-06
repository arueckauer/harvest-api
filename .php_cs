<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__);

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setUsingCache(false)
    ->setRules([
        '@PSR2'                                     => true,
        'align_multiline_comment'                   => true,
        'array_indentation'                         => true,
        'array_syntax'                              => ['syntax' => 'short'],
        'binary_operator_spaces'                    => ['default' => 'align_single_space_minimal'],
        'blank_line_after_opening_tag'              => true,
        'class_attributes_separation'               => true,
        'combine_consecutive_issets'                => true,
        'general_phpdoc_annotation_remove'          => ['annotations' => ['author', 'package', 'subpackage']],
        'declare_equal_normalize'                   => ['space' => 'single'],
        'declare_strict_types'                      => true,
        'dir_constant'                              => true,
        'fully_qualified_strict_types'              => true,
        'function_typehint_space'                   => true,
        'heredoc_to_nowdoc'                         => true,
        'include'                                   => true,
        'is_null'                                   => ['use_yoda_style' => true],
        'linebreak_after_opening_tag'               => true,
        'list_syntax'                               => ['syntax' => 'short'],
        'lowercase_cast'                            => true,
        'lowercase_constants'                       => true,
        'lowercase_keywords'                        => true,
        'modernize_types_casting'                   => true,
        'new_with_braces'                           => true,
        'no_alias_functions'                        => true,
        'no_alternative_syntax'                     => true,
        'no_blank_lines_after_phpdoc'               => true,
        'no_empty_comment'                          => true,
        'no_empty_phpdoc'                           => true,
        'no_empty_statement'                        => true,
        'no_leading_import_slash'                   => true,
        'no_leading_namespace_whitespace'           => true,
        'no_mixed_echo_print'                       => ['use' => 'echo'],
        'no_multiline_whitespace_before_semicolons' => true,
        'no_null_property_initialization'           => true,
        'no_php4_constructor'                       => true,
        'no_short_echo_tag'                         => false,
        'no_unreachable_default_argument_value'     => true,
        'no_useless_else'                           => true,
        'no_useless_return'                         => true,
        'not_operator_with_successor_space'         => true,
        'ordered_class_elements'                    => true,
        'ordered_imports'                           => true,
        'phpdoc_add_missing_param_annotation'       => ['only_untyped' => false],
        'phpdoc_order'                              => true,
        'phpdoc_return_self_reference'              => true,
        'phpdoc_scalar'                             => true,
        'phpdoc_single_line_var_spacing'            => true,
        'phpdoc_to_comment'                         => true,
        'phpdoc_trim'                               => true,
        'phpdoc_types_order'                        => ['null_adjustment' => 'always_last'],
        'phpdoc_var_without_name'                   => true,
        'return_type_declaration'                   => ['space_before' => 'one'],
        'short_scalar_cast'                         => true,
        'single_blank_line_before_namespace'        => true,
        'single_line_comment_style'                 => true,
        'single_quote'                              => ['strings_containing_single_quote_chars' => true],
        'standardize_increment'                     => true,
        'standardize_not_equals'                    => true,
        'trailing_comma_in_multiline_array'         => true,
        'trim_array_spaces'                         => true,
        'whitespace_after_comma_in_array'           => true,
        'yoda_style'                                => true,
    ])
    ->setFinder($finder);
