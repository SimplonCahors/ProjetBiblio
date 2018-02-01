<?php
/* 	Simplify Theme's Footer
	Copyright: 2012-2016, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since Simplify 1.0
*/
?>


</div><!-- container -->
<div id="footer">

<div class="versep"></div>
<div id="footer-content">

<div id="social">
<?php  if (esc_url(simplify_get_option('facebook-link', '#')) !='') : ?>
<a href="<?php echo esc_url(simplify_get_option('facebook-link', '#')); ?>" class="facebook-link" target="_blank"></a>
<?php endif; if (esc_url(simplify_get_option('twitter-link', '#')) !='') : ?>
<a href="<?php echo esc_url(simplify_get_option('twitter-link', '#')); ?>" class="twitter-link" target="_blank"></a>
<?php endif; if (esc_url(simplify_get_option('youtube-link', '#')) !='') : ?>
<a href="<?php echo esc_url(simplify_get_option('youtube-link', '#')); ?>" class="youtube-link" target="_blank"></a>
<?php  endif; if (esc_url(simplify_get_option('gplus-link', '#')) !='') : ?>
<a href="<?php echo esc_url(simplify_get_option('gplus-link', '#')); ?>" class="gplus-link" target="_blank"></a>
<?php  endif; if (esc_url(simplify_get_option('picassa-link', '#')) !='') : ?>
<a href="<?php echo esc_url(simplify_get_option('picassa-link', '#')); ?>" class="picassa-link" target="_blank"></a>
<?php  endif; if (esc_url(simplify_get_option('li-link', '#')) !='') : ?>
<a href="<?php echo esc_url(simplify_get_option('li-link', '#')); ?>" class="li-link" target="_blank"></a>
<?php  endif; if (esc_url(simplify_get_option('feed-link', '#')) !='') : ?>
<a href="<?php echo esc_url(simplify_get_option('feed-link', '#')); ?>" class="feed-link" target="_blank"></a>
<?php  endif; ?>
</div>

<?php 	get_sidebar( 'footer' ); ?>
<div class="clear"></div>
<div id="creditline"><?php echo '&copy; ' . date("Y"). ': ' . get_bloginfo( 'name' ) . '  '; simplify_creditline(); ?></div>
</div> <!-- footer-content -->
</div> <!-- footer -->
<?php wp_footer(); ?>
</body>
</html>