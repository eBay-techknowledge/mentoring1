<?php

function WLT_DEMOOPTIONS(){ 

 
if(!isset($_SESSION['skin']) ){

if(!isset($_POST['homelayoutid'])){ $_POST['homelayoutid'] = ""; }

$selected_template = $core_admin_values['template']; 
		$HandlePath = TEMPLATEPATH;
	    $count=1; $TemplateString = "";
		if($handle1 = opendir($HandlePath)) {      
			while(false !== ($file = readdir($handle1))){			
				if(strpos($file,"home-") !== false ){	
			 		
					$file_name = str_replace(".php","",str_replace("home-","",$file));
					if($file == "home-mobile.php"){ continue; }
					$TemplateString .= "<option "; 
					if ($core_admin_values['homepage_layout'] == $file_name) { $TemplateString .= ' selected="selected"'; }   
					$TemplateString .= 'value="'.$file_name.'" '.selected( $_POST['homelayoutid'], $file_name, false ).'>'; 					
					//$TemplateString .= str_replace("home-","Custom ",str_replace("home","", str_replace("layout","layout ", str_replace("-"," ", str_replace(".php","",$file))))); 
					$TemplateString .= "Extra Layout ".$count;										
					$TemplateString.= "</option>";			
   					$count++;
				}
			}
			 
		}

?>

     <!-- Start Switcher -->
		<div class="demo_changer">
			<div class="demo-icon">
            	<i class="fa fa-cog fa-spin fa-2x"></i>
            </div><!-- end opener icon -->
            <div class="form_holder">
            	<div class="row">
                	<h2 class="text-center">
                        PREMIUMPRESS DEMO
                    </h2>
                    <p class="text-center">
                    	Here you can preview some of the design options available.
                    </p>
                	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                		<div class="predefined_styles"> 
							<h4>Template Width</h4>
                     
							<a href="javascript:void(0);" data-rel="1" class="widthswitch"><img class="img-thumbnail" src="<?php echo FRAMREWORK_URI; ?>/img/demo/boxed.png" alt=""></a>	
							<a href="javascript:void(0);" data-rel="2" class="widthswitch"><img class="img-thumbnail" src="<?php echo FRAMREWORK_URI; ?>/img/demo/wide.png" alt=""></a>	
				 
                           
                           <hr>
                            <h4>Color Skins</h4>
                    		<!-- MODULE #3 -->
                            <a href="javascript:void(0);" data-rel="" class="styleswitch"><img src="<?php echo FRAMREWORK_URI; ?>/img/demo/white.png" alt=""></a>	
                   
                            <a href="javascript:void(0);" data-rel="purple" class="styleswitch"><img src="<?php echo FRAMREWORK_URI; ?>/img/demo/purple.png" alt=""></a>		
                            <a href="javascript:void(0);" data-rel="blue" class="styleswitch"><img src="<?php echo FRAMREWORK_URI; ?>/img/demo/blue.png" alt=""></a>		
                            <a href="javascript:void(0);" data-rel="green" class="styleswitch"><img src="<?php echo FRAMREWORK_URI; ?>/img/demo/green.png" alt=""></a>		
                            <a href="javascript:void(0);" data-rel="red" class="styleswitch"><img src="<?php echo FRAMREWORK_URI; ?>/img/demo/red.png" alt=""></a>		
                            <a href="javascript:void(0);" data-rel="yellow" class="styleswitch"><img src="<?php echo FRAMREWORK_URI; ?>/img/demo/yellow.png" alt=""></a>		
                            <a href="javascript:void(0);" data-rel="pink" class="styleswitch"><img src="<?php echo FRAMREWORK_URI; ?>/img/demo/pink.png" alt=""></a>		
                            <a href="javascript:void(0);" data-rel="grey" class="styleswitch"><img src="<?php echo FRAMREWORK_URI; ?>/img/demo/grey.png" alt=""></a>
                    		<!-- END MODULE #3 -->
                            
                  <div class="clearfix"></div>
                  
                            <small>images are for demo purposes </small>
                            
                            
                            
                            
                            
                        </div><!-- end predefined_styles -->
                	</div><!-- end col -->
                	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                		<div class="predefined_styles"> 
                        
                        
                        
                            
                            <h4>Homepage Layout</h4>
                               <select id="headers" class="show-menu-arrow form-control input-sm"  onChange="ChangeHome(this.value)">
                                        
                                        <?php echo $TemplateString; ?>  
                                </select>  
                                    
                         <hr>
                        <h4>Change Logo </h4>
                        
                        
                        <input type="text" onChange="ChangeLogoTxt(this.value, 1)" name="txt1" placeholder="Website Logo" id="txt1" />
                        <input type="text" onChange="ChangeLogoTxt(this.value, 2)" name="txt2" placeholder="my solgan here" style="margin-top:15px;" id="txt2" />
                        
                         <select class="show-menu-arrow form-control input-sm"  onChange="ChangeLogo(this.value)" id="changelogo" style="margin-top:10px;">
                                    
                                        <?php $i = 1; while($i < 10){ ?>
                                        <option value="<?php echo get_template_directory_uri(); ?>/framework/img/logo/<?php echo $i; ?>.png">Logo <?php echo $i; ?></option>
                                        <?php $i++; } ?>
                                         
                        </select>   
                        <small>more logos in full version!</small>
            
                    
                       
                                        
                                                  
                          
                    	 <form id="changehome" name="changehome" action="<?php echo home_url(); ?>/" method="post">
                         <input type="hidden" name="homelayoutid" value="<?php echo $_POST['homelayoutid']; ?>" id="homelayoutid" />
                         </form>
                        </div><!-- end predefined_styles -->
                	</div><!-- end col -->
                    <div class="clearfix"></div>
                    <hr>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                    
                    
                   <a class="btn btn-success btn-lg" style="color:#fff; margin-right:20px;" href="<?php echo home_url(); ?>/wp-login.php" ><i class="fa fa-users"></i> User Demo </a>
                   <a class="btn btn-success btn-lg" style="color:#fff;" href="<?php echo home_url(); ?>/wp-login.php" ><i class="fa fa-user"></i> Admin Demo</a>
                   
                   <hr />
                   
                   <div class="text-center"><a class="btn btn-danger btn-lg" style="color:#fff;" href="http://www.premiumpress.com/premium-wordpress-themes/" title="" target="_blank">Buy Now</a></div>
                    
                    
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end form_holder -->
        </div><!-- end demo_changer -->
    <!-- End Switcher -->

<?php } ?>
     
<script>
 
	
	(function($)
	{
		jQuery(document).ready(function() { 
		
			jQuery('.styleswitch').click(function()
			{
				switchStylestyle(this.getAttribute("data-rel"));
				return false;
			});
			var c = readCookie('style');
			if (c){ switchStylestyle(c); }else{ ChangeDemoImages(''); }
			
			 
			var t1 = readCookie('txt1');
			if (t1) ChangeLogoTxt(t1, 1);
			
			var t2 = readCookie('txt2');
			if (t2) ChangeLogoTxt(t2, 2);
			 
			var li = readCookie('logoicon');
			if (li) ChangeLogo(li);
			
			var donedemo = readCookie('donedemo');
			
			if(donedemo != "yes"){
			
				jQuery(function () {
					var intro = jQuery.hemiIntro({
						steps: [
							{
								selector: ".demo-icon",
								placement: "bottom",
								content: "<h4>More Demo Options!! </h4> <p>You can view more options by clicking here.</p> <p>Don't miss the admin area demo!</p>",
							},							 
						],
						onComplete: function (plugin) {
						createCookie('donedemo', "yes", 1);
						}
					}
					
					
					);
					intro.start();
				});
			
		}
			
			
		});
	
		function switchStylestyle(styleName)
		{
			jQuery('link[rel*=style][title]').each(function(i) 
			{
				this.disabled = true;
				if (this.getAttribute('title') == styleName) this.disabled = false;
			});
			createCookie('style', styleName, 365);
			
			ChangeDemoImages(styleName);
		}
	})(jQuery);
	
	
	function ChangeDemoImages(styleName){ 
	
	<?php if($GLOBALS['CORE_THEME']['template'] == "template_joboard_theme"  ){ ?> 
	
	var obj = {
	 
		  ".cimg0": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c0.jpg",
		  ".cimg1": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c1.jpg",
		  ".cimg2": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c2.jpg",
		  ".cimg3": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c3.jpg",
		  ".cimg4": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c4.jpg",
		  ".cimg5": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c5.jpg",
		  ".cimg6": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c6.jpg",
		  ".cimg7": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c7.jpg",
		  ".cimg8": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c8.jpg",
		  ".cimg9": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c9.jpg",
		  ".cimg10": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c10.jpg",
 
		  ".cimg11": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c11.jpg",
		  ".cimg12": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c12.jpg",
		  ".cimg13": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c13.jpg",
		  ".cimg14": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c14.jpg",
		  ".cimg15": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c15.jpg",
		  ".cimg16": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c16.jpg",
 		  
		 };
		 
		 jQuery.each( obj, function( key, value ) {
 
			if(key.substr(0, 4) == ".cim"){
				jQuery(key).css('background-image', 'url("' + value + '")');
			}else{
				jQuery(key).attr('src', value);
			}
		  
		});
		 
	<?php } ?>
	
	<?php if($GLOBALS['CORE_THEME']['template'] == "template_comparison_theme"   ){ ?> 
	
	var obj = {
	 
		  ".cimg0": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c0.jpg",
		  ".cimg1": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c1.jpg",
		  ".cimg2": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c2.jpg",
		  ".cimg3": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c3.jpg",
		  ".cimg4": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c4.jpg",
		  ".cimg5": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c5.jpg",
		  ".cimg6": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c6.jpg",
		  ".cimg7": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c7.jpg",
		  ".cimg8": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c8.jpg",
		  ".cimg9": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c9.jpg",
		  ".cimg10": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c10.jpg",
		   
		  
		  ".pimg1": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/1.jpg",
		  ".pimg2": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/2.jpg",
		  ".pimg3": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/3.jpg",
		  ".pimg4": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/4.jpg",
		  ".pimg5": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/5.jpg",
		  ".pimg6": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/6.jpg",
		  ".pimg7": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/7.jpg",
		  ".pimg8": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/8.jpg",
		  ".pimg9": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/9.jpg",
		  ".pimg10": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/10.jpg",
		   ".pimg11": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/11.jpg",
		   ".pimg12": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/12.jpg",
		   ".pimg13": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/13.jpg",
		   ".pimg14": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/14.jpg",
		   ".pimg15": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/15.jpg",
		  
		  
		 };
		 
		 jQuery.each( obj, function( key, value ) {
 
			if(key.substr(0, 4) == ".cim"){
				jQuery(key).css('background-image', 'url("' + value + '")');
			}else{
				jQuery(key).attr('src', value);
			}
		  
		});
		 
	<?php } ?>
	
	<?php if( $GLOBALS['CORE_THEME']['template'] == "template_microjob_theme" || ( isset($_SESSION['default_skin']) && $_SESSION['default_skin'] == "template_microjob_theme" )  || $GLOBALS['CORE_THEME']['template'] == "template_realestate_theme"  ){ ?> 
	
		var obj = {
		  ".box0": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/b1.jpg",
		  ".box1": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/b2.jpg",
		  ".box2": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/b3.jpg",
		  ".box3": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/b4.jpg",
		  
 
		  ".cimg1": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c1.jpg",
		  ".cimg2": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c2.jpg",
		  ".cimg3": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c3.jpg",
		  ".cimg4": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c4.jpg",
		  ".cimg5": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c5.jpg",
		 	  
		  
		  ".pimg1": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/1.jpg",
		  ".pimg2": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/2.jpg",
		  ".pimg3": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/3.jpg",
		  ".pimg4": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/4.jpg",
		  ".pimg5": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/5.jpg",
		  ".pimg6": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/6.jpg",
		  ".pimg7": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/7.jpg",
		  ".pimg8": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/8.jpg",
		  ".pimg9": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/9.jpg",
		  ".pimg10": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/10.jpg",
		   ".pimg11": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/11.jpg",
		   ".pimg12": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/12.jpg",
		   ".pimg13": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/13.jpg",
		   ".pimg14": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/14.jpg",
		   ".pimg15": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/15.jpg",
		  
		  
		  
		   
		};
		jQuery.each( obj, function( key, value ) {
 
			if(  key.substr(0, 4) == ".box" || key.substr(0, 4) == ".cim"){
				jQuery(key).css('background-image', 'url("' + value + '")');
			}else{
				jQuery(key).attr('src', value);
			}
		  
		}); 
	
	 <?php }elseif($GLOBALS['CORE_THEME']['template'] == "template_shop_theme" || $GLOBALS['CORE_THEME']['template'] == "template_classifieds_theme"  || $GLOBALS['CORE_THEME']['template'] == "template_auction_theme" || $GLOBALS['CORE_THEME']['template'] == "template_directory_theme" ){ ?> 
		var obj = {
		
		 ".box1": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c1.jpg",
		  ".box2": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c2.jpg",
		  ".box3": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c3.jpg",
		  ".box4": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c4.jpg",		  
		  ".box5": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c5.jpg",
		  ".box6": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c6.jpg",
		  ".box7": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c7.jpg",
		  ".box8": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c8.jpg",
		  
		
		  ".cimg0": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c1.jpg",
		  ".cimg1": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c2.jpg",
		  ".cimg2": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c3.jpg",
		  ".cimg3": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c4.jpg",
		  ".cimg4": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c5.jpg",
		  ".cimg5": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c6.jpg",
		  ".cimg6": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c7.jpg",
		  ".cimg7": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c8.jpg",
		  ".cimg8": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c9.jpg",
		  ".cimg9": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c10.jpg",
		  ".cimg10": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c11.jpg",
		  ".cimg11": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c12.jpg",
		  ".cimg12": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c13.jpg",		  
		  ".cimg13": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c14.jpg",
		  ".cimg14": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c15.jpg",
		  ".cimg15": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/c16.jpg",		  
 	  
		  
		  ".pimg1": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/1.jpg",
		  ".pimg2": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/2.jpg",
		  ".pimg3": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/3.jpg",
		  ".pimg4": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/4.jpg",
		  ".pimg5": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/5.jpg",
		  ".pimg6": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/6.jpg",
		  ".pimg7": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/7.jpg",
		  ".pimg8": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/8.jpg",
		  ".pimg9": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/9.jpg",
		  ".pimg10": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/10.jpg",
		  ".pimg11": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/11.jpg",
		  ".pimg12": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/12.jpg",
		  ".pimg13": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/13.jpg",
		  ".pimg14": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/14.jpg",
		  ".pimg15": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/15.jpg",
		  ".pimg16": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/16.jpg",
		   
		};
	 
		jQuery.each( obj, function( key, value ) {
 
			if(jQuery('#homelayoutid').val() == "layout-directory3" && key.substr(0, 4) == ".cim"){
				jQuery(key).css('background-image', 'url("' + value + '")');
			
			}else if( key.substr(0, 4) == ".box"){
				jQuery(key).css('background-image', 'url("' + value + '")');
		 
			}else{
				jQuery(key).attr('src', value);
			}
		  
		});
	
	<?php } ?>
	
	
	
		<?php if($GLOBALS['CORE_THEME']['template'] == "template_dating_theme" || ( isset($_SESSION['default_skin']) && $_SESSION['default_skin'] == "template_dating_theme" )   ){ ?> 
	
	var obj = {
	 
		  ".r1": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/r1.jpg",
		  ".r2": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/r2.jpg",
		  ".r3": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/r3.jpg",
		   
		  ".pimg1": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/1.jpg",
		  ".pimg2": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/2.jpg",
		  ".pimg3": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/3.jpg",
		  ".pimg4": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/4.jpg",
		  ".pimg5": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/5.jpg",
		  ".pimg6": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/6.jpg",
		  ".pimg7": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/7.jpg",
		  ".pimg8": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/8.jpg",
		  ".pimg9": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/9.jpg",
		  ".pimg10": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/10.jpg",
		   ".pimg11": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/11.jpg",
		   ".pimg12": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/12.jpg",
		   ".pimg13": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/13.jpg",
		   ".pimg14": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/14.jpg",
		   ".pimg15": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/15.jpg",
		  ".pimg16": "<?php echo home_url(); ?>/democontent/<?php echo get_option('wlt_base_theme'); ?>/16.jpg",
		  
		  
		 };
		 
		 jQuery.each( obj, function( key, value ) {
 
			if(key.substr(0, 4) == ".cim"){
				jQuery(key).css('background-image', 'url("' + value + '")');
			}else{
				jQuery(key).attr('src', value);
			}
		  
		});
		 
	<?php } ?>
	
	}
	
	
	function createCookie(name,value,days)
	{
		if (days)
		{
			var date = new Date();
			date.setTime(date.getTime()+(days*24*60*60*1000));
			var expires = "; expires="+date.toGMTString();
		}
		else var expires = "";
		document.cookie = name+"="+value+expires+"; path=/";
	}
	function readCookie(name)
	{
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for(var i=0;i < ca.length;i++)
		{
			var c = ca[i];
			while (c.charAt(0)==' ') c = c.substring(1,c.length);
			if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
		}
		return null;
	}
	function eraseCookie(name)
	{
		createCookie(name,"",-1);
	}

	// DEMO Swticher Base
	jQuery('.demo_changer .demo-icon').click(function(){
		if(jQuery('.demo_changer').hasClass("active")){
			jQuery('.demo_changer').animate({"left":"-400px"},function(){
				jQuery('.demo_changer').toggleClass("active");
			});						
		}else{
			jQuery('.demo_changer').animate({"left":"0px"},function(){
				jQuery('.demo_changer').toggleClass("active");
			});			
		} 
	});
 

	// Selector (MODULE #2)
	jQuery('.demo_changer .PatternChanger a').click(function(){
		var bgBgCol = jQuery(this).attr('href');
		jQuery('.demo_changer .PatternChanger a').removeClass('current');
		jQuery('body').css({backgroundColor:'#ffffff'});
		jQuery(this).addClass('current');
		jQuery('body').css({backgroundImage:'url(' + bgBgCol + ')'});
		if (jQuery(this).hasClass('bg_t')){
			jQuery('body').css({backgroundRepeat:'repeat', backgroundPosition:'50% 0', backgroundAttachment:'scroll'});
		} else {
			jQuery('body').css({backgroundRepeat:'repeat', backgroundPosition:'50% 0', backgroundAttachment:'scroll'});
		}
		return false;
	});
	
	
	jQuery('.widthswitch').click(function(){
	var w = jQuery(this).attr('data-rel');
 
	if(w == 1){ // boxed layout
		jQuery(this).addClass('current');
		jQuery('.page-wrapper').addClass('container');
		jQuery('#core_breadcrumbs .container').addClass('container-fluid').removeClass('container');
		jQuery('.core_section_top_container').addClass('container-fluid').removeClass('container');
		jQuery('#footer .container').addClass('container-fluid').removeClass('container');
		jQuery('#core_header').removeClass('container').addClass('container-fluid');
		
	} else if(w == 2){ // wide layout
		jQuery(this).addClass('current');
		jQuery('.page-wrapper').removeClass('container');	
		jQuery('.core_section_top_container .container-fluid').addClass('container');
		jQuery('#core_header').addClass('container');
		jQuery('#core_header_navigation .container-fluid').addClass('container');
		jQuery('#core_menu_wrapper .container-fluid').addClass('container');
		jQuery('#core_padding .container-fluid').addClass('container');
		jQuery('#footer .container-fluid').addClass('container');
		jQuery('#core_breadcrumbs .container-fluid').addClass('container').removeClass('container-fluid');
					
	} else if(w == 3){ // boxed content
		jQuery(this).addClass('current');
		jQuery('body').removeClass('container-fluid').addClass('container').removeClass('cold');
		jQuery('.container').addClass('cold').removeClass('container').removeClass('container-fluid');		
		jQuery('#core_header .container').removeClass('container').addClass('container-fluid');
		
		
	} else if(w == 4){ // wide content
		jQuery(this).addClass('current');
		jQuery('.cold').removeClass('container-fluid').addClass('container').removeClass('cold');
	}
	
	return false;
	});
	
	function ChangeLogo(logoid) { 	
		jQuery('#logoicon').attr("src", logoid);
		
		createCookie('logoicon', logoid, 365);
	
	}
	
	function ChangeHeader(hid) {  
		jQuery('.overlay').css("background-image", "url(" + hid + ")");  
		
		createCookie('hid', hid, 365);
	
	}
	
	function ChangeLogoTxt(txt, type){
		
		if(type == 1){
			jQuery('#core_logo .main').html(txt);
		} else{ 
			jQuery('#core_logo .submain').html(txt);
		}
		jQuery('#txt' + type).val(txt);
		createCookie('txt' + type, txt, 365);
	}
	
	function ChangeHome(id){
		 
		jQuery('#homelayoutid').val(id);
		document.changehome.submit();
		
	}
 
!function(o){var n="hemiIntro";o[n]=function(t){var e=this,s={debug:!1,steps:[],startFromStep:0,backdrop:{element:o("<div>"),"class":"hemi-intro-backdrop"},popover:{template:'<div class="popover hemi-intro-popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'},buttons:{holder:{element:o("<div>"),"class":"hemi-intro-buttons-holder"},next:{element:o("<button>Next</button>"),"class":"btn btn-primary"},finish:{element:o("<button>Finish</button>"),"class":"btn btn-primary"}},welcomeDialog:{show:!1,selector:null},scroll:{anmationSpeed:500},currentStep:{selectedClass:"hemi-intro-selected"},init:function(){},onLoad:function(){},onStart:function(){},onBeforeChangeStep:function(){},onAfterChangeStep:function(){},onShowModalDialog:function(){},onHideModalDialog:function(){},onComplete:function(){}};e.options=o.extend(!0,s,t),e.options.init(e);var i=e.options.startFromStep,p=null,l=null;e.backdrop=e.options.backdrop.element.clone().addClass(e.options.backdrop["class"]),e.options.onLoad(e),e.start=function(){if(e.options.onStart(e),e.options.welcomeDialog.show){var t=o(e.options.welcomeDialog.selector);t.length>0?(t.on("show.bs.modal",function(){e.options.onShowModalDialog(e,t)}),t.on("hidden.bs.modal",function(){e.options.onHideModalDialog(e,t),e.backdrop.appendTo("body"),a(i)}),t.modal("show")):(u(n+":","Modal '"+e.options.welcomeDialog.selector+"' not found"),e.backdrop.appendTo("body"),a(i))}else e.backdrop.appendTo("body"),a(i)},e.next=function(){e.options.steps[i+1]?a(i+1):e.finish()},e.prev=function(){a(0>i-1?i:i-1)},e.finish=function(){c()},e.goToStep=function(o){a(o)};var a=function(t){if(e.options.steps[t]){var s=e.options.steps[t];o(s.selector).length>0?(r(),p=o(s.selector),i=t,l=s,e.options.onBeforeChangeStep(e,s),p.addClass(e.options.currentStep.selectedClass),d(function(){var n,i=o(e.options.popover.template),l="id"+Math.random().toString(30).slice(2),a=e.options.buttons.holder.element.clone().addClass(e.options.buttons.holder["class"]);e.options.steps[t+1]?(n=e.options.buttons.next.element.clone(),n.addClass(e.options.buttons.next["class"]).addClass(l),a.append(n)):(n=e.options.buttons.finish.element.clone(),n.addClass(e.options.buttons.finish["class"]).addClass(l),a.append(n));var r=o("<div>").append(s.content);s.showButtons!==!1&&r.append(a.get(0).outerHTML),p.popover({content:r.get(0).outerHTML,html:!0,trigger:"manual",placement:s.placement,template:i.get(0).outerHTML}).popover("show"),p.on("shown.bs.popover",function(){e.options.onAfterChangeStep(e,s),o("."+l).on("click",function(){e.options.steps[t+1]?e.next():e.finish()})})})):u(n+":","Step element not found: ",s)}else u(n+":","Step not found")},r=function(){null!==p&&(p.removeClass(e.options.currentStep.selectedClass),p.popover("destroy"))},c=function(){r(),e.backdrop.remove(),e.options.onComplete(e)},d=function(n){if("function"!=typeof n&&(n=o.noop()),l.scrollToElement!==!1){var t=20;l.offsetTop&&(t=l.offsetTop);var s=!1;o("html, body").animate({scrollTop:p.offset().top-t},e.options.scroll.anmationSpeed,function(){s===!1&&(n(),s=!0)})}else n()},u=function(){e.options.debug&&console.log.apply(console,arguments)};return e}}(jQuery);
</script>

<?php } 


