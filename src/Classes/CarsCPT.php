<?php

namespace PremiumCars\Classes;

class CarsCPT {
	private $name = 'cars';
	private $label = 'Cars';
	private $description = 'Upload your car';

	function init() {
		$this->premium_cars_register_cpt();
	}

	private function premium_cars_register_cpt() {
		add_action( 'init', function () {
			$this->premium_cars_register_fields();
			add_action('add_meta_boxes', function (){
				$this->premium_cars_register_metaboxes();
			});
		} );
	}

	private function premium_cars_register_fields() {
		$args = [
			'label'         => $this->label,
			'description'   => $this->description,
			'public'        => true,
			'rewrite'       => [
				'slug' => 'cars'
			],
			'menu_icon'     => 'dashicons-car',
			'menu_position' => 5,
			'map_meta_cap'  => true,
			'supports'      => [ 'title', 'thumbnail' ]
		];

		register_post_type( $this->name, $args );

		rewrite_flush();
	}

	private function premium_cars_register_metaboxes() {
		add_meta_box('car-metabox', 'Car Features', function() {
			include (PLUGIN_URL . 'Cars/views/cars_cpt_metaboxes.php');
		}, 'cars');
	}

}