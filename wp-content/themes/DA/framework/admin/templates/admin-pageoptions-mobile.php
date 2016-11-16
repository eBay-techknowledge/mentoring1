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

<div class="heading2">Responsive Design - Mobile Setup</div>
    
      <div class="form-row control-group row-fluid ">
                                <label class="control-label span4 offset3" data-placement="top">Search Box</label>
                                <div class="controls span4">
                                  <div class="row-fluid">
                                    <div class="pull-left">
                                      <label class="radio off">
                                      <input type="radio" name="toggle" 
                                      value="off" onchange="document.getElementById('mobile_search').value='0'">
                                      </label>
                                      <label class="radio on">
                                      <input type="radio" name="toggle"
                                      value="on" onchange="document.getElementById('mobile_search').value='1'">
                                      </label>
                                      <div class="toggle <?php if($core_admin_values['mobileview']['search'] == '1'){  ?>on<?php } ?>">
                                        <div class="yes">ON</div>
                                        <div class="switch"></div>
                                        <div class="no">OFF</div>
                                      </div>
                                    </div> 
                                   </div>
                                 </div>
                                 
                                 <input type="hidden" class="row-fluid" id="mobile_search" name="admin_values[mobileview][search]" 
                                 value="<?php echo $core_admin_values['mobileview']['search']; ?>">
         </div>
         
      <div class="form-row control-group row-fluid ">
                                <label class="control-label span4 offset3" data-placement="top">Use Advanced Search</label>
                                <div class="controls span4">
                                  <div class="row-fluid">
                                    <div class="pull-left">
                                      <label class="radio off">
                                      <input type="radio" name="toggle" 
                                      value="off" onchange="document.getElementById('mobile_adsearch').value='0'">
                                      </label>
                                      <label class="radio on">
                                      <input type="radio" name="toggle"
                                      value="on" onchange="document.getElementById('mobile_adsearch').value='1'">
                                      </label>
                                      <div class="toggle <?php if($core_admin_values['mobileview']['adsearch'] == '1'){  ?>on<?php } ?>">
                                        <div class="yes">ON</div>
                                        <div class="switch"></div>
                                        <div class="no">OFF</div>
                                      </div>
                                    </div> 
                                   </div>
                                 </div>
                                 
                                 <input type="hidden" class="row-fluid" id="mobile_adsearch" name="admin_values[mobileview][adsearch]" 
                                 value="<?php echo $core_admin_values['mobileview']['adsearch']; ?>">
         </div>
         
       
    
         <div class="form-row control-group row-fluid ">
                                <label class="control-label span4 offset3" data-placement="top">Show Sidebars (if available)</label>
                                <div class="controls span4">
                                  <div class="row-fluid">
                                    <div class="pull-left">
                                      <label class="radio off">
                                      <input type="radio" name="toggle" 
                                      value="off" onchange="document.getElementById('sidebars').value='0'">
                                      </label>
                                      <label class="radio on">
                                      <input type="radio" name="toggle"
                                      value="on" onchange="document.getElementById('sidebars').value='1'">
                                      </label>
                                      <div class="toggle <?php if($core_admin_values['mobileview']['sidebars'] == '1'){  ?>on<?php } ?>">
                                        <div class="yes">ON</div>
                                        <div class="switch"></div>
                                        <div class="no">OFF</div>
                                      </div>
                                    </div> 
                                   </div>
                                 </div>
                                 
                                 <input type="hidden" class="row-fluid" id="sidebars" name="admin_values[mobileview][sidebars]" 
                                 value="<?php echo $core_admin_values['mobileview']['sidebars']; ?>">
        
                
    </div> 
    
    
    
    
      <div class="heading1">Mobile Website (beta)</div>
      
      
      <div>
      
      <img src="<?php echo get_template_directory_uri(); ?>/framework/img/mobile/screen.png" style="float:left; padding-right:50px;" />
      
      
      <h3>Mobile Website Design</h3>
      
      <p>This new feature will display a completely different layout and design optimized for mobile users to provide a better viewing experience.</p>
      
      <p>The mobile website design has been optimized for mobile browsers with faster page loading, easy access options and a simplified user interface. </p>
      
      <p>Although this design has limited features due to mobile browser limitations it offers a unique, user friendly experience for your visitors.</p>
      
      </div>
      
      <div class="clearfix"></div>
      
   
     <div class="form-row control-group row-fluid " style="padding-bottom: 5px; border-top: 1px dotted #dfdfdf; padding-top:15px;">
                                <label class="control-label span4 offset3" data-placement="top">Enable Mobile Website</label>
                                <div class="controls span4">
                                  <div class="row-fluid">
                                    <div class="pull-left">
                                      <label class="radio off">
                                      <input type="radio" name="toggle" 
                                      value="off" onchange="document.getElementById('mobileweb').value='0'">
                                      </label>
                                      <label class="radio on">
                                      <input type="radio" name="toggle"
                                      value="on" onchange="document.getElementById('mobileweb').value='1'">
                                      </label>
                                      <div class="toggle <?php if($core_admin_values['mobileweb'] == '1'){  ?>on<?php } ?>">
                                        <div class="yes">ON</div>
                                        <div class="switch"></div>
                                        <div class="no">OFF</div>
                                      </div>
                                    </div> 
                                   </div>
                                 </div>
                                 
                                 <input type="hidden" class="row-fluid" id="mobileweb" name="admin_values[mobileweb]" 
                                 value="<?php echo $core_admin_values['mobileweb']; ?>">
        
    </div>  
    
    
 <div class="form-row control-group row-fluid">
                <label class="control-label span4 offset3"  >Home Setup</label>
                <div class="controls span3">
                 <select name="admin_values[mobileweb_homesetup]" class="chzn-select" id="mobileweb_homesetup">
                    <option <?php selected( $core_admin_values['mobileweb_homesetup'], "0" );  ?> value="0">Welcome List</option>
                     <option <?php selected( $core_admin_values['mobileweb_homesetup'], "1" );  ?> value="1">Recent Listings</option>
                    <option <?php selected( $core_admin_values['mobileweb_homesetup'], "2" );  ?> value="2">Website Categories</option>
                    <?php hook_admin_1_tab1_mobile_homelist(); ?>
                  </select>
                              
                </div>
                