function WLT_FeedbackSystem($authorID){  global $CORE, $wpdb, $userdata;

if(isset($GLOBALS['CORE_THEME']['feedback_enable']) && $GLOBALS['CORE_THEME']['feedback_enable'] == '1'){

// GET USER FEEDBACK
$query = new WP_Query('posts_per_page=200&post_type=wlt_feedback&meta_key=uid&meta_value='.$authorID); 
$posts = $query->posts;
 
// GET MY FEEDBACK
$query1 = new WP_Query('posts_per_page=200&post_type=wlt_feedback&meta_key=auid&meta_value='.$authorID); 
$posts1 = $query1->posts;
?>    

<ul class="nav nav-tabs feedbacktabs" role="tablist">
    
	<li class="active"><a href="#fb0" role="tab" data-toggle="tab"><?php echo $CORE->_e(array('feedback','0')); ?> (<?php echo $query->found_posts; ?>)</a></li>

	<li><a href="#fb1" role="tab" data-toggle="tab"><?php echo $CORE->_e(array('feedback','24')); ?> (<?php echo $query1->found_posts; ?>)</a></li>
     
</ul>

<div class="tab-content">

<hr />

<?php $i = 0; while($i< 2){ 

// GET DATA QUERY
if($i == 0){ $data =  $posts; }else { $data = $posts1; }

// OUTPUT DISPLAY
?>

<div role="tabpanel" class="tab-pane <?php if($i == 0){ ?>active<?php } ?>" id="fb<?php echo $i; ?>"> 
 
	<?php if(!empty($data)){ ?> 
     
	<ul class="list-group">

		<?php foreach($data as $post){

		// GET LISTING ID
		$listingid = get_post_meta($post->ID,'pid',true);
		if(!is_numeric($listingid)){ continue; }
		
		// GET SCORE
		$score = get_post_meta($post->ID,'score',true);
		if($score == ""){ $score = 0; }
		
		// CHECK IF THIS USER HAS PURCHASED THIS ITEM
		$SQL1 = "SELECT count(*) AS total FROM `".$wpdb->prefix."core_orders` WHERE order_items LIKE ('%".$listingid."%') AND user_id='".$post->post_author."' LIMIT 1 ";
		$result1 = $wpdb->get_results($SQL1);
		
		?>
		<li class="list-group-item"> 
         
			<div class="row">
    
			<div class="col-xs-3 col-md-3">
        
       		<small><a href="<?php echo get_permalink($listingid); ?>"><?php echo $CORE->_e(array('feedback','22')); ?> <?php echo get_post_meta($post->ID,'pid',true); ?></a></small>
        
       		<script type='text/javascript'>jQuery(document).ready(function(){ 
				jQuery('#wlt_feedbackstar_<?php echo $post->ID; ?>').raty({
				readOnly:  true,
				path: '<?php echo FRAMREWORK_URI; ?>img/rating/',
				score: <?php echo $score; ?>,
				size: 24,
				
				 
				}); });
            </script>
             
            <div id="wlt_feedbackstar_<?php echo $post->ID; ?>" class="wlt_starrating"  style="margin-top:10px;"></div> 
                
			   <?php if($result1[0]->total == 1){ ?>
               
               <span class="label label-success"><?php echo $CORE->_e(array('feedback','23')); ?></span>
               
               <?php } ?>
                    
               <?php if($userdata->ID == $post->post_author  ){ // && $result1[0]->total == 0 ?>
             
                
                <form id="deletefeedbackfrom" name="deletefeedbackfrom" method="post" action="" style="margin-top:10px;">         
                <input type="hidden" name="action" value="delfeedback" />         
                <input type="hidden" name="fid" value="<?php echo $post->ID; ?>" />
                <button type="submit"><?php echo $CORE->_e(array('feedback','9')); ?></button>        
                <div class="clearfix"></div>         
                </form>
            
                <?php } ?> 
            
            </div>
             
             <div class="col-xs-9 col-md-9">
             
             <?php echo "<a href='".get_author_posts_url( $post->post_author )."' class='hidden-xs pull-right'>".str_replace("avatar ","avatar img-circle ",get_avatar($post->post_author,50))."</a>"; ?>
             
             <h4><?php echo $post->post_title; ?></h4>
             
               <div class="article<?php echo $post->ID; ?>"><?php echo $post->post_content; ?></div>
            
            <?php if(strlen($post->post_content) > 100){  ?>     
            <script>
            jQuery(document).ready(function(){
                jQuery('.article<?php echo $post->ID; ?>').shorten({
                    moreText: '<?php echo $CORE->_e(array('feedback','3')); ?>',
                    lessText: '<?php echo $CORE->_e(array('feedback','4')); ?>',
                    showChars: '280',
                });
            });
            </script>
            <?php } ?>
                             
      </div>
                        
      </div> 
       
      </li>
      
    <?php wp_reset_postdata(); } wp_reset_query(); ?>
    
    </ul>

<?php }else{ ?>

<h4 class="text-center"><?php echo $CORE->_e(array('feedback','21')); ?></h4>

<?php } ?>

</div>

<?php $i++; } ?>

</div>


<?php } // end feedback system 

}










