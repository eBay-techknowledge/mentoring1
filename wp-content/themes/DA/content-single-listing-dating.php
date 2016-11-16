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

global $post, $CORE, $userdata; 

// GET LAST LOGIN DATE
$lastlogin = get_user_meta($post->post_author, 'login_lastdate', true);
 
		
ob_start();
?>
 
<a name="toplisting"></a>

 

<div class="panel panel-default">
<div class="panel-body">

<div class="wrap">
 
 
<div style="background:#fafafa; border:1px solid #ddd;" class="clearfix">
 
    <div class="col-md-6"> <div class="thumbnail" style="margin-top:20px;">[IMAGE]</div> </div>        
    <div class="col-md-6">    
        <h1>[TITLE-NOLINK]</h1>
        <!-- 
        <p class="lastonline"><?php echo $CORE->_e(array('widgets','26')); ?></strong> <?php echo hook_date($lastlogin); ?></p>   
       -->
       <!--   [LISTINGDATA]    -->
        </div>    
        
	</div>
 
  <div class="clearfix"></div>    
       [PROFILEBUTTONS]  
<div class="clearfix"></div>

<!--   [GOOGLEMAP]   -->

<hr />

<div style="padding:20px; border:1px solid #ddd; background:#fafafa; font-size:16px; ">

[CONTENT][FIELDS]

</div>


<hr />
[GOOGLEMAP] 

<!--  [COMMENTS]   -->
 

</div>
</div>

<?php $SavedContent = ob_get_clean(); 
echo hook_item_cleanup($CORE->ITEM_CONTENT($post, hook_content_single_listing($SavedContent)));

?>
