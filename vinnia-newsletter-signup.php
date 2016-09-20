<?php

/*
Plugin Name: Vinnia Newsletter Signup
Plugin URI: http://www.vinnia.se
Description: Signup for Mailchimp.
Version: 0.1
Author: Joakim Carlsten
Author URI: http://www.vinnia.se
License: Don't know GPL, perhaps?
*/


defined('ABSPATH') or die('No script kiddies please!');

use NewsletterSignup\Core;
use NewsletterSignup\Frontend;
use NewsletterSignup\Plugin;
use NewsletterSignup\Admin\SettingsPage;

define('NEWSLETTER_BASE_CLASS_NAME', 'NewsletterSignup');

require_once "autoload.php";

add_action( 'plugins_loaded', function () {
    newsletterSignupInit();
}); // Hook initialization function

function newsletterSignupInit() {
    $plugin = new Plugin(); // Create container
    $plugin['path'] = realpath( plugin_dir_path( __FILE__ ) ) . DIRECTORY_SEPARATOR;
    $plugin['url'] = plugin_dir_url( __FILE__ );
    $plugin['version'] = '0.1';
    $plugin['settings_page_properties'] = array(
        'parent_slug' => 'options-general.php',
        'page_title' =>  'Mailchimp',
        'menu_title' =>  'Mailchimp',
        'capability' => 'manage_options',
        'menu_slug' => 'mailchimp-settings',
        'option_group' => 'mailchimp_option_group',
        'option_name' => 'mailchimp_option_name'
    );
    $options = get_option('mailchimp_option_name');
    $mailchimpApiKey = $options['mailchimp_api_key'] ?? '';
    $newsletterSubscriptionListId = $options['newsletterSubscriptionListId'] ?? '';
    if (!empty($mailchimpApiKey) && !empty($newsletterSubscriptionListId)) {
        $mailchimpClient = new NewsletterSignup\Vendor\MailChimp\MailChimp($mailchimpApiKey);
        $plugin['core_logic'] = new Core($plugin['url'], $mailchimpClient, $newsletterSubscriptionListId);
        $plugin['frontend_form'] = new Frontend();
    }
    $plugin['settings_page'] = new SettingsPage( $plugin['settings_page_properties'] );
    $plugin->run();
}

