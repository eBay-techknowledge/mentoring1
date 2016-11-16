<?php
/*
Template Name: [My Account]
*/
/* =============================================================================
   [PREMIUMPRESS FRAMEWORK] THIS FILE SHOULD NOT BE EDITED
   ========================================================================== */
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }
/* ========================================================================== */
global  $userdata, $CORE; get_currentuserinfo(); $CORE->Authorize(); $GLOBALS['flag-myaccount'] = 1;
/* =============================================================================
   USER ACTIONS
   ========================================================================== */ 

if(isset($_POST['action']) && $_POST['action'] !=""){

	switch($_POST['action']){ 
	
	case "sellspace_set": {
		
		if(!is_numeric($_POST['cid'])){ return; }
	
		// SET NEW BANNER ID
		update_post_meta($_POST['cid'], 'bannerid', esc_attr($_POST['bannerid']));
		
		// UPDATE LINK
		update_post_meta($_POST['cid'], 'url', esc_attr($_POST['camurl']) ); 
		
		// IF THE EXISTING VALUE IS BLANK THEN LETS ASUME THIS IS THE FIRST TIME WE'VE UPLOAD
		// SO WE SHOULD START THE ADVERTISING PERIOD FROM NOW ON
		
		$timeleft = get_post_meta($_POST['cid'], 'listing_expiry_date', true);
		if($timeleft == ""){
			$campaign = get_post_meta($_POST['cid'], 'campaign', true);
			$DAYS = $sellspacedata[$campaign."_days"];
			if($DAYS == ""){ $DAYS = 30; }
			$sellspacedata = $GLOBALS['CORE_THEME']['sellspace']; 
			update_post_meta( $_POST['cid'], 'listing_expiry_date', date("Y-m-d H:i:s", strtotime( date("Y-m-d H:i:s") . " +".$DAYS." days")) );
		}
		
		// MSG
		$GLOBALS['error_message'] = "Banner Set Successfully"."<script>jQuery(document).ready(function() { jQuery('#MyAccountBlock').hide();jQuery('#MyAdvertising').show(); jQuery('#SellSpaceTabs a[href=\"#a3\"]').tab('show'); });</script>";
	
	} break;
	
	case "sellspace_delete": { 
		
		// DELETE FILES
		@unlink(get_post_meta($_POST['delid'],'path', true));
			 
		// NOW LETS SAVE THE NEW ONE	
		wp_delete_post( $_POST['delid'], true );
		
		// MSG
		$GLOBALS['error_message'] = "Banner Deleted Successfully"."<script>jQuery(document).ready(function() { jQuery('#MyAccountBlock').hide();jQuery('#MyAdvertising').show(); jQuery('#SellSpaceTabs a[href=\"#a2\"]').tab('show');  });</script>";
	
	
	} break;
	
	case "sellspace": {
		 
		if(is_array($_FILES['wlt_banner'])){
			$i = 0;
			foreach($_FILES['wlt_banner'] as $banner){
			 
			if($_FILES['wlt_banner']['name'][$i] == ""){ $i++; continue; }
			 
				if(in_array($_FILES['wlt_banner']['type'][$i],$CORE->allowed_image_types) ){
					
					// INCLUDE UPLOAD SCRIPTS
					$dir_path = str_replace("wp-content","",WP_CONTENT_DIR);
					if(!function_exists('wp_handle_upload')){
					require $dir_path . "/wp-admin/includes/file.php";
					}
					
					// GET WORDPRESS UPLOAD DATA
					$uploads = wp_upload_dir();
					
					// UPLOAD FILE 
					$file_array = array(
						'name' 		=> $_FILES['wlt_banner']['name'][$i], //$userdata->ID."_userphoto",//
						'type'		=> $_FILES['wlt_banner']['type'][$i],
						'tmp_name'	=> $_FILES['wlt_banner']['tmp_name'][$i],
						'error'		=> $_FILES['wlt_banner']['error'][$i],
						'size'		=> $_FILES['wlt_banner']['size'][$i],
					);
					//die(print_r($file_array));
					$uploaded_file = wp_handle_upload( $file_array, array( 'test_form' => FALSE ));
 
					// CHECK FOR ERRORS
					if(isset($uploaded_file['error']) ){		
						$GLOBALS['error_message'] .= $uploaded_file['error'];
					}else{
					
					// GET SIZES
					list($width, $height) = getimagesize($uploaded_file['file']);
					 
					$my_post = array();
					$my_post['post_title'] 		= strip_tags($_FILES['wlt_banner']['name'][$i]);
					$my_post['post_content'] 	= $width."X".$height."=".$_FILES['wlt_banner']['size'][$i];
					$my_post['post_excerpt'] 	= $uploaded_file['url'];
					$my_post['post_status'] 	= "publish";
					$my_post['post_type'] 		= "wlt_banner";
					$my_post['post_author'] 	= $userdata->ID;
					$POSTID 					= wp_insert_post( $my_post );
					
					// ADD CUSTOM FIELDS
					add_post_meta($POSTID,'img', $uploaded_file['url']);	
					add_post_meta($POSTID,'path', $uploaded_file['file']);
					add_post_meta($POSTID,'size', $_FILES['wlt_banner']['size'][$i]);
					add_post_meta($POSTID,'width', $width);
					add_post_meta($POSTID,'height', $height);
					
					}
					
					$i++;
					
				}else{
				$GLOBALS['error_message'] .= "File Type Invalid (".$_FILES['wlt_banner']['name'][$i].")<br>";
				}
			}
		}
		
		// MSG
		if($GLOBALS['error_message'] == ""){
		$GLOBALS['error_message'] = "Banners Saved Successfully";
		}
		
		$GLOBALS['error_message'] .= "<script>jQuery(document).ready(function() { jQuery('#MyAccountBlock').hide();jQuery('#MyAdvertising').show(); jQuery('#SellSpaceTabs a[href=\"#a2\"]').tab('show');   });</script>";
	
	
	} break;
	
	case "withdraw": {
	
		if(is_numeric($_POST['amount']) && $_POST['amount'] > 0){
		 
			$subject  = $CORE->_e(array('account','62'));
			$msg 	 .= "Username: ".$userdata->display_name."\r\n";
			$msg 	 .= "User ID: ".$userdata->ID."\r\n";
			$msg 	 .= "Email: ".$userdata->user_email."\r\n";
			$msg 	 .= "Amount: ".hook_price($_POST['amount'])."\r\n";
			$msg 	 .= "Preferences: ".$_POST['message']."\r\n";
	 
			// SAVE A COPY TO THE DATABASE
			
			$SQL = "INSERT INTO `".$wpdb->prefix."core_withdrawal` (
			`user_id` ,
			`user_ip` ,
			`user_name` ,
			`datetime` ,
			`withdrawal_comments` ,
			`withdrawal_status` ,
			`withdrawal_total`
			)
			VALUES ('".$userdata->ID."',  '".$CORE->get_client_ip()."',  '".$userdata->user_login."',  '".date('Y-m-d H:i:s') ."',  '".strip_tags($_POST['message'])."',  '0',  '".strip_tags($_POST['amount'])."')";
			
			$wpdb->query($SQL);
			 
			// SEND EMAIL TO ADMIN
			$CORE->SENDEMAIL('admin','custom',$subject,$msg);
			
			$GLOBALS['error_message'] 	= $CORE->_e(array('account','63'));	
		}	
	
	} break;
	
	case "subscrption": {
		
		$selstring = "";
		
		// LOOP THROUGH AND SAVE DATA
		if(isset($_POST['selsubs'])){
		
			foreach($_POST['selsubs'] as $val){
			
				$selstring .= "*".$val."*";
			
			}
		}
		 
		update_user_meta($userdata->ID,'email_subscriptions',$selstring);
		
		$GLOBALS['error_message'] 	= $CORE->_e(array('account','42'));	
	
	} break;
	
	case "deletemsgs": {
 		
		if(isset($_POST['check']) && is_array($_POST['check']) ){
		
			foreach($_POST['check'] as $msgid){
			
			update_post_meta($msgid,'status','delete');
		
			}
			
			$GLOBALS['error_message'] 	= $CORE->_e(array('account','16'))."<script>jQuery(document).ready(function() { jQuery('#MyAccountBlock').hide();jQuery('#MyMsgBlock').show(); });</script>";
	 
		}
	 	
		
	} break;
	case "deletemsg": {
 
	 	update_post_meta($_POST['messageID'],'status','delete');
		
		$GLOBALS['error_message'] 	= $CORE->_e(array('account','16'))."<script>jQuery(document).ready(function() { jQuery('#MyAccountBlock').hide();jQuery('#MyMsgBlock').show(); });</script>";	
	 
	} break;
	
	case "delfeedback": {	
		
		// CHECK FEEDBACK BELONGS TO THIS USER?
		
		wp_delete_post( $_POST['fid'], true);
		
		$GLOBALS['error_message'] 	= $CORE->_e(array('feedback','6'))."<script>jQuery(document).ready(function() { jQuery('#MyAccountBlock').hide();jQuery('#MyFeedback').show(); });</script>";	
			
	
	} break;
	
	case "addfeedback": {
	
				$my_post = array();
				$my_post['post_title'] 		= strip_tags(strip_tags($_POST['subject']));
				$my_post['post_content'] 	= strip_tags(strip_tags($_POST['message']));
				$my_post['post_excerpt'] 	= "";
				$my_post['post_status'] 	= "publish";
				$my_post['post_type'] 		= "wlt_feedback";
				$my_post['post_author'] 	= $userdata->ID;
				$POSTID 					= wp_insert_post( $my_post );			
				
				// GET THE LISTING DATA
				$feedback_postdata = get_post($_POST['pid']);				
				
				// CUSTOM FIELDS
				add_post_meta($POSTID, "pid", $_POST['pid']);
				add_post_meta($POSTID, "score", $_POST['score']);
				add_post_meta($POSTID, "uid", $feedback_postdata->post_author);
				add_post_meta($POSTID, "auid", $userdata->ID);
				
				
				// ADD FEEDBACK RATING TO THE POST ITSELF
				$fback = $CORE->FEEDBACKSCORE($_POST['pid']);	
				
				$tscore =  $fback['score']*5/100;
				
				update_post_meta($_POST['pid'], 'rating_total', $tscore);			
				 
				// SEND EMAIL
				$_POST['title'] = $feedback_postdata->post_title;
				$_POST['link'] = get_permalink($feedback_postdata->ID);
				$CORE->SENDEMAIL($feedback_postdata->post_author,'newfeedback');	
				
				// GO BACK TO LISTING
				header("location:".get_permalink($_POST['pid'])."?ftyou=1");
				
	
	} break;
	
	case "sendmsg": {
		
		$dd = get_userdatabylogin( $_POST['username'] );
		
		// ADDED TO FIX HYPEN USERNAMES
		if($dd == ""){
		$dd = get_userdatabylogin( str_replace("-"," ",$_POST['username']) );	
		}
 
		if(!isset($dd->ID)){
			$GLOBALS['error_type'] 		= "danger"; //ok,warn,error,info
			$GLOBALS['error_message'] 	= $CORE->_e(array('account','18')); 
		}elseif(isset($dd->ID)){	

			// CHECK HOW MANY MESSAGES HAVE BEEN SENT ALREADY FROM THIS USER
			$SQL = "SELECT count(*) AS total FROM $wpdb->posts WHERE post_type = 'wlt_message' AND post_author = '".$userdata->ID."' AND post_date LIKE ('".date("Y-m-d")."%')";	
			$found = (array)$wpdb->get_results($SQL);
 
			if($found[0]->total < 10){ // LIMIT 10 PER DAY
		 
				$my_post = array();
				$my_post['post_title'] 		= strip_tags(strip_tags($_POST['subject']));
				$my_post['post_content'] 	= strip_tags(strip_tags($_POST['message']));
				$my_post['post_excerpt'] 	= "";
				$my_post['post_status'] 	= "publish";
				$my_post['post_type'] 		= "wlt_message";
				$my_post['post_author'] 	= $userdata->ID;
				$POSTID 					= wp_insert_post( $my_post );
				
				add_post_meta($POSTID, "username", $dd->user_login);	
				add_post_meta($POSTID, "userID", $dd->ID);
				add_post_meta($POSTID, "status", "unread");
				 
			  
				$GLOBALS['error_type'] 		= "success"; //ok,warn,error,info
				$GLOBALS['error_message'] 	= $CORE->_e(array('account','17'));
				
				// SEND EMAIL
				$_POST['username'] = $dd->display_name;
				$_POST['from_username'] = $userdata->display_name;
				 
				$CORE->SENDEMAIL($dd->ID,'msg_new');
				
				// CLEAR MESSSAGE VALUES
				$_POST['subject'] = "";
				$_POST['message'] = "";
				
			} // end if
		} 	
		
	} break;
	
	case "update": { 
	 
			// SAVE THE CUSTOM PROFILE DATA
			if(isset($_POST['custom']) && is_array($_POST['custom'])){ 		 
				foreach($_POST['custom'] as $key=>$val){
					// SAVE DATA
					if(is_array($val)){
						update_user_meta($userdata->ID, strip_tags($key), $val);
					}else{
						update_user_meta($userdata->ID, strip_tags($key), esc_html(strip_tags($val)));
					}
				} // end foreach
			}// end if
			
			$data = array();
			$data['ID'] 			= $userdata->ID;
			// CHECK IF WE ARE CHANGING PASSWORDS	
			if(!defined('WLT_DEMOMODE')){	 
				if( ( $_POST['password'] == $_POST['password_r'] ) && $_POST['password'] !=""){
				
					$data['user_pass'] 		= $_POST['password'];	
					// ERROR MESSAGE
					$GLOBALS['error_message'] = $CORE->_e(array('account','19'));
					
				} elseif(isset($_POST['password']) && strlen($_POST['password']) > 1){	
						
					// PASSWORD CHECK ERROR
					$GLOBALS['error_message'] = $CORE->_e(array('account','20'));
					
				}else{
					// ERROR MESSAGE
					$GLOBALS['error_message'] = $CORE->_e(array('account','21'));
				}
			}// end if
			
			// CHECK EMAIL IS VALID			
			update_user_meta($userdata->ID, 'url', strip_tags($_POST['url']));
			update_user_meta($userdata->ID, 'phone', strip_tags($_POST['phone']));
			
			// SOCIAL
			update_user_meta($userdata->ID, 'facebook', strip_tags($_POST['facebook']));
			update_user_meta($userdata->ID, 'twitter', strip_tags($_POST['twitter']));
			update_user_meta($userdata->ID, 'linkedin', strip_tags($_POST['linkedin']));
			update_user_meta($userdata->ID, 'skype', strip_tags($_POST['skype']));
			
			// PROFILE BG
			update_user_meta($userdata->ID, 'pbg', strip_tags($_POST['pbg']));			
			
			// COUNTRY
			update_user_meta($userdata->ID, 'country', strip_tags($_POST['country']));
			
			// UPLOAD USER PHOTO			 
			if(isset($_FILES['wlt_userphoto']) && strlen($_FILES['wlt_userphoto']['name']) > 2 && in_array($_FILES['wlt_userphoto']['type'],$CORE->allowed_image_types) ){
				
				// INCLUDE UPLOAD SCRIPTS
				$dir_path = str_replace("wp-content","",WP_CONTENT_DIR);
				if(!function_exists('wp_handle_upload')){
				require $dir_path . "/wp-admin/includes/file.php";
				}
				
				// GET WORDPRESS UPLOAD DATA
				$uploads = wp_upload_dir();
				
				// UPLOAD FILE 
				$file_array = array(
					'name' 		=> $_FILES['wlt_userphoto']['name'], //$userdata->ID."_userphoto",//
					'type'		=> $_FILES['wlt_userphoto']['type'],
					'tmp_name'	=> $_FILES['wlt_userphoto']['tmp_name'],
					'error'		=> $_FILES['wlt_userphoto']['error'],
					'size'		=> $_FILES['wlt_userphoto']['size'],
				);
				//die(print_r($file_array));
				$uploaded_file = wp_handle_upload( $file_array, array( 'test_form' => FALSE ));
	  
				// CHECK FOR ERRORS
				if(isset($uploaded_file['error']) ){		
					$GLOBALS['error_message'] = $uploaded_file['error'];
				}else{
			 	 
				// NOW LETS SAVE THE NEW ONE	
				update_user_meta($userdata->ID, "userphoto", array('img' => $uploaded_file['url'], 'path' => $uploaded_file['file'] ) );
				
				}
			}
			
			// EXTRA
			$data['first_name'] 		= strip_tags($_POST['fname']);
			$data['last_name'] 			= strip_tags($_POST['lname']);
		 	$data['description'] 		= strip_tags($_POST['description']);		
			wp_update_user( $data );			
			
			// FUNCTION FOR PLUGINS
			//do_action('profile_update');
			hook_account_update();
		
		} break;
		
		default: {
		
		hook_account_save();
		
		} break;
	
	}

}
if(isset($_GET['did']) && is_numeric($_GET['did']) ){
	
	// CHECK THE POST AUTHOR AGAINST THE USER LOGGED IN
	$post_data = get_post($_GET['did']); 
	if($post_data->post_author == $userdata->ID){
	$my_post = array();
	$my_post['ID'] 					= $_GET['did'];
	$my_post['post_status']			= "trash";
	wp_update_post( $my_post  );
	// DELETE ALL ATTACHMENTS
	$CORE->UPLOAD_DELETEALL($_GET['did']);
	// ADD LOG ENTRY
	$CORE->ADDLOG("<a href='(ulink)'>".$userdata->user_nicename.'</a> deleted listing <b>['.get_the_title($_GET['did']).']</b>', $userdata->ID,$_GET['did'],'label-important');
	// ERROR MESSAGE
	$GLOBALS['error_message'] = $CORE->_e(array('account','22'));
	}else{
	$GLOBALS['error_message'] = "no access";
	}	
}

