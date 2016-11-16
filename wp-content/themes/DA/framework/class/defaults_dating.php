<?php

class core_dating extends white_label_themes {
 
function hook_redirectlink($c){ global $post;

	if(isset($GLOBALS['flag-single'])){
	
	return home_url()."/wp-login.php?pid=".$post->ID.'&action=register&stopspam=1';
	
	}
	
	return $c;

}

	function core_dating(){ global $wpdb;	
	
	// INSTALL DATABASE TABLES
	$this->INSTALLTABLES();
	
	add_action('hook_redirectlink', array($this, 'hook_redirectlink' ));
	
	// CHECK FOR ACTIONS
	add_action('init', array($this, '_actions' ) );
	
	// ADD FIELDS TO THE ADMIN
	add_action('hook_fieldlist_0', array($this, '_hook_adminfields' ) );
	
	// ADD IN NEW CUSTOM FIELDS
	add_action('hook_add_fieldlist',  array($this, '_hook_customfields' ) );
	
	// SHORTCODES	
	add_shortcode( 'PROFILEBUTTONS', array($this,'wlt_shortcode_profilebuttons') );
	add_shortcode( 'GENDER', array($this,'wlt_shortcode_gender') );
	add_shortcode( 'ONLINESTATUS', array($this,'wlt_shortcode_onlinestatus') );
	add_shortcode( 'LISTINGDATA', array($this,'wlt_shortcode_listingdata') );
  
 	// ADD ON CHATROOM PAGE LINK
	add_action('hook_admin_1_tab1_subtab2_pagelist', array($this,'_updatepagelist' ));
 	
	// ADD FOOTER MODALS
	add_action('wp_footer', array($this, 'modals')); 
	
	// SEARCH FORM
	add_action('hook_gallerypage_searchform', array($this, 'extrasearch'));

	// ADDIN TO LIST
	add_action('hook_shortcodelist',array($this, '_hook_shortcodelist') );	
	
	// RESET DATABASE
	if(isset($_GET['resetchat']) && current_user_can('administrator') ){
	
		$wpdb->query("DROP TABLE ".$wpdb->prefix."core_useronline");		
		$wpdb->query("DROP TABLE ".$wpdb->prefix."core_chat_messages");		
		$wpdb->query("DROP TABLE ".$wpdb->prefix."core_chat_users");
		delete_option( "datingtabledinstalled1" );
	
	}
	
    }
	
function extrasearch(){ global $CORE;

ob_start();
 

?>
        <select class="form-control" name="dagender">
        <option value="">---------</option>
      <?php
	  
	  foreach(array(					
					"1" => $CORE->_e(array('dating','25')), 
					"2" => $CORE->_e(array('dating','26')), 
					"3" => $CORE->_e(array('dating','27')), 
					"4" => $CORE->_e(array('dating','28')),
					"5" => $CORE->_e(array('dating','31')),
					"6" => $CORE->_e(array('dating','32')),
					"7" => $CORE->_e(array('dating','33')),
					"8" => $CORE->_e(array('dating','34')),
					"9" => $CORE->_e(array('dating','35')),					
					) as $k => $t){
				
					// HIDE IF BLANK
					$t = trim($t);
					if($t == ""){ continue; }
						
					if($k == $_GET['dagender']){
					echo '<option value="'.$k.'" selected=selected>'.$t.'</option>';
					}else{
					echo '<option value="'.$k.'">'.$t.'</option>';
					}
				
				}
	  ?>
        </select>
         
        
        <select class="form-control" name="daage">
        <option value="">---------</option>
        <?php foreach(array(1825,2632,3340,4145,4651,5258,5965,7090) as $age){ ?>
        <option value="<?php echo $age; ?>" <?php echo selected( $_GET['daage'], $age ); ?>><?php echo substr($age,0,2)." - ".substr($age,2,2); ?></option>
        <?php } ?>
        </select>
        

<?php 
echo ob_get_clean();

}
	
	
	// ADD-ON CHATROOM PAGE
	function _updatepagelist($c){
		$c['chatroom'] = array("name" => "Chatroom");
		return $c;
	}
	
