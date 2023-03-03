<?php
/**
 * Created by PhpStorm.
 * User: Ludwig
 * Date: 27.02.23
 * Time: 16:34
 */
?>

<div id="map" style="height: 400px;"></div>

<script>
    jQuery(document).ready(function($) {
        var map = L.map('map').setView([<?= $attributes['lat'] ?>, <?= $attributes['lng'] ?>], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var markerIcon = L.divIcon({
            //className: 'dashicons',
            html: '<span class="dashicons dashicons-location"></span>',
            iconSize: [50, 50],
            //iconAnchor: [22, 94],
            popupAnchor: [0, -20],
        });

        L.marker([<?= $attributes['lat'] ?>, <?= $attributes['lng'] ?>], {icon: markerIcon}).addTo(map)
            .bindPopup("<?= $attributes['content'] ?>")
            .openPopup();
    });
</script>
