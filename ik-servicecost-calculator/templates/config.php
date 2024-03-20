<?php
// Config for texts and values of calculator
if ( ! defined('ABSPATH')) exit('restricted access');
?>
<?php

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

    
    
    //Submited change
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $currency_submit = sanitize_text_field($_POST['currency']);
        $hourstext_submit = sanitize_text_field($_POST['hourstext']);
		$hoursval_submit = floatval($_POST['hoursval']);
        $averagetext_submit = sanitize_text_field($_POST['averagetext']);
		$averageval_submit = floatval($_POST['averageval']);
        $addcosttext_submit = sanitize_text_field($_POST['addcosttext']);
		$addcostval_submit = floatval($_POST['addcostval']);
        $savingtext_submit = sanitize_text_field($_POST['savingtext']);
		
        // I check with if I have to insert or update
        if (get_option('IK_SERVICECOST_CURRENCY') == NULL){
            add_option('IK_SERVICECOST_CURRENCY', $currency_submit);  
        } else {
            update_option('IK_SERVICECOST_CURRENCY', $currency_submit);
        }  
         if (get_option('IK_SERVICECOST_HOURSTEXT') == NULL){
            add_option('IK_SERVICECOST_HOURSTEXT', $hourstext_submit);  
        } else {
            update_option('IK_SERVICECOST_HOURSTEXT', $hourstext_submit);
        }  
         if (get_option('IK_SERVICECOST_HOURSVAL') == NULL){
            add_option('IK_SERVICECOST_HOURSVAL', $hoursval_submit);  
        } else {
            update_option('IK_SERVICECOST_HOURSVAL', $hoursval_submit);
        }  
         if (get_option('IK_SERVICECOST_AVERAGETEXT') == NULL){
            add_option('IK_SERVICECOST_AVERAGETEXT', $averagetext_submit);  
        } else {
            update_option('IK_SERVICECOST_AVERAGETEXT', $averagetext_submit);
        }  
         if (get_option('IK_SERVICECOST_AVERAGEVAL') == NULL){
            add_option('IK_SERVICECOST_AVERAGEVAL', $averageval_submit);  
        } else {
            update_option('IK_SERVICECOST_AVERAGEVAL', $averageval_submit);
        }  
         if (get_option('IK_SERVICECOST_ADDITIONALCOSTTEXT') == NULL){
            add_option('IK_SERVICECOST_ADDITIONALCOSTTEXT', $addcosttext_submit);  
        } else {
            update_option('IK_SERVICECOST_ADDITIONALCOSTTEXT', $addcosttext_submit);
        }  
         if (get_option('IK_SERVICECOST_ADDITIONALCOSTVAL') == NULL){
            add_option('IK_SERVICECOST_ADDITIONALCOSTVAL', $addcostval_submit);  
        } else {
            update_option('IK_SERVICECOST_ADDITIONALCOSTVAL', $addcostval_submit);
        }  
         if (get_option('IK_SERVICECOST_SAVINGSTEXT') == NULL){
            add_option('IK_SERVICECOST_SAVINGSTEXT', $savingtext_submit);  
        } else {
            update_option('IK_SERVICECOST_SAVINGSTEXT', $savingtext_submit);
        }  
        
        echo "<script type='text/javascript'>
           window.location = '".get_site_url()."/wp-admin/admin.php?page=ik_servicecost_config&updated=1'
      </script>";
    }
?>
<style>
    .error{display: none;}
    .servicecost-config-body{
        padding: 40px 3%;
    }
    label, select{
        display: block;
    }
    select{
        margin-bottom: 20px;
    }
    input[type=submit]{
        padding: 6px 12px;
        background: #000;
        color: #fff;
        border: 0;
        border-radius: 12px;
        margin-top: 20px;
    }
	.ik_servicecost-config-form label input[type=number], .ik_servicecost-config-form .ik-servicecost-currency{
		width: 100px! important;
		text-align: center;
	}
	.ik_servicecost-config-form label input[type=text]{
		width: 320px;
	}
	.ik_servicecost-config-form label p {
		margin: 1em 0 0! important;
	}
</style>
 
<div class="servicecost-config-body">
    <h2>Cost Calculator Config</h2>
    <form action="" method="post" class="ik_servicecost-config-form" enctype="multipart/form-data" autocomplete="no">
	    <label for="currency">
			<p>Currency Symbol</p>
			<input required class="ik-servicecost-currency" type="text" name="currency" placeholder="Currency Symbol" value="<?php echo $currency; ?>">
		</label>	    
		<label for="hourstext">
			<p>Hours Covered Text</p>
			<input required type="text" name="hourstext" placeholder="Hours Covered Text" value="<?php echo $hourstext; ?>">
		</label>	    
		<label for="hoursval">
			<p>Hours Covered Value</p>
			<input required type="number" step="0.01" name="hoursval" placeholder="Hours Covered Value" value="<?php echo $hoursval; ?>">
		</label>
		<label for="averagetext">
			<p>Average Hours Text</p>
			<input required type="text" name="averagetext" placeholder="Hours Covered Text" value="<?php echo $averagetext; ?>">
		</label>	    
		<label for="averageval">
			<p>Average Hours Value</p>
			<input required type="number" step="0.01" name="averageval" placeholder="Average Hours Value" value="<?php echo $averageval; ?>">
		</label>
		<label for="addcosttext">
			<p>Additional Cost Text</p>
			<input required type="text" name="addcosttext" placeholder="Additional Cost Text" value="<?php echo $addcosttext; ?>">
		</label>	    
		<label for="addcostval">
			<p>Additional Cost Value</p>
			<input required type="number" step="0.01" name="addcostval" placeholder="Additional Cost Value" value="<?php echo $addcostval; ?>">
		</label>
		<label for="savingtext">
			<p>Savings Text</p>
			<input required type="text" name="savingtext" placeholder="Savings Text" value="<?php echo $savingtext; ?>">
		</label>
		
        <input type="submit" value="Save">
    </form>
    <?php 
        if (isset($_GET['updated'])) {
            if (intval($_GET['updated']) == 1){
                echo "Data updated.";
            }
        }
    ?>
</div>