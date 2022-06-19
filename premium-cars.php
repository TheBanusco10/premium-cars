<?php

/*
Plugin Name: Premium Cars
Plugin URI: https://djvdev.com
Description: Upload your cars and display them into the website.
Version: 1.0
Author: David
Author URI: https://djvdev.com
License: GPLv3
*/

use PremiumCars\Classes\CarsCPT;
use PremiumCars\Classes\PremiumCarsAdmin;

require_once 'vendor/autoload.php';

define('PLUGIN_URL', plugin_dir_path(__FILE__) . 'src/');

$carsCPT = new CarsCPT();
$premiumCarsSettings = new PremiumCarsAdmin();

$carsCPT->init();
$premiumCarsSettings->init();