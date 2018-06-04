<?php
namespace CranleighSchool\CranleighBlogs;
class RemoveComments {
	use BaseClass;
	public function __construct() {
		add_action( 'admin_menu', array($this, 'remove_comment_admin_menu'));
		add_action('init', array($this, 'remove_comment_support'), 100);
		add_action('wp_before_admin_bar_render', array($this, 'remove_comments_admin_bar'));
	}

	public function remove_comment_admin_menu() {
		remove_menu_page('edit-comments.php');
	}

	public function remove_comment_support() {
		remove_post_type_support( 'post', 'comments' );
		remove_post_type_support( 'page', 'comments' );
	}

	public function remove_comments_admin_bar() {
		global $wp_admin_bar;
		$wp_admin_bar->remove_menu('comments');
	}
}
