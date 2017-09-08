<?php
/*
Plugin Name: Asano Contact Form
Description: Contact form integration for Asano.
Text Domain: asano-contact-form
Version: 1.0
*/

define('ASANOCF_PLUGIN_DIR', untrailingslashit(dirname(__FILE__)));

add_action('admin_menu', 'asanocf_admin_menu');
add_shortcode('asano-contact-form', 'asanocf_shortcode');

function asanocf_shortcode() {
  ob_start();
  require_once ASANOCF_PLUGIN_DIR . '/includes/shortcode-form.php';
  return ob_get_clean();
}

function asanocf_admin_menu() {
	global $_wp_last_object_menu;
  
	$_wp_last_object_menu++;
  add_menu_page(
    __('Asano Contact Form', 'asano-contact-form'),
    __('Contact', 'asano-contact-form'),
    'manage_options',
    'asanocf',
    'asanocf_admin_management_page',
    'dashicons-email',
    $_wp_last_object_menu
  );
}

function asanocf_admin_management_page() {
  if (isset($_POST['action']) && $_POST['action'] == 'signout') {
    delete_option('asanocf_id');
  }
  
  if (isset($_POST['id'])) {
    update_option('asanocf_id', $_POST['id']);
  }
  
  if (get_option('asanocf_id')) {
    require_once ASANOCF_PLUGIN_DIR . '/includes/page-management.php';
  } else {
    require_once ASANOCF_PLUGIN_DIR . '/includes/page-login.php';
  }
}

