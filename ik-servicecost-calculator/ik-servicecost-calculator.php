<?php
/*
Plugin Name: Service Cost Calculator
Description: Calculates savings on costs of service by using the shortcode [show_savings_calculator]
Version: 1.1.2
Author: Gabriel Caroprese / Inforket
Author URI: https://inforket.com/
*/

//I create the menu to change text and number for the cost calculator
function ik_servicecost_admin_menu(){
    add_menu_page('Cost Calculator', 'Cost Calculator', 'manage_options', 'ik_servicecost_config', 'ik_servicecost_config', plugin_dir_url( __FILE__ ) . 'img/ik-servicecalculator-logo.png' );

}
add_action('admin_menu', 'ik_servicecost_admin_menu');

//Content for config page
function ik_servicecost_config(){
    include('templates/config.php');
}


/*
    I define default variables 
*/
//Currency
define('IK_SERVICECOST_CURRENCY', '£');

//Hours Text
define('IK_SERVICECOST_HOURSTEXT', 'Hours of Security cover required');

//Hours Default Value
define('IK_SERVICECOST_HOURSVAL', '120');

//Average Cost Text
define('IK_SERVICECOST_AVERAGETEXT', 'Average cost of a security guard');

//Average Cost Value
define('IK_SERVICECOST_AVERAGEVAL', '9.20');

//Average Cost Text
define('IK_SERVICECOST_ADDITIONALCOSTTEXT', 'Cost of CCTV Remote Monitoring');

//Average Cost Value
define('IK_SERVICECOST_ADDITIONALCOSTVAL', '2');

//Average Cost Text
define('IK_SERVICECOST_SAVINGSTEXT', 'Potential savings to your company with CCTV');


//I get texts and values for calculator
function ik_servicecost_get_valstexts(){

	if (get_option('IK_SERVICECOST_CURRENCY') == NULL){
        $data_calculator['currency'] = constant('IK_SERVICECOST_CURRENCY');
    } else {
        $data_calculator['currency'] = get_option('IK_SERVICECOST_CURRENCY');
    }
	if (get_option('IK_SERVICECOST_HOURSTEXT') == NULL){
        $data_calculator['hourstext'] = constant('IK_SERVICECOST_HOURSTEXT');
    } else {
        $data_calculator['hourstext'] = get_option('IK_SERVICECOST_HOURSTEXT');
    }
	if (get_option('IK_SERVICECOST_HOURSVAL') == NULL){
        $data_calculator['hoursval'] = constant('IK_SERVICECOST_HOURSVAL');
    } else {
        $data_calculator['hoursval'] = get_option('IK_SERVICECOST_HOURSVAL');
    }
	if (get_option('IK_SERVICECOST_AVERAGETEXT') == NULL){
        $data_calculator['averagetext'] = constant('IK_SERVICECOST_AVERAGETEXT');
    } else {
        $data_calculator['averagetext'] = get_option('IK_SERVICECOST_AVERAGETEXT');
    }
	if (get_option('IK_SERVICECOST_AVERAGEVAL') == NULL){
        $data_calculator['averageval'] = constant('IK_SERVICECOST_AVERAGEVAL');
    } else {
        $data_calculator['averageval'] = get_option('IK_SERVICECOST_AVERAGEVAL');
    }
	if (get_option('IK_SERVICECOST_ADDITIONALCOSTTEXT') == NULL){
        $data_calculator['addcosttext'] = constant('IK_SERVICECOST_ADDITIONALCOSTTEXT');
    } else {
        $data_calculator['addcosttext'] = get_option('IK_SERVICECOST_ADDITIONALCOSTTEXT');
    }
	if (get_option('IK_SERVICECOST_ADDITIONALCOSTVAL') == NULL){
        $data_calculator['addcostval'] = constant('IK_SERVICECOST_ADDITIONALCOSTVAL');
    } else {
        $data_calculator['addcostval'] = get_option('IK_SERVICECOST_ADDITIONALCOSTVAL');
    }
	if (get_option('IK_SERVICECOST_SAVINGSTEXT') == NULL){
        $data_calculator['savingtext'] = constant('IK_SERVICECOST_SAVINGSTEXT');
    } else {
        $data_calculator['savingtext'] = get_option('IK_SERVICECOST_SAVINGSTEXT');
    }
    
	return $data_calculator;
}

//Add javascript and style
function ik_servicecost_add_js_css() {
    wp_register_style( 'ik_servicecost_css_calculator', plugin_dir_url( __FILE__ ) . 'css/style-calculator.css', false, '1.0', 'all' );
    wp_register_script( 'ik_servicecost_js_calculator', plugin_dir_url( __FILE__ ) . 'js/savings_cost_calculator.js', '', '', true );
}
add_action('wp_enqueue_scripts', 'ik_servicecost_add_js_css');


// Shortcode to show service cost calculator
function ik_servicecost_get_calculator_shortcode($atts = [], $content = null, $tag = '') {
    $atts = array_change_key_case((array)$atts, CASE_LOWER);
    $attrib_tform = shortcode_atts([
                                    'class' => '',
                                    ], $atts, $tag);
                                    
// turn on output buffering to capture script output
ob_start();
                                    
    include('templates/shortcode.php');
$content = ob_get_clean();
return $content;
}
add_shortcode('show_savings_calculator', 'ik_servicecost_get_calculator_shortcode');
?>