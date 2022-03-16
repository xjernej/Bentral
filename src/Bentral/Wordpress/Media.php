<?php

namespace Bentral\Wordpress;

use WP_Http;

class Media {

	public function createFromBentralImageUrl( $url, $postId = null ) {
		require_once( ABSPATH . WPINC . '/class-http.php' );

		$http     = new WP_Http();
		$response = $http->request( $url );
		if ( $response['response']['code'] != 200 ) {
			return false;
		}

		$upload = wp_upload_bits( basename( $url ), null, $response['body'] );
		if ( ! empty( $upload['error'] ) ) {
			return false;
		}

		$file_path        = $upload['file'];
		$file_name        = basename( $file_path );
		$file_type        = wp_check_filetype( $file_name, null );
		$attachment_title = sanitize_file_name( pathinfo( $file_name, PATHINFO_FILENAME ) );
		$wp_upload_dir    = wp_upload_dir();

		$post_info = array(
			'guid'           => $wp_upload_dir['url'] . '/' . $file_name,
			'post_mime_type' => $file_type['type'],
			'post_title'     => $attachment_title,
			'post_content'   => '',
			'post_status'    => 'inherit',
		);

		// Create the attachment
		$attach_id = wp_insert_attachment( $post_info, $file_path, $postId );

		// Include image.php
		require_once( ABSPATH . 'wp-admin/includes/image.php' );

		// Define attachment metadata
		$attach_data = wp_generate_attachment_metadata( $attach_id, $file_path );

		// Assign metadata to attachment
		wp_update_attachment_metadata( $attach_id, $attach_data );
		update_post_meta($attach_id, 'bentral_property_image', '1');
		update_post_meta($attach_id, 'bentral_property_image_url', $url);

		return $attach_id;
	}

	public function deletePostMedia( $postId ) {
		$attachments = get_attached_media( '', $postId );
		foreach ($attachments as $attachment) {
			wp_delete_attachment( $attachment->ID, 'true' );
		}
	}

	public function getPostImageList( $post_id ){
        return get_children(
            array(
                'post_parent'    => $post_id,
                'post_status'    => 'inherit',
                'post_type'      => 'attachment',
                'post_mime_type' => 'image',
                'order'          => 'ASC',
                'orderby'        => 'ID'
            )
        );
    }
}