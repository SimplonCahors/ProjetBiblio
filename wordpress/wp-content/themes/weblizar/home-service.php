	<?php $wl_theme_options = weblizar_get_options(); ?>
<!-- service section -->
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="center-title">
						<?php if($wl_theme_options['site_intro_title']!='') { ?>
						<div class="heading-title">
							<h2 class="h2-section-title weblizar_site_intro_title"><?php echo $wl_theme_options['site_intro_title']; ?></h2>
						</div>
						<?php } ?>
						<?php if($wl_theme_options['site_intro_text']!='') { ?>
						<p class="weblizar_site_intro_text"> <?php echo get_theme_mod('site_intro_text' , $wl_theme_options['site_intro_text']); ?></p>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<?php if($wl_theme_options['service_home'] == 'on') { ?>
		<div class="space-sep60"></div>	
		<div class="container">
			<div class="row">
				<?php if($wl_theme_options['service_1_title'] || $wl_theme_options['service_1_icons']) { ?>
				<div class="col-md-3 col-sm-3">
					<div class="content-box content-style2 anim-opacity animated fadeIn animatedVisi" data-animtype="fadeIn" data-animrepeat="0" data-animspeed="1s" data-animdelay="0.2s" style="-webkit-animation: 1s 0.2s;">	
						<?php if($wl_theme_options['service_1_title']) { ?>
						<h4 class="h4-body-title weblizar_service_1_title"><i class="fa <?php if($wl_theme_options['service_1_icons']) { echo $wl_theme_options['service_1_icons']; } ?> weblizar_service_1_icons"></i><?php echo $wl_theme_options['service_1_title'];   ?></h4>
						<?php } ?>
						<div class="content-box-text weblizar_service_1_text">
							<?php if($wl_theme_options['service_1_text']) { echo get_theme_mod('service_1_text' , $wl_theme_options['service_1_text']); } ?>
							<div><a href="<?php if($wl_theme_options['service_1_link']) { echo $wl_theme_options['service_1_link']; } ?>" class="read-more "><span><?php _e('read more', 'weblizar'); ?></span></a></div>
						</div>
					</div>
				</div>
				<?php } if($wl_theme_options['service_2_title'] || $wl_theme_options['service_2_icons']) { ?>
				<div class="col-md-3 col-sm-3">
					<div class="content-box content-style2 anim-opacity animated fadeIn animatedVisi" data-animtype="fadeIn" data-animrepeat="0" data-animspeed="1s" data-animdelay="0.2s" style="-webkit-animation: 1s 0.2s;">	
						<?php if($wl_theme_options['service_2_title']) { ?>
						<h4 class="h4-body-title weblizar_service_2_title"><i class="fa <?php if($wl_theme_options['service_2_icons']) { echo $wl_theme_options['service_2_icons']; } ?> weblizar_service_2_icons"></i><?php echo $wl_theme_options['service_2_title'];   ?></h4>
						<?php } ?>
						<div class="content-box-text weblizar_service_2_text">
							<?php if($wl_theme_options['service_2_text']) { echo apply_filters('the_content', get_theme_mod('service_2_text' , $wl_theme_options['service_2_text']), true); } ?>
							<div><a href="<?php if($wl_theme_options['service_2_link']) { echo $wl_theme_options['service_2_link']; } ?>" class="read-more "><span><?php _e('read more', 'weblizar'); ?></span></a></div>
						</div>
					</div>
				</div>
				<?php } if($wl_theme_options['service_3_title'] || $wl_theme_options['service_3_icons']) { ?>
				<div class="col-md-3 col-sm-3">
					<div class="content-box content-style2 anim-opacity animated fadeIn animatedVisi" data-animtype="fadeIn" data-animrepeat="0" data-animspeed="1s" data-animdelay="0.2s" style="-webkit-animation: 1s 0.2s;">	
						<?php if($wl_theme_options['service_3_title']) { ?>
						<h4 class="h4-body-title weblizar_service_3_title"><i class="fa <?php if($wl_theme_options['service_3_icons']) { echo $wl_theme_options['service_3_icons']; } ?> weblizar_service_3_icons"></i><?php echo $wl_theme_options['service_3_title'];   ?></h4>
						<?php } ?>
						<div class="content-box-text weblizar_service_3_text">
							<?php if($wl_theme_options['service_3_text']) { echo apply_filters('the_content', get_theme_mod('service_3_text' , $wl_theme_options['service_3_text']), true); } ?>
							<div><a href="<?php if($wl_theme_options['service_3_link']) { echo $wl_theme_options['service_3_link']; } ?>" class="read-more "><span><?php _e('read more', 'weblizar'); ?></span></a></div>
						</div>
					</div>
				</div>
				<?php } if($wl_theme_options['service_4_title'] || $wl_theme_options['service_4_icons']) { ?>
				<div class="col-md-3 col-sm-3">
					<div class="content-box content-style2 anim-opacity animated fadeIn animatedVisi" data-animtype="fadeIn" data-animrepeat="0" data-animspeed="1s" data-animdelay="0.2s" style="-webkit-animation: 1s 0.2s;">	
						<?php if($wl_theme_options['service_4_title']) { ?>
						<h4 class="h4-body-title weblizar_service_4_title"><i class="fa <?php if($wl_theme_options['service_4_icons']) { echo $wl_theme_options['service_4_icons']; } ?> weblizar_service_4_icons"></i><?php echo $wl_theme_options['service_4_title'];   ?></h4>
						<?php } ?>
						<div class="content-box-text weblizar_service_4_text">
							<?php if($wl_theme_options['service_4_text']) { echo apply_filters('the_content', get_theme_mod('service_4_text' , $wl_theme_options['service_4_text']), true); } ?>
							<div><a href="<?php if($wl_theme_options['service_4_link']) { echo $wl_theme_options['service_4_link']; } ?>" class="read-more "><span><?php _e('read more', 'weblizar'); ?></span></a></div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
		<?php } ?>
		<div class="space-sep60"></div>