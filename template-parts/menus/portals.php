<nav class="portals" id="portals-menu">
	<ul>
		<li>
			<a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo('name'); ?></a>
		</li>
		

		<li>
			<a href="<?php echo esc_url( home_url( '?s=' ) ); ?>" class="show-search">
				<i class="fa fa-fw fa-search"></i>
			</a>
		</li>
	</ul>
<div id="search" class="fade popup search">
		<?php get_search_form(); ?>
	</div>
</nav>
