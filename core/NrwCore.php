<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NrwCore {

	public static function get_option( $key ) {
		$default_options = NrwDefault::default_theme_options();

		if ( empty( $key ) ) {
			return null;
		}

		$theme_options = (array) get_theme_mod('theme_options');
		$theme_options = wp_parse_args( $theme_options, $default_options );

		$value = null;

		if ( isset( $theme_options[ $key ] ) ) {
			$value = $theme_options[ $key ];
		}

		return $value;
	}

	public static function render_meta_boxes($field_array, $stored_page_meta) {
		// p($stored_page_meta);

		$fields = '';

		foreach($field_array as $field_group) {
			$fields .= '<div class="inside">';
			$fields .= '<h2>' . $field_group['name'] . '</h2>';
			foreach($field_group['fields'] as $field) {
				$value = null;
				$choices = null;
				$enabled = '';
				$type = $field['type'];
				$name = $field['name'];
				$id = $field['id'];
				$label = $field['label'];
				$btn_id = null;
				$btn_text = __( 'Choose or Upload an Image', NRW_TXT_DOMAIN);
				if(isset($field['btn_text']))
					$btn_text = $field['btn_text'];
				if(isset($field['btn_id']))
					$btn_id = $field['btn_id'];
				if(isset($field['choices']))
					$choices = $field['choices'];
				if('check' == $type) {
					$value = array();
					foreach ($choices as $key => $choice) {
						if(isset($stored_page_meta[$id])) {
							$value[$id] = $stored_page_meta[$id][0];
						}
					}
				} else {
					if(isset($stored_page_meta[$id])) {
						$value = $stored_page_meta[$id];
					}
				}
				if(isset($field['target']))
					$target = $field['target'];
				if('opt_in_options' == $type) {
					if(isset($field['enabled'])) {
						$enabled = $field['enabled'];
					}
				}

				// p($value);
				$description = $field['description'];
				switch($type){
					case 'text':
						$fields .= '<div id="nrw_admin_text_'. $name . '">';
						$fields .= '<label>' . $label . '</label>';
						$fields .= '<p><input type="' . $type . '" name="' . $name . '" id="' . $id . '" value="' . $value[0] . '" style="width: 100%" /></p>';
						$fields .= '</div>';
						break;
					case 'textarea':
						$fields .= '<div id="nrw_admin_textarea_'. $name . '">';
						$fields .= '<label>' . $label . '</br><small>' . $description . '</small></label>';
						$fields .= '<p><textarea name="' . $name . '" id="' . $id . '" rows="4" style="width:100%">' . $value[0] . '</textarea></p>';
						$fields .= '</div>';
						break;
					case 'image':
						$fields .= '<div id="nrw_admin_image_upload_'. $name . '">';
						$fields .= '<label>' . $label . '</label><br><small>' . $description . '</small>';
						if('' != $value[0] && isset($value[0])) {
							$fields .= self::check_file_type($value[0], $name, $btn_text);
						} else {
							$fields .= '<input type="text" name="' . $name . '" id="upload_image" value="' . $value[0] . '" style="width: 100%" /><br>';
							$fields .= '<input type="button" id="upload_image_button" class="button nrw_button" value="'. $btn_text .'"/></p>';
						}
						$fields .= '</div>';
						break;
					case 'select':
						$fields .= '<div id="nrw_admin_select_'. $name . '">';
						$fields .= '<label>' . $label . '</label><br><small>' . $description . '</small>';
						$fields .= '<p><select name="' . $name . '" id="' . $id . '" style="width: 150px">';
						$fields .= '<option>-- Select --</option>';
						foreach ($choices as $key => $choice) :
							if ($key == $value[0]) :
								$fields .= '<option value="'. $key . '" selected="selected">' . $choice . '</option>';
							else :
								$fields .= '<option value="'. $key . '">' . $choice . '</option>';
							endif;
						endforeach;
						$fields .= '</select></p>';
						$fields .= '</div>';
						break;
					case 'wp_editor':
						wp_editor( htmlspecialchars_decode($value[0]), $name, $settings = array
						('textarea_name'=>$name, 'wpautop' => false) );
						break;
					case 'radio':
						$fields .= '<div id="nrw_admin_radio_'. $name . '">';
						$fields .= '<label>' . $label . '</label><br><small>' . $description . '</small>';
						foreach ($choices as $key => $choice) {
							if ( $value[0] == $key ) {
								$fields .= '<input type="radio" name="' . $name . '" value="' . $key . '" checked="checked">' . $choice . '<br>';
							} else {
								$fields .= '<input type="radio" name="' . $name . '" value="' . $key . '">' . $choice . '<br>';
							}
						}
						$fields .= '</div><br>';
						break;
					case 'check':
						$fields .= '<div id="nrw_admin_checkbox_'. $name . '">';
						$fields .= '<label>' . $label . '</label><br><small>' . $description . '</small>';
						$count = 0;
						foreach ($choices as $key => $choice) {
							//p($value[$id]);
							if (isset($value[$id]) && $value[$id] == $key) {
								$fields .= '<input id="'.$id.'" type="checkbox" name="' . $name . '" value="' . $key . '" 
								checked="checked">' . $choice . '<br>';
							} else {
								$fields .= '<input id="'.$id.'" type="checkbox" name="' . $name . '" value="' . $key
								           . '">' . $choice . '<br>';
							}
							$count++;
						}
						$fields .= '</div><br>';
						break;
					case 'color':
						$fields .= '<div id="nrw_admin_color_picker_' . $name . '">';

							$fields .= '<label>' . $label . '</label> <small>' . $description . '</small><br>';
							$fields .= '<input id="' . $id . '" class="color-field" type="text" name="' . $name . '" value="' . $value[0] . '" /><br>';
						$fields .= '</div><br>';
						break;
				}
			}
			$fields .= '</div>';
		}
		return $fields;
	}

	public static function get_active_homepage_sections() {
		$output = array();
		$args = array(
			'post_type' => 'homepage_section',
			'posts_per_page'   => -1,
			'orderby'          => 'menu_order',
			'order'            => 'ASC',
		);
		$posts = get_posts($args);

		foreach($posts as $post) {
			if ('enabled' == get_post_meta($post->ID, 'enable_section', true)) {
				$output[] = $post;
			}
		}

		return $output;
	}

	public static function get_image_id_by_url( $image_url ) {
		global $wpdb;
		$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ));
		return $attachment[0];
	}

	public static function check_file_type($file, $name, $btn_text) {
		$pinfo = pathinfo($file);
		$ext = $pinfo['extension'];
		$image_exts = array(
			'jpg',
			'jpeg',
			'png',
			'gif',
			'webp',
			'svg'
		);
		$file_exts = array(
			'pdf',
			'zip',
			'doc',
			'docx'
		);
		$fields = '';
		switch ($ext) {
			case in_array($ext, $image_exts):
				$img_id = self::get_image_id_by_url($file);
				$img = wp_get_attachment_image_src($img_id, 'thumbnail');
				$fields .= '<div style="max-width: 150px">';
				$fields .= '<img src="' . $img[0] . '"><br><br>';
				$fields .= '</div>';
				$fields .= '<input type="hidden" name="' . $name . '" id="upload_image" value="' . $file . '" style="width: 100%" />';
				$fields .= '<input type="button" id="' . $name . '_remove_btn" class="button nrw_remove_image_button" value="Remove Image"/></p>';
				break;
			case in_array($ext, $file_exts):
				$fields .= '<div style="max-width: 150px">';
				$fields .= '<img src="' . get_template_directory_uri(). '/assets/images/fallback-file.png" width="75" height="75"><br><br><span>
' . $pinfo['filename'] . '.' . $pinfo['extension'] .'</span><br><br>';
				$fields .= '</div>';
				$fields .= '<input type="hidden" name="' . $name . '" id="upload_image" value="' . $file . '" style="width: 100%" />';
				$fields .= '<input type="button" id="' . $name . '_remove_btn" class="button nrw_remove_file_button" value="Remove File"/></p>';
				break;
			default:
				$fields .= '<input type="text" name="' . $name . '" id="upload_image" value="' . $file . '" style="width: 100%" /><br><br>';
				$fields .= '<input type="button" id="upload_image_button" class="button nrw_button" value="'. $btn_text .'"/></p>';
				break;
		}

		return $fields;
	}
}