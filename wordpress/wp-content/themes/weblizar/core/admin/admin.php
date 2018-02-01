<?php if (!function_exists('weblizar_info_page')) {
	function weblizar_info_page() {
	$page1=add_theme_page(__('Welcome to Weblizar', 'weblizar'), __('Pro Themes & Plugin', 'weblizar'), 'edit_theme_options', 'weblizar', 'weblizar_display_theme_info_page');
	
	add_action('admin_print_styles-'.$page1, 'weblizar_admin_info');
	}	
}
add_action('admin_menu', 'weblizar_info_page');

function weblizar_admin_info(){
	// CSS
	wp_enqueue_style('bootstrap',  get_template_directory_uri() .'/css/bootstrap.min.css');
	wp_enqueue_style('admin',  get_template_directory_uri() .'/core/admin/admin.css');
	wp_enqueue_style('font-awesome',  get_template_directory_uri() .'/css/font-awesome-4.7.0/css/font-awesome.css');
	//JS
	wp_enqueue_script('bootstrap-js', get_template_directory_uri().'/js/menu/bootstrap.min.js');
	wp_enqueue_script('script-menu', get_template_directory_uri().'/js/menu/menu.js');
	
} 
if (!function_exists('weblizar_display_theme_info_page')) {
	function weblizar_display_theme_info_page() {
		$theme_data = wp_get_theme(); ?>
		
<div class="wrapper">
<!-- Header -->
<header>
<div id="snow"></div>
<div class="container-fluid p_header">
	<div class="container">
		<div class="row p_head">
		<div class="col-md-4"></div>
			<div class="col-md-4">

	<img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" class="img-responsive" alt=""/>
</div>
<div class="col-md-4"></div>	
		</div>
		</div>
		</div>
	
<nav class="navbar navbar-default menu">
		<div class="container-fluid">
			<div class="container">
				<div class="row spa-menu-head">
					<div class="navbar-header">
					  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>                        
					  </button>
					</div>
					<div class="collapse navbar-collapse" id="myNavbar">
						<ul class="nav navbar-nav">
							<li class="theme-menu active" id="theme"><button class="btn tp">Themes</button></li>
							<li class="theme-menu" id="plugin"><button class="btn tp">Plugins</button></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</nav>
</header>
<!-- Header -->
<!-- Themes & Plugin -->
<div class="container-fluid space p_front theme active">
	<div class="container">	
		<div class="row p_head theme">
			<div class="col-xs-12 col-md-8 col-sm-6">
				<h1 class="section-title">WordPress Themes</h1>
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/corporal.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Corporal- Ultimate Multi-Purpose WordPress Theme</a></h2>
						<p><strong>Tags: </strong>clean, responsive, portfolio, blog, e-commerce, Business,
						WordPress, Corporate, dark, real estate, shop, restaurant, ele…</p>
						<div>
						<p><strong>Description: </strong>
						Corporal Premium  is a responsive and fully customizable template for Business and Multi-purpose theme.
						The Theme has You can use it for your business, portfolio, blogging or any type of site.Custom menus to 
						choose the menu in Primary Location that is in Header area of the site. </div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>25</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="http://demo.weblizar.com/corporal-premium/">Demo</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/corporal-premium">Buy Now</a>
				</div>			
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/explora.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Explora- Ultimate Multi-Purpose WordPress Theme</a></h2>
						<p><strong>Tags: </strong>clean, responsive, portfolio, blog, e-commerce, Business,
						WordPress, Corporate, dark, real estate, shop, restaurant, ele…</p>
						<div>
						<p><strong>Description: </strong>
						Explora Premium is a multi-purpose responsive theme coded & designed with a lot of care and love. You can use it
						for your business, portfolio, blogging or any type of site. </div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>25</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="http://demo.weblizar.com/explora-premium/">Demo</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/explora-premium">Buy Now</a>
				</div>			
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/BeautySpa.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">BeautySpa- Beauty Salon Theme</a></h2>
						<p><strong>Tags: </strong>Customize Front Page, Multilingual, Complete Documentation, Theme Option Panel, Unlimited Color Skins, Multiple Background Patterns, Multiple Theme Templates, 5 Portfolio Layout, 3 Page Layout and many more.</p>
					<div>
						<p><strong>Description: </strong>
						BeautySpa is versatile business WordPress theme suitable for spa, spa salon, sauna, massage , medical business, massage center, beauty center, eCommerce and beauty salon websites.</p>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>39</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="http://demo.weblizar.com/beautyspa-premium/">Demo</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/themes/beautyspa-premium/">Buy Now</a>
				</div>			
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/Scorline.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Scoreline- Business and Multi-purpose Theme</a></h2>
						<p><strong>Tags: </strong>clean, responsive, portfolio, blog, e-commerce, Business,
						WordPress, Corporate, dark, real estate, shop, restaurant, ele</p>
						<div>
						<p><strong>Description: </strong>
						Scoreline is a responsive and fully customizable template for Business and Multi-purpose theme.The Theme has You can use it for your business, portfolio, blogging or any type of site.</p>
						</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>29</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="http://demo.weblizar.com/scoreline-premium/">Demo</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/themes/scoreline-premium/">Buy Now</a>
				</div>			
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/Weblizar.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Weblizar- Responsive WordPress Theme</a></h2>
						<p><strong>Tags: </strong>Clean, Responsive, e-commerce, Business, Option Panel,
						WordPress, Corporate, Restaurant, Isotop Effects.</p>
						<div>
						<p><strong>Description: </strong>
						Weblizar Premium theme is a super professional one page WordPress theme for modern businesses. It is cross-browser compatible, fully responsive, and retina ready.</p>
						</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>29</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="https://weblizar.com/themes/weblizar-premium-theme/">Detail</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/themes/weblizar-premium-theme/">Buy Now</a>
				</div>
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/Green lantern.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Green Lantern- Ultimate Multi-Purpose WordPress Theme</a></h2>
						<p><strong>Tags: </strong>Responsive, Portfolio, Blog, e-commerce, Business,
						WordPress, Corporate, Custom Shortcode, Multilingual.</p>
						<div>
						<p><strong>Description: </strong>
						Introducing Green-Lantern, a premium WordPress theme. With its light and clean design it is a smart choice for big companies, smaller businesses and freelancers.</p>
						</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>29</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="https://weblizar.com/themes/green-lantern-premium-theme/">Detail</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/themes/green-lantern-premium-theme/">Buy Now</a>
				</div>
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/Creative.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Creative- Multi-Purpose WordPress Theme</a></h2>
						<p><strong>Tags: </strong>Awesome Slider, Filterable Portfolio, Beautiful Galleries, Multiple Background Patterns, Rich Color Changer, Light/Dark Color Skins, Boxed/wide layout styles, Additional page options.</p>
						<div>
						<p><strong>Description: </strong>
						Creative is one of our most customizable and flexible themes, you can create practically unlimited versions of your website, your imagination is the only limit.</p>
						</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>39</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="https://weblizar.com/themes/creative-premium/">Detail</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/themes/creative-premium/">Buy Now</a>
				</div>				
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/Chronicle.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Chronicle- Beautifully Designed Theme</a></h2>
						<p><strong>Tags: </strong>Unlimited Color Skins, Multiple Background Patterns, Multiple Theme Templates, Isotop Effects, Custom Shortcode.</p>
						<div>
						<p><strong>Description: </strong>
						Chronicle is a Full Responsive Multi-Purpose Theme suitable for Business , corporate office and others .Cool Blog Layout and full width page also present.</p>
						</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>35</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="https://weblizar.com/themes/chronicle-premium-theme/">Detail</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/themes/chronicle-premium-theme/">Buy Now</a>
				</div>
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/Enigma.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Enigma- Modern & Clean Designed Multi-Purpose WordPress Theme</a></h2>
						<p><strong>Tags: </strong>clean, responsive, portfolio, blog, e-commerce, Business,
						WordPress, Corporate, dark, real estate, shop, restaurant.</p>
						<div>
						<p><strong>Description: </strong>
						Enigma is a Full Responsive Multi-Purpose Theme suitable for Business , corporate office and others .Cool Blog Layout and full width page also present.</p>
						</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>39</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="https://weblizar.com/themes/enigma-premium/">Detail</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/themes/enigma-premium/">Buy Now</a>
				</div>			
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/Healthcare.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Healthcare- Medical & Multi-Purpose WordPress Theme</a></h2>
						<p><strong>Tags: </strong>Team , Doctors template & Details, Dr. Departments & Detail View, 3 Contact Page Template, Custom Shortcodes, Woo-commerce compatibility, 2 Home page Template, Wordpress.</p>
						<div>
						<p><strong>Description: </strong>
						Healthcare is a perfect solution for any medical and healthcare-related businesses. It is a fully dynamic, well structured and beautiful WordPress theme which is specifically designed for hospitals, health clinics, dentists and everyone else involved in health services.</p>
						</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>39</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="https://weblizar.com/themes/healthcare/">Detail</a>
					<a class="btn btn-success btn-lg" href="http://demo.weblizar.com/healthcare-premium/">Buy Now</a>
				</div>				
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/Incredible.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Incridible- Responsive and Flexible Theme</a></h2>
						<p><strong>Tags: </strong>Clean, Responsive, Portfolio, Blog, e-commerce, Business,
						WordPress, Corporate, Multiple Templates, shop, restaurant, business.</p>
						<div>
						<p><strong>Description: </strong>
						Incredible Premium  is an incredibly superfine multipurpose responsive theme coded & designed with a lot of care and love. You can use it for your business, portfolio, blogging or any type of site.</p>
						</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>19</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="https://weblizar.com/themes/incredible-premium-theme/">Detail</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/themes/incredible-premium-theme/">Buy Now</a>
				</div>
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/Guardian.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Guardian- Corporate Business Theme</a></h2>
						<p><strong>Tags: </strong>Multiple Background Patterns, Rich color changer, Boxed/wide layout styles, Additional Page, WPML & Woo Commerce.</p>
						<div>
						<p><strong>Description: </strong>
						Guardian Premium Theme is a super professional one page WordPress theme for modern businesses. Ideal for creative agencies, startups, small businesses, and freelancers and best of all it is so easy to use that you can have your website up in minutes.</p>
						</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>39</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="https://weblizar.com/themes/guardian-premium-theme/">Detail</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/themes/guardian-premium-theme/">Buy Now</a>
				</div>
			</div>
		</div>
	</div>
</div>
<!----Plugin----->
<div class="container-fluid space p_front plugin">
	<div class="container">
		<div class="row p_head theme">
			<div class="col-xs-12 col-md-8 col-sm-6">
				<h1 class="section-title">WordPress Plugins</h1>
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/Search-Engine-Optimizer-new.jpg" class="img-responsive" alt="Coming-Soon-Page"/>
					
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">SEO Image Optimizer Pro </a></h2>
						<p><strong>Features: </strong>
						<ul>
						<li>WooCommerce Product Images SEO</li>
						<li>Auto Fill Title & Alt Tag</li>
						<li>Custom Title & Alt Tag</li>
						<li>Featured Images SEO</li>
						<li>Magical Reset</li>
						<li>Delimiter Removal</li>
						<li>Image Compression</li>
						<li>Site Speed Up</li>
						</ul>
						</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number"><span>$11</span></span>
				</div>
				<div class="btn-group-vertical">
					<a target="_blank" class="btn btn-primary btn-lg" href="http://demo.weblizar.com/seo-image-optimizer-pro/">Demo</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/seo-image-optimizer-pro">Buy Now</a> 
				</div>			
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/newsletter.png" class="img-responsive" alt="Coming-Soon-Page"/>
					
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Newsletter Subscription Form Pro </a></h2>
						<p><strong>Features: </strong>
						<ul>
						<li>Multiple Pro Template</li>
						<li>News Letter Subscription</li>
						<li>Download Subscriber List</li>
						<li>Auto & Manual Notification</li>
						<li>Major Browser Compatible</li>
						<li>Multi Site and Multilingual</li>
						<li>Customized Form</li>
						<li>Forms shotcode</li>
						</ul>
						</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number"><span>$7</span></span>
				</div>
				<div class="btn-group-vertical">
					<a target="_blank" class="btn btn-primary btn-lg" href="http://demo.weblizar.com/newsletter-subscription-form-pro/">Demo</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/newsletter-subscription-form-pro">Buy Now</a> 
				</div>			
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/Comingsoon.jpg" class="img-responsive" alt="Coming-Soon-Page"/>
					
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Responsive Coming Soon Page</a></h2>
						<p><strong>Features: </strong>
						<ul>
						<li>Bootstrap Based Responsive Plugin Settings Panel</li>
						<li>Compatible With Most WordPress Theme</li>
						<li>Image background</li>
						<li>Color background</li>
						<li>Multiple Color Skins Selection</li>
						<li>News Letter Subscriber Forms</li>
						<li>Subscriber Notification</li>
						<li>Export & Import Subscribers List</li>
						</ul>
						</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number"><span>$24</span></span>
				</div>
				<div class="btn-group-vertical">
					<a target="_blank" class="btn btn-primary btn-lg" href="http://demo.weblizar.com/coming-soon-page-pro/">Demo</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/plugins/coming-soon-page-maintenance-mode-pro/">Buy Now</a>
				</div>			
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/about-author.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">About Author Pro- Display Profile In Various Style</a></h2>
						<p><strong>Features: </strong>
						<ul>
						<li>Author Design Templates</li>
						<li>Social Media Profiles</li>
						<li>General & Google Fonts</li>
						<li>Multiple Author Image Layout</li>
						<li>Responsive Design</li>
						<li>Multiple Author Widgets</li><li>Multiple Author Shortcode, and many more..</li>
						</ul>
						</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>15</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="http://demo.weblizar.com/about-author-pro/">Demo</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/plugins/about-author-pro/">Buy Now</a>
				</div>			
			</div>
		</div>
		
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/gallery-pro.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Gallery Pro- Gallery Layout with Various Fonts</a></h2>
						<p><strong>Features: </strong>
						<ul>
						<li>Gallery Layout</li>
						<li>Color Scheme</li>
						<li>Light Box</li>
						<li>All Gallery Shortcode</li>
						<li>Single Gallery Shortcode</li> 
						<li>Number of Gallery Layout</li>
						<li>Number of Hover Color and so on..</li>
						</ul>
						</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>9</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="http://demo.weblizar.com/gallery-pro-by-weblizar/">Demo</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/plugins/gallery-pro/">Buy Now</a>
				</div>			
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/instagram-gallery-pro.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Instagram Gallery Pro- Display Instagram Images</a></h2>
						<p><strong>Features: </strong>
						<ul>
						<li>Responsive Design<li>
						<li>Animation Effects</li>
						<li>Number of LightBox Style</li>
						<li>Number of Gallery Layout</li>
						<li>Image Style Layout</li>
						<li>Profile Backgound Image Option</li>
						<li>Multiple Instagram Shortcode etc..</li>
						</ul>
						</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>15</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="http://demo.weblizar.com/instagram-gallery-pro-demo/">Demo</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/plugins/instagram-gallery-pro/">Buy Now</a>
				</div>			
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/ultimate-image-pro.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Ultimate Responsive Image Slider Pro- Perfect Responsive Image Slider Plugin</a></h2>
						<p><strong>Features: </strong>
						<ul>
						<li>Responsiveness</li>
						<li>Full Screen Slideshow</li>
						<li>Thumbnail Slider</li>
						<li>All Gallery Shortcode</li>
						<li>Drag and Drop image Position</li>
						<li>Shortcode Button on post or page and so on..</li>
						</ul>
						</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>21</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="http://demo.weblizar.com/ultimate-responsive-image-slider-pro/">Demo</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/plugins/ultimate-responsive-image-slider-pro/">Buy Now</a>
				</div>			
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/photo-pro.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Photo Video Link Gallery Pro- Display Hover Animation & Lightbox</a></h2>
						<p><strong>Features: </strong>
						<ul>
						<li>Image Hover Animation</li>
						<li>Single Gallery Shortcode</li>
						<li>Number of Hover Animation</li>
						<li>Number of Gallery Layout</li>
						<li>Shortcode Button on post or page</li>
						<li>Video Gallery and many more..</li>
						</ul>
						</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>16</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="http://demo.weblizar.com/photo-video-link-gallery-pro/">Demo</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/plugins/photo-video-link-gallery-pro/">Buy Now</a>
				</div>			
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/flicker-pro.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Flickr Album Gallery Pro- Plublish Flickr Albums On WordPress Blog Site</a></h2>
						<p><strong>Features: </strong>
						<ul>
						<li>Image Hover Animation</li>
						<li>All Gallery Shortcode</li>
						<li>Single Gallery Shortcode</li>
						<li>Number of Hover Animation</li>
						<li>Number of Light Styles</li>
						<li>Unique settings for each gallery and so on..</li>
						</ul>
						</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>15</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="http://demo.weblizar.com/flickr-album-gallery-pro/">Demo</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/plugins/flickr-album-gallery-pro/">Buy Now</a>
				</div>			
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/responsive-pro.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Responsive Portfolio Pro- Perfect Responsive Portfolio Plugin</a></h2>
						<p><strong>Features: </strong>
						<ul>
						<li>Image Hover Animation</li>
						<li>Number of Hover Color</li>
						<li>Number of Font Style</li>
						<li>Number of Lightbox Styles</li>
						<li>Drag and Drop image Position</li>
						<li>Multiple Image uploader and so on..<li>
						</ul>
						</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>19</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="http://demo.weblizar.com/responsive-portfolio-pro/">Demo</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/plugins/responsive-portfolio-pro/">Buy Now</a>
				</div>			
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/lightbox-pro.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Lightbox Slider Pro- A Complete Lightbox Gallery Plugin</a></h2>
						<p><strong>Features: </strong>
						<ul>
						<li>Gallery Layout</li>
						<li>Hover Color</li>
						<li>Hover Color Opacity</li>
						<li>Caption Font Style</li>
						</li>Light Box</li>
						<li>All Gallery Shortcode</li>
						<li>Single Gallery Shortcode, and many more..</li>
						</ul>
						</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>12</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="http://demo.weblizar.com/lightbox-slider-pro-demo/">Demo</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/plugins/lightbox-slider-pro/">Buy Now</a>
				</div>			
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/responsive-photo-pro.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Responsive Photo Gallery Pro- A Highly Animated Image Gallery Plugin</a></h2>
						<p><strong>Features: </strong>
						<ul>
						<li>Number of Lightbox Styles</li>
						<li>Drag and Drop image Position</li>
						<li>Multiple Image uploader</li>
						<li>Shortcode Button on post or page</li>
						<li>Unique settings for each gallery</li>
						<li>Hide/Show gallery Title and label and so on..</li>
						</ul>
						</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>10</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="http://demo.weblizar.com/responsive-photo-gallery-pro/">Demo</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/plugins/responsive-photo-gallery-pro/">Buy Now</a>
				</div>			
			</div>
		</div>
		<div class="row p_plugin blog_gallery">
			<div class="col-xs-12 col-sm-4 col-md-5 p_plugin_pic">
				<div class="img-thumbnail">
					<img src="<?php echo get_template_directory_uri(); ?>/images/recent-post-pro.jpg" class="img-responsive" alt=""/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 p_plugin_desc">
				<div class="row p-box">
					<h2><a href="">Recent Related Post And Page WordPress Plugin- Fully Responsive Plugin For WordPress Blog</a></h2>
						<p><strong>Features: </strong>
						<ul>
						<li>Multiple Template</li>
						<li>select feature image</li>
						<li>8 Border style</li>
						<li>8 post Status, 2 Post Type</li>
						<li>500+ Google Font for Template and many more..</li>
						</ul>
						</p>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 col-md-2 p_plugin_pic">
				<div class="price">
					<span class="currency">USD</span>
					<span class="price-number">$<span>10</span></span>
				</div>
				<div class="btn-group-vertical">
					<a class="btn btn-primary btn-lg" href="http://demo.weblizar.com/recent-related-post-and-page-pro/">Demo</a>
					<a class="btn btn-success btn-lg" href="https://weblizar.com/plugins/recent-related-post-and-page-pro/">Buy Now</a>
				</div>			
			</div>
		</div>
	</div>
</div>
	<div id="theme-author">
		<p><?php printf(__('%1s is proudly brought to you by %2s. If you like this WordPress theme, %3s.', 'weblizar'),
			$theme_data->Name,
			'<a target="_blank" href="https://weblizar.com/" title="weblizar">Weblizar</a>',
			'<a target="_blank" href="https://wordpress.org/support/view/theme-reviews/weblizar" title="Weblizar Review">' . __('rate it', 'weblizar') . '</a>'); ?>
		</p>
	</div>
</div>
<?php
	}
}
?>