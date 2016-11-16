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

 
    <div id="layoutedit" class="accordion-body collapse">
    <div class="accordion-inner">
    <div class="innerwrap">
  


<h1>Homepage Content</h1>

 
<div style="margin-bottom:40px; padding:10px; background:#fff; border:1px dashed green;"><b>Remember,</b> different home page layouts have different display options therefore not all settings below will apply to your current layout. </div>
 

<div class="heading2">Turn on/off display blocks</div>


<?php $i=1; while($i < 6){ ?>

      <div class="form-row control-group row-fluid content">
                                <label class="control-label span4 offset2" data-placement="top">Display Block <?php echo $i; ?></label>
                                <div class="controls span4">
                                  <div class="row-fluid">
                                    <div class="pull-left">
                                      <label class="radio off">
                                      <input type="radio" name="toggle" 
                                      value="off" onchange="document.getElementById('home_section<?php echo $i; ?>').value='0'">
                                      </label>
                                      <label class="radio on">
                                      <input type="radio" name="toggle"
                                      value="on" onchange="document.getElementById('home_section<?php echo $i; ?>').value='1'">
                                      </label>
                                      <div class="toggle <?php if(!isset($core_admin_values['home_section'.$i]) || (isset($core_admin_values['home_section'.$i]) && $core_admin_values['home_section'.$i] == '1' ) ){  ?>on<?php } ?>">
                                        <div class="yes">ON</div>
                                        <div class="switch"></div>
                                        <div class="no">OFF</div>
                                      </div>
                                    </div> 
                                   </div>
                                 </div>
                                 
                                 <input type="hidden" class="row-fluid" id="home_section<?php echo $i; ?>" name="admin_values[home_section<?php echo $i; ?>]" 
                                 value="<?php if(!isset($core_admin_values['home_section'.$i])){ echo 1; }else{ echo $core_admin_values['home_section'.$i]; } ?>">
         </div>

<?php $i++; } ?>

<p>A display block refers to each feature on your home page, for example the banner is one block, categories is another block. Count from the top down.</p>
 


<hr />

<?php 


$homedata = array( 


'j1' => array(
	"n" => "Main Banner Block", 
	"data" => array(
		"title1" 	=> array( "t" => "Title Text", "d" => "Hello! &amp; Welcome" ),
		"title2" 	=> array( "t" => "Sub title text", "d" => "We hope you enjoy our new website" ),
		"title3" 	=> array( "t" => "Short Description", 	"type" => "textarea", "d" => "You can edit this text via the admin area under the page setup." ),
		"img" 		=> array( "t" => "Background Image <br><small>(size: 1150px / 400px )</small>", 	"type" => "upload", "d" => "" ),
	),
),

't1' => array(
	"n" => "Title Block 1", 
	"data" => array(
		"title1" 	=> array( "t" => "Title Text" , "d" => "Your Amazing Title Here"),
		"title2" 	=> array( "t" => "Sub Title Text", "d" => "" ),
	),
),
't2' => array(
	"n" => "Title Block 2", 
	"data" => array(
		"title1" 	=> array( "t" => "Title Text", "d" => "" ),
		"title2" 	=> array( "t" => "Sub Title Text", "d" => "" ),
	),
),

't3' => array(
	"n" => "Image Block 1", 
	"data" => array(
		"img1" 	=> array( "t" => "Image 1 <br><small>(size: 350px / 150px )</small>","type" => "upload", "d" => ""  ),
		"img2" 	=> array( "t" => "Image 2 <br><small>(size: 350px / 150px )</small>", "type" => "upload", "d" => ""  ),
		"img3" 	=> array( "t" => "Image 3 <br><small>(size: 350px / 150px )</small>", "type" => "upload", "d" => ""  ),
		
		
	),
),
 
);
 

foreach($homedata as $key => $data){ ?>


  <div class="accordion-group">
  
    <div class="accordion-heading btn-success">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#wlt_widget_list" href="#collapse<?php echo $key; ?>" style="color:#fff; font-weigt:bold;">
      <img src="<?php echo get_template_directory_uri(); ?>/framework/img/a3.png" style="float:right;margin-top:3px;">
        <?php echo $data['n']; ?>
      </a>
    </div>
    
    <div id="collapse<?php echo $key; ?>" class="accordion-body collapse in" style="background:#F1FFF1;">
      <div class="accordion-inner">
      <ul>
      <?php foreach($data['data'] as $key1 => $item){  if(!isset($item['type'])){ $item['type'] = ""; } ?>
	
<div class="row-fluid clearfix">
          
                <label class="control-label span4"><?php echo $item['t']; ?></label>
                <div class="controls span8">    
                
                <?php switch($item['type']){ 
				
				case "textarea": { ?>
                
                <textarea name="admin_values[hdata][<?php echo $key; ?>][<?php echo $key1; ?>]" style="height:150px; width:100%;"/><?php if($core_admin_values['hdata'][$key][$key1] == ""){ echo $item['d']; }else{ echo stripslashes($core_admin_values['hdata'][$key][$key1]); } ?></textarea> 
                
                <?php } break; 
				
				case "upload": { ?> 
                
                
                <div class="input-append row-fluid" style="width:90%;">
    
    			<input name="admin_values[hdata][<?php echo $key; ?>][<?php echo $key1; ?>]" type="text" id="up_<?php echo $key; ?><?php echo $key1; ?>" value="<?php if($core_admin_values['hdata'][$key][$key1] == ""){ echo $item['d']; }else{  echo stripslashes($core_admin_values['hdata'][$key][$key1]); } ?>" class="row-fluid">
   
   				<span class="add-on" style="margin-right: -30px;" id="upload_<?php echo $key; ?><?php echo $key1; ?>"><i class="gicon-search"></i></span>   
  
    			</div>
                
               <script type="text/javascript">
			   
				jQuery(document).ready(function () {
			  
				   jQuery('#upload_<?php echo $key."".$key1; ?>').click(function() {           
			  
					 ChangeImgBlock('up_<?php echo $key."".$key1; ?>');
					 formfield = jQuery('#up_<?php echo $key."".$key1; ?>').attr('name');
					 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
					 return false;
					});
					
				});	
				
				</script>
            
                <?php } break; ?>
                
                <?php default: { ?>    
                
                  <input type="text" name="admin_values[hdata][<?php echo $key; ?>][<?php echo $key1; ?>]" value="<?php if($core_admin_values['hdata'][$key][$key1] == ""){ echo $item['d']; }else{ echo stripslashes($core_admin_values['hdata'][$key][$key1]); } ?>" style="width:100%">
                  
                <?php } } ?>
                
                </div>             
</div>
<div class="clearfix"></div>
	<?php } ?>    
  </ul>
  </div>
   </div>  </div>
 

<?php } ?>


 

<input type="hidden" value="" name="imgIdblock" id="imgIdblock" />
<script type="text/javascript">
function ChangeImgBlock(divname){
document.getElementById("imgIdblock").value = divname;
} 

jQuery(document).ready(function() {
window.send_to_editor = function(html) {
 imgurl = jQuery('img',html).attr('src'); 
 jQuery('#'+document.getElementById("imgIdblock").value).val(imgurl);
 tb_remove();
}
});

 

function DisplayFormValues(type){
	var elem = document.getElementById(type).elements;
	for(var i = 0; i < elem.length; i++){
		jQuery("#up_"+elem[i].name).val(elem[i].value);
	}
	 
	 
	jQuery('#custom_css_box').val('');
	jQuery('#shownewcode').val('save');	
	document.admin_save_form.submit(); 
}
 
</script>



    </div>
    </div>
    </div>
