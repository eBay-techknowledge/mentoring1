<?php
/*
Template Name: [How It Works]
*/
/* =============================================================================
   [PREMIUMPRESS FRAMEWORK] THIS FILE SHOULD NOT BE EDITED
   ========================================================================== */
   
if (!defined('THEME_VERSION')) {	header('HTTP/1.0 403 Forbidden'); exit; }

global  $userdata, $CORE; get_currentuserinfo();  $GLOBALS['flag-members'] = 1; 

// LOAD HEADER   
get_header($CORE->pageswitch()); ?>


<div class="panel panel-default">

<div class="panel-body">  

<h1>How it works?</h1>

<hr />

<section>

    <div class="col-md-4">
    
    	<img src="http://placehold.it/250x150&text=image here" class="img-responsive">
    
    </div>
    
    <div class="col-md-8">
    
        <h3>Your Own Text Here</h3>
         
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. 
        Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p>
    
    </div>

</section>

<div class="clearfix"></div>

<hr />


<section>

    <div class="col-md-4 pull-right">
    
    	<img src="http://placehold.it/250x150&text=image here" class="img-responsive">
    
    </div>
    
    <div class="col-md-8">
    
        <h3>Your Own Text Here</h3>
         
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. 
        Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p>
    
    </div>

</section>

<div class="clearfix"></div>

<hr />

<section>

    <div class="col-md-4">
    
    	<img src="http://placehold.it/250x150&text=image here" class="img-responsive">
    
    </div>
    
    <div class="col-md-8">
    
        <h3>Your Own Text Here</h3>
         
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. 
        Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.</p>
    
    </div>

</section>
 
 

</div>

</div>

<?php get_footer($CORE->pageswitch()); ?>