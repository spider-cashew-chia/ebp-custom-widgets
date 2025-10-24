<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH'))
    exit;

class Ebp_Custom_Map_1 extends Widget_Base
{

    public function get_name()
    {
        return 'ebp_custom_map_1';
    }

    public function get_title()
    {
        return __('EBP Custom Map 1', 'ebp-custom-widgets');
    }

    public function get_icon()
    {


        // Fallback to default icon if file doesn't exist
        return 'eicon-hero-3';
    }

    public function get_categories()
    {
        return ['ebp-custom-widgets'];
    }

    // Enqueue widget assets
    public function get_script_depends()
    {
        return ['jquery'];
    }

    public function get_style_depends()
    {
        return ['ebp-custom-map-1-style'];
    }


    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Map Content', 'ebp-custom-widgets'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Latitude Control
        $this->add_control(
            'map_latitude',
            [
                'label' => __('Latitude', 'ebp-custom-widgets'),
                'type' => Controls_Manager::NUMBER,
                'default' => 53.385980,
                'step' => 0.000001,
                'description' => __('Enter the latitude coordinate for your map location.', 'ebp-custom-widgets'),
            ]
        );

        // Longitude Control
        $this->add_control(
            'map_longitude',
            [
                'label' => __('Longitude', 'ebp-custom-widgets'),
                'type' => Controls_Manager::NUMBER,
                'default' => -2.980840,
                'step' => 0.000001,
                'description' => __('Enter the longitude coordinate for your map location.', 'ebp-custom-widgets'),
            ]
        );

        // Zoom Level Control
        $this->add_control(
            'map_zoom',
            [
                'label' => __('Zoom Level', 'ebp-custom-widgets'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 20,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'description' => __('Set the zoom level for your map (1 = world view, 20 = street level).', 'ebp-custom-widgets'),
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // Get coordinates and zoom from settings
        $latitude = $settings['map_latitude'];
        $longitude = $settings['map_longitude'];
        $zoom = $settings['map_zoom']['size'];

        // Generate unique ID for this map instance
        $map_id = 'map_' . $this->get_id();
        ?>
        <!-- Custom Map Widget -->
        <section class="ebp-custom-map-1">
            <!-- Map Container -->
            <div class="map">
                <div id="<?php echo esc_attr($map_id); ?>" class="map"></div>
            </div>
        </section>
        <!-- Custom Map Widget End -->

        <script>
            function initMap<?php echo esc_js($map_id); ?>() {
                var latlng = new google.maps.LatLng(<?php echo esc_js($latitude); ?>, <?php echo esc_js($longitude); ?>);

                var myOptions = {
                    zoom: <?php echo esc_js($zoom); ?>,
                    center: latlng,
                    disableDefaultUI: true,
                    styles: [{
                        "elementType": "geometry",
                        "stylers": [{
                            "color": "#f3efe0"
                        }]
                    },
                    {
                        "elementType": "labels.icon",
                        "stylers": [{
                            "visibility": "off"
                        }]
                    },
                    {
                        "elementType": "labels.text.fill",
                        "stylers": [{
                            "color": "#616161"
                        }]
                    },
                    {
                        "elementType": "labels.text.stroke",
                        "stylers": [{
                            "color": "#f3efe0"
                        }]
                    },
                    {
                        "featureType": "administrative.land_parcel",
                        "elementType": "labels.text.fill",
                        "stylers": [{
                            "color": "#bdbdbd"
                        }]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "geometry",
                        "stylers": [{
                            "color": "#eeeeee"
                        }]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "labels.text.fill",
                        "stylers": [{
                            "color": "#757575"
                        }]
                    },
                    {
                        "featureType": "poi.park",
                        "elementType": "geometry",
                        "stylers": [{
                            "color": "#e5e5e5"
                        }]
                    },
                    {
                        "featureType": "poi.park",
                        "elementType": "labels.text.fill",
                        "stylers": [{
                            "color": "#9e9e9e"
                        }]
                    },
                    {
                        "featureType": "road",
                        "elementType": "geometry",
                        "stylers": [{
                            "color": "#ffffff"
                        }]
                    },
                    {
                        "featureType": "road.arterial",
                        "elementType": "labels.text.fill",
                        "stylers": [{
                            "color": "#757575"
                        }]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "geometry",
                        "stylers": [{
                            "color": "#dadada"
                        }]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "labels.text.fill",
                        "stylers": [{
                            "color": "#616161"
                        }]
                    },
                    {
                        "featureType": "road.local",
                        "elementType": "labels.text.fill",
                        "stylers": [{
                            "color": "#9e9e9e"
                        }]
                    },
                    {
                        "featureType": "transit.line",
                        "elementType": "geometry",
                        "stylers": [{
                            "color": "#e5e5e5"
                        }]
                    },
                    {
                        "featureType": "transit.station",
                        "elementType": "geometry",
                        "stylers": [{
                            "color": "#eeeeee"
                        }]
                    },
                    {
                        "featureType": "water",
                        "elementType": "geometry",
                        "stylers": [{
                            "color": "#93D4E6"
                        }]
                    },
                    {
                        "featureType": "water",
                        "elementType": "labels.text.fill",
                        "stylers": [{
                            "color": "#9e9e9e"
                        }]
                    }
                    ]
                };

                var map = new google.maps.Map(document.getElementById("<?php echo esc_js($map_id); ?>"), myOptions);

                //map.panBy(-100, -40);

                var myMarker = new google.maps.Marker({
                    position: latlng,
                    map: map,
                    icon: '/wp-content/uploads/2025/09/target-scaffolding-map-icon.svg'
                });
			
			
			
            }
        </script>
        <script
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFbrLn5fMXqLFWZFemXgojLaiDkk3crwc&callback=initMap<?php echo esc_js($map_id); ?>"
            async defer></script>
        <?php
    }
}