</div>
    
    
 
    
<div class="form-row control-group row-fluid">
                <label class="control-label span4 offset3"  >Color Scheme</label>
                <div class="controls span3">
                  <select name="admin_values[mobileweb_color]" class="chzn-select" id="mobileweb_color">
                    <option value=""></option>
                    <option value="" <?php if($core_admin_values['mobileweb_color'] == ""){ echo "selected=selected"; } ?>>Default (Blue)</option>
                    <option value="red" <?php if($core_admin_values['mobileweb_color'] == "red"){ echo "selected=selected"; } ?>>Red</option>   
                     <option value="green" <?php if($core_admin_values['mobileweb_color'] == "green"){ echo "selected=selected"; } ?>>Green</option>   
                     <option value="orange" <?php if($core_admin_values['mobileweb_color'] == "orange"){ echo "selected=selected"; } ?>>Orange</option>   
                     <option value="purple" <?php if($core_admin_values['mobileweb_color'] == "purple"){ echo "selected=selected"; } ?>>Purple</option>                 
                  </select>
                </div>
                
</div>
    
    
          <!------------ FIELD -------------->    
                
            <div class="row-fluid" style="padding-bottom: 5px; border-bottom: 1px dotted #dfdfdf; padding-top:5px;">
          
                <label class="control-label span4 offset3">Mobile Logo (text only) <br /><small>use span tags to &lt;span&gt;highlight&lt;/span&gt;</small></label>
                <div class="controls span4"> 
                        
                 <textarea class="row-fluid" name="admin_values[mobileweb_logo]"><?php echo stripslashes($core_admin_values['mobileweb_logo']); ?></textarea>
         
                       
                </div>
             
            </div>
            <!------------ END FIELD -------------->  
    
             <div class="row-fluid" style="padding-bottom: 5px; border-bottom: 1px dotted #dfdfdf; padding-top:5px;">
          
                <label class="control-label span4 offset3">Subline Text <br /><small>home page display only</small> </label>
                <div class="controls span4"> 
                        
                 <textarea class="row-fluid" name="admin_values[mobileweb_subtxt]"><?php echo stripslashes($core_admin_values['mobileweb_subtxt']); ?></textarea>
         
                       
                </div>
             
            </div>
            <!------------ END FIELD -------------->     