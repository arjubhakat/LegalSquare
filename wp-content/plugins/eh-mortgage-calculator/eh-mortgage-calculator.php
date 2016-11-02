<?php
/**
 * Plugin Name: EH Mortgage Calculator
 * Plugin URI: https://wordpress.org/plugins/eh-mortgage-calculator/
 * Description: EH Mortgage Calculator is a simple plugin designed to calculate a mortgage payment.
 * The plugin creates an amortization table, and pagination for easier readability.
 * Version: 2.0
 * Author: Edgar Hernandez
 * Author URI: http://edgarjhernandez.com
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: eh-mortgage-calculator
 * Domain Path: /languages/
 * Network: Optional. Whether the plugin can only be activated network wide. Example: true
 * 
 * EH-Mortgage-Calculator is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 * 
 * EH-MortgageCalculator is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with EH-MortgageCalculator. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
 */

defined( 'ABSPATH' ) or die( "I'm sorry, Dave, I'm afraid I can't do that" );

define( 'EHMORTGAGECALCULATOR__VERSION',            '2.0' );
define( 'EHMORTGAGECALCULATOR_MASTER_USER',         true );
define( 'EHMORTGAGECALCULATOR__PLUGIN_DIR',         plugin_dir_path( __FILE__ ) );
define( 'EHMORTGAGECALCULATOR__PLUGIN_FILE',        __FILE__ );

require_once( EHMORTGAGECALCULATOR__PLUGIN_DIR . 'class.ehmortgagecalculator.php'     );
require_once( EHMORTGAGECALCULATOR__PLUGIN_DIR . 'class.ehmortgagecalculator-html.php' );
require_once( EHMORTGAGECALCULATOR__PLUGIN_DIR . 'class.ehmortgagecalculator-widget.php' );

EHMortgageCalculator::init();
