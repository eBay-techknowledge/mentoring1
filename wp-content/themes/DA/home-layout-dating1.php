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
if (!defined('THEME_VERSION')) {    header('HTTP/1.0 403 Forbidden'); exit; }

global $CORE;

// GET HOME PAGE CUSTOM DATA
$HDATA = $GLOBALS['CORE_THEME']['hdata'];
 
// HEADER
get_header($CORE->pageswitch()); 

?> 
<?php if(!isset($GLOBALS['CORE_THEME']['home_section1']) || (isset($GLOBALS['CORE_THEME']['home_section1']) && $GLOBALS['CORE_THEME']['home_section1'] == '1' ) ){  ?>

<?php if(isset($GLOBALS['CORE_THEME']['homesliderid']) && $GLOBALS['CORE_THEME']['homesliderid'] != "" && $GLOBALS['CORE_THEME']['homeslider'] == 1 ){  

echo do_shortcode(stripslashes("[rev_slider ".$GLOBALS['CORE_THEME']['homesliderid']."]")); 

}else{ ?>

<!-- JUMBO TRON   -->
<style>
.home .jumbostyle1 .inner {
    max-width: 1000px; /* old 500px  */
}

.blue {
    color:#337ab7;
} 

.blue:hover {
    color:#337ab7;
} 

/*
.home .jumbostyle1 {
    background: grey;
}
*/


</style>



<div class="jumbostyle1 cols<?php echo $GLOBALS['CORE_THEME']['layout_columns']['homepage']; ?>" <?php if(isset($HDATA['j1']['img']) && $HDATA['j1']['img'] != ""){ echo 'style="background-image: url(\''.$HDATA['j1']['img'].'\'); background-size: cover;"'; } ?>>

    <div class="jumbotron" style='padding-top:25px'>
    
    <!--div class="inner"-->
           <div class='col-md-4' style="text-align:left; padding-top:100px;">
            <h1><?php //echo stripslashes($HDATA['j1']['title1']); ?>Mentoring Program</h1>
            
            <?php //echo wpautop(stripslashes($HDATA['j1']['title3'])); ?>Advance your future here at eBay or help others to grow in theirs
            </div>
            
            <div class='col-md-8' style="text-align:right; margin-top:25px;">
	        <iframe width="85%" height="401" src="https://drive.google.com/a/ebay.com/file/d/0BwXkWEZNCg-4S2FTYmVqQzlmYjg/preview" frameborder="0"></iframe>
       		<!--
		<iframe width="85%" height="401" src="http://www.powtoon.com/embed/f9SEzNNv7te/" frameborder="0"></iframe>
		-->
                
               
	    </div>
            
    </div>
     
    <!--/div-->

</div>

<?php } ?>

<?php } ?>



<!--
<?php if(!isset($GLOBALS['CORE_THEME']['home_section2']) || (isset($GLOBALS['CORE_THEME']['home_section2']) && $GLOBALS['CORE_THEME']['home_section2'] == '1' ) ){  ?>

<div id="car1" class="owl-carousel wlt_search_results grid_style style1">
<?php //echo do_shortcode('[LISTINGS dataonly=1 show=10]'); $GLOBALS['imagecount']=6; ?> 
</div>
<hr />
<script> 
jQuery(document).ready(function() {  
jQuery("#car1").owlCarousel({ items : 5, autoPlay : true,  }); 
});
</script>
<?php } ?>
-->



