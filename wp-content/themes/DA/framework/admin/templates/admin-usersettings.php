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

<div class="row-fluid">

<div class="span8">
 
<!-- START ACCORDING --->
<div class="accordion style1" id="user_according">


<div class="accordion-group">
    <div class="accordion-heading" style="background:#fff;">
        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#user_according" href="#user0">
         <h4 style="margin:0xp;font-weight:bold;">
         
         <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/img/core/icons/u1.png">
        My Account Options <span style="font-size:12px;">(view/hide)</span></h4> 
        </a>
    </div>
    
    <div id="user0" class="accordion-body collapse">
    <div class="accordion-inner">
    <div class="innerwrap content">
    <?php get_template_part('framework/admin/templates/admin', 'user-account' ); ?>
    </div>
    </div>
    </div>
</div>


<div class="accordion-group">
    <div class="accordion-heading" style="background:#fff;">
        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#user_according" href="#user1">
         <h4 style="margin:0xp;font-weight:bold;">
         
         <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/img/core/icons/u2.png">
        User Credit <span style="font-size:12px;">(view/hide)</span></h4> 
        </a>
    </div>
    
    <div id="user1" class="accordion-body collapse">
    <div class="accordion-inner">
    <div class="innerwrap content">
    <?php get_template_part('framework/admin/templates/admin', 'user-credit' ); ?>
    </div>
    </div>
    </div>
</div>


<div class="accordion-group">
    <div class="accordion-heading" style="background:#fff;">
        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#user_according" href="#user2">
         <h4 style="margin:0xp;font-weight:bold;">
         
         <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/img/core/icons/u4.png">
        Registration Fields <span style="font-size:12px;">(view/hide)</span></h4> 
        </a>
    </div>
    
    <div id="user2" class="accordion-body collapse">
    <div class="accordion-inner">
    <div class="innerwrap content">
    <?php get_template_part('framework/admin/templates/admin', 'userfields' ); ?>
    </div>
    </div>
    </div>
</div>


</div>

  
 

 
</div>

<div class="span4">
 
 
<div class="box gradient">
<div class="title"><div class="row-fluid"><h3>User Registrations<h3></div></div> 
<div class="content">

   <?php if(!defined('WP_ALLOW_MULTISITE')){ ?>
       <div class="form-row control-group row-fluid ">
                            <label class="control-label span8">Enable Registrations</label>
                            <div class="controls span4">
                              <div class="row-fluid">
                                <div class="pull-left">
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('can_reg').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('can_reg').value='1'">
                                  </label>
                                  <div class="toggle <?php if(get_option('users_can_register') == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                               </div>
                             </div>
                             
                             <input type="hidden" class="row-fluid" id="can_reg" name="adminArray[users_can_register]" 
                             value="<?php echo get_option('users_can_register'); ?>">
            </div>
            <?php }else{ ?>
            <p class="alert">Registration on/off options are part of <a href="<?php echo get_home_url(); ?>/wp-admin/network/settings.php" style="text-decoration:underline;">WordPress Network settings.</a></p>
            
             <input type="hidden" class="row-fluid" id="can_reg" name="adminArray[users_can_register]" 
                             value="1">
            <?php } ?>
            
            

                   

            
            
          <div class="form-row control-group row-fluid ">
                            <label class="control-label span8" rel="tooltip" data-original-title="Enable this option if you prefer users to create their own password instead of being emailed one." data-placement="top">Create Passwords</label>
                            <div class="controls span4">
                              <div class="row-fluid">
                                <div class="pull-left">
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('visitor_password').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('visitor_password').value='1'">
                                  </label>
                                  <div class="toggle <?php if($core_admin_values['visitor_password'] == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                               </div>
                             </div>
                             
                             <input type="hidden" class="row-fluid" id="visitor_password" name="admin_values[visitor_password]" 
                             value="<?php echo $core_admin_values['visitor_password']; ?>">
            </div>  
            
     
 

        

        
               <div class="form-row control-group row-fluid ">
                            <label class="control-label span8">Security Code</label>
                            <div class="controls span4">
                              <div class="row-fluid">
                                <div class="pull-left">
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('register_securitycode').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('register_securitycode').value='1'">
                                  </label>
                                  <div class="toggle <?php if($core_admin_values['register_securitycode'] == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                               </div>
                             </div>
                             
                             <input type="hidden" class="row-fluid" id="register_securitycode" name="admin_values[register_securitycode]" 
                             value="<?php echo $core_admin_values['register_securitycode']; ?>">
            </div> 
           
            
     
<div class="heading2">Additional Registration Page Text</div>
<p><small>Here you can add your own text which will be displayed on your registration page. </small></p>
<textarea id="default-textarea" style="height:100px; width:250px;" name="admin_values[register_text]"><?php echo stripslashes($core_admin_values['register_text']); ?></textarea>
  


</div></div>
 
 
</div>

</div>