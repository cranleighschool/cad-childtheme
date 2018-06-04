<?php

namespace CranleighSchool\CranleighBlogs;

use WeDevs_Settings_API;

if (!class_exists( 'WeDevs_Settings_API')):
	require_once get_template_directory( ).'/inc/class.settingsapiwrapper.php';
endif;

if ( !class_exists( __NAMESPACE__.'\SettingsAPI' ) ):
	class SettingsAPI {

		private $settings_api;

		function __construct() {
			$this->settings_api = new WeDevs_Settings_API;

			add_action( 'admin_init', array($this, 'admin_init') );
			add_action( 'admin_menu', array($this, 'admin_menu') );
		}

		function admin_init() {

			//set the settings
			$this->settings_api->set_sections( $this->get_settings_sections() );
			$this->settings_api->set_fields( $this->get_settings_fields() );

			//initialize settings
			$this->settings_api->admin_init();
		}

		function admin_menu() {

			add_theme_page( 'Blog Settings', 'Blog Settings', 'manage_network', 'cranleighblogssettings', array($this, 'plugin_page') );
		}

		function get_settings_sections() {
			$sections = array(
				array(
					"id" => "blogsettings",
					"title" => __("Blog Settings", 'cranleigh-2016')
				),
			);
			return $sections;
		}

		/**
		 * Returns all the settings fields
		 *
		 * @return array settings fields
		 */
		function get_settings_fields() {
			$settings_fields = array(
				'blogsettings' => array(
					array(
						'name' => 'disclaimer',
						'label' => 'About / Disclaimer Text',
						'desc' => 'This blog is managed by...',
						'type' => 'wysiwyg',
						'default' => "<p>This blog is managed and moderated by staff at <a href=\"https://www.cranleigh.org/\" target=\"_blank\">Cranleigh School</a>.</p>"
					),
				),
			);

			return $settings_fields;
		}

		function plugin_page() {
			echo '<div class="wrap">';
			echo "";
			$this->settings_api->show_navigation();
			$this->settings_api->show_forms();

			echo '</div>';
		}

		/**
		 * Get all the pages
		 *
		 * @return array page names with key value pairs
		 */
		function get_pages() {
			$pages = get_pages();
			$pages_options = array();
			if ( $pages ) {
				foreach ($pages as $page) {
					$pages_options[$page->ID] = $page->post_title;
				}
			}

			return $pages_options;
		}

	}
endif;