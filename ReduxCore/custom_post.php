<?php
/* New Code For Custom Linker */
	function instantcma_post_type() {
		$labels = array(
			'name'               => __( 'InstantCMA Request', 'redux-framework' ),
			'singular_name'      => __( 'InstantCMA Request', 'redux-framework' ),
			'add_new'            => __( 'Add New', 'redux-framework' ),
			'add_new_item'       => __( 'Add New Request', 'redux-framework' ),
			'edit'               => __( 'Edit Request', 'redux-framework' ),
			'edit_item'          => __( 'Edit Request', 'redux-framework' ),
			'new_item'           => __( 'New Request', 'redux-framework' ),
			'view'               => __( 'View Request', 'redux-framework' ),
			'view_item'          => __( 'View Request', 'redux-framework' ),
			'search_items'       => __( 'Search Request', 'redux-framework' ),
			'not_found'          => __( 'No Links found', 'redux-framework' ),
			'not_found_in_trash' => __( 'No Links found in Trash', 'redux-framework' ),
		);

		$args = array(
			'labels'          => $labels,
			'public'          => true,
			'query_var'       => true,
			'capability_type' => 'post',
			'has_archive'     => false,
			'hierarchical'    => false,
			'menu_position'   => 30,
			'supports'        => array( 'title', 'author' ),
			'show_in_menu' => false,
			'rewrite'         => array(
				'slug'       => apply_filters( 'req_user_prefix_slug', 'go' ),
				'with_front' => false,
			),
		);
		
		register_post_type( 'req_user',$args );
	}	
	add_action( 'init', 'instantcma_post_type', 0 );
	
	/* Custom Column List for Request */
	add_filter( 'manage_req_user_posts_columns','admin_cpt_columns');
	function admin_cpt_columns( $columns ) {
		return array(
			'cb'               => '<input type="checkbox" />',
			'title'            => __( 'Title', 'redux-framework' ),
			'user'       => __( 'User Name', 'redux-framework' ),
			'email' => __( 'Email', 'redux-framework' ),
			'phone'    => __( 'Phone', 'redux-framework' ),
			'report'    => __( 'Report Send', 'redux-framework' ),
		);
	}	
	
/* Custom Column List fill for req_user */
	add_action('manage_req_user_posts_custom_column', 'req_user_custom_columns', 10, 2 );
	function req_user_custom_columns($column) { 
		global $post;

		switch ( $column ) {
			case 'user' :
				echo ucfirst(get_post_meta( $post->ID, 'req_frist_name', true ))." ".get_post_meta( $post->ID, 'req_last_name', true );
				break;
			
			case 'email' :
				echo get_post_meta( $post->ID, 'req_email', true );
				break;
			
			case 'phone' :
				echo get_post_meta( $post->ID, 'req_phone', true );
				break;
				
			case 'report' :
				$zip_id=get_post_meta( $post->ID, 'req_zpid', true );
				$report_send=get_post_meta($post->ID,'report_send',true);
				$send_time=get_post_meta($post->ID,'report_send_date',true);
				if($report_send=='1'):
					echo "<div style='font-size: 11px; color: green;'>Send On ".$send_time."</div>";
					echo "<a style='font-size: 12px;'  href='".PROP_PLUGIN_WS_PATH.'public/download.php?id='.$post->ID."'>View</a>"; 
					echo " | <a style='font-size: 12px;' target='_blank' href='".PROP_PLUGIN_WS_PATH.'public/resend.php?id='.$post->ID."'>Re-Send</a>"; 
				else:
					echo "<div style='font-size: 11px; color: red;'>Pending</div>";
					echo "<a style='font-size: 12px;'  href='".PROP_PLUGIN_WS_PATH.'public/download.php?id='.$post->ID."'>View</a>"; 
					echo " | <a style='font-size: 12px;' target='_blank' href='".PROP_PLUGIN_WS_PATH.'public/resend.php?id='.$post->ID."&new=1'>Send Report</a>"; 
				endif;
				break;
		}
	}	
	
		/* req_user Custom Meta Box*/
	add_action( 'add_meta_boxes', 'add_req_user_metaboxes' );	
	function add_req_user_metaboxes() {
		add_meta_box('wpt_req_user_details', 'User Details', 'wpt_req_user_details', 'req_user', 'normal', 'high');
	}
	
	function wpt_req_user_details() {
		global $post;
		
			$field_id = 'req_frist_name';
			echo strtr( '<p><strong><label for="{name}">{label}</label></strong></p><p><input type="text" id="{name}" name="{name}" value="{value}" placeholder="{placeholder}" class="large-text" /></p>', array(
				'{label}' => __( 'First Name :', 'redux-framework' ),
				'{name}'  => $field_id,
				'{value}' => esc_attr( get_post_meta( $post->ID, $field_id, true ) ),
			) );
			
			$field_id = 'req_last_name';
			echo strtr( '<p><strong><label for="{name}">{label}</label></strong></p><p><input type="text" id="{name}" name="{name}" value="{value}" placeholder="{placeholder}" class="large-text" /></p>', array(
				'{label}' => __( 'Last Name :', 'redux-framework' ),
				'{name}'  => $field_id,
				'{value}' => esc_attr( get_post_meta( $post->ID, $field_id, true ) ),
			) );			
		
			$field_id = 'req_email';
			echo strtr( '<p><strong><label for="{name}">{label}</label></strong></p><p><input type="text" id="{name}" name="{name}" value="{value}" placeholder="{placeholder}" class="large-text" /></p>', array(
				'{label}' => __( 'Email :', 'redux-framework' ),
				'{name}'  => $field_id,
				'{value}' => esc_attr( get_post_meta( $post->ID, $field_id, true ) ),
			) );
			
			$field_id = 'req_phone';
			echo strtr( '<p><strong><label for="{name}">{label}</label></strong></p><p><input type="text" id="{name}" name="{name}" value="{value}" placeholder="{placeholder}" class="large-text" /></p>', array(
				'{label}' => __( 'Phone :', 'redux-framework' ),
				'{name}'  => $field_id,
				'{value}' => esc_attr( get_post_meta( $post->ID, $field_id, true ) ),
			) );
			
			$field_id = 'req_place';
			echo strtr( '<p><strong><label for="{name}">{label}</label></strong></p><p><input type="text" id="{name}" name="{name}" value="{value}" placeholder="{placeholder}" class="large-text" /></p>', array(
				'{label}' => __( 'Search Place :', 'redux-framework' ),
				'{name}'  => $field_id,
				'{value}' => esc_attr( get_post_meta( $post->ID, $field_id, true ) ),
			) );
	}	

	function clivern_plugin_top_menu(){
		add_submenu_page( 'WPInstantCMA', 'InstantCMA Request', 'InstantCMA Request', 'read', 'edit.php?post_type=req_user', '' );
    }
	add_action('admin_menu','clivern_plugin_top_menu');

?>