	function _actions(){ global $userdata, $CORE;
		
		// INVITE USER TO CHAT
		if(isset($_POST['action']) && $_POST['action'] == "invitechat" &&  is_numeric($_POST['user_id']) && $userdata->ID ){
		
			// SET NEW VALUE IN THE USERS ACCOUNT
			update_user_meta($_POST['user_id'],"chatinvite", array("asker_id" => $userdata->ID, "asker_name" => $userdata->user_nicename));
			 
			// LEAVE MSG	
			$GLOBALS['error_message'] = $CORE->_e(array('dating','1'));		
		}		
		
		// SEND GIFT MESSAGE
		if(isset($_POST['action']) && $_POST['action'] == "sendgift" && is_numeric($_POST['gift']) && $userdata->ID ){
	 
	 	// SAVE MESSAGE
		$Message = "
		 
		<div class='text-center'><img src='".ACTIVE_THEME_URI."icons/".$_POST['gift'].".png' alt='gift' /></div>
		
		<p><b><a href='".get_author_posts_url( $userdata->ID )."'>".$userdata->user_nicename."</a></b> ".$CORE->_e(array('dating','2'))."</p>
		
		".$CORE->_e(array('single','30')).": <a href='".get_permalink($_POST['pid'])."'>".get_permalink($_POST['pid'])."</a>\r\n"; 
	 
		// SENDER			 
		if(!$userdata->ID){ $userid = 1; }else{	$userid = $userdata->ID; }
		
		// SENT TO USER
		$user_info = get_userdata($_POST['user_id']);		
		$my_post = array();
		$my_post['post_title'] 		= $userdata->user_nicename." ".$CORE->_e(array('dating','2'));
		$my_post['post_content'] 	= $Message;
		$my_post['post_excerpt'] 	= "";
		$my_post['post_status'] 	= "publish";
		$my_post['post_type'] 		= "wlt_message";
		$my_post['post_author'] 	= $userid;
		$POSTID = wp_insert_post( $my_post );
		
		// ADD SOME EXTRA CUSTOM FIELDS
		add_post_meta($POSTID, "username", $user_info->user_login );	
		add_post_meta($POSTID, "userID", $user_info->ID);	
		add_post_meta($POSTID, "status", "unread" );
		add_post_meta($POSTID, "ref", get_permalink($_POST['pid']) );

		// SEND EMAIL	 
		$_POST['message'] = $_POST['contact_m1'];
		$_POST['phone'] = $_POST['contact_p1'];
		$_POST['email'] = $_POST['contact_e1'];
		$_POST['name'] = $_POST['contact_n1'];
		$CORE->SENDEMAIL($post->post_author,'contact');
		 
		// ADD LOG ENTRY
		$CORE->ADDLOG("<a href='(ulink)'>".$userdata->user_nicename.'</a> used the send gift feature: <a href="(plink)"><b>['.get_the_title($_POST['pid']).']</b></a>.', $userdata->ID, $_POST['pid'] ,'label-info');
		 
		// LEAVE MSG	
		$GLOBALS['error_message'] = $CORE->_e(array('dating','4'));	
		
		}
	
	}
	
	
	function modals(){ global $CORE, $userdata;
	
	?>
 

<!-- SEND GIFT MODAL -->
<div class="modal fade" id="giftmodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo $CORE->_e(array('dating','5')); ?></h4>
      </div>
      <div class="modal-body">
      
      <p><?php echo $CORE->_e(array('dating','6')); ?></p>
      
      <ul class="giftideas clearfix">
      <?php $i=1; while($i < 9){ ?>
      <li class="gifti<?php echo $i; ?>"> 
      <a href="javascript:void(0);" onclick="jQuery('#daGift').val('<?php echo $i; ?>');jQuery('.giftideas li').removeClass('selected');jQuery('.gifti<?php echo $i; ?>').addClass('selected');"><img src="<?php echo ACTIVE_THEME_URI."icons/".$i; ?>.png" alt="gif" class="img-responsive" /></a>
      </li>
	  <?php $i++; } ?>
      </ul>
      
      <div class="clearfix"></div>
      
      </div>
      <div class="modal-footer">
      
      <form method="post" action="" onsubmit="<?php if(!$userdata->ID){ ?>alert('<?php echo strip_tags($CORE->_e(array('validate','25'))); ?>'); return false;<?php } ?>">
      <input type="hidden" name="action"  value="sendgift" />
      <input type="hidden" name="gift" id="daGift" value="" />
      <input type="hidden" name="user_id" id="daGiftUid" value="" />
      <input type="hidden" name="pid" id="daGiftPid" value="" />
      <button type="submit" class="btn btn-primary"><?php echo $CORE->_e(array('dating','7')); ?></button>
      </form>
      
      </div>
    </div>
  </div>
</div>



<!-- SEND GIFT MODAL -->
<div class="modal fade" id="invitemodal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo $CORE->_e(array('dating','8')); ?></h4>
      </div>
      <div class="modal-body">
      
      
      <div class="col-md-3">
      <i class="fa fa-comments" style="font-size:100px;"></i>
      </div>
      
      <div class="col-md-9">
      
      <h3><?php echo $CORE->_e(array('dating','9')); ?></h3>
      
      <p><?php echo $CORE->_e(array('dating','10')); ?></p>
      
      </div>
       
      <div class="clearfix"></div>
      
      </div>
      <div class="modal-footer">
      
      <form method="post" action="" onsubmit="<?php if(!$userdata->ID){ ?>alert('<?php echo strip_tags($CORE->_e(array('validate','25'))); ?>'); return false;<?php } ?>">
      <input type="hidden" name="action"  value="invitechat" />
      <input type="hidden" name="user_id" id="daInviteUid" value="" />      
      <button type="submit" class="btn btn-primary"><?php echo $CORE->_e(array('dating','11')); ?></button>
      </form>
      
      </div>
    </div>
  </div>
</div>


<?php 

// CHAT REQUEST POP-UP
if($userdata->ID){ $ff = get_user_meta($userdata->ID, 'chatinvite',true); if(is_array($ff)){ ?>
<!-- CHAT REQUEST MODEAL -->
<div class="modal fade" id="chatroominvite" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo $CORE->_e(array('dating','12')); ?></h4>
      </div>
      <div class="modal-body">
      
      
      <div class="col-md-3">
      <a href='<?php echo get_author_posts_url( $ff['asker_id']  ); ?>'><?php echo get_avatar( $ff['asker_id'], 180 ); ?></a>
      </div>
      
      <div class="col-md-9">
            
      <h3><?php echo $CORE->_e(array('dating','13')); ?></h3>
      
      <p><?php echo $ff['asker_name']; ?> <?php echo $CORE->_e(array('dating','14')); ?> </p>
      
      </div>
       
      <div class="clearfix"></div>
      
      </div>
      <div class="modal-footer">   
           
      <a href="<?php echo $GLOBALS['CORE_THEME']['links']['chatroom']; ?>" class="btn btn-primary"><?php echo $CORE->_e(array('dating','15')); ?></a>     
      
      </div>
    </div>
  </div>
</div>
<script>
jQuery(document).ready(function($) {
    jQuery('#chatroominvite').modal()
});
</script>
<?php 
// blank it out so it doesnt keep poping-up
update_user_meta($userdata->ID, 'chatinvite', ''); 
} } ?>
    
    <?php 
	
	}
	
