<?php
/*
  Plugin Name: Hide most sidebar menus
  Plugin URI:
  Description: When the logged in user does not have the admin role, hide most sidebar menus.
  Version: 1.0.0
  Author: tai
  Author URI:
  License: GPLv2
/*
  Copyright (C) 2019 tai

  This program is free software; you can redistribute it and/or
  modify it under the terms of the GNU General Public License
  as published by the Free Software Foundation; either version 2
  of the License, or (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

Class Hide_Most_Sidebar_Menus {

	function __construct() {
		add_action( 'init', [ $this, 'load_pulgin_init_function' ] );
	}

	public function load_pulgin_init_function() {
		// means the current user is NOT admin 
		if ( ! current_user_can( 'update_core' ) ) {  
			add_action( 'admin_menu', [ $this, 'remove_menus' ] );
			add_filter( 'login_redirect', [ $this, 'return_default_page' ] );
		}
	}

	public function remove_menus() {
		remove_menu_page( 'index.php' );   //Dashboard
		remove_menu_page( 'jetpack' );  //Jetpack* 
//		remove_menu_page( 'edit.php' ); //Posts
//		remove_menu_page( 'upload.php' );  //Media
//		remove_menu_page( 'edit.php?post_type=page' ); //Pages
		remove_menu_page( 'edit-comments.php' ); //Comments
		remove_menu_page( 'themes.php' );  //Appearance
		remove_menu_page( 'plugins.php' ); //Plugins
		remove_menu_page( 'tools.php' );   //Tools
		remove_menu_page( 'options-general.php' );  //Settings
		remove_submenu_page( 'users.php', 'profile.php' ); //Users
		remove_menu_page( 'profile.php' ); //Profile
	}

	public function return_default_page() {
		return 'wp-admin/edit.php';
	}

}

new Hide_Most_Sidebar_Menus();
