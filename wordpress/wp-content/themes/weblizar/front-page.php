<?php get_header(); $wl_theme_options = weblizar_get_options();
if ($wl_theme_options['_frontpage']=="on" && is_front_page()) { ?>
<!-- Carousel
    ================================================== -->
	<?php  if($wl_theme_options['slider_image_speed']!='')
	{
		
	echo '<script type="text/javascript">
		jQuery(document ).ready(function( $ ) {
		jQuery("#myCarousel" ).carousel({
			interval:'.$wl_theme_options['slider_image_speed'].'

		    });
	   });
	</script>';
	 
	} ?>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>        
        <li data-target="#myCarousel" data-slide-to="2"></li>        
      </ol>
      <div class="carousel-inner">
	  <?php $wl_theme_options = weblizar_get_options();
		$ImageUrl1 = WL_TEMPLATE_DIR_URI ."/images/slide-1.jpg";
		$ImageUrl2 = WL_TEMPLATE_DIR_URI ."/images/slide-2.jpg";
		$ImageUrl3 = WL_TEMPLATE_DIR_URI ."/images/slide-3.jpg";  ?>
        <div class="item active">
			<?php if($wl_theme_options['slide_image']!='') {  ?>
          <img src="<?php echo $wl_theme_options['slide_image']; ?>" class="img-responsive" alt="First slide">
          <?php } else { ?>
		  <img src="<?php echo $ImageUrl1 ?>" class="img-responsive" alt="First slide">
		  <?php } ?>		  
		  <div class="container">
            <div class="carousel-caption">
			<?php if($wl_theme_options['slide_title']!='') {  ?>
              <h1 class="weblizar_slide_title"><?php echo $wl_theme_options['slide_title']; ?></h1>
			<?php } 	
			 if($wl_theme_options['slide_desc']!='') {  ?>
			 <p class="weblizar_slide_desc"><?php echo $wl_theme_options['slide_desc']; ?></p>
			 <?php }
				if($wl_theme_options['slide_btn_text']!='') { ?>
              <p class="weblizar_slide_btn_text"><a class="btn btn-lg btn-primary" href="<?php if($wl_theme_options['slide_btn_link']!='') { echo $wl_theme_options['slide_btn_link']; } ?>" role="button"><?php echo $wl_theme_options['slide_btn_text']; ?></a></p>
			  <?php } ?>
            </div>
          </div>
        </div>		
        <div class="item">		
			<?php if($wl_theme_options['slide_image_1']!='') {  ?>
          <img src="<?php echo $wl_theme_options['slide_image_1']; ?>" class="img-responsive" alt="Second slide">
          <?php } else { ?>
		  <img src="<?php echo $ImageUrl2 ?>" class="img-responsive" alt="Second slide">
		  <?php } ?>
          <div class="container">
            <div class="carousel-caption">
			<?php if($wl_theme_options['slide_title_1']!='') {  ?>
              <h1 class="weblizar_slide_title_1"><?php echo $wl_theme_options['slide_title_1']; ?></h1>
			<?php } 	
			 if($wl_theme_options['slide_desc_1']!='') {  ?>
			 <p class="weblizar_slide_desc_1"><?php echo $wl_theme_options['slide_desc_1']; ?></p>
			 <?php }
				if($wl_theme_options['slide_btn_text_1']!='') { ?>
              <p class="weblizar_slide_btn_text_1"><a class="btn btn-lg btn-primary" href="<?php if($wl_theme_options['slide_btn_link_1']!='') { echo $wl_theme_options['slide_btn_link_1']; } ?>" role="button"><?php echo $wl_theme_options['slide_btn_text_1']; ?></a></p>
			  <?php } ?>
            </div>
          </div>
        </div>
		<div class="item">		
			<?php if($wl_theme_options['slide_image_2']!='') {  ?>
          <img src="<?php echo $wl_theme_options['slide_image_2']; ?>" class="img-responsive" alt="Third slide">
          <?php } else { ?>
		  <img src="<?php echo $ImageUrl3 ?>" class="img-responsive" alt="Third slide">
		  <?php } ?>
          <div class="container">
            <div class="carousel-caption">
			<?php if($wl_theme_options['slide_title_2']!='') {  ?>
              <h1 class="weblizar_slide_title_2"><?php echo $wl_theme_options['slide_title_2']; ?></h1>
			<?php } 	
			 if($wl_theme_options['slide_desc_2']!='') {  ?>
			 <p class="weblizar_slide_desc_2"><?php echo $wl_theme_options['slide_desc_2']; ?></p>
			 <?php }
				if($wl_theme_options['slide_btn_text_2']!='') { ?>
              <p class="weblizar_slide_btn_text_2"><a class="btn btn-lg btn-primary" href="<?php if($wl_theme_options['slide_btn_link_2']!='') { echo $wl_theme_options['slide_btn_link_2']; } ?>" role="button"><?php echo $wl_theme_options['slide_btn_text_2']; ?></a></p>
			  <?php } ?>
            </div>
          </div>
        </div>
		
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div><!-- /.carousel -->
<div class="content-wrapper">    
	<div class="body-wrapper">
	<?php 
	if($sections = json_decode(get_theme_mod('home_reorder'),true)) {
		  foreach ($sections as $section) {
			$data =$section.'_home';
			if($wl_theme_options[$data]=="on") {
			get_template_part('home', $section);
			}
		}
	} else {
		if($wl_theme_options['service_home']=='on') {
		get_template_part('home','service'); 
		}
		if($wl_theme_options['blog_home']=='on') {
		get_template_part('home','blog');
		}
	} ?>			
	</div>
</div><!--.content-wrapper end -->
<style>
ul.post-footer {
	text-align: center;
	list-style: none;
	margin-top: 50px;
}
.item {
  margin-bottom: 30px;
}
a.append-button.btn.btn-color{
	background-color: #3498db;
	border: 1px solid transparent;
	color: #fff;
	font-size: 21px;
	border-radius: 6px;
	line-height: 1.4;
}
a.append-button.btn.btn-color:hover {
  opacity: 0.9;
  color: #fff;
}
</style>
<?php get_footer(); 
}
else 
if(is_page()) { 
get_template_part('page'); 
} else { 
get_template_part('index'); 
}	
?>