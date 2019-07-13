<?php
/**
 * Plugin Name: Expand the shipping methods
 * Description: Expand the Flat and free shipping methods to add carrier.
 * Version: 1.0
 * Author: Moustafa Gouda
 * Author URI: https://github.com/bafi
 */

$shipment_methods = ['flat_rate', 'free_shipping'];
foreach ($shipment_methods as $method) {
    add_filter("woocommerce_shipping_instance_form_fields_{$method}", 'expand_shipping_method_woocommerce_shipping_instance_form_fields');
}
add_action('woocommerce_order_status_processing', 'expand_shipping_method_woocommerce_order_status_processing');


/**
 * Alter order when the status change to processing to append free shipping carrier ID
 * @param $order_id
 */
function expand_shipping_method_woocommerce_order_status_processing($order_id) {

    $shipment_methods = ['flat_rate', 'free_shipping'];
    $order = wc_get_order($order_id);

    if (!$order) {
        return;
    }

    /** @var WC_Order_Item_Shipping $shipping */
    foreach ($order->get_items('shipping') as $shipping) {
        $instance_id = $shipping->get_instance_id();
        $shipping_method_id = $shipping->get_method_id();
    }

    switch ($shipping_method_id) {
        case 'flat_rate':
            $shipping_method = new WC_Shipping_Flat_Rate($instance_id);
            update_post_meta($order_id, '_carrier_id', $shipping_method->get_option('_carrier_id'));
            break;
        case 'free_shipping':
            $shipping_method = new WC_Shipping_Free_Shipping($instance_id);
            update_post_meta($order_id, '_carrier_id', $shipping_method->get_option('_carrier_id'));
            break;
    }
}

/**
 * Get settings fields for instances of the selected shipping method (within zones).
 * Override the shipping methods to add options.
 *
 * @return array
 * @since 2.6.0
 */
function expand_shipping_method_woocommerce_shipping_instance_form_fields($formFields) {
    $formFields['_carrier_id'] = [
        'title' => 'Carrier ID',
        'type' => 'text',
        'description' => 'Description of carrier ID should GOES_HERE.',
        'default' => '0',
    ];

    return $formFields;
}