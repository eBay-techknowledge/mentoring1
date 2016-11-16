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

global $CORE;

// CHECK IF HOME PAGE IS SET
$HOMEPAGESET = $CORE->PAGEEXISTS('homepage');

// LOAD IN MAIN DEFAULTS 
$core_admin_values = get_option("core_admin_values");  
  
?>
 
<div class="row-fluid">

<div class="span8">


<?php get_template_part('framework/admin/templates/admin', 'pagelayout-home-edit' ); ?>
 
<!-- START ACCORDING --->
<div class="accordion style1" id="pagelayout_according">

<div class="accordion-group">
    <div class="accordion-heading" style="background:#fff;">
        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#pagelayout_according" href="#layout0">
         <h4 style="margin:0xp;font-weight:bold;">
         <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/img/core/icons/8.png">
         Home Page <span style="font-size:12px;">(view/hide)</span></h4> 
        </a>
    </div>
    
    <div id="layout0" class="accordion-body collapse">
    <div class="accordion-inner">
    <div class="innerwrap">
    <?php  get_template_part('framework/admin/templates/admin', 'pagelayout-home' ); ?>
    </div>
    </div>
    </div>
</div>


<div class="accordion-group">
    <div class="accordion-heading" style="background:#fff;">
        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#pagelayout_according" href="#layout1">
         <h4 style="margin:0xp;font-weight:bold;">
         <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/img/core/icons/9.png">
         Search Page <span style="font-size:12px;">(view/hide)</span></h4> 
        </a>
    </div>
    
    <div id="layout1" class="accordion-body collapse">
    <div class="accordion-inner">
    <div class="innerwrap content">
    <?php get_template_part('framework/admin/templates/admin', 'pagelayout-search' ); ?>
    </div>
    </div>
    </div>
</div>

<div class="accordion-group">
    <div class="accordion-heading" style="background:#fff;">
        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#pagelayout_according" href="#layout2">
         <h4 style="margin:0xp;font-weight:bold;">
         <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/img/core/icons/10.png">
         Listing Page <span style="font-size:12px;">(view/hide)</span></h4> 
        </a>
    </div>
    
    <div id="layout2" class="accordion-body collapse">
    <div class="accordion-inner">
    <div class="innerwrap content">
    <?php  get_template_part('framework/admin/templates/admin', 'pagelayout-listing' ); ?>
    </div>
    </div>
    </div>
</div>

<div class="accordion-group">
    <div class="accordion-heading" style="background:#fff;">
        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#pagelayout_according" href="#layout3">
         <h4 style="margin:0xp;font-weight:bold;">
         <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/img/core/icons/11.png">
         Normal Pages <span style="font-size:12px;">(view/hide)</span></h4> 
        </a>
    </div>
    
    <div id="layout3" class="accordion-body collapse">
    <div class="accordion-inner">
    <div class="innerwrap content">
    <?php  get_template_part('framework/admin/templates/admin', 'pagelayout-page' ); ?>
    </div>
    </div>
    </div>
</div>


<div class="accordion-group">
    <div class="accordion-heading" style="background:#fff;">
        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#pagelayout_according" href="#layout5">
         <h4 style="margin:0xp;font-weight:bold;">
         <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/img/core/icons/12.png">
         Print Page <span style="font-size:12px;">(view/hide)</span></h4> 
        </a>
    </div>
    
    <div id="layout5" class="accordion-body collapse">
    <div class="accordion-inner">
    <div class="innerwrap content">
    <?php  get_template_part('framework/admin/templates/admin', 'pagelayout-print' ); ?>
    </div>
    </div>
    </div>
</div>

<div class="accordion-group">
    <div class="accordion-heading" style="background:#fff;">
        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#pagelayout_according" href="#layout4">
         <h4 style="margin:0xp;font-weight:bold;">
         <img src="<?php echo get_template_directory_uri(); ?>/framework/admin/img/core/icons/13.png">
         Misc <span style="font-size:12px;">(view/hide)</span></h4> 
        </a>
    </div>
    
    <div id="layout4" class="accordion-body collapse">
    <div class="accordion-inner">
    <div class="innerwrap">
    <?php  get_template_part('framework/admin/templates/admin', 'pagelayout-misc' ); ?>
    </div>
    </div>
    </div>
</div>


</div>





 



</div>

<div class="span4">


 <?php 
 // DONT SHOW HOME PAGE OPTIONS IF ALREADY SET WITHIN CHILD THEME
