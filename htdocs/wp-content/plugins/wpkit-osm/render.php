<?php
/**
 * Created by PhpStorm.
 * User: Ludwig
 * Date: 27.02.23
 * Time: 16:34
 */

//var_dump($attributes);

?>

<div id="map" style="height: 400px;"></div>

<script>
    jQuery(document).ready(function($) {
        var map = L.map('map').setView([<?= $attributes['lat'] ?>, <?= $attributes['lng'] ?>], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([<?= $attributes['lat'] ?>, <?= $attributes['lng'] ?>]).addTo(map)
            .bindPopup("<?= $attributes['content'] ?>")
            .openPopup();
    });
</script>