if(!function_exists('_user_trustbar')){
function _user_trustbar($user_id, $size = "big"){ global $wpdb, $CORE;

// MAKE SURE ITS ENABLED
if(isset($GLOBALS['CORE_THEME']['feedback_trustbar']) && $GLOBALS['CORE_THEME']['feedback_trustbar'] == '1'){ }else{ return; }


// COUNT RATING FROM ALL LISTINGS
$SQL = "SELECT count(*) as total, sum(mt2.meta_value) AS total_score FROM ".$wpdb->prefix."posts 
	INNER JOIN ".$wpdb->prefix."postmeta AS mt1 ON (".$wpdb->prefix."posts.ID = mt1.post_id ) 
	INNER JOIN ".$wpdb->prefix."postmeta AS mt2 ON (".$wpdb->prefix."posts.ID = mt2.post_id ) 
	WHERE 1=1 	
	AND ".$wpdb->prefix."posts.post_status = 'publish'	
	AND mt1.meta_key = 'uid' AND mt1.meta_value = '".$user_id."'
	AND mt2.meta_key = 'score'";
 
$result = $wpdb->get_results($SQL);
 
// working out
$T_R = $result[0]->total;
$T_S = $result[0]->total_score;
if($T_S  == ""){ $T_S  = 0; }

if($T_R > 0){
	$barWidth = ( $T_S / ($T_R * 5 ) ) * 100;
}else{
	$barWidth = 100;
}
 
// BAR COLOR
if($barWidth > 0 && $barWidth < 50){ $barcolor = "info"; } 
if($barWidth > 49 && $barWidth < 80){ $barcolor = "warning"; } 
if($barWidth > 79){ $barcolor = "success"; } 


if($size == "big"){
?>

<div class="feedback_big"> 
  
<small><?php echo $CORE->_e(array('feedback','5')); ?></small>

<p> <?php echo $barWidth; ?>% <span class="pull-right"><?php echo $T_R; ?> <?php echo $CORE->_e(array('feedback','2')); ?></span>  </p>

<div class="progress" style="margin:0px;">
  <div class="progress-bar progress-bar-<?php echo $barcolor; ?> progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $barWidth; ?>%">
    <span class="sr-only"><?php echo $barWidth; ?>%</span>
  </div>
</div> 
 
  
</div>

<?php }elseif($size == "inone"){ ?>

 
<div class="progress" style="margin:0px;">
  <div class="progress-bar progress-bar-<?php echo $barcolor; ?> progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $barWidth; ?>%">
  
  <span><?php echo $T_R; ?> <?php echo $CORE->_e(array('feedback','2')); ?>  <strong><?php echo $barWidth; ?>%</strong> </span>
    
  </div>
</div> 
 
 

<?php }else{ ?>

<div class="feedback_small">

<div class="clearfix"></div>
<div class="progress" style="height:8px; margin:0px; border-radius:0px;">
  <div class="progress-bar progress-bar-<?php echo $barcolor; ?> progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $barWidth; ?>%">
    <span class="sr-only"><?php echo $barWidth; ?>%</span>
  </div>
</div>
</div>

<?php } ?>


<?php

}
}

