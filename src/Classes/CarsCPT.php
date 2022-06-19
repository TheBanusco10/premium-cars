<?php

namespace PremiumCars\Classes;

class CarsCPT {
	private $name = 'cars';
	private $label = 'Cars';
	private $description = 'Upload your car';

	function init() {
		$this->premium_cars_register_cpt();
		$this->premium_cars_register_shortcode();
		add_action('wp_enqueue_scripts', function () {
			$this->premium_cars_register_scripts();
		});
	}

	private function premium_cars_register_cpt() {
		add_action( 'init', function () {
			$this->premium_cars_register_fields();
		} );
		add_action( 'add_meta_boxes', function () {
			$this->premium_cars_register_metaboxes();
		} );
		add_action( 'save_post', function () {
			$this->premium_cars_save_cpt();
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
			'supports'      => [ 'title', 'thumbnail' ],
			'taxonomies'    => [ 'category' ]
		];

		register_post_type( $this->name, $args );

		rewrite_flush();
	}

	private function premium_cars_register_metaboxes() {
		add_meta_box( 'car-metabox', 'Car Features', function () {
			include( PLUGIN_URL . 'Views/Cars/cars_cpt_metaboxes.php' );
		}, 'cars' );
	}

	private function premium_cars_save_cpt() {
		global $post;

		$post_id = $post->ID;
		$type = $post->post_type;

		if ( $type !== $this->name ) {
			return;
		}
		if ( ! wp_verify_nonce( $_POST['car_cpt_nonce'] ) ) {
			return;
		}

		$carModel = $_POST['car_model'] ?? null;
		$carPrice = $_POST['car_price'] ?? null;

		if ( $carModel ) {
			update_post_meta( $post_id, 'model', sanitize_text_field( $carModel ) );
		}

		if ( $carPrice ) {
			update_post_meta( $post_id, 'price', sanitize_text_field( $carPrice ) );
		}
	}

	private function premium_cars_register_shortcode() {
		add_shortcode('premium-cars', [$this, 'premium_cars_load_shortcode']);
	}

	function premium_cars_load_shortcode() {
		ob_start();

		switch ( PremiumCarsAdmin::PREMIUM_CARS_TEMPLATE_TYPE() ) {
			case 'full_image':
				include( PLUGIN_URL . 'Views/Cars/shortcode/parts/cars_shortcode_full_image.php' );
				break;
			case 'slider':
				include( PLUGIN_URL . 'Views/Cars/shortcode/parts/cars_shortcode_slider.php' );
				break;
			default:
				echo "<p>Choose a template</p>";
				break;
		}

		return ob_get_clean();
	}

	private function premium_cars_register_scripts() {
		PremiumCarsAdmin::PREMIUM_CARS_TEMPLATE_TYPE() === 'full_image'
			? wp_enqueue_style( 'shortcode_full_image', plugin_dir_url( __FILE__ ) . '../styles/css/shortcode_full_image.css' )
			: wp_enqueue_style( 'shortcode_slider', plugin_dir_url( __FILE__ ) . '../styles/css/shortcode_slider.css' );

	}

}