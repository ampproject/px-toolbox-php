<?php // phpcs:ignore PSR12.Files.FileHeader.SpacingAfterBlock
/**
 * Plugin Name: PX Toolbox PHP Test Plugin
 */

/**
 * Use unoptimized web font to trigger CLS issues.
 */
function px_toolbox_test_plugin_enqueue_scripts()
{
    wp_enqueue_style(
        'px-toolbox-test-plugin-google-font',
        'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,'
        . '300;0,400;0,500;0,600;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap'
    );

    wp_enqueue_style(
        'px-toolbox-test-plugin',
        plugin_dir_url(__FILE__) . 'px-toolbox-test-plugin.css',
        [ 'px-toolbox-test-plugin-google-font' ]
    );

    wp_enqueue_script(
        'px-toolbox-test-plugin',
        plugin_dir_url(__FILE__) . 'px-toolbox-test-plugin.js',
        [],
    );
}

add_action('wp_enqueue_scripts', 'px_toolbox_test_plugin_enqueue_scripts');

/**
 * Remove some best practices from the HTML.
 */
function my_string_conversion()
{
    ob_start('ob_callback');
}

/**
 * Callback function for the ob_start() call.
 *
 * @param string $buffer The buffer to process.
 * @return string
 */
function ob_callback($buffer)
{
    $buffer = str_replace(
        [
            '<!DOCTYPE html>',
            '<meta charset="UTF-8" />',
            '<meta name="viewport" content="width=device-width, initial-scale=1" />',
            'rel="preload"',
        ],
        '',
        $buffer
    );

    $buffer = preg_replace('/aria-.+?=".+?"/', '', $buffer);

    return $buffer;
}

add_action('template_redirect', 'my_string_conversion', -100);

/**
 * Remove resource hints to browsers.
 */
function remove_wp_resource_hints()
{
    remove_action('wp_head', 'wp_resource_hints', 2);
}

add_action('wp_head', 'remove_wp_resource_hints', 1);