if(!function_exists('_design_header')){
function _design_header(){ global $CORE;

// LOAD IN USER STYLE
if(!isset($GLOBALS['CORE_THEME']['layout_header'])){ $style = 1; }else{ $style = $GLOBALS['CORE_THEME']['layout_header']; }
 
$STRING = '<div id="core_header_wrapper"><div class="'.$CORE->CSS("container",true).' header_style'.$style.'" id="core_header">
<div class="row">'.hook_header_row_top('');
 
switch($style){

	case "6": { // LOGO LONG + TEXT
	
		// LOGO
		$STRING .= hook_header_style6(stripslashes($GLOBALS['CORE_THEME']['header_style_text']));	
	} break;

	case "5": { // LOGO LONG + TEXT
	
		// LOGO
		$STRING .= '<div class="col-md-6 col-sm-6 col-xs-12" id="core_logo"><a href="'.get_home_url().'/" title="'.get_bloginfo('name').'">'.hook_logo(true).'</a></div>';
		$STRING .= '<div class="col-md-6 col-sm-6 col-xs-12">';
		$STRING .= hook_header_style5(stripslashes($GLOBALS['CORE_THEME']['header_style_text']));		 
		$STRING .= '</div>';	
	} break;

	case "4": { // LOGO LONG + SEARCH
	
		// LOGO
		$STRING .= '<div class="col-md-6 col-sm-6 col-xs-12" id="core_logo"><a href="'.get_home_url().'/" title="'.get_bloginfo('name').'">'.hook_logo(true).'</a></div>';
		$STRING .= '<div class="col-md-6 col-sm-6 col-xs-12">';
		$STRING .= hook_header_searchbox('<form action="'.get_home_url().'/" method="get" id="wlt_searchbox_form">
			<div class="wlt_searchbox clearfix">
				<div class="inner">
					<div class="wlt_button_search"><i class="glyphicon glyphicon-search"></i></div>
					<input type="search" name="s" placeholder="'.$CORE->_e(array('button','11','flag_noedit')).'" value="'.(isset($_GET['s']) ? $_GET['s'] : "").'">
				</div>');
		 	
			if(!isset($GLOBALS['CORE_THEME']['addthis']) || ( isset($GLOBALS['CORE_THEME']['addthis']) && $GLOBALS['CORE_THEME']['addthis']  == 1 ) ){
			$STRING .= "<div class='text-right hidden-xs'>".do_shortcode('[D_SOCIAL size=16]')."</div>";
			}
		 
			$STRING .= '</div></form></div>';
	
	} break;
	case "2": { // LOGO MENU SPLIT
		
		// LOGO
		$STRING .= '<div class="col-md-5 col-sm-12" id="core_logo"><a href="'.get_home_url().'/" title="'.get_bloginfo('name').'">'.hook_logo(true).'</a></div>';
		$STRING .= '<div class="col-md-7 col-sm-12">
			<nav class="navbar hidden-xs"><div class="container-fluid">'.		  
			wp_nav_menu( array( 
				'container' => 'div',
				'container_class' => '',
				'theme_location' => 'primary',
				'menu_class' => 'nav navbar-nav',
				'fallback_cb'     => '',
				'echo'            => false,
				'walker' => new Bootstrap_Walker(),									
				) )	.							
		'</div></nav></div>'; 
		 
	} break;
	case "3": {	 // FULL HEADER IMAGE
		// LOGO
		$STRING .= hook_logo_wrapper('<div class="col-md-12" id="core_logo"><a href="'.get_home_url().'/" title="'.get_bloginfo('name').'">'.hook_logo(true).'</a></div>');	
	} break;
	
	default: {	// LOGO BANNER SPLIT
		// LOGO
		$STRING .= hook_logo_wrapper('<div class="col-md-5 col-sm-5" id="core_logo"><a href="'.get_home_url().'/" title="'.get_bloginfo('name').'">'.hook_logo(true).'</a></div>');
		// BANNER
		$STRING .= hook_banner_header_wrapper('<div class="col-md-7 col-sm-7 hidden-xs" id="core_banner">'.hook_banner_header($CORE->BANNER('header')).'</div>'); 	
	} break;
}
	
$STRING .= hook_header_row_bottom('').'</div></div></div>';

return hook_header_layout($STRING);
}
}

// THIS IS THE CORE MENU HOOK
if(!function_exists('_design_menu')){
function _design_menu(){ global $CORE, $userdata; $STRING = "";

	// LOAD IN USER STYLE
	if(!isset($GLOBALS['CORE_THEME']['layout_menu'])){ $style = 3; }else{ $style = $GLOBALS['CORE_THEME']['layout_menu']; }

	// GET MENU CONTENT
	$MENUCONTENT = wp_nav_menu( array( 
					'container' => 'div',
					'container_class' => 'navbar-collapse',
					'theme_location' => 'primary',
					'menu_class' => 'nav navbar-nav',
					'fallback_cb'     => '',
					'echo'            => false,
					'walker' => new Bootstrap_Walker(),									
					) );


switch($style){

	case "1": { // NO MENU	
	
	} break;
	
	case "5": {
	
		// DISPLAY MENU
		 
		$GLOBALS['flasg_smalldevicemenubar'] = true;
		$STRING = '<!-- [WLT] FRAMRWORK // MENU STYLE 5 -->
				
		<div class="container-fluid" id="core_smallmenu"><div class="row">
			<div id="wlt_smalldevicemenubar">
			<a href="javascript:void(0);" class="b1" data-toggle="collapse" data-target=".wlt_smalldevicemenu">'.$CORE->_e(array('mobile','4')).' <span class="glyphicon glyphicon-chevron-down"></span></a>
			 '.wp_nav_menu( array( 
			'container' => 'div',
			'container_class' => 'wlt_smalldevicemenu collapse',
			'theme_location' => 'primary',
			'menu_class' => '',
			'fallback_cb'     => '',
			'echo'            => false,
			'walker' => new Bootstrap_Walker(),									
			) ).'       
			</div>
		</div></div>
		
		<div id="core_menu_wrapper" class="menu_style5"><div class="'.$CORE->CSS("container", true).'"><div class="row"><nav class="navbar">';
		unset($GLOBALS['flasg_smalldevicemenubar']);
		
		if(!$userdata->ID){
		$EXTRA =  "<li class='pull-right'><a href='".home_url()."/wp-login.php?action=login'>".$CORE->_e(array('button','59'))."</a></li>";
		}else{
		 
		$EXTRA = "<li class='pull-right'>
		<a href='".$GLOBALS['CORE_THEME']['links']['account']."'>".$CORE->_e(array('head','4'))."</a>
		</li>";
		
		}	 
					
		$STRING .= str_replace("</ul>", $EXTRA. "</ul>",$MENUCONTENT) .'</nav></div></div></div>';
	
	} break;
	
	case "4": { //ADD LISTING BUTTON 
					
		// DISPLAY MENU
		 
		$GLOBALS['flasg_smalldevicemenubar'] = true;
		$STRING = '<!-- [WLT] FRAMRWORK // MENU STYLE 4 -->
				
		<div class="container-fluid" id="core_smallmenu"><div class="row">
			<div id="wlt_smalldevicemenubar">
			<a href="javascript:void(0);" class="b1" data-toggle="collapse" data-target=".wlt_smalldevicemenu">'.$CORE->_e(array('mobile','4')).' <span class="glyphicon glyphicon-chevron-down"></span></a>
			 '.wp_nav_menu( array( 
			'container' => 'div',
			'container_class' => 'wlt_smalldevicemenu collapse',
			'theme_location' => 'primary',
			'menu_class' => '',
			'fallback_cb'     => '',
			'echo'            => false,
			'walker' => new Bootstrap_Walker(),									
			) ).'       
			</div>
		</div></div>
		
		<div id="core_menu_wrapper" class="menu_style4"><div class="'.$CORE->CSS("container", true).'"><div class="row"><nav class="navbar">';
		unset($GLOBALS['flasg_smalldevicemenubar']);
	 
		$STRING .= "<div class='pull-right'>
		<a href='".$GLOBALS['CORE_THEME']['links']['add']."'>
		<button>
			<div class='title'>".$CORE->_e(array('homepage','4'))."</div>
		</button>
		</a>
		</div>";
	 
					
		$STRING .= $MENUCONTENT .'</nav></div></div></div>';
	
	
	} break;
	
	case "2":
	default: {
 
					
		// DISPLAY MENU
		if(strlen($MENUCONTENT) > 1){
		$GLOBALS['flasg_smalldevicemenubar'] = true;
		$STRING = '<!-- [WLT] FRAMRWORK // MENU -->
				
		<div class="container-fluid" id="core_smallmenu"><div class="row">
			<div id="wlt_smalldevicemenubar">
			<a href="javascript:void(0);" class="b1" data-toggle="collapse" data-target=".wlt_smalldevicemenu">'.$CORE->_e(array('mobile','4')).' <span class="glyphicon glyphicon-chevron-down"></span></a>
			 '.wp_nav_menu( array( 
			'container' => 'div',
			'container_class' => 'wlt_smalldevicemenu collapse',
			'theme_location' => 'primary',
			'menu_class' => '',
			'fallback_cb'     => '',
			'echo'            => false,
			'walker' => new Bootstrap_Walker(),									
			) ).'       
			</div>
		</div></div>
		
		
		<div id="core_menu_wrapper"><div class="'.$CORE->CSS("container", true).'"><div class="row"><nav class="navbar">';
		unset($GLOBALS['flasg_smalldevicemenubar']);
		
		// STYLE 2
		if($style == "2"){ 	  
			$STRING .= hook_menu_searchbox('<form action="'.get_home_url().'/" method="get" id="wlt_searchbox_form" class="hidden-sm hidden-xs">
			<div class="wlt_searchbox">
			
			<div class="input-group" style="max-width:300px;">
<input type="search" name="s" placeholder="'.$CORE->_e(array('button','11','flag_noedit')).'">
<div class="wlt_button_search"><i class="glyphicon glyphicon-search"></i></div>
   
</div> 
				
			</div>
			</form>');
		}
					
		$STRING .= $MENUCONTENT .'</nav></div></div></div>';
		
		}
	
	
	} break;

} // end switch 
	
			
return $STRING;

}
}

