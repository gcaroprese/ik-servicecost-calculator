jQuery( "#ik_servicecost_data_savings_calculate" ).keyup(function() {
    var numberval = parseFloat(jQuery(this).val());

    if (numberval.length > 11){
        var removeLast = numberval.substring(0, numberval.length - 2);
        jQuery(this).val(removeLast);
    } else {
        jQuery(this).val(numberval);
    }
    
    var avarageValue = parseFloat(jQuery('#ik_servicecost_average_value').attr('data_value'));
    var costValue = parseFloat(jQuery('#ik_servicecost_cost_value').attr('data_value'));
    
    var costMarket =  numberval * avarageValue;
    var cctvCost =  numberval * costValue;
    var totalSavings = costMarket - cctvCost;
    
    if (totalSavings != 0){
        jQuery('#ik_servicecost_average_value').text(costMarket.toFixed(2));
        jQuery('#ik_servicecost_cost_value').text(cctvCost.toFixed(2));
        jQuery('#ik_servicecost_data_total_value').text(totalSavings.toFixed(2));
    } else {
        jQuery('#ik_servicecost_average_value').text('-');
        jQuery('#ik_servicecost_cost_value').text('-');
        jQuery('#ik_servicecost_data_total_value').text('-');
    }
});