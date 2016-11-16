<?php
// CHECK THE PAGE IS NOT BEING LOADED DIRECTLY
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
// SETUP GLOBALS
global $wpdb, $CORE, $userdata, $CORE_ADMIN;

if(!defined('WLT_DEMOMODE') && current_user_can('administrator')){
 
$core_admin_values = get_option("core_admin_values");
 
// LOAD IN HEADER
echo $CORE_ADMIN->HEAD();

?>

 
 
<ul id="tabExample1" class="nav nav-tabs">

<?php
// HOOK INTO THE ADMIN TABS
function _5_tabs(){ $STRING = ""; global $wpdb; $core_admin_values = get_option("core_admin_values");

	if(isset($_GET['tab'])){ $_POST['tab'] = $_GET['tab']; }
	
	$pages_array = array( 
	"0" => array("t" => "Settings", 			"k"=>"settings"),
 
 	);
	foreach($pages_array as $page){
	
	if( ( isset($_POST['tab']) && $_POST['tab'] == $page['k'] ) || ( !isset($_POST['tab']) && $page['k'] == "settings" ) ){ $class = "active"; }else{ $class = ""; }
	
		$STRING .= '<li class="'.$class.'"><a href="#'.$page['k'].'" onclick="document.getElementById(\'ShowTab\').value=\''.$page['k'].'\'" data-toggle="tab">'.$page['t'].'</a></li>';		
	}
 
	return $STRING;

}
echo hook_admin_5_tabs(_5_tabs());
// END HOOK
?>  
                     
</ul>
           
           
<div class="tab-content">

<?php do_action('hook_admin_5_content'); ?>


<!--------------------------- LANGUAGE TAB ---------------------------->
<div class="tab-pane fade <?php if(!isset($_POST['tab']) || ( isset($_POST['tab']) && $_POST['tab'] =="" ) || ( isset($_POST['tab']) && $_POST['tab'] == "settings" ) ){ echo "active in"; } ?>" id="settings">

<div class="row-fluid">

<div class="span8">

	<!-- START BOX -->
	<div class="box gradient">

      <div class="title">
            <div class="row-fluid"><h3><i class="gicon-folder-open"></i>Setup Options</h3></div>
        </div>         
        <div class="content">
     
     
           
            
            
                             
                    
  <div class="heading2">  Media Uploading </div>     
        
                    
                    
 
     
     
     
     
     
     
        </div>
        
     </div>
     
</div>

<div class="span4">


<div class="box gradient">

      <div class="title">
            <div class="row-fluid"><h3><i class="gicon-folder-open"></i>Settings</h3></div>
        </div> 
        
        <div class="content">
        asd
        </div>
        
</div>

</div>


</div>

</div>
 


</div>
<?php } ?>
<?php // LOAD IN FOOTER
echo $CORE_ADMIN->FOOTER(); ?>