if( $HOMEPAGESET ){  }else{ ?>

<?php if($core_admin_values['homeeditor'] == '1'){ }else{ ?>
<a data-toggle="collapse" data-parent="#pagelayout_according" href="#layoutedit" class="btn btn-lg btn-success" style="width: 100%;    font-size: 20px;    line-height: 40px;    border-radius: 0px;    margin-bottom: 20px;">Edit Home Page Content</a>
<?php } ?>

<?php if(!isset($GLOBALS['WLT_REVSLIDER'])  ){  ?>
<a href="<?php echo home_url(); ?>/wp-admin/plugin-install.php?tab=plugin-information&plugin=wlt_revslider&TB_iframe=true&width=640&height=799" class="btn btn-lg btn-info" style="width: 100%; border-radius: 0px; line-height: 25px; font-size: 20px; padding: 10px;"><b>No Slider</b> - Install Now</a>
<?php } ?>


<div class="box gradient" style="margin-top:20px;">
<div class="title"><div class="row-fluid">
<h3> <i class="gicon-retweet"></i> Slider</h3></div></div> 
<div class="content"> 

<?php if(isset($GLOBALS['WLT_REVSLIDER'])  ){  ?>

	<label><b>Which slider should i display?</b></label>
	<select name="admin_values[homesliderid]" class="chzn-select" id="homesliderid">			 
    <?php	
	$results = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."revslider_sliders", OBJECT);
	foreach ($results as $result){	
	?> 
    <option value="<?php echo $result->alias; ?>" <?php selected( $core_admin_values['homesliderid'], $result->alias ); ?>><?php echo $result->title; ?></option>
    <?php } ?>   		
	</select>
    
   <div class="form-row control-group row-fluid ">
                            <label class="control-label span7"><b>Enable Slider</b></label>
                            <div class="controls span5">
                              <div class="row-fluid">
                                <div class="pull-left">
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('homeslider').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('homeslider').value='1'">
                                  </label>
                                  <div class="toggle <?php if($core_admin_values['homeslider'] == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                               </div>
                             </div>
                             
                             <input type="hidden" class="row-fluid" id="homeslider" name="admin_values[homeslider]" value="<?php echo $core_admin_values['homeslider']; ?>">
            </div>

<?php }else{ ?>

<div style="padding:10px; background:#fff; border:1px dashed green;">
<p><span class="label label-info">Note</span> The home page slider is a free plugin that allows you to replace the default header block with a slider block.</p>
</div> 

<?php } ?>
 
</div>        
</div>







<div class="box gradient">
<div class="title"><div class="row-fluid">
<h3> 


<a data-toggle="modal" href="#VideoModelBox"  class="label label-warning pull-right" onclick="PlayPPTVideo('yP3e5krJIW8','videoboxplayer','479','350');" style="float:right; margin-right:5px; margin-top:8px;">Watch Video</a>


Home Page Editor</h3></div></div> 
<div class="content"> 

<div style="padding:10px; background:#fff; border:1px dashed green;">
<p><span class="label label-info">Note</span> This will disable the default theme design so you can create your own using new options at the bottom.</p>
</div>
       
 
    <div class="form-row control-group row-fluid ">
                            <label class="control-label span7"><b>Enable Editor</b></label>
                            <div class="controls span5">
                              <div class="row-fluid">
                                <div class="pull-left">
                                  <label class="radio off">
                                  <input type="radio" name="toggle" 
                                  value="off" onchange="document.getElementById('homeeditor').value='0'">
                                  </label>
                                  <label class="radio on">
                                  <input type="radio" name="toggle"
                                  value="on" onchange="document.getElementById('homeeditor').value='1'">
                                  </label>
                                  <div class="toggle <?php if($core_admin_values['homeeditor'] == '1'){  ?>on<?php } ?>">
                                    <div class="yes">ON</div>
                                    <div class="switch"></div>
                                    <div class="no">OFF</div>
                                  </div>
                                </div> 
                               </div>
                             </div>
                             
                             <input type="hidden" class="row-fluid" id="homeeditor" name="admin_values[homeeditor]" value="<?php echo $core_admin_values['homeeditor']; ?>">
            </div>
</div>        
</div>

 
<?php  } // END CHECK FOR HOMEPAGE FILE ?>

</div>

</div>


<?php if($core_admin_values['homeeditor'] == '1'){  get_template_part('framework/admin/templates/admin', 'home-editor' ); } ?>
