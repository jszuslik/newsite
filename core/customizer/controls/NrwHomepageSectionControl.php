<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NrwHomepageSectionControl extends WP_Customize_Control {

	/**
	 * Control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'section-manager';

	/**
	 * Arguments.
	 *
	 * @access public
	 * @var array
	 */
	public $args = array();

	/**
	 * Enqueue scripts and styles.
	 *
	 * @since 1.0.0
	 */
	public function enqueue() {

		wp_enqueue_style( 'nrw-css-customize-controls' );
		wp_enqueue_script( 'nrw-customize-controls' );

		wp_localize_script( 'nrw-customize-controls', 'nrw_update_menu_order', array(
			'ajax_url' => admin_url('admin-ajax.php')
		));

	}

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since 1.0.0
	 */
	public function to_json() {
		//p($this->choices);
		parent::to_json();
		$this->json['value']   = ! is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value();
		$this->json['choices'] = $this->choices;
		$this->json['link']    = $this->get_link();
		$this->json['id']      = $this->id;
	}

	/**
	 * Content template.
	 *
	 * @since 1.0.0
	 */
	public function content_template() {
		?>
		<# if ( ! data.choices ) {
			return;
			} #>

			<# if ( data.label ) { #>
				<span class="customize-control-title">{{ data.label }}</span>
				<# } #>

					<# if ( data.description ) { #>
						<span class="description customize-control-description">{{{ data.description }}}</span>
						<# } #>

							<ul class="section-list">
								<# _.each( data.choices, function( item, choice ) { #>
									<li>
										<label>
											<i class="dashicons dashicons-move"></i>
											<span>{{ item.label }}</span>
											<input type="checkbox" class="section-item-checkbox" value="{{ choice }}"
											       data-order="{{ item.menu_order }}" data-post_id="{{ item.post_id }}" <#
												if (true == item.enabled) { #>
												checked="checked" <# } #> />
										</label>
									</li>
									<# } ) #>
							</ul>
		<?php
	}

	/**
	 * Render content.
	 *
	 * @since 1.0.0
	 */
	public function render_content() {}

}