<?php 
	namespace CranleighSchool\CranleighBlogs;
	
	class CallThemPosts {
		
		use BaseClass;
		
		public function __construct() {
			add_action('admin_menu', array($this, 'change_post_label'),11);
			add_action('init', array($this, 'change_post_objects'),11);
		}
		
		
		public function change_post_label() {
			global $menu, $submenu;
			$menu[5][0] = "Posts";
			$submenu['edit.php'][5][0] = "All Posts";
			$submenu['edit.php'][10][0] = "Add New Post";
			$submenu['edit.php'][16][0] = "Post Tags";
		}
		public function change_post_objects() {
			global $wp_post_types;
			$labels = &$wp_post_types['post']->labels;
			$labels->name = "Blog Posts";
		}
	}