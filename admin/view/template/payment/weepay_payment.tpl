<?php echo $header; ?>

<div id="content">
    <div class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
            <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
        <?php } ?>
    </div>
    
    
    
    <?php if ($message) { ?>
        <div class="<?php echo $hasError?'warning':'success'; ?>"><?php echo $message; ?></div>
    <?php } ?>
    <?php if ($error_warning) { ?>
        <div class="warning"><?php echo $error_warning; ?></div>
    <?php } ?>
	<?php if ($error_version) { ?>
        <div class="warning"><?php echo $error_version; ?> <a href="<?php echo $version_update_link; ?>"> <?php echo $iyzico_update_button; ?></a> <?php echo $iyzico_or_text; ?></div>
    <?php } ?>
    
    <div class="box">
        <div class="heading">
            <h1><img src="view/image/payment.png" alt="" /> <?php echo $text_edit; ?></h1>
            <div class="buttons"><a onclick="$('#form').submit();" class="button" id="saveKeys"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
        </div>
        
        <div class="content">
            <form action="<?php echo $action; ?>" method="post"  method="post" enctype="multipart/form-data" id="form">
                
                <table class="form">
                    
                    <tr>     
                        <td>   <label class="col-sm-2 control-label" for="weepay_payment_bayiid"> <?php echo $entry_bayiid; ?></label>   </td>
                        
                        <td>         <input type="text" name="weepay_payment_bayiid" value="<?php echo $weepay_payment_bayiid; ?>" class="form-control"/>
                            <?php if ($error_bayiid) { ?>
                                <span class="error"><?php echo $error_bayiid; ?></span>
                            <?php } ?>
                        </td>
                    </tr>
                    
                    
                    
                    <tr>     
                        <td>   <label class="col-sm-2 control-label" for="weepay_payment_api">  <?php echo $entry_api; ?></label>   </td>
                        
                        <td>         
                            <input type="text" name="weepay_payment_api" value="<?php echo $weepay_payment_api; ?>" class="form-control"/>
                            <?php if ($error_api) { ?>
                                <span class="error"><?php echo $error_api; ?></span>
                            <?php } ?>
                        </td>
                    </tr>
                    
                   
                                     
                    <tr>     
                        <td>     <label class="col-sm-2 control-label" for="weepay_payment_secret">  <?php echo $entry_secret; ?></label>   </td>
                        
                        <td>         
                                <input type="text" name="weepay_payment_secret" value="<?php echo $weepay_payment_secret; ?>" class="form-control"/>
                                    <?php if ($error_secret) { ?>
                                        <span class="error"><?php echo $error_secret; ?></span>
                                    <?php } ?>
                        </td>
                    </tr>
                    
                    
                                                       
                    <tr>     
                        <td>       <label class="col-sm-2 control-label" for="weepay_payment_status"><?php echo $entry_status; ?></label> </td>
                        
                        <td>         
                                  <select name="weepay_payment_status" class="form-control">
                                        <?php if ($weepay_payment_status) { ?>
                                            <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                            <option value="0"><?php echo $text_disabled; ?></option>
                                        <?php } else { ?>
                                            <option value="1"><?php echo $text_enabled; ?></option>
                                            <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                        <?php } ?>
                                    </select>
                        </td>
                    </tr>
                      
                
                
                <tr>     
                        <td>        <label class="col-sm-2 control-label" for="weepay_payment_installement"><?php echo $entry_installement; ?></label> </td>
                        
                        <td>         
                                <select name="weepay_payment_installement" class="form-control">
                                        <?php if ($weepay_installement == "OFF") { ?>
                                            <option value="ON"><?php echo $text_enabled; ?></option>
                                            <option value="OFF" selected="selected"><?php echo $text_disabled; ?></option>
                                        <?php } else { ?>
                                            <option value="ON" selected="selected"><?php echo $text_enabled ?></option>
                                            <option value="OFF"><?php echo $text_disabled; ?></option>
                                        <?php } ?>
                                    </select>
                        </td>
                    </tr>
                    
                   
                   
                                   <tr>     
                        <td>        <label class="col-sm-2 control-label" for="weepay_payment_installement"><?php echo $entry_installement; ?></label> </td>
                        
                        <td>         
                                <select name="weepay_payment_installement" class="form-control">
                                        <?php if ($weepay_installement == "OFF") { ?>
                                            <option value="ON"><?php echo $text_enabled; ?></option>
                                            <option value="OFF" selected="selected"><?php echo $text_disabled; ?></option>
                                        <?php } else { ?>
                                            <option value="ON" selected="selected"><?php echo $text_enabled ?></option>
                                            <option value="OFF"><?php echo $text_disabled; ?></option>
                                        <?php } ?>
                                    </select>
                        </td>
                    </tr>
                    
                    
                                       
                                   <tr>     
                        <td>        <label class="col-sm-2 control-label" for="weepay_payment_form_type"><?php echo $entry_form_type; ?></label> </td>
                        
                        <td>         
                                  <select name="weepay_payment_form_type" class="form-control">
                                        <?php if ($weepay_payment_form_type == "responsive") { ?>
                                            <option value="popup"><?php echo $entry_class_popup ?></option>
                                            <option value="responsive" selected="selected"><?php echo $entry_class_responsive; ?></option>
                                        <?php } else { ?>
                                            <option value="popup" selected="selected"><?php echo $entry_class_popup ?></option>
                                            <option value="responsive"><?php echo $entry_class_responsive; ?></option>
                                        <?php } ?>
                                    </select>
                        </td>
                    </tr>
                    

                    
                    
                                   
                <tr>     
                        <td>         <label class="col-sm-2 control-label" for="weepay_payment_test_mode"><?php echo $entry_test_mode; ?></label> </td>
                        
                        <td>         
                                    <select name="weepay_payment_test_mode" class="form-control">
                                        <?php if ($weepay_payment_test_mode == "OFF") { ?>
                                            <option value="ON"><?php echo $text_enabled; ?></option>
                                            <option value="OFF" selected="selected"><?php echo $text_disabled; ?></option>
                                        <?php } else { ?>
                                            <option value="ON" selected="selected"><?php echo $text_enabled ?></option>
                                            <option value="OFF"><?php echo $text_disabled; ?></option>
                                        <?php } ?>
                                    </select>
                        </td>
                    </tr>    
                         
                    
                   
                                                      
               <tr>     
                    <td>                     <label class="col-sm-2 control-label" for="weepay_order_status_id">
                                    <span data-toggle="tooltip" title="<?php echo $entry_order_status; ?>">
                                        <?php echo $entry_order_status; ?>
                                    </span>
                                </label></td>
                        
                        <td>         
                                              <select name="weepay_payment_order_status_id" id="input-order-status" class="form-control">
                                        <?php foreach ($order_statuses as $order_status) { ?>
                                            <?php if ($order_status['order_status_id'] == $weepay_payment_order_status_id) { ?>
                                                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                        </td>
                    </tr>    
                         
                                  <tr>     
                    <td>           <label class="col-sm-2 control-label" for="weepay_payment_cancel_order_status_id"><span data-toggle="tooltip" title="<?php echo $entry_cancel_order_status; ?>"><?php echo $entry_cancel_order_status; ?></span></label></td>
                        
                        <td>         
                                    <select name="weepay_payment_cancel_order_status_id" id="input-cancel-order-status" class="form-control">
                                        <?php foreach ($order_statuses as $order_status) { ?>
                                            <?php if ($order_status['order_status_id'] == $weepay_payment_cancel_order_status_id) { ?>
                                                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                                            <?php } ?>
                                        <?php } ?>
                                    </select>
                        </td>
                    </tr>    
                         
                                                     <tr>     
                    <td>           <label class="col-sm-2 control-label" for="input-order-status"><?php echo $entry_sort_order; ?></label></td>
                        
                        <td>         
    <input type="text" name="weepay_payment_sort_order" value="<?php echo $weepay_payment_sort_order; ?>" size="1" class="form-control"/>
                        </td>
                    </tr>   
                </table>
            </form>
            
            
            
            
        </div>
        
        
        
        
    </div>
    
</div>

<script>
    $( function() {
        $( "#tabs" ).tabs();
    } );
</script>
<style>
    .continue-button {
    width: 280px;
    font-size: 16px;
    font-weight: 600;
    letter-spacing: -.33px;
    border-radius: 31px;
    background-image: linear-gradient(279deg,#5170e9 ,#12bbe2);
    height: 40px;
    line-height: 38px;
    border-radius: 100px;
    
    color: #fff;
    font-size: 16px;
    font-weight: 600;
    letter-spacing: -.33px;
    
    text-align: center;
    cursor: pointer;
    border: none;
    outline: 0;
    padding: 0 20px;
    }
    .zbtn {
    border: none;
font-family: inherit;
font-size: 13px;
color: white !important;
background: none;
cursor: pointer;
padding: 25px 80px;
display: inline-block;

margin: 15px 30px;
text-transform: uppercase;
letter-spacing: 1px;
font-weight: 700;
max-width: 350px;
min-width: 350px;
outline: none;
position: relative;
-webkit-transition: all 0.3s;
-moz-transition: all 0.3s;
transition: all 0.3s;
}
.btn-2a {
border-radius: 0 0 5px 5px;
}

.btn-2a:hover {
box-shadow: 0 4px #e91027;
top: 2px;
}

.btn-2a:active {
box-shadow: 0 0 #e91027;
top: 6px;
}
.btn-2 {
background: #ff2b42;
color: #fff;
box-shadow: 0 6px #e91027;
-webkit-transition: none;
-moz-transition: none;
transition: none;
}

</style>



