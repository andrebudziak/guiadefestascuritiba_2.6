(function($) {

    var map;
    var markers = [];
    var bounds = new google.maps.LatLngBounds();
    var sites = [];
    var site = {};
    var use_geolocation;
    var geolocation_always_active;
    var user_pos;
    var search_distance;
    var markers_bounds;
    var user_marker_icon;
    var theme_color;
    var markers_data;
    var clusters_icon;
    var map_length_unit;

    /** Prepare markers */
    function setMarkers(markers_data) {

        var markerShape = {
            coords: [1, 1, 1, 48, 72, 48, 72 , 1],
            type: 'poly'
        };

        var args = {
            content: '',
            disableAutoPan: false,
            maxWidth: 0,
            pixelOffset: new google.maps.Size(-40, -265),
            zIndex: 150,
            boxStyle: {
                background: "",
                opacity: 1,
                width: "345px"
            },
            closeBoxMargin: "-5px -5px 0 0",
            closeBoxURL: "",
            infoBoxClearance: new google.maps.Size(1, 1),
            isHidden: false,
            pane: "floatPane",
            enableEventPropagation: false
        };

        $.each(markers_data, function(index, marker_data) {

            if ( typeof marker_data === 'undefined') {

                return;

            }

            var markerImage = {
                url: marker_data['pin']
                // This marker is 20 pixels wide by 32 pixels tall.
//                size: new google.maps.Size(180, 281),
//                // The origin for this image is 0,0.
//                origin: new google.maps.Point(0,0),
//                // The anchor for this image is the base of the flagpole at 0,32.
//                anchor: new google.maps.Point(0, 32)
            };

            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(marker_data['lat'], marker_data['lng']),
                map: map,
                icon: markerImage,
                shape: markerShape,
                title: marker_data['title'],
                zIndex: index + 1,
                fillOpacity: 1,
                animation: google.maps.Animation.DROP,
                visible: false
            });

            var contentString = '<div class="google-info-box">' +
                '<div class="google-info-box-close main-bg-color"><i class="fa fa-cancel"></i></div>' +
                '<div class="image"><img src="' + marker_data['thumb'] + '" /></div>' +
                '<div class="google-info">' +
                '<p class="google-title">' + marker_data['title'] + '</p>' +
                '<p class="google-description">' + marker_data['address'] + '</p>' +
                '<a href="' + marker_data['permalink'] + '" class="viewmore">View more <i class="fa fa-right-open border-main-color"></i></a>' +
                '</div>' +
                '<div class="arrow-down"></div>' +
                '</div>';

            marker.infoBox = new InfoBox(args);
            marker.infoBoxHtml = contentString;

            markers.push(marker);

        });

        for (var i = 0; i < markers.length; i++) {

            var marker = markers[i];

            google.maps.event.addListener(marker, 'click', function() {

                var infoBox = marker.infoBox;

                infoBox.setContent(this.infoBoxHtml);
                infoBox.open(map, this);

                google.maps.event.addListener(infoBox, 'domready', function () {

                    var infoBoxClose = document.getElementsByClassName("google-info-box-close");

                    infoBoxClose[0].addEventListener('click', function() {

                        infoBox.close(map, marker);

                    }, false);

                });

            });

        }

    }

    function mapFocusOnMarkers(markers) {

        for (var i = 0; i < markers.length; i++)
        {
            bounds.extend(markers[i].getPosition());
        }

        google.maps.event.addListener(map, 'zoom_changed', function() {
            zoomChangeBoundsListener =
                google.maps.event.addListener(map, 'bounds_changed', function(event) {
                    if (this.getZoom() > 15 && this.initialZoom == true) {
                        // Change max/min zoom here
                        this.setZoom(15);
                        this.initialZoom = false;
                    }
                    google.maps.event.removeListener(zoomChangeBoundsListener);
                });
        });

        map.initialZoom = true;
        map.fitBounds(bounds);
//        map.panToBounds(bounds);
//        map.panTo(bounds.getCenter());

    }

    function init_markers_bounds(markers_data) {

        $.each(markers_data, function(index, marker) {

            bounds.extend(new google.maps.LatLng(marker['lat'], marker['lng']));

        });

    }

    function map_focus(markers) {

//        $.each(markers, function(index, marker) {
//
//            var marker_position = new google.maps.LatLng(marker['lat'], marker['lng']);
//
//            bounds.extend(marker_position);
//
//        });

        google.maps.event.addListener(map, 'zoom_changed', function() {
            zoomChangeBoundsListener =
                google.maps.event.addListener(map, 'bounds_changed', function(event) {
                    if (this.getZoom() > 15 && this.initialZoom == true) {
                        // Change max/min zoom here
                        this.setZoom(15);
                        this.initialZoom = false;
                    }
                    google.maps.event.removeListener(zoomChangeBoundsListener);
                });
        });

        map.initialZoom = true;
        map.fitBounds(bounds);

    }

    function add_marker(iterator) {

//        if (markers[iterator]) {
            markers[iterator].setVisible(true);
//        }

    }

    function filter_markers_by_distance() {

        var index_to_remove = [];

        $.each(markers_data, function(index, marker) {

            var marker_position = new google.maps.LatLng(marker['lat'], marker['lng']);

            var distance = google.maps.geometry.spherical.computeDistanceBetween (user_pos, marker_position);

            if (distance > search_distance) {

                index_to_remove.push(index);

            }

        });

        for (var i = index_to_remove.length - 1; i >= 0 ; i--) {

            markers_data.splice(index_to_remove[i], 1);

        }

    }

    function initialize() {

        var $_GET = {};

        document.location.search.replace(/\??(?:([^=]+)=([^&]*)&?)/g, function () {
            function decode(s) {
                return decodeURIComponent(s.split("+").join(" "));
            }

            $_GET[decode(arguments[1])] = decode(arguments[2]);
        });

        $_GET['action'] = 'get_map_data';

        console.log('$_GET', $_GET);

        $.ajax({
            type: "POST",
            url: ajaxurl,
            data: $_GET,
            success: function(data) {

                var data = JSON.parse(data);
                var settings = data.settings;
                markers_data = data.markers_data;
                user_marker_icon = settings.user_marker;
                search_distance = settings.search_distance * 1000;
                theme_color = settings.theme_color;
                clusters_icon = settings.clusters_icon;
                map_length_unit = settings.map_length_unit;
                var map_default_zoom = settings.map_default_zoom;
                var map_start_zoom = map_default_zoom != 0 ? map_default_zoom : 8;

                init_markers_bounds(markers_data);

                var map_default_center;

                if (markers_data.length != 0) {
                    map_default_center = bounds.getCenter();
                } else {
                    map_default_center = new google.maps.LatLng(settings.map_lat, settings.map_long);
                }

                var mapOptions = {
                    zoom: map_start_zoom,
                    center: map_default_center,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    scrollwheel: false,
                    disableDefaultUI: true,
                    panControl: false,
                    zoomControl: true,
                    mapTypeControl: false,
                    scaleControl: false,
                    streetViewControl: true,
                    overviewMapControl: false

                };

                function CoordMapType(tileSize) {
                    this.tileSize = tileSize;
                }

                CoordMapType.prototype.getTile = function(coord, zoom, ownerDocument) {
                    var div = ownerDocument.createElement('div');
                    div.style.width = this.tileSize.width + 'px';
                    div.style.height = this.tileSize.height + 'px';
                    div.style.fontSize = '10';
                    div.style.backgroundColor = settings.second_theme_color;
                    div.style.opacity = settings.overlay_opacity;
                    return div;
                };

                map = new google.maps.Map(document.getElementById('main-map-canvas'), mapOptions);

//                google.maps.event.addListenerOnce(map, 'tilesloaded', function(){
                    //this part runs when the mapobject is created and rendered

//                });

                google.maps.event.addListenerOnce(map, 'idle', function() {

                    if (settings.is_geolocation_active) {

                        if(navigator.geolocation) {

                            navigator.geolocation.getCurrentPosition(function(position) {

                                var pos = new google.maps.LatLng(position.coords.latitude,
                                    position.coords.longitude);

                                user_pos = pos;

                                map.setCenter(pos);

                                var markerShape = {
                                    coords: [1, 1, 1, 48, 72, 48, 72 , 1],
                                    type: 'poly'
                                };

                                var markerImage = {
                                    url: user_marker_icon
                                };

                                var user_marker = new google.maps.Marker({
                                    position: pos,
                                    map: map,
                                    icon: markerImage,
                                    shape: markerShape,
                                    title: 'Your Location',
                                    zIndex: 1,
                                    fillOpacity: 1,
                                    visible: true
                                });

                                if (map_length_unit == 'km') {

                                    var circle_radius = parseInt(search_distance);

                                } else {

                                    var circle_radius = parseInt(search_distance * 1.621371192);

                                }

                                var circle = new google.maps.Circle({
                                    center: pos,
                                    map: map,
                                    radius: circle_radius,
                                    strokeColor: theme_color,
                                    strokeOpacity: 0.8,
                                    strokeWeight: 2,
                                    fillColor: theme_color
                                });

                                map.fitBounds(circle.getBounds());

                                filter_markers_by_distance();

                                if (markers_data.length > 0) {
                                    setMarkers(markers_data);
                                }

                                $.each(markers, function(index, marker) {
                                    setTimeout(function() {
                                        add_marker(index);
                                    }, index * 20);
                                });

                                var clusterStyles = [
                                    {
                                        textColor: 'black',
                                        url: clusters_icon,
                                        height: 48,
                                        width: 48
                                    },
                                    {
                                        textColor: 'black',
                                        url: clusters_icon,
                                        height: 48,
                                        width: 48
                                    },
                                    {
                                        textColor: 'black',
                                        url: clusters_icon,
                                        height: 48,
                                        width: 48
                                    }
                                ];

                                var mc_options = {
                                    gridSize: 50,
                                    styles: clusterStyles,
                                    maxZoom: 15
                                };

                                var markerCluster = new MarkerClusterer(map, markers, mc_options);

                            }, function() {
                                handleNoGeolocation(true);
                            });

                        } else {
                            // Browser doesn't support Geolocation
                            handleNoGeolocation(false);
                        }

                    } else {

                        if (markers_data.length != 0) {

                            map.fitBounds(bounds);

                            if (map_default_zoom) {
                                map.setZoom(map_default_zoom);
                            }

                            if (markers_data.length > 0) {
                                setMarkers(markers_data);
                            }

                            $.each(markers, function(index, marker) {
                                setTimeout(function() {
                                    add_marker(index);
                                }, index * 20);
                            });

                            var clusterStyles = [
                                {
                                    textColor: 'black',
                                    url: clusters_icon,
                                    height: 48,
                                    width: 48
                                },
                                {
                                    textColor: 'black',
                                    url: clusters_icon,
                                    height: 48,
                                    width: 48
                                },
                                {
                                    textColor: 'black',
                                    url: clusters_icon,
                                    height: 48,
                                    width: 48
                                }
                            ];

                            var mc_options = {
                                gridSize: 50,
                                styles: clusterStyles,
                                maxZoom: 15
                            }

                            var markerCluster = new MarkerClusterer(map, markers, mc_options);

                        }
                    }

                    map.overlayMapTypes.insertAt(0, new CoordMapType(new google.maps.Size(256, 256)));

                });

            },
            error: function() {



            }

        });

    }

    google.maps.event.addDomListener(window, 'load', initialize);

    var search_distance = $('input[name="search_distance"]').val();

    $('#slider').slider({
        value: search_distance,
        min: 1,
        max: 1000,
        slide: function( event, ui ) {
            $('.ui-slider-handle').find('.tooltip-inner').html(ui.value + ' ' + map_length_unit);
        },
        stop: function( event, ui ) {
            $('input[name="search_distance"]').val(ui.value);
        }
    });

    $( ".bara" ).mouseenter(function() {
        var value = $( "#slider" ).slider( "value" );

        $('.ui-slider-handle').html('<div class="tooltip top slider-tip"><div class="tooltip-arrow"></div><div class="tooltip-inner">' + value + ' ' + map_length_unit + '</div></div>');
    });

    $( ".bara" ).mouseleave(function() {
        $('.ui-slider-handle').html("");
    });

})(jQuery);