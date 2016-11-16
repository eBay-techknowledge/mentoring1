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

   <div class="heading2">Image Display Settings</div> 

        <div class="form-row control-group row-fluid">
                <label class="control-label span4" rel="tooltip" data-original-title="This image is used when no image has been assined to a listing." data-placement="top">'No Image' Icon</label>
                <div class="controls span7">
                <div class="input-append row-fluid">
                  <input type="text"  name="admin_values[fallback_image]" id="upload_pak" class="row-fluid" 
                  value="<?php echo $core_admin_values['fallback_image']; ?>">
                  <span class="add-on" id="upload_pakimage" style="cursor:pointer;"><i class="gicon-search"></i></span>
                  </div>
                </div>
       </div> 
       
       
       <div style="text-align:center; border:1px solid #ddd; padding:20px; margin-left:100px;margin-bottom:30px;margin-right:100px;">
                <?php if(strlen($core_admin_values['fallback_image']) > 10){ echo '<img src="'.$core_admin_values['fallback_image'].'" style="max-width:250px; max-height:250px;" /> '; }else{ echo "<h1>".$core_admin_values['fallback_image']."</h1>";  }?>
                </div> 
        
    
			<script type="text/javascript">
            
                jQuery(document).ready(function () {
                    jQuery('#upload_pakimage').click(function() { 
                     
                     ChangeImgBlock('upload_pak');
                     formfield = jQuery('#upload_pak').attr('name');
                     tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
                     return false;
                    });
					
					window.send_to_editor = function(html) {
 imgurl = jQuery('img',html).attr('src'); 
 jQuery('#'+document.getElementById("imgIdblock").value).val(imgurl);
 tb_remove();
} 

                });	
				
            </script> 