<?php
/**
 * The template for displaying the homepage.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package cranleigh-2016
 */

get_header();
cranleigh_2016_hero_image();

	$cranleigh_settings = get_option("cranleigh_settings", array("welcome"=>"You can set this welcoming paragraph in "));

	if (!isset($cranleigh_settings['welcome'])) {
		$cranleigh_settings['welcome'] = "<p class=\"alert alert-warning\">You can set this welcoming paragraph in your 'Cranleigh Options' settings panel under 'Appearance' in your <a href=\"/wp-admin\" target=\"_blank\">Admin Panel</a></p>";
	}
?>
<div class="container">
	<div class="row">
		<div id="primary" class="col-sm-8 content-area">
			<main id="main" class="site-main" role="main">
				<div class="row border-bottom">
					<div class="col-md-12">
						<h2>Welcome to <?php bloginfo( 'name' ); ?></h2>
					</div>
	
					<div class="col-sm-12">
						<?php echo wpautop($cranleigh_settings['welcome']); ?>
					</div>
				</div>
				<?php
					if (!is_main_blog()): ?>
				<h2>Latest Posts</h2>
				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/archive/content', get_post_format() );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				else:
					echo "<h2>The Blogs that live here</h2>";
					echo "<ul>";
					foreach (get_sites( ['site__not_in' => [get_current_blog_id(  )]] ) as $blog) {
						$detail = get_blog_details($blog->blog_id);

						echo "<li>";
						echo '<a href="'.$detail->siteurl.'">'.$detail->blogname.'</a>';
						echo "</li>";
//						echo "<pre>";
//						var_dump(get_blog_details($blog->blog_id));
//						echo "</pre>";
					}
					echo "</ul>";
				endif;
				?>

			</main><!-- #main -->
		</div><!-- #primary -->
		<?php get_sidebar(); ?>
	</div>
</div>
<?php
get_footer();

