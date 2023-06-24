<?php
/**
 * Plugin Name: MoneyUnify
 * Plugin URI: https://moneyunify.com
 * Description: MoneyUnify is an easy-to-use USSD mobile money payments API that simplifies payment processes.
 * Version: 1.0.0
 * Requires at least: 4.7
 * Requires PHP: 7.0
 * Author: Blessed Jason Mwanza
 * Author URI: https:blessedjasonmwanza.tech
 * Update URI: https://github.com/blessedjasonmwanza/MoneyUnify/tree/wp_plugin
 */


// Exit if accessed directly
if (!defined('ABSPATH')) {
  exit;
}


// Create MoneyUnify orders table on plugin activation
function moneyunify_create_orders_table() {
  global $wpdb;
  $table_name = $wpdb->prefix . 'moneyunify_orders';
  $charset_collate = $wpdb->get_charset_collate();

  $sql = "CREATE TABLE IF NOT EXISTS $table_name (
    id INT(11) NOT NULL AUTO_INCREMENT,
    product_id INT(11) NOT NULL,
    product_description VARCHAR(255) NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone_number VARCHAR(20) NOT NULL,
    transaction_details VARCHAR(255) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    created_at DATETIME NOT NULL,
    PRIMARY KEY (id)
  ) $charset_collate;";

  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
  dbDelta($sql);
}
register_activation_hook(__FILE__, 'moneyunify_create_orders_table');

// Add MoneyUnify Settings to menu
function moneyunify_add_settings_menu() {
  add_menu_page(
    'MoneyUnify Settings',
    'MoneyUnify',
    'manage_options',
    'moneyunify-settings',
    'moneyunify_render_settings_page',
    'dashicons-money-alt',
    80
  );
}
add_action('admin_menu', 'moneyunify_add_settings_menu');

// Render MoneyUnify Settings page
function moneyunify_render_settings_page() {
  $muid = get_option('moneyunify_muid');
  $payment_aggregator = get_option('moneyunify_payment_aggregator');
  $use_as_default_checkout = get_option('moneyunify_use_as_default_checkout');
  ?>
  <div class="wrap">
    <h1><?php esc_html_e('MoneyUnify Settings', 'moneyunify'); ?></h1>
    <form method="post" action="options.php">
      <?php settings_fields('moneyunify-settings-group'); ?>
      <?php do_settings_sections('moneyunify-settings-group'); ?>
      <table class="form-table">
        <tr valign="top">
          <th scope="row"><?php esc_html_e('MUI ID', 'moneyunify'); ?></th>
          <td><input type="text" name="moneyunify_muid" value="<?php echo esc_attr($muid); ?>" /></td>
        </tr>
        <tr valign="top">
          <th scope="row"><?php esc_html_e('Payment Aggregators', 'moneyunify'); ?></th>
          <td><input type="text" name="moneyunify_payment_aggregator" value="<?php echo esc_attr($payment_aggregator); ?>" /></td>
        </tr>
        <tr valign="top">
          <th scope="row"><?php esc_html_e('Use as Default Checkout', 'moneyunify'); ?></th>
          <td><label><input type="checkbox" name="moneyunify_use_as_default_checkout" value="1" <?php checked($use_as_default_checkout, 1); ?> /> <?php esc_html_e('Enable MoneyUnify as default checkout', 'moneyunify'); ?></label></td>
        </tr>
      </table>
      <?php submit_button(); ?>
    </form>
  </div>
  <?php
}

// Register MoneyUnify plugin settings
function moneyunify_register_settings() {
  register_setting('moneyunify-settings-group', 'moneyunify_muid');
  register_setting('moneyunify-settings-group', 'moneyunify_payment_aggregator');
  register_setting('moneyunify-settings-group', 'moneyunify_use_as_default_checkout');
}
add_action('admin_init', 'moneyunify_register_settings');

// Add MoneyUnify shortcode
function moneyunify_shortcode($atts) {
  $product_id = get_product_id_from_url();
  $product_description = get_the_title();
  ob_start();
  ?>
  <form id="moneyunify-form" action="" method="POST">
    <input type="hidden" name="product_id" value="<?php echo esc_attr($product_id); ?>" />
    <input type="hidden" name="product_description" value="<?php echo esc_attr($product_description); ?>" />
    <!-- Generate input fields for user details based on MoneyUnify code sample -->
    <input type="text" name="first_name" placeholder="First Name" required />
    <input type="text" name="last_name" placeholder="Last Name" required />
    <input type="email" name="email" placeholder="Email" required />
    <input type="tel" name="phone_number" placeholder="Phone Number" required />
    <input type="text" name="transaction_details" placeholder="Transaction Details" required />
    <input type="number" name="amount" placeholder="Amount" required />
    <button type="submit">Submit</button>
  </form>
  <?php
  return ob_get_clean();
}
add_shortcode('moneyunify', 'moneyunify_shortcode');

