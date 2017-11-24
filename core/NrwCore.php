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
				if('check' == $type || 'enable_opt_in' == $type) {
					$value = array();
					foreach ($choices as $key => $choice) {
						if(isset($stored_page_meta[$id.'_'.$key])) {
							$value[$id.'_'.$key] = $stored_page_meta[$id.'_'.$key][0];
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
							$fields .= self::omni_wp_theme_check_file_type($value[0], $name, $btn_text);
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
							if ($value[$id.'_'.$key][0] == $key) {
								$fields .= '<input type="checkbox" name="' . $name . '_' . $key . '" value="' . $key . '" checked="checked">' . $choice . '<br>';
							} else {
								$fields .= '<input type="checkbox" name="' . $name . '_' . $key . '" value="' . $key . '">' . $choice . '<br>';
							}
							$count++;
						}
						$fields .= '</div><br>';
						break;
					case 'enable_opt_in':
						$fields .= '<div id="nrw_admin_enable_opt_in_'. $name . '">';
						$fields .= '<label>' . $label . '</label><br><small>' . $description . '</small>';
						$count = 0;
						p($value);
						foreach ($choices as $key => $choice) {
							p($key);
							if ($value[$id.'_'.$key] == $key) {

								$fields .= '<input type="checkbox" name="' . $name . '_' . $key . '" value="' . $key
								           . '" checked="checked" data-target="#nrw_admin_radio_'. $target . '">' .
								           $choice . '<br>';
							} else {
								$fields .= '<input type="checkbox" name="' . $name . '_' . $key . '" value="' . $key
								           . '" data-target="#nrw_admin_radio_'. $target . '">' . $choice . '<br>';
							}
							$count++;
						}
						$fields .= '</div><br>';
						break;
					case 'opt_in_options':
						$hidden = '';
						$is_enabled = $stored_page_meta[$enabled];
						if('enable' != $is_enabled[0]) {
							$hidden = 'class="hidden"';
						}
						$fields .= '<div id="nrw_admin_radio_'. $name . '" ' . $hidden . '>';
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
				}
			}
			$fields .= '</div>';
		}
		return $fields;
	}
}