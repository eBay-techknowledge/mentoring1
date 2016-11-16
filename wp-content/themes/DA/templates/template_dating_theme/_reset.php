<?php

add_action('hook_new_install','_newinstall');
function _newinstall(){ global $CORE, $wpdb;

// SETUP MY ACCOUNT PAGE
$GLOBALS['theme_defaults']['show_account_membership'] = 1;

$GLOBALS['theme_defaults']['layout_layoutwidth'] = 1;
$GLOBALS['theme_defaults']['layout_contentwidth'] = 0;
 
// HOME PAGE LAYOUT
$GLOBALS['theme_defaults']['content_layout'] = "listing-dating";
$GLOBALS['theme_defaults']['single_layout'] = "content-listing-dating";
$GLOBALS['theme_defaults']['homepage_layout'] = "layout-dating1";

// DEFAULTS FOR HOME PAGE OBJECTS
$GLOBALS['theme_defaults']['hdata'] = array(
"j1" => array("title1" => "Dating Theme", "title2" => "HTML5 Responsive Directory Theme", "title3" => "This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.", ),
"t1" => array("title1" => "Your Amazing Title Text Here", "title2" => "You can customize this area and enter your own title text via the admin area of the theme."  ),
"t2" => array("title1" => "Your Amazing Title Text Here", "title2" => "You can customize this area and enter your own title text via the admin area of the theme."  ),
); 

// WEBSITE LOGO
$GLOBALS['theme_defaults']['logo_text1'] 	= "Website Logo";
$GLOBALS['theme_defaults']['logo_text2'] 	= "Your company slogan";
$GLOBALS['theme_defaults']['logo_icon'] 	= 0;

$GLOBALS['theme_defaults']['default_gallery_perrow'] = 4;

$GLOBALS['theme_defaults']['search_searchbar'] = 1;

// SET HEADER
$GLOBALS['theme_defaults']['layout_header'] = 1;
// SET MENU
$GLOBALS['theme_defaults']['layout_menu'] = 4;
// 4. DEFAULT TEMPLATE DATA
$GLOBALS['theme_defaults']['template'] 		= "template_dating_theme";

$GLOBALS['theme_defaults']["layout_columns"] = array('homepage' => '3', 'search' => 3, 'single' => 2, 'page' => '2', 'footer' => 5, '2columns' => '0', 'style' => 'fluid', '3columns' => '', 'contentwidth' => 1,
'homepage_2columns' => 2, 'search_2columns' => 2,  'page_2columns' => 2,  'single_2columns' => 2);

// HOME PAGE SETUP
$GLOBALS['theme_defaults']['widgetobject']["datinghome"][0] 	= array(
	"fullw" => "underheader",
);

$GLOBALS['theme_defaults']['widgetobject']['3columns']['1'] = array(
'col1' => "<div class=\"panel panel-default\"><div class=\"panel-heading\"><h3>Welcome to our website</h3></div><div class=\"panel-body\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate.Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero. Aenean sit amet felisdolor, in sagittis nisi. Sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan.Aliquam in felis sit amet augue.<img src='".get_template_directory_uri()."/templates/".$GLOBALS['theme_defaults']['template']."/img/a1.jpg' alt=''></div></div>",
'col2' => "<div class=\"panel panel-default\"><div class=\"panel-heading\"><h3>Online dating made easy!</h3></div><div class=\"panel-body\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate.Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero. Aenean sit amet felisdolor, in sagittis nisi. Sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan.Aliquam in felis sit amet augue.<img src='".get_template_directory_uri()."/templates/".$GLOBALS['theme_defaults']['template']."/img/a2.jpg' alt=''></div></div>",
'col3' => "<div class=\"panel panel-default\"><div class=\"panel-heading\"><h3>Staying safe online</h3></div><div class=\"panel-body\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate.Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero. Aenean sit amet felisdolor, in sagittis nisi. Sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan.Aliquam in felis sit amet augue.<img src='".get_template_directory_uri()."/templates/".$GLOBALS['theme_defaults']['template']."/img/a3.jpg' alt=''></div></div>",
'fullw' => "yes",
);

$GLOBALS['theme_defaults']['widgetobject']["tabs"][2] 	= array(
		"title1" => "Newest Members",
		"query1" => "order=desc&orderby=rand&posts_per_page=8",
		"spanclass1" => "span3",
		
		"title2" => "Recently Logged In",
		"query2" => "order=desc&orderby=rand&posts_per_page=8",
		"spanclass1" => "span3",
		
		"title3" => "Most Viewed Members",
		"query3" => "order=desc&orderby=rand&posts_per_page=8",
		"spanclass1" => "span3",
				
		"fullw" => "yes",	
);
$GLOBALS['theme_defaults']['homepage'] 		= array("widgetblock1" => "datinghome_0,3columns_1,tabs_2");
// COLUMN LAYOUTS
$GLOBALS['theme_defaults']['display'] 			= array('default_gallery_style' => 'grid');
 

// ITEM CODE
$GLOBALS['theme_defaults']['itemcode'] 		= '[IMAGE]
<div class="caption"><h1>[TITLE]</h1>
<p>[GENDER] / [daage] / [COUNTRY] [ONLINESTATUS]</p> [DISTANCE]
<div class="hidden-details">[EXCERPT] </div>
[PROFILEBUTTONS]
</div>';
update_option('wlt_reset_itemcode', $GLOBALS['theme_defaults']['itemcode']);
 
$GLOBALS['theme_defaults']['listingcode']		= '<div class="block">

<div class="block-content">

<div class="row">
<div class="col-md-6">[IMAGES gallery=yes]</div>        
<div class="col-md-6"><h1>[TITLE-NOLINK]</h1>[LISTINGDATA]  </div></div>
<hr />[PROFILEBUTTONS]<hr />
<ul class="nav nav-tabs navstyle1" id="Tabs">
  <li class="active"><a href="#t1" data-toggle="tab">My Description</a></li>
  
  <li><a href="#t3" data-toggle="tab">Comments</a></li>
</ul> 
<div class="tab-content">
  <div class="tab-pane active" id="t1">
   [CONTENT] [FIELDS]
   [GOOGLEMAP]
  </div>
 
  <div class="tab-pane" id="t3"><br />
  [COMMENTS] 
  </div>  
</div> 
 

</div></div>'; 
update_option('wlt_reset_listingcode', $GLOBALS['theme_defaults']['listingcode']);



// 6. INSTALL THE SAMPLE DATA LISTINGS
$i=1;
while($i < 16){
 
	$my_post = array();
	$my_post['post_title'] 		= "Example Profile ".$i;
	$my_post['post_content'] 	= "<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate.
Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero. Aenean sit amet felis</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate.
Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero. Aenean sit amet felis</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate.
Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero. Aenean sit amet felis</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate.
Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero. Aenean sit amet felis</p>";
	$my_post['post_type'] 		= THEME_TAXONOMY."_type";
	$my_post['post_status'] 	= "publish";
	$my_post['post_category'] 	= "";
	$my_post['tags_input'] 		= "";
	$POSTID 					= wp_insert_post( $my_post );	
 
 	add_post_meta($POSTID, "dagender", rand(1, 3));
	add_post_meta($POSTID, "daseeking", rand(1, 3));
	add_post_meta($POSTID, "daage", rand(18,65));
	add_post_meta($POSTID, "image", "http://placehold.it/820x550&text=Image+Here");
	add_post_meta($POSTID, "featured", "no");
  
	// UPDATE CAT LIST
	wp_set_post_terms( $POSTID, $saved_cats_array, THEME_TAXONOMY );
	
	$i++;		
} 


// HOME PAGE OBJECTS
update_option('datinghome_t1','Online Dating Made Easy!');
update_option('datinghome_t2','Search active and online member profiles below;');

}

?>