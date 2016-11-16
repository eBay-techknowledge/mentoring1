<?php
/* 
* Theme: PREMIUMPRESS CORE FRAMEWORK FILE
* Url: www.premiumpress.com
* Author: Mark Fail
*
* THIS FILE WILL BE UPDATED WITH EVERY UPDATE
* IF YOU WANT TO MODIFY THIS FILE, CREATE A CHILD THEME
*
* http://codex.wordpress.org/Child_Themes
*/
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }


// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  
  
?> 
 
    
   <div class="heading2">Website Analytics</div>   
      
   <p>Analytics Code  <a href="http://www.google.com/analytics/" target="_blank" style="text-decoration:underline;">What's this?</a></p>
   
    
    <textarea class="row-fluid" style="height:60px; font-size:11px;" placeholder="Analytics Code Here" name="adminArray[google_analytics]"><?php echo stripslashes(get_option('google_analytics')); ?></textarea>
    
    

        
        
 
			<div class="form-row row-fluid span11 ">
                            <label class="control-label span7" rel="tooltip" data-original-title="This will allow Google analytics to track your website visitor click history to see which listings are most popular. This is strongly recommended for all website owners." data-placement="top">Google Event Tracking</label>
                            <div class="controls span5">
                              <div class="row-fluid">                              
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('google_tracking').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('google_tracking').value='1'">
                                  </label>
                                  <div class="toggle <?php if($core_admin_values['google_tracking'] == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                               </div>
                            
                             
                             <input type="hidden" class="row-fluid" id="google_tracking" name="admin_values[google_tracking]" 
                             value="<?php echo $core_admin_values['google_tracking']; ?>">
            </div>
            
<!-- end WEBSITE SCREENSHOT PREVIEWER -->
  
   
   
   <hr />
    
    <div class="heading2">Conversion Tracking Code</div> 
    
    <p>The code you enter here will be displayed on your callback page for successful orders.</p>
    
    <p>Shortcodes: [total] [orderid] [description] </p>  
      
    <textarea class="row-fluid" style="height:100px; font-size:11px;" placeholder="Analytics Code Here" name="adminArray[google_conversion]"><?php echo stripslashes(get_option('google_conversion')); ?></textarea>
    
    <?php /*
    <div class="heading1">PremiumPress Powered By Link</div> 
    <p>This will display a link back to PremiumPress in your footer. </p>
    
    
    <div class="form-row row-fluid span11 ">
                            <label class="control-label span7" rel="tooltip" data-original-title="Enable this to disable the powered by text." data-placement="top">Disable Feature</label>
                            <div class="controls span5">
                              <div class="row-fluid">                              
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('poweredby').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('poweredby').value='1'">
                                  </label>
                                  <div class="toggle <?php if($core_admin_values['poweredby'] == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                               </div>
                            
                             
                             <input type="hidden" class="row-fluid" id="poweredby" name="admin_values[poweredby]" 
                             value="<?php echo $core_admin_values['poweredby']; ?>">
            </div>
    
    
    */ ?>
   