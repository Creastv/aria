<?php
$poi = get_field('punkty_poi');
$localization = get_field('lokalizacja_inwestycji');
if ($localization) :
    $loc = $localization['lokalizacja'];
    $pin = $localization['pin'];
    $zoom = $localization['zoom'];
endif;
?>
<!-- =================== Map Area =================== -->
<div class="map-area">

    <div class="row">
        <div class="col-lg-6">
            <div class="map-left">
                <div class="section-title">
                    <InnerBlocks />
                </div>
                <!-- /.section-title -->
            </div>
            <!-- /.map-left -->
        </div>
        <!-- /.col-lg-5 -->
        <div class="col-lg-6">
            <div class="map-right">
                <div id="map"></div>
            </div>
            <!-- /.map-right -->
        </div>
        <!-- /.col-lg-7 -->
    </div>
    <!-- /.row -->
</div>
<!-- /.map-area -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/plugins/leaflet.js"></script>
<script>
    // Initialize the map
    const map = L.map("map").setView([<?php echo $loc['lat']; ?>, <?php echo $loc['lng'] + 00.006; ?>],
        15); // Approximate coordinates for Legionowo area

    // Add custom white map style
    L.tileLayer("https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png", {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
        subdomains: "abcd",
        maxZoom: <?php echo $zoom; ?>,
    }).addTo(map);
    const olszankowaArea = L.circle([<?php echo $loc['lat']; ?>, <?php echo $loc['lng']; ?>], {
        // Adjusted longitude to move left
        radius: 500, // radius in meters
        color: "#f8a13f",
        fillColor: "#f8a13f",
        fillOpacity: 0.15,
        weight: 1,
    }).addTo(map);

    // Create a larger circular area with lighter color
    const largerCircle = L.circle([<?php echo $loc['lat']; ?>, <?php echo $loc['lng']; ?>], {
        // Adjusted longitude to match inner circle
        radius: 1200,
        color: "#f8a13f",
        fillColor: "#f8a13f",
        fillOpacity: 0.1,
        weight: 1,
    }).addTo(map);

    // // Add the logo as a separate marker
    const logoIcon = L.icon({
        iconUrl: "<?php echo $pin ? $pin : get_template_directory_uri() . '/assets/img/map/map-marker-2.svg'; ?>",
        iconSize: [47, 47],
        iconAnchor: [23, 23],
        popupAnchor: [0, 0],
    });

    // Add the logo marker slightly above the main marker
    const logoMarker = L.marker([<?php echo $loc['lat']; ?>, <?php echo $loc['lng']; ?>], {
        icon: logoIcon,
        name: 'test',
    }).addTo(map);

    // Add POI markers with specific icons
    const pois = [
        <?php foreach ($poi as $po) { ?> {
                // icon: transportIcon,
                name: '<?php echo $po['nazwa_punktu']; ?>',
                position: [<?php echo $po['mapa']['lat']; ?>, <?php echo $po['mapa']['lng']; ?>],
                icon: L.icon({
                    iconUrl: '<?php echo $po['ikona']; ?>',
                    iconSize: [32, 45],
                    iconAnchor: [12, 41],
                    popupAnchor: [0, -41]
                })
            },
        <?php } ?>
        //{
        //     position: [52.3135, 20.9753],
        //     name: "Przystanek autobusowy",
        //     icon: transportIcon,
        // },
    ];

    // Add all POI markers to the map with their specific icons
    pois.forEach((poi) => {
        L.marker(poi.position, {
                icon: poi.icon
            })
            .addTo(map)
            .bindPopup(`<b>${poi.name}</b>`);
    });
</script>