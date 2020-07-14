<?php

require_once get_template_directory() . '/inc/tgm/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'easy_store_register_required_plugins' );

function easy_store_register_required_plugins() {
	$plugins = array(

		array(
            'name'      => __( 'WooCommerce', 'easy-store' ),
            'slug'      => 'woocommerce',
            'required'  => false,
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'      => __( 'YITH WooCommerce Wishlist', 'easy-store' ),
            'slug'      => 'yith-woocommerce-wishlist',
            'required'  => false,
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
		array(
            'name'      => __( 'Contact Form, Drag and Drop Form Builder for WordPress – Everest Forms', 'easy-store' ),
            'slug'      => 'everest-forms',
            'required'  => false,
            'force_activation'   => false,
            'force_deactivation' => false,
        )

	);

	$config = array(
		'id'           => 'easy-store',            // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'easy-store' ),
			'menu_title'                      => __( 'Install Plugins', 'easy-store' ),
			'installing'                      => __( 'Installing Plugin: %s', 'easy-store' ),// translators: %s: plugin name.
			'updating'                        => __( 'Updating Plugin: %s', 'easy-store' ),//translators: %s: plugin name.
			'oops'                            => __( 'Something went wrong with the plugin API.', 'easy-store' ),
			'notice_can_install_required'     => _n_noop(
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'easy-store'
			),
			'notice_can_install_recommended'  => _n_noop(
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'easy-store'
			),
			'notice_ask_to_update'            => _n_noop(
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'easy-store'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'easy-store'
			),
			'notice_can_activate_required'    => _n_noop(
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'easy-store'
			),
			'notice_can_activate_recommended' => _n_noop(
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'easy-store'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'easy-store'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'easy-store'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'easy-store'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'easy-store' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'easy-store' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'easy-store' ),
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'easy-store' ),
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'easy-store' ),
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'easy-store' ),
			'dismiss'                         => __( 'Dismiss this notice', 'easy-store' ),
			'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'easy-store' ),
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'easy-store' ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		)
	);

	tgmpa( $plugins, $config );
}
