## Technical assessment 

#### Prerequisites:
You need to run locally with the solution of your choice:
- WordPress as the CMS
- WooCommerce as active Plugin
- StoreFront as default Theme

#### Task
Create a ​ small​ WordPress/WooCommerce plugin which:
* Creates and saves a new text input field ***Carrier ID​*** for the shipping methods
***Flat-rate***​ and ***Free-shipping​*** in the ***WP-Admin > WooCommerce >
Settings > Shipping*** tab.
It should expand the existing fields:
    1. Flat-rate​ : ***Method Title***, ***Tax Status***, and ***Cost***.
    2. Free Shipping​ :​ ***Title*** and ***Free Shipping Requires***.
* Saving the value with the​ meta key​ ***​_carrier_id​*** in the order meta data
of each order - when the order changes to the order status ***Processing***
(​ wc-processing ​ ).

#### Additional information

* I created a separate plugin called ***Expand the shipping methods*** you can find it on the following path
`[PROJECT_PATH]/wp-content/plugins/ExpandShippingMethods/index.php`.
* Once you installed the database or copy the plugin you have to enable it from wordpress dashboard.