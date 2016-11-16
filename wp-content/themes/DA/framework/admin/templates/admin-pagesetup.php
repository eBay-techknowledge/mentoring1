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

// TEMPLATE CHOICE
$selected_template = $core_admin_values['template']; 
$HandlePath = TEMPLATEPATH . '/templates/';
	    $count=1; $TemplateString = "";
		if($handle1 = opendir($HandlePath)) {      
			while(false !== ($file = readdir($handle1))){			
				if(strpos($file,".") ===false && ( strpos($file,strtolower('template')) !== false  ) ){	
			 					
					$TemplateString .= "<option "; 
					if ($selected_template == $file) { $TemplateString .= ' selected="selected"'; }   
					$TemplateString .= 'value="'.$file.'">'; 					
					$TemplateString .= str_replace("basic","[CHILD]",str_replace("_"," ",str_replace("-"," ",str_replace(strtolower('template'),"",$file)))); 										
					$TemplateString .= "</option>";			
   
				}
			}
			
		}

// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  
  
?> 

<div class="row-fluid">

<div class="span8">


<?php if(!defined('CHILD_THEME_NAME')){ ?>

<!-- COLOR BOX --->
<div class="box gradient" style="box-shadow:0px; border: 1px solid #e9e9e9;">
<div class="content">
<div class="heading2">Website Color Scheme</div>
<input type="hidden" name="admin_values[colorstyle_file]" id="colorstyle_file" value="<?php echo $core_admin_values['colorstyle_file']; ?>">
<div class="row-fluid">
<div class="span12 well" >   
    
 <div style="background:#fff; 
 <?php if($core_admin_values['colorstyle_file'] == ""){ ?>border: 2px solid red;<?php }else{ ?>border: 1px solid #C2C2C2;<?php } ?> 
 padding: 1px; 
 margin-right:15px;
 cursor:pointer;
  margin-bottom:0px; 
  float:left;
  width:51px; 
  height:51px;
  line-height: 50px;
  text-align: center;
  color: #000;
 font-size:11px; " 
   onclick="document.getElementById('colorstyle_file').value='<?php echo $cc; ?>';document.admin_save_form.submit();">default</div>
   
<?php 

$colorarrays = array('blue' => "278fce",'yellow' => 'f4d925','pink' => 'e94d81','green' => '87c623','purple' => '9546b1','red' => 'c20307','grey' => '444444' );

foreach($colorarrays as $cc => $ddd){ ?>
 <div style="
 background:#<?php echo $ddd; ?>; 
 <?php if($core_admin_values['colorstyle_file'] == $cc){ ?>border: 2px solid red;<?php }else{ ?>border: 1px solid #C2C2C2;<?php } ?> 
 padding: 1px; 
 margin-right:12px;
 cursor:pointer;
  margin-bottom:0px; 
  float:left;
  width:51px; 
  height:51px;
  line-height: 50px;
  text-align: center;
  color: #000;" 
  class="img-circle" onclick="document.getElementById('colorstyle_file').value='<?php echo $cc; ?>';document.admin_save_form.submit();">&nbsp;</div>
<?php } ?>
</div>
<div class="clearfix"></div>

  
</div>

</div> 
</div>
<!-- END COLOR BOX -->
<?php } ?>

 


<!-- START ACCORDING --->
<div class="accordion  style1" id="pagesetup_according">
 
<?php do_action('hook_admin_1_tab1_tablist'); ?> 

<?php do_action('hook_admin_1_pagesetup'); ?>


<div class="accordion-group">
    <div class="accordion-heading" style="background:#fff;">
        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#pagesetup_according" href="#item0">
         <h4 style="margin:0xp;font-weight:bold;">
         <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/img/core/icons/2.png">
         Website Logo <span style="font-size:12px;">(view/hide)</span></h4> 
        </a>
    </div>
    
    <div id="item0" class="accordion-body collapse">
    <div class="accordion-inner">
    <div class="innerwrap content">
    <?php get_template_part('framework/admin/templates/admin', 'item-logo' ); ?>
    </div>
    </div>
    </div>
</div>

<div class="accordion-group">
    <div class="accordion-heading" style="background:#fff;">
        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#pagesetup_according" href="#item1">
         <h4 style="margin:0xp;font-weight:bold;">
         <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/img/core/icons/3.png">
         Top Navigation <span style="font-size:12px;">(view/hide)</span></h4> 
        </a>
    </div>
    
    <div id="item1" class="accordion-body collapse">
    <div class="accordion-inner">
    <div class="innerwrap content">
    <?php get_template_part('framework/admin/templates/admin', '2-item1' ); ?>
    </div>
    </div>
    </div>
</div>


<div class="accordion-group">
    <div class="accordion-heading" style="background:#fff;">
        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#pagesetup_according" href="#item2">
         <h4 style="margin:0xp;font-weight:bold;">
         <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/img/core/icons/4.png">
         Main Menu <span style="font-size:12px;">(view/hide)</span></h4> 
        </a>
    </div>
    
    <div id="item2" class="accordion-body collapse">
    <div class="accordion-inner">
    <div class="innerwrap content">
    <?php get_template_part('framework/admin/templates/admin', '2-item2' ); ?>
    </div>
    </div>
    </div>
</div>



<div class="accordion-group">
    <div class="accordion-heading" style="background:#fff;">
        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#pagesetup_according" href="#item3">
         <h4 style="margin:0xp;font-weight:bold;">
         <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/img/core/icons/5.png">
         Breadcrumbs <span style="font-size:12px;">(view/hide)</span></h4> 
        </a>
    </div>
    
    <div id="item3" class="accordion-body collapse">
    <div class="accordion-inner">
    <div class="innerwrap content">
    <?php get_template_part('framework/admin/templates/admin', '2-item3' ); ?>
    </div>
    </div>
    </div>
</div>


<div class="accordion-group">
    <div class="accordion-heading" style="background:#fff;">
        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#pagesetup_according" href="#item4">
         <h4 style="margin:0xp;font-weight:bold;">
         <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/img/core/icons/6.png">
         Footer <span style="font-size:12px;">(view/hide)</span></h4> 
        </a>
    </div>
    
    <div id="item4" class="accordion-body collapse">
    <div class="accordion-inner">
    <div class="innerwrap content">
    <?php get_template_part('framework/admin/templates/admin', '2-item4' ); ?>
    </div>
    </div>
    </div>
</div>


<div class="accordion-group">
    <div class="accordion-heading" style="background:#fff;">
        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#pagesetup_according" href="#item5">
         <h4 style="margin:0xp;font-weight:bold;">
         <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/img/core/icons/7.png">
         Custom CSS/Javascript <span style="font-size:12px;">(view/hide)</span></h4> 
        </a>
    </div>
    
    <div id="item5" class="accordion-body collapse">
    <div class="accordion-inner">
    <div class="innerwrap content">
    <?php get_template_part('framework/admin/templates/admin', 'item-customcss' ); ?>
    </div>
    </div>
    </div>
</div>



</div><!-- END ACCORDING -->



















	

</div>

<div class="span4">




<div class="box gradient">

      <div class="title">
            <div class="row-fluid"><h3><i class="gicon-folder-open"></i>Installed Theme</h3></div>
        </div> 
        
        <div class="content"> 
        
<?php if(defined('CHILD_THEME_NAME')){ ?>
<img src="<?php echo CHILD_THEME_PATH_URL; ?>/screenshot.png" />
 <input type="hidden" name="admin_values[template]" value="<?php echo $core_admin_values['template']; ?>" />
<?php }else{ ?>
       
        
<!-- WEBSITE SCREENSHOT // PREVIEW -->          
<script type="text/javascript">
jQuery(document).ready(function() { 
   jQuery("#themepreview").change(function() {
     jQuery("#imagePreview").empty();
	 if(jQuery("#themepreview").val() != ""){
	 jQuery('#previewbox').show();
        jQuery("#imagePreview").append("<img src=\"<?php echo get_template_directory_uri(); ?>/templates/" + jQuery("#themepreview").val()  + "/screenshot.png\" />");	
	} else {
		jQuery('#previewbox').hide();
	}
   });   
 }); 
</script>   

<div id="imagePreview" style="margin-bottom:5px;"><?php if($core_admin_values['template'] != ""){ ?><img src="<?php echo get_template_directory_uri(); ?>/templates/<?php echo $core_admin_values['template']; ?>/screenshot.png" /><?php } ?></div>

<select name="admin_values[template]" style="width:100%;" id="themepreview">
        <option value="">None</option>
        <?php echo $TemplateString; ?>
</select>

<input type="hidden" name="current_template_save" value="<?php echo $selected_template; ?>" />
        
<?php } ?>
        </div>
        
</div>







 
 









<div class="box gradient">

      <div class="title">
            <div class="row-fluid"><h3> Settings</h3></div>
        </div> 
        
        <div class="content">
        
        
      
            <div class="form-row control-group row-fluid ">
                            <label class="control-label span7" rel="tooltip" data-original-title="Enable this option if you want the website to become fluid and resizable. This option is recommended if you want your site to appear resized for mobile and tablet devices." data-placement="top">Responsive Design</label>
                            <div class="controls span5">
                              <div class="row-fluid">
                                <div class="pull-left">
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('display_responsive').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('display_responsive').value='1'">
                                  </label>
                                  <div class="toggle <?php if($core_admin_values['responsive'] == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                               </div>
                             </div>
                             
                             <input type="hidden" class="row-fluid" id="display_responsive" name="admin_values[responsive]" 
                             value="<?php echo $core_admin_values['responsive']; ?>">
            </div>
        
        
<script>

function changelayoutstyle(t){

if(t == 1){
	jQuery('#lw').val(0);
	jQuery('#lc').val(1);
}else{
	jQuery('#lw').val(1);
	jQuery('#lc').val(0);
}

document.admin_save_form.submit();
}

</script>

<input id="lw" class="hidden" name="admin_values[layout_layoutwidth]" value="<?php echo $core_admin_values['layout_layoutwidth']; ?>">
<input id="lc" class="hidden" name="admin_values[layout_contentwidth]" value="<?php echo $core_admin_values['layout_contentwidth']; ?>">
        
      
<div class="well row-fluid" style="border-radius: 0px;">        
    <div class="span6">
               
                <a href="javascript:void(0);" onclick="changelayoutstyle(1);">
                <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/img/core/boxed.png" style="border:1px solid #ccc; padding:4px;background:#fff; <?php if($core_admin_values['layout_layoutwidth'] ==  0){ echo "border:1px solid red;"; } ?>">
                </a>
                     
    </div>        
    <div class="span6">
                <a href="javascript:void(0);" onclick="changelayoutstyle(2);">
                <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/img/core/wide.png" style="border:1px solid #ccc; padding:4px;background:#fff; <?php if($core_admin_values['layout_layoutwidth'] == 1){ echo "border:1px solid red;"; } ?>">
                </a>
                     
    </div>
</div>

</div>
        
        
    </div>

</div>

</div>
 