<?php if(!isset($GLOBALS['CORE_THEME']['home_section3']) || (isset($GLOBALS['CORE_THEME']['home_section3']) && $GLOBALS['CORE_THEME']['home_section3'] == '1' ) ){  ?>




<div class="row" style='margin-bottom:50px; margin-top:50px;'>
    <div class='row'>    
        <!--div class="col-md-4"> 
                <img src="http://localhost:8888/mentor2/wp-content/themes/DA/framework/img/mentor-circle.png">
        </div--> 
        <div class='md-col-12' style='text-align:center; margin-bottom:25px;'>
            <h2>The Importance of Mentoring</h2>
        </div>    
    </div>
    <div>

	<div class='col-md-6' style='text-align:center;'>
            <img src="http://techknowledge1-6339.phx01.dev.ebayc3.com/mentoring/wp-content/themes/DA/framework/img/mentor-words2.jpg" style="width:400px; height:400px;">   
      </div>

        <div class="col-md-6" style='font-size:28px; font-weight:lighter !important; line-height:40px;'>
              Mentoring can help you move forward in your career by utilizing the experience, perspectives and wisdom of others. Effective mentoring can also give you higher job satisfaction and increased work success. Use the new CPT Mentoring website to help you find a mentor or a mentee at eBay. All you need to do is Login and fill out your profile to get started. 
        </div>
        

    </div>
</div>




<!--  Video embed *************************************************************** -->
<div class="row" style='margin-bottom:50px; margin-top:50px;'>
     <!--<div class='col-md-12' style='text-align:center;'>
          <iframe width="64%" height="401" src="http://www.powtoon.com/embed/f9SEzNNv7te/" frameborder="0"></iframe>
     </div>-->
</div>




<!--  Layout with BOXES  ********************************************************    --
<div class="row" style='margin-bottom:100px; margin-top:50px;'>
    <div class="col-md-12" style="margin-bottom:25px; color:#606060;">

        <div class="col-md-1"></div>
        
        <div class="col-md-5" style='text-align:center; font-size:22px; font-weight:lighter !important; line-height:30px; color:#606060; border:1px solid #eee; padding:30px;'>
            <h2  style="margin-bottom:25px; color:#606060;">What does it mean to be a mentor</h2>
            <img src="http://techknowledge1-6339.phx01.dev.ebayc3.com/mentoring/wp-content/themes/DA/framework/img/mentor-people1.jpg" style="width:350px; height:150px;"></a><br><br>
            <p style="font-size:18px; font-weight:lighter !important; line-height:30px;">
                <ul style="text-align:left; font-size:18px; font-weight:lighter !important; line-height:30px;">
                <li>Quality conversations around career growth</li>
                <li>Enhance skills in coaching, counseling, listening</li>
                <li>New perspectives</li>
                <li>Opportunity to pass on unique expertise to others</li>
                 </ul>
            <a href="http://techknowledge1-6339.phx01.dev.ebayc3.com/mentoring/index.php/for-mentors/" class="blue">Learn more ></a><br>
            </p>
        </div>

        <div class="col-md-1"></div>

        <div class="col-md-5" style='text-align:center; font-size:22px; font-weight:lighter !important; line-height:30px; color:#606060; border:1px solid #eee; padding:30px;'>
            <h2  style="margin-bottom:25px; color:#606060;">What does it mean to be a mentee</h2>
            <img src="http://techknowledge1-6339.phx01.dev.ebayc3.com/mentoring/wp-content/themes/DA/framework/img/mentor-people4.jpg" style="width:350px; height:150px;"></a><br><br>
            <p style="font-size:18px; font-weight:lighter !important; line-height:30px;">
                <ul style="text-align:left; font-size:18px; font-weight:lighter !important; line-height:30px;">
                <li>Satisfaction, overall quality of experience</li>
                <li>Training, Best Practices </li>
                <li>Greater exposure – internal networking</li>
                <li>Give back once they gain special skills</li>
                 </ul>
            <a href="http://techknowledge1-6339.phx01.dev.ebayc3.com/mentoring/index.php/for-mentees/" class="blue">Learn more ></a><br>
            </p>
        </div>

        <div class="col-md-1"></div>

    </div>  
</div>
-->


<!--  Layout with straight ********************************************************  

<div class="row" style='margin-bottom:100px; margin-top:50px;'>
  
    <div class="col-md-12" style="text-align:center; margin-bottom:25px; color:#606060;">
        <h2>What does it mean to be a mentor</h2>
    </div>
    <div class="row" style="margin-bottom:100px;">
         <div class="col-md-4"> 
            <img src="http://localhost:8888/mentor2/wp-content/themes/DA/framework/img/mentor-people1.jpg" style="width:350px; height:150px;"></a>
        </div> 
        <div class="col-md-8" style='font-size:22px; font-weight:lighter !important; line-height:30px; color:#606060'>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.
            <br>
            <a href="http://techknowledge1-6339.phx01.dev.ebayc3.com/mentoring/index.php/mentor-program/" class="blue">Learn more ></a>
        </div>
    </div>  

    <hr>  
   
    <div class="col-md-12" style="text-align:center; margin-top:25px; margin-bottom:25px;">
        <h2 style="color:#606060; font-weight:300;">What does it mean to be a mentee</h2>
    </div>
    <div class="row">
         <div class="col-md-8" style='font-size:22px; font-weight:lighter !important; line-height:30px; color:#606060'>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent tempus eleifend risus ut congue. Pellentesque nec lacus elit. Pellentesque convallis nisi ac augue pharetra eu tristique neque consequat. Mauris ornare tempor nulla, vel sagittis diam convallis eget.
            <br>
            <a href="http://techknowledge1-6339.phx01.dev.ebayc3.com/mentoring/index.php/mentee-program/" class="blue">Learn more ></a> 
        </div>
        <div class="col-md-4"> 
            <img src="http://localhost:8888/mentor2/wp-content/themes/DA/framework/img/mentor-people4.jpg" style="width:350px; height:150px;"></a>
        </div> 
    </div>  
</div>
-->



<?php } ?>

<?php if(!isset($GLOBALS['CORE_THEME']['home_section3']) || (isset($GLOBALS['CORE_THEME']['home_section3']) && $GLOBALS['CORE_THEME']['home_section3'] == '1' ) ){  ?>

<!--
<div id="car2" class="owl-carousel wlt_search_results grid_style style1">
<?php //echo do_shortcode('[LISTINGS dataonly=1 show=10 custom="random"]'); $GLOBALS['imagecount']=6; ?> 
</div>
-->


<script> 
jQuery(document).ready(function() {  
jQuery("#car2").owlCarousel({ items : 5, autoPlay : true,  }); 
});
</script>
<?php } ?>

  

<?php get_footer($CORE->pageswitch()); ?>