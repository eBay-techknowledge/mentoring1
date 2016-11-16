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
?>

<?php get_header($CORE->pageswitch());  ?>

<?php $mapData = $CORE->wlt_googlemap_data(true);  $CanShowMap = false; if(strlen($mapData) > 10){ $CanShowMap = true; } ?>

<?php hook_gallerypage_before(); ?> 

<?php hook_gallerypage_results_before(); ?> 

<?php if(!defined('HIDE_SEARCHRESULTS_BOX')){ ?>

<div class="_searchresultsblock">

<?php if(!defined('HIDE_SEARCHRESULTS_HEAD')){ ?>

<h3><?php echo hook_gallerypage_results_title(''); ?></h3>

<h4><?php echo hook_gallerypage_results_text(str_replace("%a",number_format($wp_query->found_posts),$CORE->_e(array('gallerypage','1')))); ?></h4>

<hr /> 

<?php } ?>

<?php $LAYOUT->gallerypage_results_before(); ?>

<?php if(!isset($GLOBALS['CORE_THEME']['search_searchbar']) || isset($GLOBALS['CORE_THEME']['search_searchbar']) && $GLOBALS['CORE_THEME']['search_searchbar'] == 1){ ?>

<div class="row">

    <div class="col-md-6 col-sm-12 col-xs-12">
        
        <form action="<?php echo get_home_url(); ?>/" method="get" class="form-inline" role="search">
        
        <input type="text" class="form-control " name="s" placeholder="<?php echo $CORE->_e(array('homepage','7')); ?>">
        
      	<?php hook_gallerypage_searchform(); ?>
        
        <button type="submit" class="btn btn-primary"><?php echo $CORE->_e(array('button','11')); ?></button> 
              
        </form>
    
    </div>
    
    <div class="col-md-6 col-sm-12 col-xs-12">
 
        <ul class="list-inline ext1">
        
        <li class="sf"><a href="javascript:void(0);" onclick="jQuery('#s1').show(); ShowAdSearch('<?php echo str_replace("http://","",get_home_url()); ?>','advancedsearchformajax');"><?php echo $CORE->_e(array('head','2')); ?></a></li>
        
        <?php if($GLOBALS['CORE_THEME']['show_account_favs'] == '1'){ ?>
                
        <li class="fac"><a href="<?php echo home_url().'/?s=&amp;favs=1'; ?>"><?php echo $CORE->_e(array('account','46')); ?> (<?php echo $CORE->FAVSCOUNT(); ?>)</a></li>
                
        <?php } ?>
        
        <?php if(isset($GLOBALS['CORE_THEME']['geolocation']) && $GLOBALS['CORE_THEME']['geolocation'] != "" && $GLOBALS['CORE_THEME']['google'] == 1){ 
		
				if(isset($_SESSION['mylocation'])){
				$country = $_SESSION['mylocation']['country'];
				$addresss = $_SESSION['mylocation']['address'];
				}else{
				$address = "";
				$country = $GLOBALS['CORE_THEME']['geolocation_flag'];
				}
			 
		?>
        
        <li class="cff"><a href="javascript:void(0);" onclick="GMApMyLocation();" data-toggle="modal" data-target="#MyLocationModal"><div class="flag flag-<?php echo strtolower($country); ?> wlt_locationflag"></div><?php echo $CORE->_e(array('widgets','16')); ?></a></li>
        
        <?php } ?>
        
        </ul>
    
    </div>
 
</div>

<div class="clearfix"></div>

<hr />

<?php } ?>

<div id="s1" style="display:none">
    <div class="box1" >
    <a href="javascript:void(0);" onclick="jQuery('#s1').hide();" class="badge pull-right" ><?php echo $CORE->_e(array('single','14')); ?></a>
  
   <div id="advancedsearchformajax"></div>
    </div>
    <hr />
</div>


<?php if ($wp_query->have_posts()) : ?>


<?php if($GLOBALS['CORE_THEME']['search_sortby'] == '1'){ ?>
<div>
<ul class="list-inline orderby">
    <li><strong><?php echo $CORE->_e(array('gallerypage','9')); ?>: </strong></li>
    <?php echo $CORE->OrderBy(); ?>
</ul>
</div>

 
<div class="changebtns">
        
          <a href="#" id="wlt_search_tab1" class="btn btn-default btn-sm <?php if($GLOBALS['CORE_THEME']['display']['default_gallery_style'] == "list"){ echo "active"; }?>">
                    <i class="fa fa-list"></i> <?php echo $CORE->_e(array('button','50')); ?></a>
                    
                    <?php if($GLOBALS['CORE_THEME']['display']['default_gallery_style'] != "listonly"){ ?>
                    <a href="#" id="wlt_search_tab2" class="btn btn-default btn-sm <?php if($GLOBALS['CORE_THEME']['display']['default_gallery_style'] == "grid"){ echo "active"; }?>">
                    <i class="fa fa-th-large"></i> <?php echo $CORE->_e(array('button','51')); ?></a>
                    <?php } ?>
                    
                    <?php if($GLOBALS['CORE_THEME']['display']['default_gallery_style'] != "listonly" && $CanShowMap && $GLOBALS['CORE_THEME']['google'] == 1){ ?>
                    <a href="#" id="wlt_search_tab3" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-map-marker"></span> <?php echo $CORE->_e(array('button','52')); ?></a>
                    <?php } ?> 
                    
                    <?php hook_gallerypage_results_btngroup(); ?>     
</div>

<hr />
<?php } ?>

<?php endif; ?>
 
<div class="clearfix"></div>  

</div>

<?php } ?>

