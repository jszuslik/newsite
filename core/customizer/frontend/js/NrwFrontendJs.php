<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class NrwFrontendJs {

	public function __construct() {

	}

	public function init() {
		if(NrwCore::get_option('fixed_header')) {
			add_action( 'wp_footer', array($this, 'enable_shrink_header') );
		}
		add_action( 'wp_footer', array($this, 'inject_js_plumb_process_cards'), 20 );
	}

	public function enable_shrink_header() { ?>
		<script type="text/javascript">
            jQuery(document).on("scroll", function(){
                if
                (jQuery(document).scrollTop() > 100){
                    jQuery(".nrw-brand-inline-menu-wrapper").addClass("shrink");
                }
                else
                {
                    jQuery(".nrw-brand-inline-menu-wrapper").removeClass("shrink");
                }
            });
		</script>

	<?php }

	public function inject_js_plumb_process_cards() {
		?>
        <script type="text/javascript">

					
            jsPlumb.ready(setupJsPlumb);
					
					
					function setupJsPlumb() {
                        var instance = jsPlumb.getInstance();
                        instance.setContainer(document.getElementById("nrw-process-section"));
                        var endpointOptions1 = {
                            isSource:true,
                            isTarget:false,
                            connector : "Flowchart",
                            connectorStyle: { strokeWidth:2, stroke:'#FC5130' },
                            dragAllowedWhenFull:false,
                            connectorOverlays:[
                                [ "Arrow", { width:30, height: 30, location:1, id:"arrow" } ]
                            ],
                            reattachConnections: true
                        };

                        var endpointOptions2 = {
                            isSource:false,
                            isTarget:true,
                            connector : "Flowchart",
                            connectorStyle: { strokeWidth:2, stroke:'#FC5130' },
                            dragAllowedWhenFull:false,
                            reattachConnections: true
                        };
						
						var div1Endpoint = instance.addEndpoint('nrw-card-1', {
								endpoint: "Blank",
								anchor:"Right"
						}, endpointOptions1 );

						var div2Endpoint = instance.addEndpoint('nrw-card-2', {
								endpoint: "Blank",
								anchor:"Left"
						}, endpointOptions2);
						
						instance.connect({
								source: div1Endpoint,
								target: div2Endpoint
						});
						
						var div3Endpoint = instance.addEndpoint('nrw-card-2', {
								endpoint: "Blank",
								anchor:"Right"
						}, endpointOptions1 );

						var div4Endpoint = instance.addEndpoint('nrw-card-3', {
								endpoint: "Blank",
								anchor:"Left"
						}, endpointOptions2 );
						
						instance.connect({
								source: div3Endpoint,
								target: div4Endpoint
						});
						
						var div5Endpoint = instance.addEndpoint('nrw-card-3', {
								endpoint: "Blank",
								anchor:"Right"
						}, endpointOptions1 );

						var div6Endpoint = instance.addEndpoint('nrw-card-4', {
								endpoint: "Blank",
								anchor:"Left"
						}, endpointOptions2 );

						instance.connect({
								source: div5Endpoint,
								target: div6Endpoint
						});
						
						var div7Endpoint = instance.addEndpoint('nrw-card-4', {
								endpoint: "Blank",
								anchor:"Right"
						}, endpointOptions1 );

						var div8Endpoint = instance.addEndpoint('nrw-card-5', {
								endpoint: "Blank",
								anchor:"Left"
						}, endpointOptions2 );

						instance.connect({
								source: div7Endpoint,
								target: div8Endpoint
						});
						
						var div9Endpoint = instance.addEndpoint('nrw-card-5', {
								endpoint: "Blank",
								anchor:"Right"
						}, endpointOptions1 );

						var div10Endpoint = instance.addEndpoint('nrw-card-6', {
								endpoint: "Blank",
								anchor:"Left"
						}, endpointOptions2 );

						instance.connect({
								source: div9Endpoint,
								target: div10Endpoint
						});
						
						var div11Endpoint = instance.addEndpoint('nrw-card-6', {
								endpoint: "Blank",
								anchor:"Right"
						}, endpointOptions1 );

						var div12Endpoint = instance.addEndpoint('nrw-card-7', {
								endpoint: "Blank",
								anchor:"Left"
						}, endpointOptions2 );

						instance.connect({
								source: div11Endpoint,
								target: div12Endpoint
						});
						
						jQuery( window ).resize(function() {
								instance.repaintEverything();
						});
                        jQuery(document).on("scroll", function(){
                            instance.repaintEverything();
                        });
          }
					

        </script>
        <?php
	}

}
$nrwfrontendjs = new NrwFrontendJs();
$nrwfrontendjs->init();