if(isset($_GET['claime']) && is_numeric($_GET['claime']) ){

	// CHECK IF THE USER HAS CLAIMED ANY LISTINGS BEFORE
	if(get_user_meta($userdata->ID, "claimed_listing",true) == ""){
		// ALLOW CLAIM
		$my_post = array();
		$my_post['ID'] 					= $_GET['claime'];
		$my_post['post_status']			= "publish";
		$my_post['post_author']			= $userdata->ID;	
		wp_update_post( $my_post  );
		// ADD CUSTOM FIELD SO WE KNOW IT WAS CLAIMED
		$_POST['title'] = get_the_title($_GET['claime']);
		// SET USER FLAG
		update_user_meta($userdata->ID, "claimed_listing", $_GET['claime']);
		// REMOVE CLAIM
		$CORE->SENDEMAIL('admin','admin_newclaim');
		// ADD LOG ENTRY
		$CORE->ADDLOG("<a href='(ulink)'>".$userdata->user_nicename.'</a> claimed listing <b>['.get_the_title($_GET['claime']).']</b>', $userdate->ID,$_GET['claime'],'label-important');
		
	// ERROR MESSAGE
	$GLOBALS['error_message'] = $CORE->_e(array('account','23'));
	}else{
	
	// ADD LOG ENTRY
	$CORE->ADDLOG("<a href='(ulink)'>".$userdata->user_nicename.'</a> tried to claim listing <b>['.get_the_title($_GET['claime']).']</b> but was denied! (too many claims)', $userdate->ID,$_GET['claime'],'label-info');
		
	$GLOBALS['error_message'] = $CORE->_e(array('account','24'));
	$GLOBALS['error_type'] = "error";
	}	
	
}

