<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NrwBaseImage {

	private $title;

	private $content;

	private $image_url;

	private $lg_col;

	private $md_col;

	private $sm_col;

	private $xs_col;

	private $image_size;

	private $overlay_pos;

	private $overlay_color;

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

}