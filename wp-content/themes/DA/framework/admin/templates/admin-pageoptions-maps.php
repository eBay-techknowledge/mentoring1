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
 
 
<div class="heading2">Enable Google Maps</div>  
       

       <div class="form-row control-group row-fluid ">
                            <label class="control-label span4 offset3" rel="tooltip" data-original-title="Turn ON this feature to display a Google map on submission pages to collect long/lat data for mapping user listings. *recommended*" data-placement="top">Google Maps</label>
                            <div class="controls span4">
                              <div class="row-fluid">
                                <div class="pull-left">
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('google').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('google').value='1'">
                                  </label>
                                  <div class="toggle <?php if($core_admin_values['google'] == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                               </div>
                             </div>
                             
                             <input type="hidden" class="row-fluid" id="google" name="admin_values[google]" 
                             value="<?php echo $core_admin_values['google']; ?>">
            </div>  
 
 
  <?php if(!defined('WLT_CART')){ ?>
            
<div class="heading2">GEO Location</div>  
             
             
       <div class="form-row control-group row-fluid">
        <label class="control-label span5" for="style">Enable GEO Location</label>
        <div class="controls span6">
        <select name="admin_values[geolocation]" class="chzn-select" id="geo1">

          <option value="" <?php if($core_admin_values['geolocation'] == ""){ echo "selected=selected"; } ?>>Disable</option>
          <option value="1" <?php if($core_admin_values['geolocation'] == "1"){ echo "selected=selected"; } ?>>Enable in Top Menu</option> 
          
        </select>
        </div>
        </div> 
        
        <div class="form-row control-group row-fluid">
        <label class="control-label span5" for="style">Display GEO Flag</label>
        <div class="controls span6">
        <select name="admin_values[geolocation_flag]" class="chzn-select" id="geo2">

         <?php
		 
		  $selected = $core_admin_values['geolocation_flag'];
				 
                 foreach ($GLOBALS['core_country_list'] as $key=>$option) {				 				
                 	printf( '<option value="%1$s"%3$s>%2$s</option>', trim( $key  ), $option, selected( $selected, $key, false ) );
                 }
		 
		 ?> 
         
        </select>
        </div>
        </div> 
        
        
        <div class="form-row control-group row-fluid">
        <label class="control-label span5" for="style">Distance Unit</label>
        <div class="controls span6">
        <select name="admin_values[geolocation_unit]" class="chzn-select" id="geo3">

          <option value="" <?php if($core_admin_values['geolocation_unit'] == ""){ echo "selected=selected"; } ?>>Miles</option>
          <option value="K" <?php if($core_admin_values['geolocation_unit'] == "K"){ echo "selected=selected"; } ?>>Kilometers</option> 
          <option value="N" <?php if($core_admin_values['geolocation_unit'] == "N"){ echo "selected=selected"; } ?>>Nautical Miles</option> 
         
         
        </select>
        </div>
        </div> 
        
        
        <?php }else{ ?>

<input name="admin_values[geolocation]" value="" type="hidden">
		<?php } ?>



     
            
            
            <div class="well">
            <b>Finding Map Cords</b>
            <p>To get your own long/lat values, view the link below to Google maps. Right-click on the desired spot on the map and, from the menu, choose "What's here?". Click on the green marker to get the lat/long coordinates/</p>
            <p><a href="https://maps.google.com/maps?f=q&hl=en&q=&ie=UTF8&ll=34.019968,-118.289988&spn=0.001205,0.001714&t=k&z=1" target="_blank" style="text-decoration:underline;color:blue;">https://maps.google.com/</a>

            </div> 