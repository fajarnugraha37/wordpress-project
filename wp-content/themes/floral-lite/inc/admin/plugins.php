<?php
/**
 * Add required and recommended plugins.
 *
 * @package floral
 */

add_action( 'tgmpa_register', 'floral_lite_register_required_plugins' );
add_filter( 'ocdi/register_plugins', 'floral_lite_register_ocdi_plugins' );

function floral_lite_register_required_plugins() {
	tgmpa( floral_lite_required_plugins(), [
		'id'          => 'floral-lite',
		'has_notices' => true,
	] );
}

function floral_lite_register_ocdi_plugins( $plugins ) {
	return array_merge( $plugins, floral_lite_required_plugins() );
}

/**
 * List of required plugins
 */
function floral_lite_required_plugins() {
	return [
		[
			'name' =>'Jetpack',
			'slug' => 'jetpack',
		],
		[
            'name' =>'Slim SEO',
			'slug' => 'slim-seo',
		],
		[
			'name' =>  'Falcon',
			'slug' => 'falcon',
		],
		[
			'name' =>  'One Click Demo Import',
			'slug' => 'one-click-demo-import',
		],
	];
}
