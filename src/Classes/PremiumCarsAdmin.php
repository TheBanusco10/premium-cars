<?php

namespace PremiumCars\Classes;

use Carbon_Fields\Carbon_Fields;
use Carbon_Fields\Container\Container;
use Carbon_Fields\Field\Field;

class PremiumCarsAdmin {

	function init() {
		add_action( 'carbon_fields_register_fields', function () {
			$this->premium_cars_register_settings_page();
		} );
		add_action( 'after_setup_theme', function () {
			$this->premium_cars_init_settings_page();
		} );

	}

	private function premium_cars_register_settings_page() {
		Container::make( 'theme_options', __( 'Premium Cars', 'pc' ) )
		         ->add_fields( [
			         Field::make( 'select', 'pc_template_type', __( 'Template type', 'pc' ) )->add_options( [
				         'full_image' => 'Full image',
				         'slider'     => 'Slider'
			         ] )
		         ] );

	}

	private function premium_cars_init_settings_page() {
		Carbon_Fields::boot();
	}

	static function PREMIUM_CARS_TEMPLATE_TYPE (): string {
		return carbon_get_theme_option('pc_template_type');
	}
}