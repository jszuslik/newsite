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
					
					
            jsPlumb.bind("ready", setupJsPlumb);
					
					
					function setupJsPlumb() {
                var firstInstance = jsPlumb.getInstance();	
						jQuery(window).on("resize", jsPlumb.revalidate("jsplumb-validate"));
						
                var endpointOptions = {
                    isSource:true,
                    isTarget:true,
                    connector : "Flowchart",
                    connectorStyle: { strokeWidth:4, stroke:'#FC5130' },
                    dragAllowedWhenFull:false
                };
                var div1Endpoint = jsPlumb.addEndpoint('nrw-card-1', {
                    endpoint: "Blank",
                    anchor:"Right",
                    connectorOverlays:[
                        [ "Arrow", { width:30, height: 30, location:1, id:"arrow" } ]
                    ]
                }, endpointOptions );
                div1Endpoint.addOverlay([ "Arrow", { width:10, height:10, id:"arrow" }]);
                var div2Endpoint = jsPlumb.addEndpoint('nrw-card-2', {
                    endpoint: "Blank",
                    anchor:"Left"
                }, endpointOptions );
                firstInstance.connect({
                    source: div1Endpoint,
                    target: div2Endpoint,
                    endpoint: "Rectangle"
                });

                var div3Endpoint = jsPlumb.addEndpoint('nrw-card-2', {
                    endpoint: "Blank",
                    anchor:"Right",
                    connectorOverlays:[
                        [ "Arrow", { width:30, height: 30, location:1, id:"arrow" } ]
                    ]
                }, endpointOptions );
                div3Endpoint.addOverlay([ "Arrow", { width:10, height:10, id:"arrow" }]);
                var div4Endpoint = jsPlumb.addEndpoint('nrw-card-3', {
                    endpoint: "Blank",
                    anchor:"Left"
                }, endpointOptions );
                firstInstance.connect({
                    source: div3Endpoint,
                    target: div4Endpoint
                });

                var div5Endpoint = jsPlumb.addEndpoint('nrw-card-3', {
                    endpoint: "Blank",
                    anchor:"Right",
                    connectorOverlays:[
                        [ "Arrow", { width:30, height: 30, location:1, id:"arrow" } ]
                    ]
                }, endpointOptions );
                div5Endpoint.addOverlay([ "Arrow", { width:10, height:10, id:"arrow" }]);
                var div6Endpoint = jsPlumb.addEndpoint('nrw-card-4', {
                    endpoint: "Blank",
                    anchor:"Left"
                }, endpointOptions );
                firstInstance.connect({
                    source: div5Endpoint,
                    target: div6Endpoint
                });

                var div7Endpoint = jsPlumb.addEndpoint('nrw-card-4', {
                    endpoint: "Blank",
                    anchor:"Right",
                    connectorOverlays:[
                        [ "Arrow", { width:30, height: 30, location:1, id:"arrow" } ]
                    ]
                }, endpointOptions );
							
                div7Endpoint.addOverlay([ "Arrow", { width:10, height:10, id:"arrow" }]);
                var div8Endpoint = jsPlumb.addEndpoint('nrw-card-5', {
                    endpoint: "Blank",
                    anchor:"Left"
                }, endpointOptions );
                firstInstance.connect({
                    source: div7Endpoint,
                    target: div8Endpoint
                });
							
							var div9Endpoint = jsPlumb.addEndpoint('nrw-card-5', {
                    endpoint: "Blank",
                    anchor:"Right",
                    connectorOverlays:[
                        [ "Arrow", { width:30, height: 30, location:1, id:"arrow" } ]
                    ]
                }, endpointOptions );
							
                div9Endpoint.addOverlay([ "Arrow", { width:10, height:10, id:"arrow" }]);
                var div10Endpoint = jsPlumb.addEndpoint('nrw-card-6', {
                    endpoint: "Blank",
                    anchor:"Left"
                }, endpointOptions );
                firstInstance.connect({
                    source: div9Endpoint,
                    target: div10Endpoint
                });
							
							var div11Endpoint = jsPlumb.addEndpoint('nrw-card-6', {
                    endpoint: "Blank",
                    anchor:"Right",
                    connectorOverlays:[
                        [ "Arrow", { width:30, height: 30, location:1, id:"arrow" } ]
                    ]
                }, endpointOptions );
							
                div11Endpoint.addOverlay([ "Arrow", { width:10, height:10, id:"arrow" }]);
                var div12Endpoint = jsPlumb.addEndpoint('nrw-card-7', {
                    endpoint: "Blank",
                    anchor:"Left"
                }, endpointOptions );
                firstInstance.connect({
                    source: div11Endpoint,
                    target: div12Endpoint
                });
								
            }
					

        </script>
        <?php
	}

}
$nrwfrontendjs = new NrwFrontendJs();
$nrwfrontendjs->init();