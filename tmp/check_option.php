<?php
require_once('../../../wp-load.php');

// Trigger 'init' hook manually since we are running via CLI
do_action('init');

$option = get_option('acme_settings');

if ($option !== false) {
    echo "Option 'acme_settings' exists.\n";
    if (is_array($option)) {
        echo "Option value is an array.\n";
    } else {
        echo "Option value is NOT an array: " . json_encode($option) . "\n";
    }
} else {
    echo "Option 'acme_settings' does NOT exist.\n";
}
