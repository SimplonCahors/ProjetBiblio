<?php
/* 	Simplify Theme's Featured Box to show the Featured Items of Front Page
	Copyright: 2012-2016, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since Simplify 1.0
*/
?>

<div id="featured-boxs">

<span class="featured-box-first"><h2><?php echo esc_textarea(simplify_get_option('featuredr-title', __('Recent Works','simplify'))); ?></h2><div class="content-ver-sep"></div><br /><p><?php echo esc_textarea(simplify_get_option('featuredr-description',  __('The Color changing options of Simplify will give the WordPress Driven Site an attractive look.','simplify'))); ?></p></span>
<?php 
foreach (range(1, 3) as $fboxn) { ?>
<span class="featured-box"> 
<a href="<?php echo esc_url(simplify_get_option('featured-link' . $fboxn, '#')); ?>" >
<img class="box-image" src="<?php echo esc_url(simplify_get_option('featured-image' . $fboxn, get_template_directory_uri() . '/images/featured-image' . $fboxn . '.jpg')) ?>"/>
<h3><?php echo esc_textarea(simplify_get_option('featured-title' . $fboxn,  __('Simplify Theme for Small Business','simplify'))); ?></h3>
</a>
<div class="content-ver-sep"></div><br />
<p><?php echo wp_kses_post(simplify_get_option('featured-description' . $fboxn ,  __('The Color changing options of Simplify will give the WordPress Driven Site an attractive look. Simplify is super elegant and Professional Responsive Theme which will create the business widely expressed.','simplify'))); ?></p>
</span>

<?php }  


if ( esc_html(simplify_get_option('srfbox', '1')) == '1' ): echo '<div class="clear"></div><br /><div class="lsep"></div><br /><br />'; ?>
<br /><span class="featured-box-first"><h2><?php echo esc_textarea(simplify_get_option('featuredr2-title', __('Our Services','simplify'))); ?></h2><div class="content-ver-sep"></div><br /><p><?php echo esc_textarea(simplify_get_option('featuredr2-description', __('Simplify is super elegant and Professional Responsive Theme which will create the business widely expressed.','simplify'))); ?></p></span>
<?php  foreach (range(1, 3) as $fboxn2) { ?>
<span class="featured-box">
<a href="<?php echo esc_url(simplify_get_option('featured-link2' . $fboxn2, '#')); ?>" > 
<img class="box-icon" src="<?php echo esc_url(simplify_get_option('featured-image2' . $fboxn2, get_template_directory_uri() . '/images/featured-image' . $fboxn2 . '.png')) ?>"/>
<h3 class="featured-box2"><?php echo esc_textarea(simplify_get_option('featured-title2' . $fboxn2, __('Simplify Theme for Business','simplify'))); ?></h3>
</a>
<div class="clear"> </div>
<p><?php echo wp_kses_post(simplify_get_option('featured-description2' . $fboxn2 , __('Simplify is super elegant and Professional Responsive Theme which will create the business widely expressed. The Color changing options of Simplify will give the WordPress Driven Site an attractive look.','simplify'))); ?></p>

</span>

<?php }  ; endif; ?>



</div> <!-- featured-boxs -->