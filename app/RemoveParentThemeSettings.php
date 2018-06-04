<?php
namespace CranleighSchool\CranleighBlogs;

class RemoveParentThemeSettings {
	use BaseClass;
	public function __construct() {
		add_action("widgets_init", array($this, "remove_sidebars"), 11);
		add_action("init", array($this, "register_menus"));
	}

	public function remove_sidebars() {
		
		$remove = [
			"admissions",
			"cranleigh-activities",
			"development",
			"information",
			"our-family",
			"our-school",
			"welcome",
			"beyond-cranleigh",
			"careers",
			"cranleigh-friends",
			"foundation",
			"work-at-cranleigh",
			"our-ethos",
			"medical-centre",
			"sportsdesk",
			"headmaster"
		];

		foreach ($remove as $sidebar):
			unregister_sidebar( $sidebar.'-sidebar' );
		endforeach;
		
	}

	public function register_menus() {
		register_nav_menus(
			array(
				"main-menu" => __('Main Menu')
			)
		);
	}
}