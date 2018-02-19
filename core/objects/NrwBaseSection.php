<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NrwBaseSection {

	protected $id;

	protected $bg_color;

	public function __set(
		$name,
		$value
	) {
		if (property_exists($this, $name)) {
			$this->$name = $value;
		}
	}

	public function __get( $name ) {
		if(property_exists($this, $name)) {
			return $this->$name;
		}
	}

	public function return_responsive_image_set($image_url, $image_size = 'full', $width = 'auto', $height = 'auto', $img_fluid = true) {
		$image_id = self::get_image_id_by_url($image_url);
		$image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
		$image_size_url = wp_get_attachment_image_src($image_id, $image_size);
		$image_srcset = wp_get_attachment_image_srcset($image_id, $image_size);

		if ($img_fluid) {
			$image = '<img src="' . $image_size_url[0] . '" srcset="' . $image_srcset . '" class="img-fluid" width="' .$width.'" height="'.$height.'" alt="' . $image_alt . '" >';
		} else {
			$image = '<img src="' . $image_size_url[0] . '" srcset="' . $image_srcset . '" width="' .$width.'" height="'.$height.'" alt="' . $image_alt . '" >';
		}

		return $image;
	}

	public function get_image_id_by_url( $image_url ) {
		global $wpdb;
		$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
		return $attachment[0];
	}

}