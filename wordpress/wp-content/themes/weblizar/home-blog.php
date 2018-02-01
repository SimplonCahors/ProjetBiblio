	<?php $wl_theme_options = weblizar_get_options(); ?>
		<!-- blog section -->
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="center-title">
						<?php 
							if($wl_theme_options['blog_title']) { ?>
						<div class="heading-title">
							<h2 class="h2-section-title weblizar_blog_title"><?php echo $wl_theme_options['blog_title']; ?></h2>
						</div>
						<?php } ?>
						<?php if($wl_theme_options['blog_text']) { ?>
						<p class="weblizar_blog_text"><?php echo get_theme_mod('blog_text' , $wl_theme_options['blog_text']); ?> </p>
						<?php } ?>
						<div class="space-sep20"></div>
					</div>
				</div>
			</div>
			<div class="row masonry1">
			<?php
				$count_posts = wp_count_posts();
				$published_posts = $count_posts->publish;
				$args = array( 'post_type' => 'post', 'posts_per_page' =>-1,'ignore_sticky_posts' => 1);		
				$post_type_data = new WP_Query( $args );
				$i=1;
				while($post_type_data->have_posts()):
				$post_type_data->the_post();
				global $more;	$more = 0; ?>							
				<div class="col-md-4 col-sm-4" id="row-<?php echo $i; ?>">
					<div class="feature animated fadeIn animatedVisi" data-animtype="fadeIn" data-animrepeat="0" data-animspeed="1s" data-animdelay="0s" style="-webkit-animation: 1s 0s;">
						<div class="feature-image img-overlay">							
							<?php if(has_post_thumbnail()): ?>
							<?php $default=array('class'=>'img-responsive'); 
								the_post_thumbnail('wl_blog_img', $default); ?>
							<?php endif; ?>		
						</div>			
						<div class="feature-content">
							<h3 class="h3-blog-title"><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?>	</a></h3>
							
								<p><?php echo substr(get_the_excerpt(),0,$wl_theme_options['excerpt_blog'] ); ?></p>
							
						</div>
						<div class="feature-details">
							<span><i class="fa fa-picture-o"></i></span>					
							<span><i class="fa fa-clock-o"></i><?php echo get_the_date('d M y'); ?></span>
							<span><i class="fa fa-user"></i><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author(); ?></a></span>					
						</div>		
					</div>
				</div>
			<?php if($i%3==0){ echo "<div class='clearfix'></div>"; } $i++; endwhile; ?>		
			</div>
			<ul class="post-footer post-btn1"><li><a class="append-button btn btn-color"><?php _e('Show More', 'weblizar'); ?></a></li></ul>
		</div>