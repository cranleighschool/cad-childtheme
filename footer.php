<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cranleigh-2016
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="ancillary">
			<div class="container">

			<?php if ( is_active_sidebar('footer_widgets') ): ?>

				<div class="row">
					<?php dynamic_sidebar('footer_widgets'); ?>
				</div>

			<?php else:
				echo "<div class=\"row\">";
				the_widget(
					'Cranleigh_Footer_Addr',
				[
					'title' => "Address",
				],
				cranleigh_2016_sidebar_footer_defaults("footer-addr", "footer-addr")
				);
				the_widget(
					'Cranleigh_Footer_SocialMedia',
					['title' => 'Social Media'],
					cranleigh_2016_sidebar_footer_defaults("footer-socials", "footer-socials")
				);
				
				if (isset(get_option( 'blogsettings' )['disclaimer'])) {
					$disclaimer_text = get_option( 'blogsettings' )['disclaimer'];
				} else {
					$disclaimer_text = "<p>This blog is managed by staff at <a href=\"https://www.cranleigh.org\">Cranleigh School</a>.</p>";
				}
				the_widget(
					"WP_Widget_Text",
					['title' => 'About This Blog','text' => $disclaimer_text],
					cranleigh_2016_sidebar_footer_defaults("text", "none")
				);
				the_widget(
					"Cranleigh_Footer_Logo",
					[],
					cranleigh_2016_sidebar_footer_defaults("footer-logo", "footer-logo")
				);
				echo "</div>";

				endif; ?>
				<div class="row">
					<?php get_template_part( 'template-parts/footer', 'legal' ); ?>
				</div>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php // Back to top link ?>
<a href="#page" class="hidden-sr cd-top">Top</a>

<?php wp_footer(); ?>
<?php if (function_exists('is_open') && is_open() !== false):
	 // A better UI than doing this would be to edit the Widget so that the button still exists, but shows a message saying "live chat currently closed"
		echo '<script src="https://embed.small.chat/T17D0KSGZG5V1R2DHA.js" async></script>';
		endif;
 ?>
<?php if (isset(get_option("wpseo_social")['fbadminadd']) && get_option("wpseo_social")['fbadminapp'] != null): ?>
 <script>

    window.fbAsyncInit = function() {
      FB.init({
        appId: <?php echo get_option("wpseo_social")['fbadminapp']; ?>,
        xfbml: true,
        version: "v2.10"
      });

      FB.AppEvents.logPageView();


    };

    (function(d, s, id){
       var js, fjs = d.getElementsByTagName(s)[0];
       if (d.getElementById(id)) { return; }
       js = d.createElement(s); js.id = id;
       js.src = "//connect.facebook.net/en_GB/sdk.js";
       fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

  </script>
<?php endif; ?>
</body>
</html>