// THIS IS THE CORE BREADCRUMBS HOOK
if(!function_exists('_design_breadcrumbs')){
function _design_breadcrumbs(){ global $CORE, $userdata;  $showBreadcrumbs = true;
	

	if(!isset($GLOBALS['flag-home']) && $GLOBALS['CORE_THEME']['breadcrumbs_inner'] != '1'){
	$showBreadcrumbs = false;
	}elseif(isset($GLOBALS['flag-home']) && $GLOBALS['CORE_THEME']['breadcrumbs_home'] != '1'){
	$showBreadcrumbs = false;
	}
 	
	if( $showBreadcrumbs ){ 	
	$STRING = '<!-- FRAMRWORK // BREADCRUMBS --> 
	 
	<div id="core_breadcrumbs" class="clearfix">
	<div class="'.$CORE->CSS("container", true).'">
		<div class="row"> 
		 
			<ul class="breadcrumb pull-left">  
			'.hook_breadcrumbs_func($CORE->BREADCRUMBS('<li>','</li>')).'
			</ul>	 
		
			<ul class="breadcrumb pull-right">';
			
			// ACCOUNT LINKS
			if(isset($GLOBALS['CORE_THEME']['header_accountdetails']) && $GLOBALS['CORE_THEME']['header_accountdetails'] != 1){
			$STRING .= _accout_links();
			}
			
			// SOCIAL ICONS
			if(!$isTop && isset($GLOBALS['CORE_THEME']['social']) && isset($GLOBALS['CORE_THEME']['breadcrumbs_social']) && $GLOBALS['CORE_THEME']['breadcrumbs_social'] == 1){   
			
			$blog_title = get_bloginfo('name');            
						   
			$STRING .= '<li>
			
			<a href="https://api.addthis.com/oexchange/0.8/forward/facebook/offer?url='.home_url().'&pubid=ra-53d6f43f4725e784&ct=1&title='.$blog_title.'&pco=tbxnj-1.0" target="_blank">
<img src="'.get_template_directory_uri().'/framework/img/social/facebook16.png" border="0" alt="Facebook"/></a>
<a href="https://api.addthis.com/oexchange/0.8/forward/twitter/offer?url='.home_url().'&pubid=ra-53d6f43f4725e784&ct=1&title='.$blog_title.'&pco=tbxnj-1.0" target="_blank">
<img src="'.get_template_directory_uri().'/framework/img/social/twitter16.png" border="0" alt="Twitter"/></a>
<a href="https://api.addthis.com/oexchange/0.8/forward/linkedin/offer?url='.home_url().'&pubid=ra-53d6f43f4725e784&ct=1&title='.$blog_title.'&pco=tbxnj-1.0" target="_blank">
<img src="'.get_template_directory_uri().'/framework/img/social/linkedin16.png" border="0" alt="LinkedIn"/></a>
<a href="https://api.addthis.com/oexchange/0.8/forward/google_plusone_share/offer?url='.home_url().'&pubid=ra-53d6f43f4725e784&ct=1&title='.$blog_title.'&pco=tbxnj-1.0" target="_blank"><img src="'.get_template_directory_uri().'/framework/img/social/googleplus16.png" border="0" alt="Google+"/></a>
			</li>';
													   
			}
	
		$STRING .= '</ul>
		</div>
	</div> 
	</div>';	
 	return $STRING;
	}
} 

function _accout_links($b_f ='<li class="hidden-sm hidden-xs">', $b_a = '</li>'){ global $userdata, $CORE;

$STRING = "";

			if(isset($userdata) && $userdata->ID){
			 
				if(isset($GLOBALS['CORE_THEME']['links'])){				
				 
				// my account
				$STRING .= str_replace("hidden-sm hidden-xs","",$b_f).'<a href="'.$GLOBALS['CORE_THEME']['links']['myaccount'].'" class="ua1 '.$linkclass.'">'.$CORE->_e(array('head','4')).'</a>'.$b_a;
				 		 	
				// notifications
				$NOTIFICATION_COUNT = $CORE->MESSAGECOUNT($userdata->user_login);
				if($NOTIFICATION_COUNT > 0){							
				$STRING .= $b_f.'<a href="'.$GLOBALS['CORE_THEME']['links']['myaccount'].'?notify=1" class="ua2 '.$linkclass.'">'.$CORE->_e(array('head','8')).' ('.$NOTIFICATION_COUNT.')</span></a>'.$b_a;
				}
				
				// favorites
				if($GLOBALS['CORE_THEME']['show_account_favs'] == '1'){
			 
						 
				$STRING .= $b_f.'<a href="'.home_url().'/?s=&amp;favs=1" class="ua3 '.$linkclass.'">'.$CORE->_e(array('account','46')).' ('.$CORE->FAVSCOUNT().')</a>'.$b_a;
				}
				
				// logout
				$STRING .= $b_f.'<a href="'.wp_logout_url().'" class="ua4 '.$linkclass.'">'.$CORE->_e(array('account','8')).'</a>'.$b_a;
							
				
				}
			}else{
				
				//login
				$STRING .= $b_f.'<a href="'.get_home_url().'/wp-login.php" class="ua5 '.$linkclass.'">'.$CORE->_e(array('head','5','flag_link')).'</a>'.$b_a;
				
				// register
				$STRING .= $b_f.'<a href="'.get_home_url().'/wp-login.php?action=register" class="ua6 '.$linkclass.'">'.$CORE->_e(array('head','6','flag_link')).'</a>'.$b_a; 
				       
			}// end if
return $STRING;

}

// THIS IS THE CORE TOP MENU FUNCTION
function _design_topmenu(){ global $CORE; $mylocatopntop = "";

	$topmenu = wp_nav_menu( array( 
            'container' => 'div',
            'container_class' => '',
            'theme_location' => 'top-navbar',
            'menu_class' => 'nav nav-pills',
			'fallback_cb'     => '',
			'echo'            => false,
            'walker' => new Bootstrap_Walker(),									
            ) );
			
 
	if(!defined('WLT_CART') && isset($GLOBALS['CORE_THEME']['geolocation']) && $GLOBALS['CORE_THEME']['geolocation'] == "1" ){
				
			if(isset($_SESSION['mylocation'])){
				$country = $_SESSION['mylocation']['country'];
				$addresss = $_SESSION['mylocation']['address'];
			}else{
				$address = "";
				$country = $GLOBALS['CORE_THEME']['geolocation_flag'];
			}
	
			$mylocatopntop = '<li class="MyLocationLi"> 
			
			<a href="javascript:void(0);" onclick="GMApMyLocation();" data-toggle="modal" data-target="#MyLocationModal"><div class="flag flag-'.strtolower($country).' wlt_locationflag"></div> '.$CORE->_e(array('widgets','8')).'</a> </li>';
			
			// ATTACH IT TO THE TOP MENU
			if($topmenu == ""){
			
				$topmenu = "<ul class='nav nav-pills'>".$mylocatopntop."</ul>";
			
			}else{
			
				$topmenu = str_replace('class="nav nav-pills">','class="nav nav-pills">'.$mylocatopntop,$topmenu);
			
			}
		}

	// ONLY SHOW IF WE'VE CREATED ONE	
	if(strlen($topmenu) > 0 ||  defined('WLT_CART') ){ 
 
 
	$topmenustring = '<div id="core_header_navigation" class="hidden-xs">
	<div class="'.$CORE->CSS("container", true).'">
			
	<div class="row"> 	';
	
	if(isset($GLOBALS['CORE_THEME']['header_accountdetails']) && $GLOBALS['CORE_THEME']['header_accountdetails'] == 1){
	
	$topmenustring .= '<ul class="nav nav-pills pull-right accountdetails">'._accout_links().'</ul>';
	
	}else{
	
	$topmenustring .= '<span class="welcometext pull-right">'.hook_welcometext(stripslashes($GLOBALS['CORE_THEME']['header_welcometext'])).'</span>';
	
	}
			 
	$topmenustring .= '<div class="navbar-inner">'.$topmenu.'</div>
	
	</div>
	
	</div></div>';
 		
			return hook_header_navbar($topmenustring);	
	}	

} 
}
/* =============================================================================
	 MOBILE MENU DISPLSAY
	========================================================================== */