// Handle MoneyUnify form submission
function moneyunify_handle_form_submission() {
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $muid = get_option('moneyunify_muid');
    $payment_aggregator = get_option('moneyunify_payment_aggregator');
    $product_id = sanitize_text_field($_POST['product_id']);
    $product_description = sanitize_text_field($_POST['product_description']);
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $email = sanitize_email($_POST['email']);
    $phone_number = sanitize_text_field($_POST['phone_number']);
    $transaction_details = sanitize_text_field($_POST['transaction_details']);
    $amount = sanitize_text_field($_POST['amount']);

    $order_id = save_order_data($product_id, $product_description, $first_name, $last_name, $email, $phone_number, $transaction_details, $amount);
    if ($order_id) {
      send_moneyunify_api_request($muid, $payment_aggregator, $order_id, $product_id, $product_description, $first_name, $last_name, $email, $phone_number, $transaction_details, $amount);
      wp_redirect(wc_get_cart_url());
      exit;
    } else {
      echo '<div class="moneyunify-error">' . esc_html__('Error occurred while processing the order. Please try again.', 'moneyunify') . '</div>';
    }
  }
}
add_action('init', 'moneyunify_handle_form_submission');

// Save order data
function save_order_data($product_id, $product_description, $first_name, $last_name, $email, $phone_number, $transaction_details, $amount) {
  global $wpdb;
  $table_name = $wpdb->prefix . 'moneyunify_orders';

  $data = array(
    'product_id' => $product_id,
    'product_description' => $product_description,
    'first_name' => $first_name,
    'last_name' => $last_name,
    'email' => $email,
    'phone_number' => $phone_number,
    'transaction_details' => $transaction_details,
    'amount' => $amount,
    'created_at' => current_time('mysql'),
  );

  $format = array('%d', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s');

  if ($wpdb->insert($table_name, $data, $format)) {
    return $wpdb->insert_id;
  }

  return false;
}

// Send MoneyUnify API request
function send_moneyunify_api_request($muid, $payment_aggregator, $order_id, $product_id, $product_description, $first_name, $last_name, $email, $phone_number, $transaction_details, $amount) {
  // Prepare the data for the API request
  $data = array(
    'muid' => $muid,
    'payment_aggregator' => $payment_aggregator,
    'order_id' => $order_id,
    'product_id' => $product_id,
    'product_description' => $product_description,
    'first_name' => $first_name,
    'last_name' => $last_name,
    'email' => $email,
    'phone_number' => $phone_number,
    'transaction_details' => $transaction_details,
    'amount' => $amount,
  );

  // Convert the data to JSON
  $data_json = json_encode($data);

  // Set the API endpoint URL
  $api_url = 'https://api.moneyunify.com/payment';

  // Create a new cURL resource
  $ch = curl_init($api_url);

  // Set cURL options
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_json)
  ));

  // Execute the API request
  $response = curl_exec($ch);

  // Check for cURL errors
  if (curl_errno($ch)) {
    $error_message = curl_error($ch);
    // Handle the error appropriately (e.g., log or display an error message)
    error_log('MoneyUnify API request failed: ' . $error_message);
    return; // Exit the function if there was an error
  }

  // Close the cURL resource
  curl_close($ch);

  // Process the API response
  if ($response) {
    $response_data = json_decode($response, true);
    
    // Check if the API request was successful
    if ($response_data['status'] === 'success') {
      // Process the successful response (e.g., update order status, redirect to success page)
      $transaction_id = $response_data['transaction_id'];
      $order_status = $response_data['order_status'];
      // Update the order status in your database or perform any other necessary actions
      // Example: update_order_status($order_id, $transaction_id, $order_status);
      // Example: redirect_to_success_page($order_id, $transaction_id);
    } else {
      // Handle the API response indicating a failure (e.g., log or display an error message)
      $error_message = $response_data['message'];
      error_log('MoneyUnify API request failed: ' . $error_message);
      // Display an error message to the user or handle the failure accordingly
    }
  } else {
    // Handle the empty response case (e.g., log or display an error message)
    error_log('Empty response received from MoneyUnify API');
    // Display an error message to the user or handle the failure accordingly
  }
}


// Get product ID from URL
function get_product_id_from_url() {
  global $post;

  if (is_singular('product')) {
    return $post->ID;
  }

  return 0;
}

// Get product description
function get_product_description() {
  global $post;

  if (is_singular('product')) {
    return $post->post_title;
  }

  return '';
}

// Enqueue MoneyUnify scripts
function moneyunify_enqueue_scripts() {
  wp_enqueue_script('moneyunify', plugin_dir_url(__FILE__) . 'js/moneyunify.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'moneyunify_enqueue_scripts');


