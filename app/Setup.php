<?php
namespace CranleighSchool\CranleighBlogs;

class Setup {
	use BaseClass;
	
	public function __construct() {
		$settings = new SettingsAPI();
		RemoveParentThemeSettings::run();
		RemoveComments::run();
		CallThemPosts::run();
		self::add_menu_to_header();
		
		add_action( 'wp_enqueue_scripts', array(__CLASS__, 'enqueue'), 11);
	}
	
	public static function enqueue() {
		wp_enqueue_style( 'blogs-default-theme', get_stylesheet_uri(), array(), time() );
	}
	
	public static function add_menu_to_header() {
		add_action( 'after_setup_theme', function() {
			register_nav_menu('blog-primary', __('Blog Primary Menu', 'cranleigh-2016'));
		});
		add_filter('cranleigh_header_end', array(__CLASS__, 'display_menu_in_header'));
	}
	
	public static function display_menu_in_header($current_content) {
		if (has_nav_menu( 'blog-primary' )):
		ob_start();
		?>
		<nav role="navigation" aria-expanded="false" class="navbar navbar-default primary-navbar">
			<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#blog-primary-navbar-collapse" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
    			</div>

				<!-- Collect the nav links, forms, and other content for toggling -->

			    <?php 
				    wp_nav_menu([
					    "theme_location" => "blog-primary",
					    "menu_class" => "nav navbar-nav navbar-nav-justify",
					    "container_class" => "collapse navbar-collapse",
					    "container_id" => "blog-primary-navbar-collapse"
				   ]); 
				?>

			</div><!-- /.container-fluid -->
		</nav>
	<?php
		endif;
		$contents = ob_get_contents();
		ob_end_clean();
		return $current_content.$contents;
	}
	
}