if(!function_exists('_design_mobilemenu')){
function _design_mobilemenu($type="inner"){ global $wpdb, $CORE; $STRING = "";  


	if(defined('IS_MOBILEVIEW')){
		return;	
	}

if(isset($GLOBALS['CORE_THEME']['responsive']) && $GLOBALS['CORE_THEME']['responsive'] == '1'){
	
 
	// GET MENU DATA
	$locations = get_nav_menu_locations();
	$menu_name = 'mobile-menu';		
	if ( ( $locations ) && isset( $locations[ $menu_name ] ) && $locations[ $menu_name ] != 0 ) {
	
	// BUTTONS
	$STRING .= '<nav class="navbar navbar-inverse navbar-fixed-top" id="core_mobile_menu"> <div class="container-fluid">';
	
	if(defined('WLT_CART')){
	global $CORE_CART;
	$cart_data = $CORE_CART->GETCART(true); 
	}
		
		// ADD CSS
		
		$STRING .= '<style type="text/css" scoped> @media (min-width: 0px) and (max-width: 400px) { html {margin-top: 0px !important;}  		body { padding:0px !important; margin-top:50px !important; } }</style>';
	
		// GET ASSIGNED MENU ID
		$nav_menu = wp_get_nav_menu_object($locations['mobile-menu']);
		
		// START HEADER
		$STRING .= '<div class="navbar-header">
						
						  <button type="button" class="navbar-toggle menubtntop" data-toggle="collapse" data-target=".mmenu2">
							<span class="sr-only">Toggle navigation</span>
							<span class="gicon-bar"></span>
							<span class="gicon-bar"></span>
							<span class="gicon-bar"></span>
						  </button>';
						  
		if($GLOBALS['CORE_THEME']['mobileview']['search'] == '1'){ 				 
			// SEARCH BUTTON
			$STRING .= '<button type="button" class="navbar-toggle searchbtntop" data-toggle="collapse" data-target=".mmenu1">
							<span class="sr-only">Toggle Search</span>
							<span class="glyphicon glyphicon-search"></span>
						  </button>';
		}
		
		// CART BUTTONS
		if(defined('WLT_CART')){
		$STRING .= '<script> 		 
		jQuery(document).ready(function(){
			if (jQuery(window).width() < 400) {
				jQuery("#wlt_cart_qty1").attr("id","wlt_cart_qty"); 
			}
		});
		jQuery(window).resize(function(){
			if (jQuery(window).width() < 400) {
				jQuery("#wlt_cart_qty1").attr("id","wlt_cart_qty"); 
			}	
		});		
		</script>';
				
		$STRING .= '<button type="button" class="navbar-toggle cartbtntop" data-toggle="collapse" data-target=".mmenu3">
							<span class="sr-only">Toggle Cart</span>
							<span class="glyphicon glyphicon-shopping-cart"></span>
							<span class="badge">'.hook_price('<i id="wlt_cart_total">'.$cart_data['total'].'</i>').'</span>
							 <span id="wlt_cart_qty1">'.$cart_data['qty'].'</span>							
						  </button>';
		}
		 
		 
		
						  
		// END BUTTONS			  
		$STRING .= '<a class="navbar-brand" href="'.get_home_url().'/">'.$CORE->_e(array('head','1')).'</a>
		
		</div>'; // END HEADER BUTTONS
		
		
						
		// ADD-ON FOR MOBILE SEARCH TOOL 
		if($GLOBALS['CORE_THEME']['mobileview']['search'] == '1'){ 				 
			 // WRAPPER  
			$STRING .= '<div class="collapse navbar-collapse  mmenu1">';
				if($GLOBALS['CORE_THEME']['mobileview']['adsearch'] == '1'){ 
					$STRING .= '<div class="padding">'.core_search_form(null,'mobile_advanced_search').'</div>';
				}else{
					$STRING .= '
					<div class="padding">
					<form  action="'.get_home_url().'/" method="get" style="margin-left:10px;">
						<input class="form-control" type="text" name="s" id="s">
						<button class="btn btn-default" type="submit">'.$CORE->_e(array('button','11')).'</button>
					</form>
					</div>';
				}
			// END WRAPPER
			$STRING .= '</div>';
		}
		
		if(defined('WLT_CART')){
		// ADD-ON CART MENU
		$STRING .= '<div class="collapse navbar-collapse mmenu3"><ul class="nav navbar-nav">';		
		if(isset($cart_data['items']) && is_array($cart_data['items'])){
		
			foreach($cart_data['items'] as $key=>$item){
				foreach($item as $mainitem){
				$STRING .= '<li>
				<a href="'.$mainitem['link'].'">'.str_replace("","",strip_tags($mainitem['image'], '<img>')).' '.$mainitem['name'].' 
				<div class="extrainfo badge right"><span class="pricetag">'.hook_price($mainitem['amount']).'</span> <span class="customtag">'.$mainitem['custom'].'&nbsp;<span> <div class="clearfix"></div></div></a>
				</li>';
				}
			}		
			$STRING .= '<li class="checkoutnow"><a href="'.$GLOBALS['CORE_THEME']['links']['checkout'].'"><span class="glyphicon glyphicon-shopping-cart"></span> '.$CORE->_e(array('checkout','14')).'</a></li>';
		}else{
			$STRING .= '<li class="emptybasket">'.$CORE->_e(array('checkout','46')).'</li>';
		}				
		$STRING .= '</ul></div>';
		}
		

		// ADD-ON NORMAL MENU
		$STRING .=  '<div class="collapse navbar-collapse mmenu2">'.wp_nav_menu( array( 
				'container' => '',
				'container_class' => '',
				'menu' => $nav_menu->term_id,
				'menu_class' => 'nav navbar-nav',
				'fallback_cb'     => '',
				'echo'            => false,
				'walker' => new Bootstrap_Walker(),									
				) ).'
				</div>';
	 
	// END WRAPPER
	$STRING .= '</div></nav>';  
	 
	} // has menu
	
}// is responsive

return $STRING; 

}
}

