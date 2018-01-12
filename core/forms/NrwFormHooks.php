<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NrwFormHooks {

	private $footer_form_id;
	private $nrw_form_table_version;

	public function __construct() {
		$this->footer_form_id = 1;
		$this->nrw_form_table_version = '0.1';
	}

	public function init() {
		add_action('nrw_action_footer_form', array($this, 'nrw_ftr_form'));
		add_action('after_setup_theme', array($this, 'nrw_form_db_table_install'));

		add_action( 'wp_enqueue_scripts', array($this, 'nrw_form_ajax_localize_script') );

		add_action( 'wp_ajax_nopriv_nrw_save_ftr_submission', array($this, 'nrw_save_ftr_submission') );
		add_action( 'wp_ajax_nrw_save_ftr_submission', array($this, 'nrw_save_ftr_submission') );

	}

	public function nrw_ftr_form() {
		?>
		<form id="nrw-footer-contact">
			<div class="nrw-input-group-wrapper">
				<input type="hidden" id="action" name="action" value="nrw_save_ftr_submission">
				<input type="hidden" id="nrw_form_id" name="nrw_form_id" value="<?php echo $this->footer_form_id; ?>">
				<div class="nrw-input-text-wrapper nrw-input-half nrw-input-left">
					<input type="text" id="nrw_name" name="nrw_name" placeholder="Your Name" required>
				</div>
				<div class="nrw-input-text-wrapper nrw-input-half nrw-input-right">
					<input type="email" id="nrw_email" name="nrw_email" placeholder="Your Email" required>
				</div>
				<div class="nrw-input-text-wrapper">
					<input type="text" id="nrw_subject" name="nrw_subject" placeholder="Subject">
				</div>
				<div class="nrw-input-text-wrapper">
					<textarea id="nrw_message" name="nrw_message" placeholder="Your Message"></textarea>
				</div>
			</div>
			<button type="submit" class="nrw-btn nrw-btn-blue nrw-btn-full">Send Your Message</button>
		</form>
	<?php }

	public function nrw_save_ftr_submission() {
		$data = array(
			'name'             => filter_var($_POST['nrw_name'], FILTER_SANITIZE_STRING),
			'email'            => filter_var($_POST['nrw_email'], FILTER_SANITIZE_STRING),
			'subject'          => filter_var($_POST['nrw_subject'], FILTER_SANITIZE_STRING),
			'message'          => filter_var($_POST['nrw_message'], FILTER_SANITIZE_STRING)
		);
		$form_id = filter_var($_POST['nrw_form_id'], FILTER_SANITIZE_NUMBER_INT);
		$ip_address = self::nrw_get_real_ip_addr();

		$entry = array(
			'form_id'     => $form_id,
			'info'        => json_encode($data),
			'ip_address'  => $ip_address
		);

		$response_msg = 'Thanks! We will contact you during the next business day.';
		$response_class = 'nrw-form-success';
		$is_success = true;

		if(!$this->nrw_add_form_entry($entry)) {
			$response_msg = 'There was an error with your submission. Try Again!';
			$response_class = 'nrw-form-error';
			$is_success = false;
		}

		$response_html = '<div class="' . $response_class .'"><h5>' . $response_msg . '</h5></div>';

		$response = json_encode(
			array(
				'is_success' => $is_success,
				'msg'        => $response_html,
				'data'       => $data
			)
		);

		$this->nrw_send_form_submission($data);

		echo $response;
		die();
	}

	private function nrw_add_form_entry($entry) {
		global $wpdb;
		$table_name = $wpdb->prefix . 'nrw_frm_entries';

		$wpdb->insert(
			$table_name,
			array(
				'form_id'      => $entry['form_id'],
				'info'         => $entry['info'],
				'ip_address'   => $entry['ip_address'],
				'time'         => date('Y-m-d H:i:s', time())
			),
			array(
				'%d',
				'%s',
				'%s',
				'%s'
			)
		);

		return $wpdb->insert_id;
	}

	public function nrw_form_ajax_localize_script() {
		wp_enqueue_script('nrw_ftr_form_script', get_template_directory_uri() . '/admin/js/form-ajax.js', array('jquery'), false, true);

		wp_localize_script('nrw_ftr_form_script', 'nrw_ftr_ajax', array('ajax_url' => admin_url('admin-ajax.php')));
	}

	public static function nrw_get_real_ip_addr() {
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip=$_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip=$_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}

	/**
	 * DB Setup
	 */
	public function nrw_form_db_table_install() {
		global $wpdb;
		$installed_ver = get_option('nrw_form_table_version');

		if($installed_ver != $this->nrw_form_table_version) {
			$table_name = $wpdb->prefix . 'nrw_frm_entries';
			$charset_collate = $wpdb->get_charset_collate();

			$sql = "CREATE TABLE $table_name (
					id mediumint(9) NOT NULL AUTO_INCREMENT,
					form_id mediumint(9) NOT NULL,
					time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
					info text NOT NULL,
					ip_address varchar(16) DEFAULT '' NOT NULL,
					PRIMARY KEY (id)
					) $charset_collate;";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );

			update_option( 'nrw_form_table_version', $this->nrw_form_table_version );
		}
	}

	public function nrw_send_form_submission($data) {
		$headers = array('Content-Type: text/html; charset=UTF-8');
		$to = 'ninja@norulesweb.com';
		$subject = 'Form Submission - ' . $data['subject'];
		$message = 'From: ' . $data['name'] . ' - ' . $data['email'] . '<br><br>';
		$message .= $data['message'];


		wp_mail( $to, $subject, $message, $headers );
	}

}
$nrwformhooks = new NrwFormHooks();
$nrwformhooks->init();