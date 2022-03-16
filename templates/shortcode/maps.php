<?php

try {
    $page_id = get_queried_object_id();

    if (isset($atts['id'])) {
        $bentral_unit_id = $atts['id'];
        include_once 'map.php';
        return;
    }

    if (!empty($page_id)) {
        include 'bentral_helpers.php';

        $elem_id                   = wp_generate_uuid4();
        $lang                      = bentral_widget_language();
        $map_style                 = (isset($atts['style'])) ? $atts['style'] : "width:100%; height:350px;";
        $bentral_google_api_key    = get_option('bentral_google_api_key');
        $bentral_google_center_lat = get_option('bentral_google_center_lat');
        $bentral_google_center_lng = get_option('bentral_google_center_lng');
        $bentral_google_zoom       = get_option('bentral_google_zoom');
        $bentral_google_type       = get_option('bentral_google_type');
        $bentral_type              = get_option('bentral_type');
        $list                      = [];
        $properties                = get_option('bentral_all_properties');
        if (empty($properties)) {
            return null;
        }
        foreach ($properties as $property) {
            if ($bentral_type == 'bentral_full') {
                $page_id = V($property, 'post_id');
            } else {
                $page_id = V(V($property, 'post'), '$lang');
            }
            if (!empty($page_id)) {
                $bentral_unit        = V($property, 'unit');
                $bentral_coordinates = V(V($property, 'property'), 'coordinates');
                $list[] = (object)[
                    'id'      => V($bentral_unit, 'id'),
                    'post_id' => $post->ID,
                    'title'   => bentral_property_title($property, $page_id),
                    'lat'     => V($bentral_coordinates, 'lat'),
                    'lng'     => V($bentral_coordinates, 'lon'),
                    'img'     => bentral_property_image($bentral_unit, $page_id),
                    'link'    => get_post_permalink($page_id)
                ];
            }
        }
    }

} catch (Exception $e) {
    echo 'Error: ', $e->getMessage(), "\n";
}

if (empty($bentral_google_api_key)) {
    $bentral_google_api_key = '';
}
if (empty($bentral_google_center_lat)) {
    $bentral_google_center_lat = '0';
}
if (empty($bentral_google_center_lng)) {
    $bentral_google_center_lng = '0';
}
if (empty($bentral_google_zoom)) {
    $bentral_google_zoom = '6';
}
if (empty($bentral_google_type)) {
    $bentral_google_type = 'satellite';
}

?>
<div id="bentral_map_<?= $elem_id; ?>" style="<?= $map_style; ?>"></div>
<style>
    .mapPopup {
        width: 250px;
        text-align: center;
    }

    .mapBTN {
        width: 100%;
        height: 30px;
        color: #FFF;
        font-weight: bold;
        background-color: #bb9e42;
        text-align: center;
        display: block;
        line-height: 30px;
        margin-top: 10px;
    }
</style>
<script>
    var markers = <?=json_encode($list)?>;

    function initMap() {
        var myLatlng = new google.maps.LatLng(<?=$bentral_google_center_lat;?>, <?=$bentral_google_center_lng;?>);
        var mapOptions = {
            zoom: <?=$bentral_google_zoom;?>,
            center: myLatlng,
            mapTypeId: '<?=$bentral_google_type;?>'
        };
        var map = new google.maps.Map(document.getElementById('bentral_map_<?=$elem_id;?>'), mapOptions);
        var infoWindow = new google.maps.InfoWindow;

        for (var i = 0; i < markers.length; i++) {
            var data = markers[i];
            var myLatlng = new google.maps.LatLng(data.lat, data.lng);
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: data.title
            });
            //Attach click event to the marker.
            (function (marker, data) {
                google.maps.event.addListener(marker, "click", function (e) {
                    var template = "<div class='mapPopup'><a href='" + data.link + "'><h5>" + data.title + "</h5><img src='" + data.img + "' alt='" + data.title + "' width='150' height='150' class='aligncenter size-thumbnail' /></a><a href='" + data.link + "' class='mapBTN'>INFO</a>";
                    infoWindow.setContent(template);
                    infoWindow.open(map, marker);
                });
            })(marker, data);
        }
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?= $bentral_google_api_key; ?>&callback=initMap" async
        defer></script>


