<?php
// Shortcode to show cost calculator
if ( ! defined('ABSPATH')) exit('restricted access');

//I check the values of text and values from the calculator
$valuesSet = ik_servicecost_get_valstexts();

$currency = $valuesSet['currency'];
$hourstext = $valuesSet['hourstext'];
$hoursval = $valuesSet['hoursval'];
$averagetext = $valuesSet['averagetext'];
$averageval = $valuesSet['averageval'];
$addcosttext = $valuesSet['addcosttext'];
$addcostval = $valuesSet['addcostval'];
$savingtext = $valuesSet['savingtext'];

if ($hoursval != 0){
    $averagevaltotal = $averageval*$hoursval;
    $addcostvaltotal = $addcostval*$hoursval;
    $totalCalculator = number_format(($averagevaltotal - $addcostvaltotal), 2);
} else {
    $averagevaltotal = '-';
    $addcostvaltotal = '-'; 
    $totalCalculator = '-';
}

//I add js and css
wp_enqueue_style( 'ik_servicecost_css_calculator' );
wp_enqueue_script( 'ik_servicecost_js_calculator' );
?>
<form id="ik_servicecost_savings_calculator" currency="<?php echo $currency; ?>">
    <label class="ik_servicecost_label">
        <div class="ik_servicecost_data_text">
            <span><?php echo $hourstext; ?><span class="ik_servicecost_requrired">*</span></span>
        </div>
        <input type="number" name="data_savings_calculate" id="ik_servicecost_data_savings_calculate" maxlength="10" step="0.01" min="0" max="999999999" value="<?php echo $hoursval; ?>">
    </label>
    <div class="ik_servicecost_fixeddata">
        <div class="ik_servicecost_data_text">
            <span><?php echo $averagetext; ?></span>
        </div>
        <div class="ik_servicecost_data_value">
            <span><?php echo $currency; ?><span id="ik_servicecost_average_value" data_value="<?php echo $averageval; ?>"><?php echo $averagevaltotal; ?></span></span>
        </div>
    </div>
    <div class="ik_servicecost_fixeddata">
        <div class="ik_servicecost_data_text">
            <span><?php echo $addcosttext; ?></span>
        </div>
        <div class="ik_servicecost_data_value">
            <span><?php echo $currency; ?><span id="ik_servicecost_cost_value" data_value="<?php echo $addcostval; ?>"><?php echo $addcostvaltotal; ?></span></span>
        </div>
    </div>
    <div class="ik_servicecost_fixeddata">
        <div class="ik_servicecost_data_text">
            <span><?php echo $savingtext; ?></span>
        </div>
        <div class="ik_servicecost_data_total"><?php echo $currency; ?><span id="ik_servicecost_data_total_value"><?php echo $totalCalculator; ?></span></span></div>
    </div>
</form>