// THIS IS THE CORE HEADER HOOK
if(!function_exists('_design_footer')){
function _design_footer(){ global $CORE; 


	// LOAD IN CHILD THEME TEMPATE FILES
	if(defined('CHILD_THEME_NAME') && file_exists(WP_CONTENT_DIR."/themes/".CHILD_THEME_NAME."/_footer.php") ){
	
		include(WP_CONTENT_DIR."/themes/".CHILD_THEME_NAME."/_footer.php");
		
	}elseif(file_exists(str_replace("functions/","",THEME_PATH)."/templates/".$GLOBALS['CORE_THEME']['template']."/_footer.php") ){
		
		include(str_replace("functions/","",THEME_PATH)."/templates/".$GLOBALS['CORE_THEME']['template'].'/_footer.php');
 		
	}else{
	

if(!isset($GLOBALS['CORE_THEME']['layout_footer'])){ $footerwidths = 0; }else{ $footerwidths = $GLOBALS['CORE_THEME']['layout_footer']; }
switch($footerwidths){
	case "1": {
	$col1 = "col-md-8";
	$col2 = "col-md-4";
	$col3 = "hide";		
	} break;
	case "2": {
	$col1 = "col-md-4";
	$col2 = "col-md-8";
	$col3 = "hide";		
	} break;
	case "3": {
	$col1 = "col-md-12";
	$col2 = "hide";
	$col3 = "hide";		
	} break;
	
	case "5": {
	$col1 = "col-md-3";
	$col2 = "col-md-3";
	$col3 = "col-md-3";		
	$col4 = "col-md-3";	
	} break;	
	
	default: {	
	$col1 = "col-md-4";
	$col2 = "col-md-4";
	$col3 = "col-md-4";
	} break;
}// end switcj

?>
<!-- [WLT] FRAMRWORK // FOOTER -->

<p id="back-top"> <a href="#top"><span></span></a> </p>

<footer id="footer">
	
    <div id="footer_content">
    
        <div class="<?php $CORE->CSS("container"); ?>">
        
            <div class="row clearfix">
                
                    <div class="<?php echo $col1; ?>"><?php dynamic_sidebar('sidebar-3'); ?></div>
                    
                    <div class="<?php echo $col2; ?> hidden-xs"><?php dynamic_sidebar('sidebar-4'); ?></div>
                    
                    <div class="<?php echo $col3; ?> hidden-xs"><?php dynamic_sidebar('sidebar-5'); ?></div>
                    
                    <?php if($GLOBALS['CORE_THEME']['layout_footer'] == 5){ ?>
                    <div class="<?php echo $col4; ?> hidden-xs"><?php dynamic_sidebar('sidebar-6'); ?></div>
                    <?php } ?>
                
            </div>
       
       </div>
   
   </div>
   
   <div id="footer_bottom">
   
   <div class="<?php $CORE->CSS("container"); ?>">
    
    <div class="row clearfix">
    
    
   	 <div class="pull-left copybit"> <?php echo stripslashes($GLOBALS['CORE_THEME']['copyright']); ?> </div>   
            
            <?php
			
			// GET MENU DATA
			$locations = get_nav_menu_locations();
			$menu_name = 'footer-menu';		
			if ( ( $locations ) && isset( $locations[ $menu_name ] ) && $locations[ $menu_name ] != 0 ) {
			
			$nav_menu = wp_get_nav_menu_object($locations['mobile-menu']);
			
			echo  wp_nav_menu( array( 
						'container' => '',
						'container_class' => '',
						'menu' => $nav_menu->term_id,
						'menu_class' => 'list-inline pull-left',
						'fallback_cb'     => '',
						'echo'            => false,
						'walker' => new Bootstrap_Walker(),									
						) );
			
			} ?>
      
             
              
                <?php
                $si = ""; $sb = "";
                if(isset($GLOBALS['CORE_THEME']['social'])){
                $si = "<ul class='socialicons list-inline pull-right'>";
                    
                        if(strlen($GLOBALS['CORE_THEME']['social']['twitter']) > 1){ 
						$sb .= "<li><a href='".$GLOBALS['CORE_THEME']['social']['twitter']."' class='twitter' rel='nofollow' target='_blank'>
						<i class='fa ".$GLOBALS['CORE_THEME']['social']['twitter_icon']."'></i>
						</a></li>"; } 
                        if(strlen($GLOBALS['CORE_THEME']['social']['dribbble']) > 1){ 
						$sb .= "<li><a href='".$GLOBALS['CORE_THEME']['social']['dribbble']."' class='dribbble' rel='nofollow' target='_blank'>
						<i class='fa ".$GLOBALS['CORE_THEME']['social']['dribbble_icon']."'></i>
						</a></li>"; } 
                        if(strlen($GLOBALS['CORE_THEME']['social']['facebook']) > 1){ 
						$sb .= "<li><a href='".$GLOBALS['CORE_THEME']['social']['facebook']."' class='facebook' rel='nofollow' target='_blank'>
						<i class='fa ".$GLOBALS['CORE_THEME']['social']['facebook_icon']."'></i>
						</a></li>"; } 
                        if(strlen($GLOBALS['CORE_THEME']['social']['linkedin']) > 1){ 
						$sb .= "<li><a href='".$GLOBALS['CORE_THEME']['social']['linkedin']."' class='linkedin' rel='nofollow' target='_blank'>
						<i class='fa ".$GLOBALS['CORE_THEME']['social']['linkedin_icon']."'></i>
						</a></li>"; } 
                        if(strlen($GLOBALS['CORE_THEME']['social']['youtube']) > 1){ 
						$sb .= "<li><a href='".$GLOBALS['CORE_THEME']['social']['youtube']."' class='youtube' rel='nofollow' target='_blank'>
						<i class='fa ".$GLOBALS['CORE_THEME']['social']['youtube_icon']."'></i>
						</a></li>"; } 
                        if(strlen($GLOBALS['CORE_THEME']['social']['rss']) > 1){ 
						$sb .= "<li><a href='".$GLOBALS['CORE_THEME']['social']['rss']."' class='rss' rel='nofollow' target='_blank'>
						<i class='fa ".$GLOBALS['CORE_THEME']['social']['rss_icon']."'></i>
						</a></li>"; } 
                        
                $si .= $sb."</ul>";
                if($sb == ""){ $si = ""; }
                }
                echo hook_footer_socialicons($si);
                ?>
        
    </div>  </div>
    
    </div> </div>
    

</footer>
<div id="freeow" class="freeow freeow-top-right"></div>
<?php } }
}


if(!function_exists('DEFAULTLISTINGPAGE1')){
function DEFAULTLISTINGPAGE1(){ global $post, $CORE; $STRING = "";

// CAN WE DISPLAY THE GOOGLE MAP BOX ?
if( get_post_meta($post->ID,'showgooglemap',true) == "yes"){
	$my_long  			= get_post_meta($post->ID,'map-log',true);
	$my_lat  			= get_post_meta($post->ID,'map-lat',true);
	$GOOGLEMAPADDRESS 	= 'https://www.google.com/maps/dir/'.str_replace(",","",str_replace(" ","+",get_post_meta($post->ID,'map_location',true)))."/".$my_lat.",".trim($my_long);
}

$STRING .= '<div class="panel panel-default" id="DEFAULTLISTINGPAGE1">
<div class="panel-body">
 
<h1>[TITLE]</h1>

<ol class="breadcrumb">
  <li>[FAVS]</li>
  
  <li  class="pull-right">[RATING results=1]</li>
 
  <li class="pull-right hidden-xs"><i class="fa fa-area-chart"></i> [hits] views</li>
  <li class="pull-right hidden-xs">#[ID]</li>
  
</ol>

<small>[DATE]</small>

<div  class="pull-right">[SOCIAL]</div>

</div>  

 
<div class="col-md-6">
	[IMAGES]
</div>
<div class="col-md-6"> 
	[EXCERPT] 
	
	[FIELDS smalllist=1]
	
	[THEMEEXTRA]
 	 
	<div class="clearfix"></div>	
</div>

<div class="clearfix"></div> 



<div class="board">
	<div class="board-inner">
    
	<ul class="nav nav-tabs" id="Tabs">
    
	<div class="liner"></div>
					
    <li class="active"><a href="#home" data-toggle="tab" title="'.$CORE->_e(array('single','34')).'"><span class="round-tabs one"><i class="fa fa-file-text-o"></i></span></a></li>

    <li><a href="#t4" data-toggle="tab" title="'.$CORE->_e(array('single','37')).'"> <span class="round-tabs two"><i class="fa fa-comments-o"></i></span> </a></li>
				  
    <li><a href="#messages" data-toggle="tab" title="'.$CORE->_e(array('single','16')).'"><span class="round-tabs three"><i class="fa fa-bars"></i></span> </a></li>

    <li><a href="#settings" data-toggle="tab" title="'.$CORE->_e(array('single','36')).'"><span class="round-tabs four"><i class="glyphicon glyphicon-comment"></i></span></a></li>';
	
	if(isset($GOOGLEMAPADDRESS)){
	$STRING .='<li><a href="#doner" data-toggle="tab" title="'.$CORE->_e(array('button','52')).'" id="GoogleMapTab"><span class="round-tabs five"><i class="fa fa-map-marker"></i></span></a></li>';
   }
   
    $STRING .= '</ul></div>

	<div class="tab-content">
    
	<div class="tab-pane fade in active" id="home"> [THEMEEXTRA1] [CONTENT]</div>
    
	<div class="tab-pane fade" id="t4">[COMMENTS tab=0]</div>
    
	<div class="tab-pane fade" id="messages"><div class="well"><h3>'.$CORE->_e(array('single','16')).'</h3> <hr /> [FIELDS] </div> </div>
    
	<div class="tab-pane fade" id="settings">[CONTACT style="2"]</div>';
    
	if(isset($GOOGLEMAPADDRESS)){
	$STRING .= '<div class="tab-pane fade" id="doner">
	
		<div class="well">
		<a href="'.$GOOGLEMAPADDRESS.'" target="_blank" class="btn btn-default pull-right">
		'.$CORE->_e(array('button','56')).'</a>
		<h3>'.$CORE->_e(array('add','67')).'</h3>
		<hr />
		[GOOGLEMAP]	
		</div>
		<script>		
		jQuery( "#GoogleMapTab" ).click(function() {
		setTimeout(function () {google.maps.event.trigger(map, "resize"); }, 200);
		});
		</script>
	</div>';
	}else{
	$STRING .= '<style>.board .nav-tabs > li {width: 25%;}</style>';
	}
	
	$STRING .='<div class="clearfix"></div>
	
	</div>
</div></div>

<script>
jQuery(function(){jQuery(\'a[title]\').tooltip();});
</script>'; 

return $STRING;
}
}

if(!function_exists('DEFAULTLISTINGPAGE2')){
function DEFAULTLISTINGPAGE2(){ global $post, $CORE; $STRING = "";

// CAN WE DISPLAY THE GOOGLE MAP BOX ?
if( get_post_meta($post->ID,'showgooglemap',true) == "yes"){
	$my_long  			= get_post_meta($post->ID,'map-log',true);
	$my_lat  			= get_post_meta($post->ID,'map-lat',true);
	$GOOGLEMAPADDRESS 	= 'https://www.google.com/maps/dir/'.str_replace(",","",str_replace(" ","+",get_post_meta($post->ID,'map_location',true)))."/".$my_lat.",".trim($my_long);
}

$STRING .= '<div class="panel panel-default" id="DEFAULTLISTINGPAGE2">
<div class="panel-body">
 
<h1>[TITLE]</h1>

<ol class="breadcrumb">
  <li>[FAVS]</li>
  
  <li  class="pull-right">[RATING results=1]</li>
 
  <li class="pull-right hidden-xs"><i class="fa fa-area-chart"></i> [hits] views</li>
  <li class="pull-right hidden-xs">#[ID]</li>
  
</ol>

<small>[DATE]</small>

<div  class="pull-right">[SOCIAL]</div>

[IMAGES]

</div> 
 
[THEMEEXTRA]

<div class="clearfix"></div> 

<div class="board">
	<div class="board-inner">
    
	<ul class="nav nav-tabs" id="Tabs">
    
	<div class="liner"></div>
					
    <li class="active"><a href="#home" data-toggle="tab" title="'.$CORE->_e(array('single','34')).'"><span class="round-tabs one"><i class="fa fa-file-text-o"></i></span></a></li>

    <li><a href="#t4" data-toggle="tab" title="'.$CORE->_e(array('single','37')).'"> <span class="round-tabs two"><i class="fa fa-comments-o"></i></span> </a></li>
				  
    <li><a href="#messages" data-toggle="tab" title="'.$CORE->_e(array('single','16')).'"><span class="round-tabs three"><i class="fa fa-bars"></i></span> </a></li>

    <li><a href="#settings" data-toggle="tab" title="'.$CORE->_e(array('single','36')).'"><span class="round-tabs four"><i class="glyphicon glyphicon-comment"></i></span></a></li>';
	
	if(isset($GOOGLEMAPADDRESS)){
	$STRING .='<li><a href="#doner" data-toggle="tab" title="'.$CORE->_e(array('button','52')).'" id="GoogleMapTab"><span class="round-tabs five"><i class="fa fa-map-marker"></i></span></a></li>';
   }
   
    $STRING .= '</ul></div>

	<div class="tab-content">
    
	<div class="tab-pane fade in active" id="home">[THEMEEXTRA1] [CONTENT]</div>
    
	<div class="tab-pane fade" id="t4">[COMMENTS tab=0]</div>
    
	<div class="tab-pane fade" id="messages"><div class="well"><h3>'.$CORE->_e(array('single','16')).'</h3> <hr /> [FIELDS] </div> </div>
    
	<div class="tab-pane fade" id="settings">[CONTACT style="2"]</div>';
    
	if(isset($GOOGLEMAPADDRESS)){
	$STRING .= '<div class="tab-pane fade" id="doner">
	
		<div class="well">
		<a href="'.$GOOGLEMAPADDRESS.'" target="_blank" class="btn btn-default pull-right">
		'.$CORE->_e(array('button','56')).'</a>
		<h3>'.$CORE->_e(array('add','67')).'</h3>
		<hr />
		[GOOGLEMAP]	
		</div>
		<script>		
		jQuery( "#GoogleMapTab" ).click(function() {
		setTimeout(function () {google.maps.event.trigger(map, "resize"); }, 200);
		});
		</script>
	</div>';
	}else{
	$STRING .= '<style>.board .nav-tabs > li {width: 25%;}</style>';
	}
	
	$STRING .='<div class="clearfix"></div>
	
	</div>
</div></div>

<script>
jQuery(function(){jQuery(\'a[title]\').tooltip();});
</script>'; 

return $STRING;
}
}