if(isset($_GET['submissionlimit'])){

	$GLOBALS['error_message'] = $CORE->_e(array('account','25'));
	$GLOBALS['error_type'] = "bs-callout bs-callout-success";
}

/* =============================================================================
   LOAD PAGE TEMPLATE
   ========================================================================== */

	$GLOBALS['flag-account'] = 1; 
	
	// CHECK FOR MEMBERSHIP ON REGISTRATION
	if(isset($GLOBALS['CORE_THEME']['show_mem_registraion']) && $GLOBALS['CORE_THEME']['show_mem_registraion'] == '1'){
	$TEMPMEMID = get_user_meta($userdata->ID,'new_memID',true);
	}
	// MEMBERSHIP DATA
	$membershipfields = get_option("membershipfields");
	$GLOBALS['current_membership']			= get_user_meta($userdata->ID,'wlt_membership',true);
    $GLOBALS['current_membership_expires'] 	= get_user_meta($userdata->ID,'wlt_membership_expires',true);
	$GLOBALS['customtext'] 					= stripslashes(get_user_meta($userdata->ID,'wlt_customtext',true));
	$GLOBALS['usercredit'] 					= get_user_meta($userdata->ID,'wlt_usercredit',true);
	$_POST['expired'] = $GLOBALS['current_membership_expires'];
	// CHECK IF MEMBERSHIP HAS EXPIRED
	$CORE->EXPIRED(0,'membership'); // uses global $post->ID
	// DISABLE REG FIELD IF USER HAS ALREADY UPGRADED/PAID	
	if($GLOBALS['current_membership'] != ""){ unset($TEMPMEMID); update_user_meta($userdata->ID,'new_memID',''); }
    
	// LOAD IN CHILD THEME TEMPATE FILES
	if(defined('CHILD_THEME_NAME') && file_exists(WP_CONTENT_DIR."/themes/".CHILD_THEME_NAME."/_account.php") ){
	
		include(WP_CONTENT_DIR."/themes/".CHILD_THEME_NAME."/_account.php");
		
	}elseif(file_exists(str_replace("functions/","",THEME_PATH)."/templates/".$GLOBALS['CORE_THEME']['template']."/_account.php") ){
		
		include(str_replace("functions/","",THEME_PATH)."/templates/".$GLOBALS['CORE_THEME']['template'].'/_account.php');
 		
	}else{
	
	
	// GET PROFILE BG STYLE
	$pbg = get_user_meta($userdata->ID,'pbg',true);
	
	// USER COUNTRY
	$selected_country = get_user_meta($userdata->ID,'country',true);
	
	// USER COUNTRY
	$logincount = get_user_meta($userdata->ID,'login_count',true);
	if($logincount == "" || $logincount == 0){ $logincount = 1; }
	// REGISTERED
	$date = $CORE->TimeDiff($userdata->user_registered);

	
/* =============================================================================
	-- LOAD IN FALLBACK TEMPLATE
	========================================================================== */	

		get_header($CORE->pageswitch()); 
		 	
		hook_account_before(); ?>
		
		<!-- START COMMENT BLOCK -->
		<div class="panel panel-default" id="MyAccountBlock" <?php if(isset($_GET['tab'])){ echo "style='display:none;'"; } ?>>
		 
		 <div class="panel-heading">
          
         <span><?php the_title(); ?></span>
           
        </div>
		 
		 <div class="panel-body clearfix"> 
         
           <!-- START MEMBERSHIP DISPLAY -->
            
            <?php if($GLOBALS['current_membership'] != "" && is_numeric($GLOBALS['current_membership']) && is_array($membershipfields) ){ ?>
         
            <div class="alert alert-success">
            <?php
			$date_expires = hook_date($GLOBALS['current_membership_expires']);
			if(strlen($date_expires) > 1){
			?>   
            <div class="pull-right"><?php echo $CORE->_e(array('single','20')); ?>: <?php echo $date_expires; ?></div>
            <?php } ?>
            
            <b><span class="label label-success"><?php echo $CORE->_e(array('account','43')); ?></span></b>  <b><?php echo $membershipfields[$GLOBALS['current_membership']]['name']; ?></b> 
             
            <?php /** SHOW RENEW BUTTON IF EXPIRING SOON **/ 
			
			
			if(strtotime(date('Y-m-d H:i:s')) > strtotime(date('Y-m-d H:i:s', strtotime($GLOBALS['current_membership_expires']. '-30 days'))) ){ ?>
			<div class="clearfix"></div>
			<a class="btn btn-primary btn-right" href="javascript:void(0);" style="margin-top:10px;margin-right:0px;" onclick="document.getElementById('membershipID').value='<?php echo $GLOBALS['current_membership']; ?>';document.MEMBERSHIPFORM.submit();"><?php echo $CORE->_e(array('account','67')); ?></a>
            <div class="clearfix"></div>
            <?php }  /*---------------------------------------*/ ?>
           
                	    
			</div>
            <?php } ?> 
            
            <?php if(is_numeric($GLOBALS['usercredit']) && $GLOBALS['usercredit'] < 0){ $current_price = str_replace("-","",$GLOBALS['usercredit']); ?>
            
         
             <div class="alert alert-danger">
               <b><span class="label label-danger"><?php echo $CORE->_e(array('account','77')); ?></span></b> 
               <span class="pull-right"><button style="margin-top:5px;" href="#myPaymentOptions" role="button" class="btn btn-danger" data-toggle="modal"><?php echo $CORE->_e(array('button','21')); ?></button></span>
               <br /><small><?php echo str_replace("%a",hook_price($current_price),$CORE->_e(array('account','78'))); ?></small>
               
               <div class="clearfix"></div>
			</div>           
            <?php 
			
			$STRING = ' 
				<!-- Modal -->
				<div id="myPaymentOptions" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				 <div class="modal-dialog"><div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
					<h4 id="myModalLabel">'.$CORE->_e(array('single','13')).' ('.hook_price($current_price).')</h4>
				  </div>
				  <div class="modal-body">'.$CORE->PAYMENTS(round($current_price,2), "PAY-".$userdata->ID."-".date("Ymd"), $post->post_title, $post->ID, $subscription = false).'</div>
				  <div class="modal-footer">
				  '.$CORE->admin_test_checkout().'
				  <button class="btn" data-dismiss="modal" aria-hidden="true">'.$CORE->_e(array('single','14')).'</button></div></div></div></div>
				<!-- End Modal -->';
				
				echo $STRING;
			
			} ?>        
         
		
           <!-- START CUSTOM TEXT DISPLAY -->            
            <?php if(strlen($GLOBALS['customtext']) > 1){ echo $GLOBALS['customtext']."<hr />"; } ?>		  
  
 <?php if($GLOBALS['CORE_THEME']['show_account_edit'] == '1'){ ?>
 
<div class="authorheader">

    <a href="1 <?php if($GLOBALS['CORE_THEME']['show_profilelinks'] == 1){ echo get_author_posts_url( $userdata->ID ); }else{ echo "#"; } ?>" class="frame"><?php echo get_avatar($userdata->ID , 60 ); ?></a>            
    <h1><?php echo get_the_author_meta( 'display_name', $userdata->ID); ?> </h1>
    <ul class="list-inline hidden-sm hidden-xs">    
    <li><span class="glyphicon glyphicon-info-sign"></span> <?php echo str_replace("%a", $date['date'], $CORE->_e(array('account','88')) ); ?></li>
    <li><span class="glyphicon glyphicon-ok-sign"></span> <?php echo number_format($logincount); ?> <?php echo $CORE->_e(array('account','87')); ?></li>
    
    <?php if($GLOBALS['CORE_THEME']['show_profilelinks'] == 1){ ?>
    <li><a href="2<?php echo get_author_posts_url( $userdata->ID ); ?>"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> <?php echo $CORE->_e(array('widgets','24')); ?></a></li>
 	<?php } ?>
    
    </ul>
    
<hr />

</div>

<?php } ?>

 
<?php 

$ex = ""; // extra

if($GLOBALS['CORE_THEME']['show_account_edit'] == '1'){
$AFIELDS[] = array(
	"l" => "#top",
	"oc" => "jQuery('#MyAccountBlock').hide();jQuery('#MyDetailsBlock').show();",
	"i" => "glyphicon glyphicon-user",
	"t" => $CORE->_e(array('account','2')),
	"d" => $CORE->_e(array('account','3')),
	"e" => $ex,
);
}


if($GLOBALS['CORE_THEME']['show_account_create'] == '1' && !defined('WLT_CART')  ){ 
	if(isset($membershipfields[$GLOBALS['current_membership']]['submissionamount']) && $membershipfields[$GLOBALS['current_membership']]['submissionamount']  == "0" ){ }else{
$AFIELDS[] = array(
	"l" => $GLOBALS['CORE_THEME']['links']['add'],
	"oc" => "",
	"i" => "glyphicon glyphicon-pencil",
	"t" => $CORE->_e(array('account','4')),
	"d" => $CORE->_e(array('account','5')),
	"e" => $ex,
);
	} 
}

if($GLOBALS['CORE_THEME']['show_account_viewing'] == '1' && !defined('WLT_CART') ){
$AFIELDS[] = array(
	"l" => get_home_url()."/?s=&uid=".$userdata->ID,
	"oc" => "",
	"i" => "glyphicon glyphicon-search",
	"t" => $CORE->_e(array('account','6')),
	"d" => $CORE->_e(array('account','7')),
	"e" => $ex,
);
}

if($GLOBALS['CORE_THEME']['message_system'] == '1' && !defined('WLT_CART') ){ 
$mc = $CORE->MESSAGECOUNT($userdata->user_login);
if($mc > 0){ $ex = '<span class="label label-danger">'.str_replace("%a",$mc,$CORE->_e(array('account','28'))).'</span>'; }

$AFIELDS[] = array(
	"l" => "#top",	
	"oc" => "jQuery('#MyAccountBlock').hide();jQuery('#MyMsgBlock').show();",
	"i" => "glyphicon glyphicon-envelope",
	"t" => $CORE->_e(array('account','26')),
	"d" => $CORE->_e(array('account','27')),
	"e" => $ex,
);
$ex = "";
} 

if(isset($GLOBALS['CORE_THEME']['feedback_enable']) && $GLOBALS['CORE_THEME']['feedback_enable'] == '1'){
$AFIELDS[] = array(
	"l" => "#top",	
	"oc" => "jQuery('#MyAccountBlock').hide();jQuery('#MyFeedback').show();",
	"i" => "glyphicon glyphicon-comment",
	"t" => $CORE->_e(array('account','81')),
	"d" => $CORE->_e(array('account','82')),
	"e" => $ex,
);
}

if($GLOBALS['CORE_THEME']['show_account_subscriptions'] == '1'){
$AFIELDS[] = array(
	"l" => "#top",	
	"oc" => "jQuery('#MyAccountBlock').hide();jQuery('#MySubscriptionBlock').show();",
	"i" => "glyphicon glyphicon-book",
	"t" => $CORE->_e(array('account','44')),
	"d" => $CORE->_e(array('account','45')),
	"e" => $ex,
);
}

 if($GLOBALS['CORE_THEME']['show_account_favs'] == '1'){ 
$AFIELDS[] = array(
	"l" => home_url()."/?s=&favs=1",	
	"oc" => "",
	"i" => "glyphicon glyphicon-star",
	"t" => $CORE->_e(array('account','46')),
	"d" => $CORE->_e(array('account','47')),
	"e" => $ex,
);
}

if(is_numeric($GLOBALS['usercredit']) && is_numeric($GLOBALS['usercredit']) && $GLOBALS['usercredit'] > 0){
$AFIELDS[] = array(
	"l" => "#top",
	"oc" => "jQuery('#MyAccountBlock').hide();jQuery('#MyWidthdrawlBlock').show();",
	"i" => "glyphicon glyphicon-usd",
	"t" => $CORE->_e(array('account','54')),
	"d" => $CORE->_e(array('account','55')),
	"e" => "<span class='label label-danger'>".$CORE->_e(array('order_status','title4'))." ".hook_price($GLOBALS['usercredit'])."</span>",
);
}

if( isset($GLOBALS['CORE_THEME']['sellspace_enable']) && $GLOBALS['CORE_THEME']['sellspace_enable'] == 1 ){
$AFIELDS[] = array(
	"l" => "#top",
	"oc" => "jQuery('#MyAccountBlock').hide();jQuery('#MyAdvertising').show();",
	"i" => "glyphicon glyphicon-list-alt",
	"t" => "Premium Advertising",
	"d" => "Here you can purchase additional advertising.",
	"e" => "",
);
}




// HOOK FOR PLUGINS
$AFIELDS = hook_account_pagelist($AFIELDS);

if(isset($GLOBALS['CORE_THEME']['account_layout']) && $GLOBALS['CORE_THEME']['account_layout'] == 1){ 
echo "<br />";
}

// DISPLAY LIST
foreach($AFIELDS as $key => $account){ 

if(isset($GLOBALS['CORE_THEME']['account_layout']) && $GLOBALS['CORE_THEME']['account_layout'] == 1){ ?>

<div class="clearfix"></div>
<a href="<?php echo $account['l']; ?>" onclick="<?php echo $account['oc']; ?>">
<div class="media">
  <div class="media-left">   
      <div class="media-object" style="  font-size: 60px;  margin-left: 20px;  margin-top: 10px; color:#ddd"><i class="<?php echo $account['i']; ?>"></i></div>  
  </div>
  <div class="media-body">
    <h4 class="media-heading"><?php echo $account['t']; ?> <?php if($account['e'] != ""){ ?><span><?php echo $account['e']; ?></span><?php } ?></h4>
    <?php echo $account['d']; ?>
  </div>
</div>
</a>
<?php }else{ ?>

<div class="col-sm-6 col-md-4 accountbit" id="accbit<?php echo $key; ?>">
   <a href="<?php echo $account['l']; ?>" onclick="<?php echo $account['oc']; ?>">
            <div class="account-block">
                <div class="icon">  <i class="<?php echo $account['i']; ?>"></i> </div>
                <div class="description">
                    <h3><?php echo $account['t']; ?></h3>
                   <?php if($account['e'] == ""){ ?> <hr /> <?php }else{ ?> <span><?php echo $account['e']; ?></span><?php } ?>
                    <p><?php echo $account['d']; ?></p>
                </div>
            </div>
	</a>
</div>

<?php } } ?>       
            
        
			
			<?php echo hook_account_menu(); ?>			
			<div class="clearfix"></div>
            
            <hr />
             
			 <a class="btn btn-default pull-right" href="<?php echo wp_logout_url(); ?>"><?php echo $CORE->_e(array('account','8')); ?></a>
       
		
			</div><!-- end block-content -->
		 
		</div>
		<!-- END COMMENT BLOCK --> 
        
        <?php do_action('hook_account_after'); ?>
        
         
        <!-- START ACCOUNT WIDTHDRAWAL  -->
       
        <?php if(isset($GLOBALS['CORE_THEME']['show_account_withdraw']) && $GLOBALS['CORE_THEME']['show_account_withdraw'] == 1){ ?>
		<div class="panel panel-default" id="MyWidthdrawlBlock" style="display:none;">
        
        <div class="panel-heading"><?php echo $CORE->_e(array('account','55')); ?></div>
		 
		<div class="panel-body"> 
        
        <p><?php echo $CORE->_e(array('account','56')); ?></p>
        <p><b><?php echo $CORE->_e(array('account','57')); ?> <?php echo hook_price($GLOBALS['usercredit']); ?></b></p>
        <?php if(strlen($GLOBALS['CORE_THEME']['auction_house_percentage']) > 0){ ?>
        <p><?php echo str_replace("%a",$GLOBALS['CORE_THEME']['auction_house_percentage'],$CORE->_e(array('account','58'))); ?></p>
        <?php } ?>
        <hr />
        
         
        <form method="post">
        <input type="hidden" name="action" value="withdraw" /> 
        
          <div class="form-group">
            <label class="control-label" for="inputEmail"><?php echo $CORE->_e(array('account','59')); ?></label>
            <div class="controls">
              
            <div class="input-group"> 
            <span class="input-group-addon"><?php echo $GLOBALS['CORE_THEME']['currency']['symbol']; ?></span>
			<input type="text" name="amount" class="form-control" style="width:100px;" /> 
			</div>
              
            </div>
          </div>
          <div class="form-group">
            <label class="control-label"><?php echo $CORE->_e(array('account','60')); ?></label>
            <div class="controls">
              <textarea name="message" style="height:150px;" class="form-control"></textarea>
            </div>
          </div>
          <div class="form-group">
            <div class="controls">
              <label class="checkbox">
                
              </label>
              <button type="submit" class="btn btn-primary"><?php echo $CORE->_e(array('account','61')); ?></button>
            </div>
          </div>
        </form>
        
      	<hr />
        		 
		<button class="btn btn-default pull-right" type="button" onclick="jQuery('#MyAccountBlock').show();jQuery('#MyWidthdrawlBlock').hide();"><?php echo $CORE->_e(array('button','7')); ?></button>
		
        <div class="clearfix"></div>
        
        </div>
        
        </div>
        <!-- END WIDTHDRAWAL  -->
        <?php } ?>
        
        
        <!-- START SUBSCRIPTIONS   -->
		<div class="panel panel-default" id="MySubscriptionBlock" style="display:none;">
        
        <div class="panel-heading"><?php echo $CORE->_e(array('account','44')); ?></div>
		 
		<div class="panel-body"> 
         
         <form method="post">
         <input type="hidden" name="action" value="subscrption" /> 
         <p><?php echo $CORE->_e(array('account','49')); ?></p>
         
         <select class="form-control" name="selsubs[]" multiple="multiple" style="height:200px;">
         <?php 
		 
		 $user_subscriptions = get_user_meta($userdata->ID,'email_subscriptions',true);
		 $user_subscriptions = str_replace("**","*",$user_subscriptions);
		 $us = explode("*",$user_subscriptions);
		 echo $CORE->CategoryList(array($us,false,0,THEME_TAXONOMY)); ?>
         </select>
		 <hr />
		 
		<button class="btn btn-primary" type="submit"><?php echo $CORE->_e(array('button','6')); ?></button>
		<button class="btn btn-default pull-right" type="button" onclick="jQuery('#MyAccountBlock').show();jQuery('#MySubscriptionBlock').hide();"><?php echo $CORE->_e(array('button','7')); ?></button>
		
         
         </form>
		  
        </div>
        
        
        
        </div>
        <!--- END SUBSCRIPTIONS --->
		
		
	    <?php if($GLOBALS['CORE_THEME']['show_account_edit'] == '1'){ ?>
		<!-- START ACCOUNT DETAILS BLOCK -->
		<div class="panel panel-default" id="MyDetailsBlock" style="display:none;">
		 
		 <div class="panel-heading"><?php echo $CORE->_e(array('account','2')); ?></div>
		 
		 <div class="panel-body"> 
	 
		<form action="" method="post" onsubmit="return ValidateCoreRegFields();" enctype="multipart/form-data" id="myaccountdataform" name="myaccountdataform">
		<input type="hidden" name="action" value="update" />
        
        <h4><?php echo $CORE->_e(array('account','2')); ?></h4>
        
        <hr />
		 
            <div class="col-md-6">
            	
                <?php if(!isset($GLOBALS['CORE_THEME']['show_account_names']) || (isset($GLOBALS['CORE_THEME']['show_account_names']) && $GLOBALS['CORE_THEME']['show_account_names'] == 1 )){ ?>
            	<div class="form-group">
                    <label class="control-label"><i class="icon-user"></i> <?php echo $CORE->_e(array('checkout','35')); ?></label>
                    <div class="controls">
                        <input type="text" name="fname" class="form-control" value="<?php echo $userdata->first_name ?>">                         
                    </div>
                </div>
                <?php } ?>
            
                <div class="form-group">
                    <label class="control-label"><i class="icon-envelope"></i> <?php echo $CORE->_e(array('account','9')); ?></label>
                    <div class="controls">
                        <input type="text" name="email" class="form-control" value="<?php echo $userdata->user_email; ?>" disabled="disabled">                         
                    </div>
                </div>		 
                
                <div class="form-group">
                    <label class="control-label"><i class="icon-globe"></i> <?php echo $CORE->_e(array('account','14')); ?></label>
                    <div class="controls">
                        <input type="text" name="url" class="form-control" value="<?php echo get_user_meta($userdata->ID,'url',true); ?>">                       
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label"><i class="icon-bell"></i> <?php echo $CORE->_e(array('account','41')); ?></label>
                    <div class="controls">
                        <input type="text" name="phone" class="form-control" value="<?php echo get_user_meta($userdata->ID,'phone',true); ?>">                        
                    </div>
                </div>          
                
				 <div class="form-group">
                    <label class="control-label"><?php echo $CORE->_e(array('checkout','39')); ?></label>
                    <div class="controls">
                        <select name="country" class="form-control" >
                        <?php 
		 
						foreach($GLOBALS['core_country_list'] as $key=>$value){
								if(isset($selected_country) && $selected_country == $key){ $sel ="selected=selected"; }else{ $sel =""; }
								echo "<option ".$sel." value='".$key."'>".$value."</option>";} ?>
                        </select>                       
                    </div>
                </div>
                        
            </div> 
            
            <div class="col-md-6">
            
            	<?php if(!isset($GLOBALS['CORE_THEME']['show_account_names']) || (isset($GLOBALS['CORE_THEME']['show_account_names'])  && $GLOBALS['CORE_THEME']['show_account_names'] == 1 )){ ?>
               <div class="form-group">
                    <label class="control-label"> <?php echo $CORE->_e(array('checkout','36')); ?></label>
                    <div class="controls">
                        <input type="text" name="lname" class="form-control"  value="<?php echo $userdata->last_name ?>" >                         
                    </div>
                </div>
                <?php } ?>               
            
                <div class="bs-callout bs-callout-warning">
                
                <div class="form-group">
                    <label class="control-label"><i class="icon-lock"></i> <?php echo $CORE->_e(array('account','10')); ?></label>
                    <div class="controls">
                        <input type="password" name="password" class="form-control">
                       
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label"><i class="icon-lock"></i> <?php echo $CORE->_e(array('account','11')); ?></label>
                    <div class="controls">
                        <input type="password" name="password_r" class="form-control">                        
                    </div>
                </div>
                
                </div>
               
                <?php echo 
				str_replace("form-row row customfield","form-group", 
				str_replace("control-label col-md-3","control-label", 
				str_replace("field_wrapper col-md-9","controls",  $CORE->CORE_FIELDS(true)))); ?>            
            
            </div>
         
          
             <div class="col-md-12">
                    <label class="control-label"><i class="icon-comment"></i> <?php echo $CORE->_e(array('account','13')); ?></label>
                   <textarea style="height:120px;" class="form-control" name="description"><?php echo stripslashes($userdata->description); ?></textarea>                     
             </div>
 
            
        <div class="clearfix"></div>
        <?php if(isset($GLOBALS['CORE_THEME']['show_account_social']) && $GLOBALS['CORE_THEME']['show_account_social'] == '1'){ ?>
        
        <hr />
        
        <h4><?php echo $CORE->_e(array('account','86')); ?></h4>
        
        <hr />
        <div class="col-md-3">
        <label class="control-label"><i class="icon-comment"></i> Facebook</label>
        <input type="text" name="facebook" class="form-control" value="<?php echo get_user_meta($userdata->ID,'facebook',true); ?>">                   
        </div>
        <div class="col-md-3">
        <label class="control-label"><i class="icon-comment"></i> Twitter</label>
        <input type="text" name="twitter" class="form-control" value="<?php echo get_user_meta($userdata->ID,'twitter',true); ?>">                   
        </div>
        <div class="col-md-3">
        <label class="control-label"><i class="icon-comment"></i> LinkedIn</label>
        <input type="text" name="linkedin" class="form-control" value="<?php echo get_user_meta($userdata->ID,'linkedin',true); ?>">                   
        </div>
        <div class="col-md-3">
        <label class="control-label"><i class="icon-comment"></i> Skype</label>
        <input type="text" name="skype" class="form-control" value="<?php echo get_user_meta($userdata->ID,'skype',true); ?>">                   
        </div>
        <?php } ?>
        
        
        <div class="clearfix"></div>
        
        <hr />
        
         <?php if($GLOBALS['CORE_THEME']['show_profilelinks'] == 1){ ?>
         
        <h4><?php echo $CORE->_e(array('account','85')); ?></h4>
        
        <hr />
        <div id="bgp">
        <?php $i=1; while($i < 9){ ?>
        <div class="col-md-3">
        	
            <div class="thumbnail" onclick="jQuery('#pbg').val('<?php echo $i; ?>'); ChangeB(); jQuery(this).css('border-color','rgb(165, 194, 165)').css('background','rgb(246, 255, 246)'); " style="cursor:pointer; <?php if($pbg == $i){ echo "border:1px solid red"; } ?>">
            
            	<img src="<?php echo FRAMREWORK_URI; ?>/img/profile/<?php echo $i; ?>.jpg" class="img-responsive" />
            
            </div>
                         
        </div>
        <?php $i++; } ?>
        </div>
        
        <input type="hidden" id="pbg" name="pbg" value="<?php  if($pbg == ""){ echo 1; }else{ echo $pbg; } ?>" />
        
        <script>		
		function ChangeB(){		
			jQuery( "#bgp .thumbnail" ).each(function() {
				jQuery(this).css('border-color','#ddd').css('background','#fff');
			});
			
		}
		</script>
        
        <?php } ?>
       
                
        <div class="clearfix"></div>
        
        <?php // USER PHOTO INTEGRATION
        if(function_exists('userphoto')){ ?>
                 
                <div class="col-md-12" style="margin-top:20px;">
                <style>#userphoto th { display:none; } .field-hint { font-size:11px; }</style>
                <?php 
                userphoto_display_selector_fieldset();
                userphoto_thumbnail($userdata->ID);	
				echo '<label><input type="checkbox" name="userphoto_delete" id="userphoto_delete" onclick="userphoto_onclick()"> Delete photo?</label> </div>';	
        
		 }elseif( isset($GLOBALS['CORE_THEME']['show_account_photo']) && $GLOBALS['CORE_THEME']['show_account_photo'] == '1'  ){
							
         ?> 
        
        <hr />
        
        <h4><?php echo $CORE->_e(array('account','79')); ?></h4>
        
        <hr />
        
        <div class="col-md-6">
        <div class="well text-center">       
        <?php echo get_avatar( $userdata->ID, 180 ); ?>
        </div>
        </div>
        
        <div class="col-md-6">
        
        <input type="file" name="wlt_userphoto" />
        </div>
        <div class="clearfix"></div>
        <?php } // end built in user photo ?>
        
        <?php echo hook_account_mydetails_after(); ?>	
		 
		<div class="clearfix"></div>
        <hr />
        
		<button class="btn btn-primary" type="submit"><?php echo $CORE->_e(array('button','6')); ?></button>
		<button class="btn btn-default pull-right" type="button" onclick="jQuery('#MyAccountBlock').show();jQuery('#MyDetailsBlock').hide();"><?php echo $CORE->_e(array('button','7')); ?></button>
		   
		</form> 
	 
		 
		 </div><!-- end block-content -->
		 
		</div>
		<!-- END ACCOUNT DETAILS BLOCK -->
        <?php } ?>
        
        
        
        
      <!-- START MESSAGE SYSTEM BLOCK -->
        <?php if(isset($GLOBALS['CORE_THEME']['message_system']) && $GLOBALS['CORE_THEME']['message_system'] != '0'){ ?>
		<div class="panel panel-default" id="MyMsgBlock" <?php if(isset($_GET['tab']) && $_GET['tab'] == "msg"){ }else{ ?>style="display:none;"<?php } ?>>
        		 
		<div class="panel-heading"><?php echo $CORE->_e(array('account','26')); ?></div>
		 
            <div class="panel-body"> 
             
              <div id="msgAjax"></div> 
              <form id="sendmsgform" name="sendmsgform" method="post" action="" class="alert" <?php if(isset($_GET['tab']) && $_GET['tab'] == "msg" && isset($_GET['show'])){ }else{ ?>style="display:none;"<?php } ?>>
              <input type="hidden" name="action" value="sendmsg" />
              
              <a href="#top" class="label label-warning" style="float:right;margin-top:30px;" onclick="jQuery('#sendmsgform').hide();"><?php echo $CORE->_e(array('account','48')); ?></a>
             
              <h3><?php echo $CORE->_e(array('account','29')); ?></h3>
             
              <p><?php echo $CORE->_e(array('account','30')); ?></p>
              
              <hr />
              
        	 <div class="input-group">
                  <span class="input-group-addon" id="ajaxMsgUser">@</span>
                  <input class="form-control" name="username" id="usernamefield" type="text" placeholder="<?php echo $CORE->_e(array('account','31','flag_noedit')); ?>"  value="<?php 
				  if(isset($_GET['u'])){				  
					  if(is_numeric($_GET['u'])){
						$muser = get_userdata($_GET['u'] );						 
						echo $muser->user_login;
					  }else{
						 echo strip_tags($_GET['u']);
					  }
				   } ?>">
              </div>
              <script type="application/javascript"> 
					jQuery('#usernamefield').change(function() { WLTValidateUsername('<?php echo str_replace("http://","",get_home_url()); ?>', this.value, 'ajaxMsgUser')  } );					
			  </script>
			  <hr />
              
              <div class="form-group">
			  <label><?php echo $CORE->_e(array('account','32')); ?></label>
              <input type="text" name="subject" id="subjectfield" value="<?php if(isset($_POST['subject'])){ echo strip_tags(strip_tags($_POST['subject'])); } ?>" class="form-control" >
              </div>
              
              <div class="form-group">
              <label><?php echo $CORE->_e(array('account','33')); ?></label>
              <textarea id="sendMsgContent" rows="3" class="form-control"  style="height:280px;" name="message"><?php if(isset($_POST['message'])){ echo strip_tags(strip_tags($_POST['message'])); } ?></textarea>               
              </div>
              
              <button class="btn btn-warning"><?php echo $CORE->_e(array('account','34')); ?></button>
              </form>
                
                
              <form method="post" action="" id="messageDel" name="messageDel">
              <input type="hidden" name="action" value="deletemsg" />
              <input type="hidden" name="messageID" id="messageID" value="" />
              </form>
              
              <form method="post" action="">
              <input type="hidden" name="action" value="deletemsgs" />
                <table class="table table-bordered table-striped">
         
                <thead>
                  <tr>
                  <th></th>
                    <th <?php if(!defined('IS_MOBILEVIEW')){ ?>style="width:80px;"<?php } ?>><?php echo $CORE->_e(array('account','35')); ?></th>
                    <th <?php if(!defined('IS_MOBILEVIEW')){ ?>style="min-width:380px;"<?php } ?>><?php echo $CORE->_e(array('account','36')); ?></th>
                    <th class="text-center"><?php echo $CORE->_e(array('account','37')); ?></th>
                  </tr>
                </thead>
                <tbody>
                <?php echo $CORE->MESSAGELIST($userdata->user_login); ?>
                  
                </tbody>
              </table>
              <div class="selectionbox">
            
              <button type="submit" class="pull-right"><?php echo $CORE->_e(array('account','84')); ?></button>
              <input type="checkbox" id="selecctall"/>  <?php echo $CORE->_e(array('account','83')); ?>
              
              </div>
              
              </form>
              
              <script>
			  jQuery(document).ready(function() {
					jQuery('#selecctall').click(function(event) {  //on click 
						if(this.checked) { // check select status
							jQuery('.checkbox1').each(function() { //loop through each checkbox
								this.checked = true;  //select all checkboxes with class "checkbox1"               
							});
						}else{
							jQuery('.checkbox1').each(function() { //loop through each checkbox
								this.checked = false; //deselect all checkboxes with class "checkbox1"                       
							});         
						}
					});
					
				});
			  </script>
              
              <hr />
              
              
            <a href="javascript:void(0);" class="btn btn-primary" onclick="jQuery('#sendmsgform').show();"><?php echo $CORE->_e(array('account','38')); ?></a>             
            	 
			<button class="btn btn-default pull-right" type="button" onclick="jQuery('#MyAccountBlock').show();jQuery('#MyMsgBlock').hide();"><?php echo $CORE->_e(array('button','7')); ?></button>
            
            </div> 
        
      </div>  
      <!-- end message system -->
      <?php } ?> 
      
 
        
<!-- START FEEDBACK SYSTEM BLOCK -->
<?php if(isset($GLOBALS['CORE_THEME']['feedback_enable']) && $GLOBALS['CORE_THEME']['feedback_enable'] == '1'){  ?>

	<?php if(isset($_GET['fpagen'])){ ?>
    <script>jQuery(document).ready(function() { jQuery('#MyAccountBlock').hide();jQuery('#MyFeedback').show(); });</script>
    <?php } ?>

    <div class="panel panel-default" id="MyFeedback" style="display:none;">
        
    <div class="panel-heading"><?php echo $CORE->_e(array('feedback','2')); ?></div>
		 
	<div class="panel-body" id="AuthorSingleFeedback">
 	
    <?php if(!isset($_GET['fdid'])){ ?>
    
	<?php WLT_FeedbackSystem($userdata->ID); ?>
    
    <?php } ?>
    
	<?php if(isset($_GET['fdid']) && is_numeric($_GET['fdid'])){ ?>
          
        <form id="addfeedbackform" name="addfeedbackform" method="post" action="" class="alert" onsubmit="return CHECKFEEDBACK();" style="padding:0px;">         
        <input type="hidden" name="action" value="addfeedback" />         
        <input type="hidden" name="pid" value="<?php echo $_GET['fdid']; ?>" />  
        <script>jQuery(document).ready(function() { jQuery('#MyAccountBlock').hide();jQuery('#MyFeedback').show();jQuery('#MyFeedbackList').hide(); });</script>
        
        <script language="javascript" type="text/javascript">

		function CHECKFEEDBACK()
		{ 
 		
			var f1 	= document.getElementById("fd1"); 
			var f2 	= document.getElementById("fd2");
			  			
			if(f1.value == '')
			{
				alert('<?php echo $CORE->_e(array('validate','0')); ?>');
				f1.focus();
				f1.style.border = 'thin solid red';
				return false;
			}
			if(f2.value == '')
			{
				alert('<?php echo $CORE->_e(array('validate','0')); ?>');
				f2.focus();
				f2.style.border = 'thin solid red';
				return false;
			} 		   		
			
			return true;
		}
 
    	</script>   
            
        <h3><?php echo $CORE->_e(array('feedback','1')); ?></h3> 
                
        <p><?php echo $CORE->_e(array('feedback','14')); ?></p>  
                    
        <hr /> 
        
        <?php if($CORE->FEEDBACKEXISTS($_GET['fdid'], $userdata->ID) == true){  ?>         
        
        <div class="text-center alert alert-info">
        
        <h4><?php echo $CORE->_e(array('feedback','15')); ?></h4>
        <p><?php echo $CORE->_e(array('feedback','16')); ?></p>
        
        </div>
        
        <?php }else{ ?>
            
              <div class="form-group">
			  <label><?php echo $CORE->_e(array('feedback','17')); ?></label>
              <input type="text" name="subject" id="fd1" value="<?php if(isset($_POST['subject'])){ echo strip_tags(strip_tags($_POST['subject'])); } ?>" class="form-control" >
              </div>
              
              <div class="form-group">
              <label><?php echo $CORE->_e(array('feedback','18')); ?></label>
              <textarea id="fd2" rows="3" class="form-control"  style="height:200px;" name="message"><?php if(isset($_POST['message'])){ echo strip_tags(strip_tags($_POST['message'])); } ?></textarea>               
              </div>
              
              <hr />
              
              
              <div class="col-md-4">
              <?php echo $CORE->_e(array('feedback','19')); ?>
              </div>
              
              <div class="col-md-6">
              
              <script type='text/javascript'>jQuery(document).ready(function(){ 
				jQuery('#wlt_feedbackstar_00').raty({				 
				path: '<?php echo FRAMREWORK_URI; ?>img/rating/',
				score: 5,
				size: 24, 
				 
				}); }); </script> 
		 		
				<div id="wlt_feedbackstar_00" class="wlt_starrating"></div>
              </div>
              
              <div class="clearfix"></div>
              
              <hr />  
                 
             <button class="btn btn-lg btn-warning" type="submit"><?php echo $CORE->_e(array('feedback','20')); ?></button>
         <?php } ?>
         
         </form> 
         <?php } ?> 
      
      
       <hr />
              
       <button class="btn  btn-default pull-right" type="button" onclick="jQuery('#MyAccountBlock').show();jQuery('#MyFeedback').hide();"><?php echo $CORE->_e(array('button','7')); ?></button>
	      
         </div>     
       </div>   
               
<?php } ?> 












<?php if( isset($GLOBALS['CORE_THEME']['sellspace_enable']) && $GLOBALS['CORE_THEME']['sellspace_enable'] == 1 ){ $sellspace = $CORE->SELLSPACE(2);  $mybanners = $CORE->SELLSPACE(3, $userdata->ID);  $sellspacedata = $GLOBALS['CORE_THEME']['sellspace']; ?>

    <div class="panel panel-default" id="MyAdvertising" style="display:none;">
        
    <div class="panel-heading">Premium Advertising</div>
		 
	<div class="panel-body" id="PremiumAdvertising">    
    
 	<ul class="nav nav-tabs" id="SellSpaceTabs">
    
	<div class="liner"></div>
					
    	<li class="active"><a href="#a1" data-toggle="tab">Advertising</a></li>

    	<li><a href="#a2" data-toggle="tab"> My Banners </a></li>
    
    	<li><a href="#a3" data-toggle="tab" class="graphtab"> My Orders </a></li>
  
    </ul></div>

	<div class="tab-content" style="padding:20px;">
    
    <div class="tab-pane fade" id="a3"> <div class="well">

    <?php
   
    // COUNT EXISTING ADVERTISERS
	$campaigns = new WP_Query('posts_per_page=200&post_type=wlt_campaign&post_author='.$userdata->ID);
 	
	if(empty($campaigns->posts)){
	?>
    <div class="text-center">no active orders found</div>
    <?php
	}
	if(!empty($campaigns->posts)){  
   ?>
   
   <h2 style="padding-top:0px;margin-top:0px;">My Orders</h2>
  
   <hr />
  
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script>

	jQuery(document).ready(function(){
	
	<?php if(isset($_GET['selladd'])){ ?>
	jQuery('#MyAccountBlock').hide();jQuery('#MyAdvertising').show();
	<?php } ?>
	 
	jQuery( ".graphtab" ).click(function() {
	 setTimeout(function(){ drawChart(); }, 500);  
	}); 
	
	});
	</script>
		   
      <?php foreach($campaigns->posts as $order){ 
	  
	  // BITS
	  $bits = explode("-",$order->post_title);
	  
	  // AVAILABLE BANNERS
	  $avibanner = $CORE->SELLSPACE(3, $userdata->ID, array($sellspace[$bits[1]]["sw"], $sellspace[$bits[1]]["sh"]));
	  
	  // TIME LEFT
	  $timeleft = get_post_meta($order->ID, 'listing_expiry_date',true);
	  
	  // GET ACTIVE BANNER ID
	  $activebannerID = get_post_meta($order->ID, 'bannerid', true);
	  
	  ?>
      
      <ul class="list-group" style="background:#fff; margin-bottom:20px;">
      
      <li class="list-group-item">
      
      <div class="col-md-6">      
      <div> <b><?php echo $sellspace[$bits[1]]["n"]; ?></b> </div>      
      <small>Size: <?php echo $sellspace[$bits[1]]["sw"]; ?> x <?php echo $sellspace[$bits[1]]["sh"]; ?></small>      
      </div>    
     
      <div class="col-md-3 text-center">
      <div>Impressions</div>
      <small><?php echo get_post_meta($order->ID, 'impressions', true); ?></small>      
      </div>    
      
      <div class="col-md-3 text-center">
      <div>Clicks</div>
      <small><?php echo get_post_meta($order->ID, 'clicks', true); ?></small>      
      </div>    
      
      <div class="clearfix"></div>
      
      </li> 
      
      <li class="list-group-item">
      
      <?php echo do_shortcode('[VISITORCHART postid="'.$order->ID.'" sellspace=1]'); ?>
      
      </li>
      
      
      
    <form action="" method="post" >
	<input type="hidden" name="action" value="sellspace_set" />
   	<input type="hidden" name="cid" value="<?php echo $order->ID; ?>" />
     
     <li class="list-group-item">
       
     <div class="pull-right">
     
	 <?php  if(is_array($avibanner) && !empty($avibanner) ){ ?>
    
    Select Banner:
          
      <select name="bannerid" class="selectpicker">
      <option></option>
      <?php 
	  foreach( $avibanner as $kh){ ?>
      <option value="<?php echo $kh['id']; ?>" <?php selected( $activebannerID, $kh['id'] ); ?>> <?php echo $kh['name']; ?> </option>
      <?php } ?>
      </select>  
        
      
      <?php }else{ ?>
      
      <div class="alert alert-info" style="margin:0px;">Please update a banner with the dimentions:  <?php echo $sellspace[$bits[1]]["sw"]; ?> x <?php echo $sellspace[$bits[1]]["sh"]; ?></div>
      
      <?php } ?>
      
      </div>
      
      <div class="clearfix"></div>
      
      </li>
      
      <li class="list-group-item">
      
      <div class="pull-right">
      Enter Banner Link: <input type="input"   name="camurl" value="<?php echo get_post_meta($order->ID, 'url', true); ?>"  />
      </div> 
      
      <div class="clearfix"></div>
      
      </li>
      <li class="list-group-item">
      <?php if($activebannerID != "" && $activebannerID != 0 ){?>
      <small> <?php if($timeleft != ""){ echo "Time Left: ". do_shortcode('[TIMELEFT key="listing_expiry_date" postid="'.$order->ID.'" layout="1"]'); } ?></small>
      <?php } ?>
      <button class="btn btn-success pull-right">save</button>   
      
      <div class="clearfix"></div>
      
      </li>
      
       </form>
       
      </ul>     
   	
	  <?php } ?>
   
   <?php } ?>
   
    </div></div>
   
    <div class="tab-pane fade" id="a2"><div class="well">
    
    <a href="javascript:void(0);" onclick="jQuery('#bupload').show();" class="pull-right btn btn-info">Upload Banner</a>
         
      <h2 style="padding-top:0px;margin-top:0px;">My Banners</h2>
      <hr />
        
     
	<form action="" method="post"  enctype="multipart/form-data" style="display:none" id="bupload">
	<input type="hidden" name="action" value="sellspace" />
     
   
    
    <p>Accepted formats are: jpg/jpeg/gif</p>
   
    <input type="file" name="wlt_banner[]" />
    <input type="file" name="wlt_banner[]" />
    <input type="file" name="wlt_banner[]" />
    <input type="file" name="wlt_banner[]" />
    <br />
    <a href="javascript:void(0);" onclick="jQuery('#bupload').hide();" class="pull-right btn btn-default">close</a>
    <button type="submit" class="btn btn-success">Save</button>   
   
    <hr /> 
    </form>
    
        
    <?php if(!empty($mybanners)){	?>
    
	  <ul class="list-group" style="background:#fff;">
      <?php foreach($mybanners as $k=> $ban){ ?>
      <li class="list-group-item">
      
          <div class="col-md-9">
          <p><?php echo $ban['w']; ?> X <?php echo $ban['h']; ?> </p>
          <a href="<?php echo $ban['img']; ?>" target="_blank" class="frame"><img src="<?php echo $ban['img']; ?>" class="img-responsive"></a>
          </div>
         
          
          <div class="col-md-3">
           <form action="" method="post" >
			<input type="hidden" name="action" value="sellspace_delete" />
   			<input type="hidden" name="delid" value="<?php echo $ban['id']; ?>" />
   
          <button class="btn btn-lg btn-success">Delete</button>
          </form>
          </div>
      
      <div class="clearfix"></div>
      
      </li>
      <?php } ?>
      </ul>
   
   <?php } ?>       
       
       
	
       
  </div></div>
        
        
   <div class="tab-pane fade in active" id="a1"> <div class="well"> 
     
  <h2 style="padding-top:0px;margin-top:0px;">Available Advertising Oppotunities</h2>
  <hr />
 
  <?php echo do_shortcode('[SELLSPACE]'); ?>
 	
    
    <div class="clearfix"></div>
    
    
    </div>
        
        </div>  
    
    
    
    <hr />
              
    <button class="btn  btn-default pull-right" type="button" onclick="jQuery('#MyAccountBlock').show();jQuery('#MyAdvertising').hide();"><?php echo $CORE->_e(array('button','7')); ?></button>
	
    <div class="clearfix"></div>
         
    </div>     
    
    </div> 
<?php } ?>






        
        
        
    
       
        
        
        <!-- START MY ORDERS BLOCK  -->
        <?php if(!defined('HIDE_MYACCOUNT_ORDERS')){ $order_string = $CORE->MYORDERS(); if(strlen($order_string) > 1){ ?> 
        
        <div class="panel panel-default" id="MyOrders">
        
         <div class="panel-heading"><?php echo $CORE->_e(array('order_status','title0')); ?></div>
		 
		 <div class="panel-body">
         <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th><?php echo $CORE->_e(array('order_status','title1')); ?></th>
                  <th><?php echo $CORE->_e(array('order_status','title2')); ?></th>
                  <th><?php echo $CORE->_e(array('order_status','title3')); ?></th>
                  <th><?php echo $CORE->_e(array('order_status','title4')); ?></th>
                  <th> </th>
                </tr>
              </thead>
              <tbody>
              <?php echo $order_string; ?>              
              </tbody>
            </table>
         
         <?php do_action('hook_account_orders_after'); ?>
         
         </div>        
        
        </div>        
        <!-- END MY ORDERS BLOCK -->
		<?php } } ?> 
        
        
        
        
          <?php if($GLOBALS['CORE_THEME']['show_account_membership'] == '1' && !defined('WLT_CART') ){  ?>
        <!-- START MEMBERSHIP PACKAGES   -->
        <?php if(is_array($membershipfields) && count($membershipfields) > 0 && $CORE->_PACKNOTHIDDEN($membershipfields) > 0 ){ ?>
		<div class="panel panel-default" id="MyMembershipPackages">
        
        <div class="panel-heading"><?php echo $CORE->_e(array('add','24')); ?></div>
		 
            <div class="panel-body">
            
            <p><?php echo $CORE->_e(array('add','25')); ?> </p>
            
            <ul class="packagelistitems list-group"><?php echo $CORE->packageblock(2,'membershipfields',10); ?></ul>  
                  
            </div>
            
        </div>       
        <?php } ?>
        <?php } ?>          
        
        
        
        <!-- memberships form -->
        <form method="post" name="MEMBERSHIPFORM" action="<?php echo $GLOBALS['CORE_THEME']['links']['add']; ?>" id="MEMBERSHIPFORM" style="margin:0px;padding:0px;">
        <input type="hidden" name="membershipID" id="membershipID" value="-1" />
        </form>
        
        <?php	
			
		// AUTO SUBMIT MEMBERSHIP FORM FOR MEMBERSHIPS ON REGISTRATION PAGE	 
		if(isset($TEMPMEMID) && is_numeric($TEMPMEMID) && isset($membershipfields[$TEMPMEMID]['price']) && $membershipfields[$TEMPMEMID]['price'] > 0){
		?>
        <form method="post" name="MEMBERSHIPFORM1" action="<?php echo $GLOBALS['CORE_THEME']['links']['add']; ?>" id="MEMBERSHIPFORM1" style="margin:0px;padding:0px;">
        <input type="hidden" name="membershipID" id="membershipID" value="<?php echo $TEMPMEMID; ?>">
        </form>
        <script>jQuery(document).ready(function(){ jQuery('#MEMBERSHIPFORM1').submit(); });</script>
        <?php } ?>
        
        <?php if(isset($_GET['notify'])){ ?>
        
        <script>jQuery(document).ready(function(){ jQuery('#MyAccountBlock').hide();jQuery('#MyMsgBlock').show(); });</script>
        
        <?php } ?>
		
		
		<?php get_footer($CORE->pageswitch()); 

 
	
	}
	
	// THAT'S ALL FOLKS! 
 
/* =============================================================================
   -- END FILE
   ========================================================================== */
?>