<?php hook_gallerypage_results_after(); ?>








<?php if ($wp_query->have_posts()) : ?> 
 
 
<?php if($CanShowMap && isset($GLOBALS['CORE_THEME']['display_search_map'] ) && $GLOBALS['CORE_THEME']['display_search_map']  == "3" && $GLOBALS['CORE_THEME']['google'] == 1 ){ ?>

<?php echo $CORE->wlt_googlemap_html(false); ?>

<?php } ?> 
 

<div class="_searchresultsdata"> 

	<?php hook_gallerypage_results_top(); ?>
 
	<a name="topresults"></a>

	<div class="wlt_search_results <?php if($GLOBALS['CORE_THEME']['display']['default_gallery_style'] == "grid"){ echo "grid_style";  }else{ echo "list_style"; } ?>">

		<?php hook_items_before(); ?>
 
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	 
             
        <?php get_template_part( 'content', hook_content_templatename($post->post_type) ); ?> 
        
        <?php wp_reset_postdata(); ?>
 
		<?php endwhile; ?>

		<?php hook_items_after(); ?>

<?php if($CanShowMap){ ?>
<script> 
<?php  $defaults = $CORE->wlt_google_getdefaults();  ?>

var wlt_map_options = [{

	path: "<?php echo get_template_directory_uri(); ?>", 
	id: "wlt_google_map", 
	region: "<?php echo $defaults['region']; ?>", 
	lang: "<?php echo $defaults['lang'] ?>", 
	long: <?php echo $defaults['long']; ?>, 
	lat: <?php echo $defaults['lat']; ?>, 	
	zoom: <?php echo $defaults['zoom'] ?>,
	data: <?php echo $mapData; ?>,
	color: "grey",
		
	<?php if(isset($_GET['zipcode']) && strlen($_GET['zipcode']) > 1 ){  $radius = $CORE->wlt_google_getradius(); ?>
	
	radius: [{ "zip":"<?php echo $radius['zip']; ?>", "long":"<?php echo $radius['long']; ?>", "lat":"<?php echo $radius['lat']; ?>", "dis":<?php echo $radius['dis']; ?> }],
	
	<?php } ?>

}];
</script>
<?php } ?>

<div class="clearfix"></div>

</div>

<?php if( $CanShowMap && ( isset($GLOBALS['CORE_THEME']['default_gallery_map']) && $GLOBALS['CORE_THEME']['default_gallery_map'] == '1' && $canShowExtras) || isset($_GET['showmap']) ):  ?>

	<script>
    jQuery(document).ready(function() {
        loadGoogleMapsApi();
        jQuery('#wlt_search_tab2').removeClass('active');
        jQuery('#wlt_search_tab1').removeClass('active');
        jQuery('#wlt_search_tab3').addClass('active');
    });
    <?php endif; ?>
    </script>

<?php endif; ?> 

<?php echo $CORE->PAGENAV(); ?>
		
<?php hook_gallerypage_after(); ?>

<?php else: ?>

<?php get_template_part( 'page', 'noresults' ); ?>

<?php endif; ?>

<?php get_footer($CORE->pageswitch()); ?>