	function _hook_shortcodelist($c){
	
	return array_merge($c,array(
	'PROFILEBUTTONS' => array('desc' => 'Display Profile Buttons', 'type' => 'inner'),
 
	));
	
	}

	function USERONLINE($userid){ global $wpdb, $CORE, $userdata;
			
			if(!is_numeric($userid)){ return false; }
		
			 // CHECK IF THE USER EXISTS OTHERWISE ADD THEM
			 $result = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."core_useronline WHERE user_id= ('".$userid."') LIMIT 1");
			 if(empty($result)){
			 return false;
			 }else{
			 return true;
			 }
	} 
		
	function wlt_shortcode_listingdata($atts, $content = null){  global $userdata, $wpdb, $CORE, $post; $STRING = "";
		
		$STRING = '<table class="table" id="wlt_shortcode_listingdata">
		<tbody>
		
		<tr>
				<th>'.$CORE->_e(array('dating','16')).'</th>
				<td>[GENDER]</td>
		</tr>
		<tr>
				<th>'.$CORE->_e(array('dating','17')).'</th>
				<td>'.get_post_meta($post->ID,'daage',true).'</td>
		</tr>			
		<tr>
				<th>'.$CORE->_e(array('dating','18')).'</th>
				<td>[COUNTRY]</td>
		</tr>
		<tr>
				<th>'.$CORE->_e(array('dating','19')).'</th>
				<td>'.get_post_meta($post->ID,'map-city',true).'</td>
		</tr>';
		
		if( isset($GLOBALS['CORE_THEME']['geolocation']) && $GLOBALS['CORE_THEME']['geolocation'] != ""){
		
			$STRING .= '<tr>
					<th>'.$CORE->_e(array('dating','20')).'</th>
					<td>[DISTANCE text_before=""]</td>
			</tr>';
			
		} 
		
		$STRING .= '<tr>
				<th>'.$CORE->_e(array('dating','21')).'</th>
				<td>[ONLINESTATUS] </td>
		</tr>
		
		</tbody>
	</table>';
		
		return do_shortcode($STRING);
	
	}	

	function wlt_shortcode_onlinestatus($atts, $content = null){  global $userdata, $wpdb, $CORE, $post; $STRING = "";
		
		// EXTRACT
		extract( shortcode_atts( array('user_id' => ''  ), $atts ) );
	
		// GET USER ID
		if($user_id == ""){ $user_id = $post->post_author; }
		 	  
		// CHECK IF THE USER EXISTS OTHERWISE ADD THEM		
		if($this->USERONLINE($user_id)){
			  return '<span class="wlt_shortcode_onlinestatus"><i class="fa fa-circle profileonline" title="'.$CORE->_e(array('dating','22')).'"></i> <span>'.$CORE->_e(array('dating','22')).'</span></span>';
		}else{
			return '<span class="wlt_shortcode_onlinestatus"><i class="fa fa-circle profileoffline" title="'.$CORE->_e(array('dating','23')).'"></i> <span>'.$CORE->_e(array('dating','23')).'</span></span>';
		}
 
 	}
	
	function wlt_shortcode_profilebuttons($atts, $content = null){  global $userdata, $CORE, $post; $STRING = "";
	
	extract( shortcode_atts( array('id' => ''  ), $atts ) );	
	
	
	// FAVS BUTTON
	$show_add = true;
	if($userdata->ID){
		$my_list = get_user_meta($userdata->ID, 'favorite_list',true);
		if(is_array($my_list) && array_key_exists("ID:".$post->ID, $my_list) ){
			$show_add = false;
		}		 
	
		if($show_add){
			$FAVS = '<a class="list_favorites_add" href="#top" onclick="WLTAddF(\''.str_replace("http://","",get_home_url()).'\', \'favorite\', '.$post->ID.', \'core_ajax_callback\');">
			<i class="glyphicon glyphicon-star"></i> <span>'.$CORE->_e(array('button','32')).'</span></a>'; 
		}else{
			$FAVS = '<a class="list_favorites_remove" href="#top" onclick="WLTAddF(\''.str_replace("http://","",get_home_url()).'\', \'favorite\', '.$post->ID.', \'core_ajax_callback\');">
			<i class="glyphicon glyphicon-remove"></i> <span>'.$CORE->_e(array('button','33')).'</span></a>'; 
		} 
	}else{
	
	$FAVS = '<a class="list_favorites_add" href="javascript:void(0);" onclick="alert(\''.strip_tags($CORE->_e(array('validate','25'))).'\')" >
		<i class="glyphicon glyphicon-star"></i> <span>'.$CORE->_e(array('button','32')).'</span></a>'; 
	}
	
	// MESSAGE BUTTON
	if($userdata->ID){
		$MSG = $GLOBALS['CORE_THEME']['links']['myaccount'].'?tab=msg&show=1&u='.$post->post_author;
	}else{
		$MSG = '" onclick="alert(\''.strip_tags($CORE->_e(array('validate','25'))).'\')';
	}
	


	// ONLINE CHAT BUTTON
	if($this->USERONLINE($post->post_author)){
		$ONLINE = "";
	}else{
		$ONLINE = "";
	}
 
    $STRING ='<div class="clearfix profilebuttons">
    <div class="col-md-4 col-sm-4 col-xs-12">'.$FAVS.' </div>
   <!--
    <div class="col-md-3 col-sm-3 col-xs-12"><a href="javascript:void(0);" onclick="jQuery(\'#daGiftPid\').val('.$post->ID.');jQuery(\'#daGiftUid\').val('.$post->post_author.');" data-toggle="modal" data-target="#giftmodal"><i class="fa fa-gift"></i> <span>Send Gift</span></a></div>
   -->
    <div class="col-md-4 col-sm-4 col-xs-12"><a href="'.$MSG.'"><i class="fa fa-envelope"></i> <span>'.$CORE->_e(array('single','7')).'</span> </a></div>
    <div class="col-md-4 col-sm-4 col-xs-12"><a href="javascript:void(0);" onclick="jQuery(\'#daInviteUid\').val('.$post->post_author.');" data-toggle="modal" data-target="#invitemodal"><i class="fa fa-comments"></i> <span>'.$CORE->_e(array('dating','24')).'</span> </a></div>
    </div>';    
	
	return $STRING;	
	
	}
	
	function wlt_shortcode_gender($atts, $content = null){  global $userdata, $CORE, $post; $STRING = "";
	
	extract( shortcode_atts( array('id' => ''  ), $atts ) );	
	
	$gender = get_post_meta($post->ID,'dagender',true);
    
	switch($gender){
		case "1": { $STRING = $CORE->_e(array('dating','25')); } break;
		case "2": { $STRING = $CORE->_e(array('dating','26')); } break;
		case "3": { $STRING = $CORE->_e(array('dating','27')); } break;
		case "4": { $STRING = $CORE->_e(array('dating','28')); } break;
		
		case "5": { $STRING = $CORE->_e(array('dating','31')); } break;
		case "6": { $STRING = $CORE->_e(array('dating','32')); } break;
		case "7": { $STRING = $CORE->_e(array('dating','33')); } break;
		case "8": { $STRING = $CORE->_e(array('dating','34')); } break;
		case "9": { $STRING = $CORE->_e(array('dating','35')); } break;
	}
	
	return $STRING;	
	
	}
	
	// ADD IN CORE FIELDS TO THE ADMIN
	function _hook_adminfields($c){ global $CORE;
	
		$CORE->Language();
		
		// DATA
		$fields = array(
		
		"tab4" => array("tab" => true, "title" => "Dating Theme Extras" ),		
		"dagender" 		=> array("label" => $CORE->_e(array('dating','16')),  "values" => array(
		"1" => $CORE->_e(array('dating','25')), 
		"2" => $CORE->_e(array('dating','26')), 
		"3" => $CORE->_e(array('dating','27')), 
		"4" => $CORE->_e(array('dating','28')),
		"5" => $CORE->_e(array('dating','31')),
		"6" => $CORE->_e(array('dating','32')),
		"7" => $CORE->_e(array('dating','33')),
		"8" => $CORE->_e(array('dating','34')),
		"9" => $CORE->_e(array('dating','35')),
		)),
		"daage" 		=> array("label" => $CORE->_e(array('dating','17')), ),
 		"daseeking" 		=> array("label" => $CORE->_e(array('dating','29')),  "values" => array(
		
		"1" => $CORE->_e(array('dating','25')), 
		"2" => $CORE->_e(array('dating','26')), 
		"3" => $CORE->_e(array('dating','27')), 
		"4" => $CORE->_e(array('dating','28')),
		"5" => $CORE->_e(array('dating','31')),
		"6" => $CORE->_e(array('dating','32')),
		"7" => $CORE->_e(array('dating','33')),
		"8" => $CORE->_e(array('dating','34')),
		"9" => $CORE->_e(array('dating','35')),
		
		) ),
 
		);
 
	 
	return array_merge($c,$fields);
	}
	
	
		// ADD IN FRONT END FIELDS
	function _hook_customfields($c){ global $CORE;
	
		$o = 50;
		$ageArray = array(); $i = 18;
		while($i < 101){
		$ageArray[$i] = $i;
		$i++;
		}
 
		$c[$o]['title'] 			= $CORE->_e(array('dating','30'));
		$c[$o]['type'] 				= "select";
 		$c[$o]['name']				= "dagender";
		$c[$o]['listvalues']		= array(
		"1" => $CORE->_e(array('dating','25')), 
		"2" => $CORE->_e(array('dating','26')), 
		"3" => $CORE->_e(array('dating','27')), 
		"4" => $CORE->_e(array('dating','28')),
		"5" => $CORE->_e(array('dating','31')),
		"6" => $CORE->_e(array('dating','32')),
		"7" => $CORE->_e(array('dating','33')),
		"8" => $CORE->_e(array('dating','34')),
		"9" => $CORE->_e(array('dating','35')),
		);
		$c[$o]['class'] 			= "form-control";		 
		$o++;
		
		
		$c[$o]['title'] 			= $CORE->_e(array('dating','29'));
		$c[$o]['type'] 				= "select";
 		$c[$o]['name']				= "daseeking";
		$c[$o]['listvalues']		= array(
		"1" => $CORE->_e(array('dating','25')), 
		"2" => $CORE->_e(array('dating','26')), 
		"3" => $CORE->_e(array('dating','27')), 
		"4" => $CORE->_e(array('dating','28')),
		"5" => $CORE->_e(array('dating','31')),
		"6" => $CORE->_e(array('dating','32')),
		"7" => $CORE->_e(array('dating','33')),
		"8" => $CORE->_e(array('dating','34')),
		"9" => $CORE->_e(array('dating','35')),
		);
		$c[$o]['class'] 			= "form-control";		 
		$o++;		
		
		$c[$o]['title'] 			= $CORE->_e(array('dating','17'));
		$c[$o]['type'] 				= "select";
 		$c[$o]['name']				= "daage";
		$c[$o]['listvalues']		= $ageArray;
		$c[$o]['class'] 			= "form-control";		 
		$o++;
		
		return $c;
		
		}
		

		
		function INSTALLTABLES(){ global $wpdb, $CORE, $userdata;
	
		
		if(get_option("datingtabledinstalled1") == ""){
		 $wpdb->query("CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."core_useronline` (	 
		  `id` int(10) NOT NULL auto_increment, 
		  `user_id` int(10) NOT NULL, 
		  `session` char(100) NOT NULL default '',
		  `ip` varchar(15) NOT NULL default '', 
		  `timestamp` varchar(15) NOT NULL default '', 
		  PRIMARY KEY (`id`), 
		  UNIQUE KEY `id`(`id`) );");		  


		$wpdb->query("CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."core_chat_messages` (
		  `username` varchar(50) DEFAULT NULL,
		  `user_id` int(10) NOT NULL,
		  `message` text,
		  `date` datetime DEFAULT NULL
		)");
		
		$wpdb->query("CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."core_chat_users` (
		  `username` varchar(50) DEFAULT NULL,
		  `user_id` int(10) NOT NULL,
		  `last_activity` datetime DEFAULT NULL,
		  `is_kicked` int(11) DEFAULT '0',
		  `is_banned` int(11) DEFAULT '0',
		  `kick_ban_message` varchar(100) DEFAULT NULL,
		  UNIQUE KEY `username` (`username`)
		)");
		update_option("datingtabledinstalled1", true);
		}
		 
		 // USER SESSION
		$session = session_id();
		  
		 // CHECK IF THE USER EXISTS OTHERWISE ADD THEM
		 $result = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."core_useronline WHERE session='".$session."' LIMIT 1");
		 if(empty($result)){

			$wpdb->query("INSERT INTO  ".$wpdb->prefix."core_useronline (`user_id` ,`session` ,`ip` ,`timestamp`) 
			VALUES ( '".$userdata->ID."',  '".$session."',  '".$this->get_client_ip()."',  '".date('Y-m-d H:i:s')."');");			 
			
		}else{
		
			$wpdb->query("UPDATE ".$wpdb->prefix."core_useronline SET timestamp='".date('Y-m-d H:i:s')."', user_id='".$userdata->ID."' WHERE session='".$session."' LIMIT 1");			
		}
		
		// DELETE USERS AFTER 10 MINUTES 
		$wpdb->query("DELETE FROM ".$wpdb->prefix."core_useronline WHERE timestamp < '".date('Y-m-d H:i:s', strtotime("-10 minutes"))."' ");
   
   
		}
		
	
 
}

function wlt_datinghome_object($existing_objects){ $a = array();
	$a[0]['id'] 				= "datinghome";
	$a[0]['name'] 				= "Dating Object"; 
	$a[0]['desc'] 				= "Search box + Image"; 
	$a[0]['icon'] 				= FRAMREWORK_URI."admin/img/core/icon_dating.png";
	return array_merge($existing_objects,$a);
}
add_action('hook_object_list','wlt_datinghome_object');

function wlt_datinghome_output($item_data){ 	 
 
	global $post, $CORE, $wpdb; $core_admin_values = get_option("core_admin_values"); 
  	
	$item 		=  $item_data[0];
	$i 			=  $item_data[1];
	$fullwidth 	=  $item_data[2];
 
	switch($item){
		
		case "datinghome": { $ITEMKEY = "datinghome"; 
		
		// GET IMAGE
		if(defined('WLT_DEMOMODE') && isset($GLOBALS['datinghome_image']) && strlen($GLOBALS['datinghome_image']) > 1){
		$img1 = $GLOBALS['datinghome_image'];
		}else{
		if(strlen(get_option('datinghome_image')) < 5){ $img1 = CORE_THEME_PATH_IMG."main.png"; }else{ $img1 = get_option('datinghome_image'); }
		}
		 ?>
        <div id="mainbox">  
        
        <div class="container"><div class="row">
        
        	<div class="col-md-4">
            
            <div class="block">
             
            	<div class="block-content">                
                
                <h3><?php echo stripslashes(get_option('datinghome_t1')); ?></h3>
                
				<p><?php echo stripslashes(get_option('datinghome_t2')); ?></p>
                
                <?php echo core_search_form(null,'home'); ?>
                
                </div>
                
            </div> 
            
            </div>
            
            <div class="col-md-8">
            
            	  <div id="mainphoto"><img src="<?php echo $img1; ?>" alt="<?php echo stripslashes(get_option('datinghome_t1')); ?>" /></div>
                  
            </div>
        
         
        </div></div>
        
        </div>         
        
        <?php
		
		} break;
	} // end switch 
	
	return $item_data; //MUST RETURN ARAY OTHERWISE NOTHING ELSE WILL SHOW
	
}
add_action('hook_object', 'wlt_datinghome_output');	

function wlt_datinghome_settings($bits){	
 
	$bit = $bits[0];
	$eid = $bits[1];
	$i = $bits[2];
	if (strpos($bit, "datinghome") !== false) { $ITEMKEY = "datinghome";  $core_admin_values = get_option("core_admin_values"); 
 
 
	?>
    
     <div class="form-row control-group row-fluid">
				<label class="control-label span3">Main Image</label>
				<div class="controls span7">
				<div class="input-append row-fluid">
					  <input type="text"  name="adminArray[<?php echo $ITEMKEY; ?>_image]"  id="upload_dating_image" class="row-fluid" 
					  value="<?php echo get_option($ITEMKEY.'_image'); ?>">
					  <span class="add-on" id="aupload_dating_image"><i class="gicon-search"></i></span>
					  </div>
				</div>
		</div> 
                 		
		<script type="text/javascript">
            jQuery(document).ready(function () {
                jQuery('#aupload_dating_image').click(function() { 
                 
                 ChangeImgBlock('upload_dating_image');
                 formfield = jQuery('#upload_dating_image').attr('name');
                 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
				 jQuery("div").remove('#TB_overlay');
                 return false;
                });
            });	
        </script> 
        
        <hr />
        
        
         <div class="form-row control-group row-fluid">
				<label class="control-label span3">Search Title</label>
				<div class="controls span7">			 
					  <input type="text"  name="adminArray[<?php echo $ITEMKEY; ?>_t1]"  class="row-fluid" value="<?php echo get_option($ITEMKEY.'_t1'); ?>">					  
				</div>
		</div> 
        
          <div class="form-row control-group row-fluid">
				<label class="control-label span3">Search Text</label>
				<div class="controls span7">			 
					  <input type="text"  name="adminArray[<?php echo $ITEMKEY; ?>_t2]"  class="row-fluid" value="<?php echo get_option($ITEMKEY.'_t2'); ?>">					  
				</div>
		</div> 
        
         
    
	<?php			 
		$GLOBALS['itemkey'] = $ITEMKEY;		
		return $ITEMKEY; 
	} 
}
add_action('hook_object_setup', 'wlt_datinghome_settings', 10);

?>
