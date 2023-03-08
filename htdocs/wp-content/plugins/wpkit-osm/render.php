<?php
/**
 * Created by PhpStorm.
 * User: Ludwig
 * Date: 27.02.23
 * Time: 16:34
 */

//var_dump($attributes['markerContent']);
//var_dump($content);
echo '<hr>';
var_dump($attributes);
echo '<hr>';
var_dump(wp_get_attachment_image_src($attributes['mediaId'], 'full'));

//echo parse_blocks($attributes['markerContent'])[0]['innerHTML'];

if ( $attributes['mediaId'] ) {
    $marker = wp_get_attachment_image_src($attributes['mediaId'], 'full');

    if ( $marker[1] || $marker[2] > 80 ) {
        var_dump('to big');
    }
}
?>

<div id="map" style="height: <?= $attributes['mapHeight'] ?>px; width: <?= $attributes['mapWidth'] ?>%"></div>

<script>
    jQuery(document).ready(function($) {
        var map = L.map('map').setView([<?= $attributes['lat'] ?>, <?= $attributes['lng'] ?>], <?= $attributes['zoom'] ?>);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        <?php if ($attributes['mediaUrl']) : ?>
        <?php $marker = wp_get_attachment_image_src($attributes['mediaId'], 'full'); ?>
        <?php $anchorY = $marker[2] / 2; ?>
        <?php $anchorX = $marker[1] / 2; ?>
        var markerIcon = L.icon({
            iconUrl: '<?= $marker[0] ?>',
            iconSize: [<?= $marker[1] ?>, <?= $marker[2] ?>],
            popupAnchor: [0, -<?= $marker[2] ?>],
            iconAnchor: [<?= $anchorX ?>, <?= $marker[2] ?>],
        });
        <?php endif; ?>

        L.marker([<?= $attributes['lat'] ?>, <?= $attributes['lng'] ?>], <?php if ($attributes['mediaUrl']) : ?>{icon: markerIcon}<?php endif; ?>).addTo(map)
            .bindPopup("<?= str_replace(array("\n", "\r"), '', $content) ?>")
            .openPopup();
    });
</script>