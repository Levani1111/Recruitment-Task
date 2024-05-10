<?php
$title = get_field('title');
$valley_road_birkirkara_gallery = get_field('valley_road_birkirkara_gallery');
$ix_xatt_ta_xbiex_ta_xbiex_gallery = get_field('ix_xatt_ta_xbiex_ta_xbiex_gallery');
$fort_cambridge_triq_tigne__sliema_gallery = get_field('fort_cambridge_triq_tigne__sliema_gallery');

$marker_icon_hover = get_field('marker_icon_hover');

if ($marker_icon_hover) {
    $marker_icon_hover = $marker_icon_hover['url'];
}
$marker_icon = get_field('image');

if ($marker_icon) {
    $marker_icon = $marker_icon['url'];
}

$gyms = array(
    array(
        'title' => 'Vigor XF in Birkirkara',
        'address' => '18, Valley Road, Birkirkara',
        'map' => array(
            'lat' => 35.895720,
            'lng' => 14.461208
        ),
        'image' => $marker_icon,
        'gallery' => $valley_road_birkirkara_gallery
    ),
    array(
        'title' => 'Vigor XF in Ta’ Xbiex',
        'address' => '120, ix-Xatt Ta\' Xbiex, Ta\' Xbiex',
        'map' => array(
            'lat' => 35.904712,
            'lng' => 14.499508
        ),
        'image' => $marker_icon,
        'gallery' => $ix_xatt_ta_xbiex_ta_xbiex_gallery
    ),
    array(
        'title' => 'Vigor XF in Sliema',
        'address' => 'Fort Cambridge, Triq Tigne\', Sliema',
        'map' => array(
            'lat' => 35.906059,
            'lng' => 14.505607
        ),
        'image' => $marker_icon,
        'gallery' => $fort_cambridge_triq_tigne__sliema_gallery
    )
);

?>




<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">


<section class="gym-locations-block">
    <div class="inner">
        <div class="wrapper">
            <div class="title">
                <?php if ($title) : ?>
                <h2><?= $title; ?></h2>
                <?php endif; ?>
            </div>
            <div class="gym-map"></div>
        </div>
    </div>
</section>


<script>
var gyms = <?php echo json_encode($gyms); ?>;

function initMap() {
    var mapOptions = {
        zoom: 14,
        center: {
            lat: gyms[0].map.lat,
            lng: gyms[0].map.lng
        },

    };

    var map = new google.maps.Map(document.querySelector('.gym-map'), mapOptions);



    gyms.forEach(function(gym) {
        addMarker(map, gym);
    });

}

function addMarker(map, gym) {
    var defaultIcon = {
        url: gym.image,
        scaledSize: new google.maps.Size(60, 60),
    };

    var marker = new google.maps.Marker({
        position: gym.map,
        map: map,
        title: gym.title,
        icon: defaultIcon
    });

    var remainingImages = gym.gallery.length - 4;

    var contentString = `
    <div class="infowindow">
        <h3>${gym.title}</h3>
        <p>${gym.address}</p>
        <!-- Image gallery -->
        <div class="gallery" style="position: relative;">
            ${gym.gallery.map((image, index) => `
                <a href="${image.url}" data-lightbox="gallery-${gym.title}" data-title="${image.alt}" ${index >= 4 ? 'style="display: none;"' : ''}>
                    <img src="${image.url}" alt="${image.alt}" data-index="${index}">
                </a>`).join('')}
            <div class="see-more-container" style="position: absolute; top: 50%; left: 87%; transform: translate(-50%, -50%); display: ${gym.gallery.length > 4 ? 'block' : 'none'};">
                <a class="show-all-images" data-lightbox="gallery-${gym.title}" data-title="See more images"> ${remainingImages} more</a>
            </div>
        </div>
    </div>`;


    var infowindow = new google.maps.InfoWindow({
        content: contentString,
    });


    marker.addListener('click', function() {
        infowindow.open(map, marker);


        var clickedIcon = {
            url: '<?php echo $marker_icon_hover; ?>',
            scaledSize: new google.maps.Size(50, 50),
        };

        marker.setIcon(clickedIcon);

    });

    infowindow.addListener('closeclick', function() {
        marker.setIcon(defaultIcon);
    });

}

initMap();
</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBStk5YWOHS6qD4rPuTK_7CXF_BlUQy2Sw&callback=initMap">
</script>