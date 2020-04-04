=== WooCommerce Vehicle Parts Finder - Year/Make/Model/Engine/Category/Keyword ===
Contributors: wpinstinct
Tags: e-commerce, shop, woocommerce, wordpress, filter, year, make, model, engine, category, keyword, vehicle parts, car, bike, responsive, csv, import
Requires at least: 4.0
Tested up to: 4.7.x

"WooCommerce Vehicle Parts Finder" adds the filter for vehicle accessories/parts based on Year/Make/Model/Engine/Category/Keyword.

== Description ==

“WooCommerce Vehicle Parts Finder - Year/Make/Model/Engine/Category/Keyword” is one of the best plugin for find Vehicles or Vehicle Parts on the website based on Year/Make/Model/Engine/Category/Keyword. The plugin provides very easy interface to use for Admin. Admin can add filter widget anywhere on the website using either widget section or shortcode.

= Highlights/Features =

* A plugin for vehicle parts search based on Year/Make/Model/Engine/Category/Keyword
* Built-in CSV importer to upload Years/Makes/Models/Engines in bulk ( Allows comma separated values )
* Allows you to add multiple Years from an easy interface
* Allows you to add multiple Makes relevant to a particular Year from an easy interface
* Allows you to add multiple Models relevant to a particular Make from an easy interface
* Allows you to add multiple Engines relevant to a particular Model from an easy interface
* Allows you to restrict WooCommerce Catalog to show only user searched criteria matching products whole over the website
* Allows you to show/hide Models filter
* Allows you to show/hide Engines filter
* Allows you to show/hide Categories filter
* Allows you to show/hide Keyword filter
* Provides a very easy interface to associate Years, Makes, Models and Engines for a Product
* Provides "WooCommerce Vehicle Parts Finder - Year/Make/Model" widget as well as shortcode for easy use
* Users can search for Products/Parts based on the criteria they want to choose
* Mobile friendly (Responsive) and easy to setup and use

= Feature: My Vehicles =

* Fully controllable for admin
* Saves search histories for non-logged users
* Allow logged-in users to save their searches
* Users can re-visit their searches from My Vehicles widget
* An easy popup to add more searches in histories

== Installation ==

1. Upload the `woo-vehicle-parts-finder-ymm` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. OR simply upload the plugin from WordPress admin section under Plugins >> Add New >> Upload Plugin.
4. Visit the VPF (YMM) Menu.
5. Add/Edit Years, Makes, Models and Engines to the website. 
6. Add "WooCommerce Vehicle Parts Finder - Year/Make/Model" widget to the sidebar.
7. Admin can use shortcode like: [woo_vpf_ymm_filter] to display search widget anywhere on the website. This shortcode allows few attributes like: [woo_vpf_ymm_filter title="Vehicle Parts Filter" view="H/V" label_year="Select Year" label_make="Select Make" show_model="true/false" label_model="Select Model" show_engine="true/false" label_engine="Select Engine" show_category="true/false" label_category="Select Category" show_keyword="true/false" label_keyword="Product Name" label_search="Search"]
8. Admin can also use: <?php echo do_shortcode('[woo_vpf_ymm_filter]'); ?> to display the search widget.

== Changelog ==

= 1.0 =
* Launched the initial version of the plugin

= 1.1 =
* Added individual settings page for VPF (YMM)
* Added additional tab on product details page (can be enabled/disabled from settings page)
* Added one more column "item_product" in CSV import tool to create product/terms relation at the same time while importing terms
* Added option of jQuery Chosen extension to enable/disable for the plugin

= 1.2 =
* Fixed the taxonomy (Years/Makes/Models/Engines) hierarchy issues on product edit screen
* Added option to enable jquery tree for taxonomies list on product add/edit screen to manage heavy data more easily
* Added more filter hooks to filter arguments for get lists on front end

= 1.3 =
* Added option to enable validations for filter fields
* Added multiple admin interface for assigning Years/Makes/Models/Engines to products
* Changed the admin interface for listing Years/Makes/Models/Engines
* Added option to separate CSV Year/Make/Model/Engine/Product columns by comma (,)

= 2.0 =
* Fixed the importer to handle heavy data
* Faster the importer
* Added range support to columns with importer CSV
* Added an individual admin menu for plugin
* Added few more settings

= 2.1 =
* Fixed "no terms list" issue on edit product page

= 2.2 =
* Changed the code to more optimized way for reuse and maintainability
* Fixed tweaks with CSV importer tool
* Fixed search results not to include products from child terms
* Fixed error in case if WooCommerce is not active
* Fixed terms to list by name
* Added option to disable next dropdowns until one choose current

= 2.3 =
* Added option to delete all the terms in single click
* Added SKU compatibility along with product slug with "item_product" column in importable CSV
* Added Screen Options to set number of terms per page
* Fixed speed issue conflict with Yoast SEO Plugin
* Fixed error with MultiSite in case if WooCommerce is not active
* Fixed search results page to show products template and not category archive
* Fixed JS to work even if page loads through JS/AJAX
* Fixed year column space issue in CSV while uploading in ranges
* Fixed plugin admin menu role capabilities so that can be accessed by WooCommerce Shop Manager as well
* Fixed admin terms drop down list to leave blank rather than loading Years in all the drop downs first time
* Improved HTML/PHP code snippets
* Improved products loading speed with few test cases

= 2.4 =
* Added MY VEHICLES widget
* Added option to disable VPF (YMM) terms selector metabox for specific products
* Added support to show/hide Models filter
* Added option to restrict WooCommerce Catalog to show only user searched criteria matching products whole over the website 
* Added option to redirect to product details page if single search result
* Added option to delete product assigned terms in single click on product edit page
* Added option to show year ranges over individual row per year in custom tab
* Fixed duplicating product not duplicating VPF terms relations issue
* Improved products loading speed with few more test cases
* Improved metabox layout for add/delete icons on product add/edit screen

= 2.5 =
* Fixed WPML conflicts
* Fixed Search Page Title
* Added RESET SEARCH feature
* Added few more valuable settings ( eg: Categories to Include )
* Fixed conflicts while deleting terms
* Added "Universal Product" option in products quick/bulk/edit screen
* Fixed search results Page to show products always and no more search query var ('s') is mandatory in URL

= 2.6 =
* Fixed PHP 7.x Conflicts eg: Universal Products, Warnings
* Fixed few PHP warnings ( undefined $show_keyword )
* Fixed WPML conflicts ( Added lang param in URL for search result page )
* Fixed template redirection option
* Added option for years sort order
* Fixed/Updated few designing aspects on settings page

= 2.7 =
* Fixed PHP 7.x conflicts/warnings
* Fixed undefined variable warnings
* Fixed conflict with WooCommerce Layered Nav filter widget
* Fixed conflict with get_search_query
* Fixed WPML search conflict
* Fixed invalid/large Year Range issue so max 100 years per range
* Fixed wrong year ranges issue in custom tab on product details screen
* Fixed CSV import issue with term name having "&"
* Fixed few typo with plugin filters
* Added esc_scl with queried keyword
* Changed VPF Term Labels in admin baed on saved settings
* Updated jQuery libraries

= 2.8 =
* Updated jQuery Chosen library
* Fixed duplicate VPF Terms issue while duplicates product
* Added Accordion to Plugin Settings Panel
* Added custom filter to sort/manage terms according to your need in product custom tab
* Fixed few mis-typed filters/hooks
* Fixed few options so that you can leave them blank eg: "Saved Vehicles - No Items", "Vehicles History - No Items"
* Fixed "My Vehicles" widget so it auto hides when clicking outside of widget