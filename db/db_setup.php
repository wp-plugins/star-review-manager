<?php 
	function srm_install_db() {
		global $wpdb;
		$charset_collate = $wpdb->get_charset_collate();
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		
		/* user table */
		$sql = "CREATE TABLE ".SRM_DB_USERS." (
			id int NOT NULL AUTO_INCREMENT,
			username VARCHAR(255),
			email VARCHAR(255),
			firstname VARCHAR(255),
			lastname VARCHAR(255),
			UNIQUE KEY id (id)
		) $charset_collate;";
		dbDelta($sql);
		
		/*
			container that encompasses all reviews with shortcode, settings, limit
			makes it possible to create multiple review pages if necesary.
		*/
		$sql = "CREATE TABLE ".SRM_DB_REVIEWCONTAINER." (
			id int NOT NULL AUTO_INCREMENT,
			title VARCHAR(255),
			reviewlimit INT,
			anonymous BOOLEAN,
			UNIQUE KEY id (id)
		) $charset_collate;";
		dbDelta($sql);
		
		/*review table 
			status 0 = pending, 1 active, 2 not active
		*/
		$sql = "CREATE TABLE ".SRM_DB_REVIEWS." (
			id int NOT NULL AUTO_INCREMENT,
			container_id int NOT NULL,
			user_id int,
			message VARCHAR(255),
			rating INT,
			created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
			status INT(1),
			UNIQUE KEY id (id),
			FOREIGN KEY (container_id) REFERENCES ".SRM_DB_REVIEWCONTAINER."(id)
		) $charset_collate;";
		dbDelta($sql);
		
	}
	
?>