<?php
/*
	Simplify Theme's Front Page
	Simplify Theme's Front Page to Display the Home Page if Selected
	Copyright: 2012-2016, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since Simplify 1.0
*/
 
get_header(); ?>
<div id="header-bottom"> </div>
<div id="container">
<h1 id="heading"><?php echo esc_textarea(simplify_get_option('heading-text', __('Welcome to the World of Creativity!','simplify'))); ?></h1>
<p class="heading-desc"><?php echo esc_textarea(simplify_get_option('heading-des', __('WordPress is web software you can use to create a beautiful website or blog. We like to say that WordPress is both free and priceless at the same time.','simplify'))); ?></p>

<div id="slide-container">
<div id="slide">
<img src="<?php echo esc_url(simplify_get_option('banner-image', get_template_directory_uri() . '/images/slide-image/slide-image1.jpg')); ?>"/>
<?php if ( esc_url(simplify_get_option('slide-image', get_template_directory_uri() . '/images/slide-image/slide-image2.jpg')) != '' ) : ?>
<img src="<?php echo esc_url(simplify_get_option('slide-image', get_template_directory_uri() . '/images/slide-image/slide-image2.jpg')); ?>"/>
<?php endif; ?>
<?php if ( esc_url(simplify_get_option('extra-image', get_template_directory_uri() . '/images/slide-image/slide-image3.jpg')) != '' ) : ?>
<img src="<?php echo esc_url(simplify_get_option('extra-image', get_template_directory_uri() . '/images/slide-image/slide-image3.jpg')); ?>"/>
<?php endif; ?>
</div>
</div> <!-- slide-container -->


<?php get_template_part( 'featured-box' ); ?>

<br /><br /><div class="clear"></div><div class="content-ver-sep"></div><br />

<?php if (esc_html(simplify_get_option('fpost', '0')) != '1'):  get_template_part( 'front-page-blog' ); endif;?> 

<?php if ( esc_textarea(simplify_get_option('bottom-quotation', __('All the developers of D5 Creation have come from the disadvantaged part or group of the society. All have established themselves after a long and hard struggle in their life ----- D5 Creation Team','simplify'))) != '' ) : ?>

<div id="customers-comment">
<blockquote><?php echo esc_textarea(simplify_get_option('bottom-quotation', __('All the developers of D5 Creation have come from the disadvantaged part or group of the society. All have established themselves after a long and hard struggle in their life ----- D5 Creation Team','simplify'))); ?></blockquote>
</div>
<?php endif; ?>

<?php get_footer(); ?>