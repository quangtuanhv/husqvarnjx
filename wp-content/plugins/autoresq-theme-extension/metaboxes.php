<?php

/**
 * Service Cost Metabox
 */


function autoresq_service_cost_add_meta_box() {

    $screens = array( 'service' );

    foreach ( $screens as $screen ) {
        add_meta_box( 'autoresq_service_cost_id',  esc_html__( 'Service Cost', 'zoutula' ), 'autoresq_service_cost_add_meta_box_callback', $screen, 'side' );
    }
}
add_action( 'add_meta_boxes', 'autoresq_service_cost_add_meta_box');



function autoresq_service_cost_add_meta_box_callback($post ) {
    wp_nonce_field( 'autoresq_meta_box', 'autoresq_meta_box_nonce' );

    $autoresq_service_cost = get_post_meta( $post->ID, 'autoresq_service_cost', true );
    ?>
    <div class="custom_meta_box">
        <p>
            <label> <?php echo esc_html__( 'Add service cost','zoutula' ); ?> </label> <br />
            <input class="widefat" type="text" name="autoresq_service_cost" value="<?php echo esc_attr( $autoresq_service_cost ); ?>"/>
        </p>
    </div>
    <?php
}

function autoresq_save_meta_box_service_cost_data($post_id ) {
    if ( ! isset( $_POST['autoresq_meta_box_nonce'] ) ) { // Input var okay.
        return;
    }

    if ( ! wp_verify_nonce( sanitize_key( $_POST['autoresq_meta_box_nonce'] ), 'autoresq_meta_box' ) ) { // Input var okay.
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $autoresq_service_cost= '';
    if ( isset( $_POST['autoresq_service_cost'] ) ) { // Input var okay.
	    $autoresq_service_cost =  sanitize_text_field( wp_unslash( $_POST['autoresq_service_cost'] ) ) ; // Input var okay.
    }

    update_post_meta( $post_id, 'autoresq_service_cost', $autoresq_service_cost );
}
add_action( 'save_post', 'autoresq_save_meta_box_service_cost_data');



/**
 * Service Duration Metabox
 */

function autoresq_service_duration_add_meta_box() {

	$screens = array( 'service' );

	foreach ( $screens as $screen ) {
		add_meta_box( 'autoresq_service_duration_id',  esc_html__( 'Service Duration', 'zoutula' ), 'autoresq_service_duration_add_meta_box_callback', $screen, 'side' );
	}
}
add_action( 'add_meta_boxes', 'autoresq_service_duration_add_meta_box');



function autoresq_service_duration_add_meta_box_callback($post ) {
	wp_nonce_field( 'autoresq_meta_box', 'autoresq_meta_box_nonce' );

	$autoresq_service_duration = get_post_meta( $post->ID, 'autoresq_service_duration', true );
	?>
    <div class="custom_meta_box">
        <p>
            <label> <?php echo esc_html__( 'Add service duration','zoutula' ); ?> </label> <br />
            <input class="widefat" type="text" name="autoresq_service_duration" value="<?php echo esc_attr( $autoresq_service_duration ); ?>"/>
        </p>
    </div>
	<?php
}

function autoresq_save_meta_box_service_duration_data($post_id ) {
	if ( ! isset( $_POST['autoresq_meta_box_nonce'] ) ) { // Input var okay.
		return;
	}

	if ( ! wp_verify_nonce( sanitize_key( $_POST['autoresq_meta_box_nonce'] ), 'autoresq_meta_box' ) ) { // Input var okay.
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$autoresq_service_duration= '';
	if ( isset( $_POST['autoresq_service_duration'] ) ) { // Input var okay.
		$autoresq_service_duration =  sanitize_text_field( wp_unslash( $_POST['autoresq_service_duration'] ) ) ; // Input var okay.
	}

	update_post_meta( $post_id, 'autoresq_service_duration', $autoresq_service_duration );
}
add_action( 'save_post', 'autoresq_save_meta_box_service_duration_data');




function autoresq_sidebar_options_add_meta_box() {

    $screens = array( 'post' );

    foreach ( $screens as $screen ) {
        add_meta_box( 'autoresq_sidebar_options_id', esc_html__( 'Sidebar options', 'zoutula' ), 'autoresq_sidebar_options_meta_box_callback', $screen , 'side' );
    }

}
add_action( 'add_meta_boxes', 'autoresq_sidebar_options_add_meta_box' );




function autoresq_sidebar_options_meta_box_callback( $post ) {
    wp_nonce_field( 'autoresq_meta_box', 'autoresq_meta_box_nonce' );
    $autoresq_sidebar_option = get_post_meta( $post->ID, 'autoresq_sidebar_option', true );
    if ( empty( $autoresq_sidebar_option ) ) {
        $autoresq_sidebar_option = 'right'; // default right if nothing has been set
    }
    ?>
    <div class="custom_meta_box">
        <p>
            <label><?php echo esc_html__( 'Select sidebar position:','zoutula' ); ?> </label> <br />
            <input type="radio" name="autoresq_sidebar_option" <?php if ( 'right' == $autoresq_sidebar_option  ) {echo 'checked'; } ?> value="right">Right<br />
            <input type="radio" name="autoresq_sidebar_option" <?php if ( 'disabled' == $autoresq_sidebar_option  ) {echo 'checked'; } ?> value="disabled">Disabled
        </p>
        <div class="clear"></div>
    </div>
    <?php
}


function autoresq_save_sidebar_options( $post_id ) {
    if ( ! isset( $_POST['autoresq_meta_box_nonce'] ) ) { // Input var okay.
        return;
    }

    if ( ! wp_verify_nonce( sanitize_key( $_POST['autoresq_meta_box_nonce'] ), 'autoresq_meta_box' ) ) { // Input var okay.
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $autoresq_sidebar_option = '';
    if ( isset( $_POST['autoresq_sidebar_option'] ) && in_array( wp_unslash( $_POST['autoresq_sidebar_option'] ), array( 'right', 'disabled' ) ) ) { // Input var okay.
        $autoresq_sidebar_option = sanitize_text_field( wp_unslash( $_POST['autoresq_sidebar_option'] ) ); // Input var okay.
    }

    update_post_meta( $post_id, 'autoresq_sidebar_option', $autoresq_sidebar_option );
}
add_action( 'save_post', 'autoresq_save_sidebar_options' );


//
// Display header option
//
function autoresq_header_options_add_meta_box() {

    $screens = array( 'page','post', 'member', 'service' );
    global $post;

    foreach ( $screens as $screen ) {
        if ( ! empty( $post ) ) {
            add_meta_box( 'autoresq_header_options_id', esc_html__( 'Show Header','zoutula' ), 'autoresq_header_options_meta_box_callback', $screen, 'side' );
        }
    }

}
add_action( 'add_meta_boxes', 'autoresq_header_options_add_meta_box' );

function autoresq_header_options_meta_box_callback( $post ) {
    wp_nonce_field( 'autoresq_meta_box', 'autoresq_meta_box_nonce' );
    $autoresq_header_option = get_post_meta( $post->ID, 'autoresq_header_option', true );
    if ( empty( $autoresq_header_option ) ) {
        $autoresq_header_option = 'visible';
    }
    ?>
    <div class="custom_meta_box">
        <p>
            <label><?php echo esc_html__( 'Show Header','zoutula' ); ?> </label> <br />
            <input type="radio" name="autoresq_header_option" <?php if ( 'visible' == $autoresq_header_option  ) {echo 'checked'; } ?> value="visible">Visible<br />
            <input type="radio" name="autoresq_header_option" <?php if ( 'hidden' == $autoresq_header_option  ) {echo 'checked'; } ?> value="hidden">Hidden<br />
        </p>
        <div class="clear"></div>
    </div>
    <?php
}


function autoresq_save_header_options( $post_id ) {
    if ( ! isset( $_POST['autoresq_meta_box_nonce'] ) ) { // Input var okay.
        return;
    }

    if ( ! wp_verify_nonce( sanitize_key( $_POST['autoresq_meta_box_nonce'] ), 'autoresq_meta_box' ) ) { // Input var okay.
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $autoresq_header_option = '';
    if ( isset( $_POST['autoresq_header_option'] ) && in_array( wp_unslash( $_POST['autoresq_header_option'] ), array( 'visible', 'hidden' ) ) ) { // Input var okay.
        $autoresq_header_option = sanitize_text_field( wp_unslash( $_POST['autoresq_header_option'] ) ); // Input var okay.

    }

    update_post_meta( $post_id, 'autoresq_header_option', $autoresq_header_option );
}
add_action( 'save_post', 'autoresq_save_header_options' );



//
// Display header image
//
function autoresq_header_image_add_meta_box() {

	$screens = array( 'page','post', 'member', 'service', 'product' );
	global $post;

	foreach ( $screens as $screen ) {
		if ( ! empty( $post ) ) {
			add_meta_box( 'autoresq_header_image_id', esc_html__( 'Header Image','zoutula' ), 'autoresq_header_image_meta_box_callback', $screen, 'side' );
		}
	}

}
add_action( 'add_meta_boxes', 'autoresq_header_image_add_meta_box' );

function autoresq_header_image_meta_box_callback( $post ) {
	wp_nonce_field( 'autoresq_meta_box', 'autoresq_meta_box_nonce' );

	// Get WordPress' media upload URL
	$upload_link = esc_url( get_upload_iframe_src( 'image', $post->ID ) );

    // See if there's a media id already saved as post meta
	$autoresq_header_image_id = get_post_meta( $post->ID, 'autoresq_header_image_id', true );

    // Get the image src
	$autoresq_header_image_src = wp_get_attachment_image_src( $autoresq_header_image_id, 'full' );

	?>

    <!-- Your image container, which can be manipulated with js -->
    <div class="autoresq-img-container">
		<?php if ( is_array($autoresq_header_image_src) ) : ?>
            <img src="<?php echo reset($autoresq_header_image_src) ?>" alt="" style="max-width:100%;" />
		<?php endif; ?>
    </div>

    <!-- Your add & remove image links -->
    <p class="hide-if-no-js">
        <a class="upload-autoresq-img <?php if ( is_array($autoresq_header_image_src)  ) { echo 'hidden'; } ?>"
           href="<?php echo $upload_link ?>">
			<?php esc_html_e('Set header image','zoutula'); ?>
        </a>
        <a class="delete-autoresq-img <?php if ( !is_array($autoresq_header_image_src) ) { echo 'hidden'; } ?>"
           href="#">
			<?php esc_html_e('Remove header image','zoutula') ?>
        </a>
    </p>

    <!-- A hidden input to set and post the chosen image id -->
    <input class="autoresq-header-image-id" name="autoresq-header-image-id" type="hidden" value="<?php echo esc_attr( $autoresq_header_image_id ); ?>" />
	<?php
}


function autoresq_save_header_image( $post_id ) {
	if ( ! isset( $_POST['autoresq_meta_box_nonce'] ) ) { // Input var okay.
		return;
	}

	if ( ! wp_verify_nonce( sanitize_key( $_POST['autoresq_meta_box_nonce'] ), 'autoresq_meta_box' ) ) { // Input var okay.
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$autoresq_header_image_id = '';
	if ( isset( $_POST['autoresq-header-image-id'] ) ) { // Input var okay.
		$autoresq_header_image_id = (int)( $_POST['autoresq-header-image-id'] ); // Input var okay.

	}

	update_post_meta( $post_id, 'autoresq_header_image_id', $autoresq_header_image_id );
}
add_action( 'save_post', 'autoresq_save_header_image' );

//add js for header image metabox
function autoresq_scripts_metabox() {
	wp_enqueue_script( 'autoresq-metabox', plugin_dir_url( __FILE__ ) . 'shortcodes/assets/js/zoutula-metabox.js', array( 'jquery' ), AUTORESQ_VER, true );
}

add_action( 'admin_enqueue_scripts', 'autoresq_scripts_metabox' );