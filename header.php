<?php
if ( ! defined( 'ABSPATH' ) ) exit;

do_action('nrw_action_head');
?>
<body id="nrw-body" <?php body_class(); ?> onresize="Repaint()">

<?php
do_action('nrw_action_before_header');
do_action('nrw_action_header');
do_action('nrw_action_after_header');