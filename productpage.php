<?php
include 'header.php';
include 'includes/dbh.inc.php';

$ad_id = $_GET['ad_id'];

if (isset($_SESSION['userid'])) {
    $user_id = $_SESSION['userid'];
}


//chceck if ad exists
$ad = getAllAdIds($conn);
$ads = array();
$numodads = count($ad);
$i = 0;
while ($i < $numodads) {
    $a = $ad[$i][0];
    $ads[$i] = $a;
    $i++;
}

if (!in_array($ad_id, $ads)) {
    header("Location:adlist.php");
}
?>

<section id="product-info">

    <?php

    $row1 = getAdInfo($conn, $ad_id);
    ?>

    <div class="item-image-parent">
        <div class="item-list-vertical">
            <?php
            $img = getAdImgs($conn, $ad_id);
            $j = 0;
            while ($j < count($img)) {

            ?>
                <div class='thumb-box'>
                    <img src='includes\img\<?php echo $img[$j][1] ?>' />
                </div>
            <?php
                $j++;
            }
            ?>

        </div>

    </div>

    <div class="item-info-parent">
        <!-- main info -->
        <div class="main-info">
            <h1> <?php echo $row1['title']; ?></h1>
            <p>Leie: <span id="price"><?php echo $row1['leie']; ?></span>kr</p>
            <p>Depositum: <span><?php echo $row1['depositum']; ?></span>kr</p>
            <p>Ledig fra: <span><?php echo $row1['ledigfra'] ?></span></p>
        </div>
        <!-- Choose -->
        <div class="select-items">

            <div class="description">
                <h4>Mer informasjon:</h4>
                <p><?php echo $row1['info']; ?></p>
                <br>
            </div>
        </div>
        <fieldset>
            <legend>Fasiliteter</legend>
            <ul>
                <li><?php echo $row1['fasilitet']; ?></li>
            </ul>

        </fieldset>
        <?php
        $address = $row1['adresse'];
        $row2 = getAdUserInfo($conn, $ad_id);
        $to_id = $row2['usersId'];
        ?>
        <div>
            <p> <b>Adresse:</b> </p>
            <p><?php echo $row1['adresse'] . ", " . $row1['postnr'] . " " . $row1['poststed'];  ?></p>
        </div>
        <div id="map" class="item-map"></div>

        <script src="https://unpkg.com/@mapbox/mapbox-sdk/umd/mapbox-sdk.min.js"></script>


        <?php
        if (isMyAd($conn, $ad_id, $user_id)) { ?>

            <div class="kontakt">
                <a class="kntkt" <?php if (isset($_SESSION['userid'])) { ?> href="editad.php?ad_id=<?php echo $ad_id; ?>"> <?php }
                                                                                                                            ?> Rediger
                </a>
                <form action="includes/deletead.inc.php" method="post" enctype="multipart/form-data">
                    <button type="submit" name="submit">Slett Annonse</button>
                    <input type="hidden" name="ad_id" value="<?php echo $ad_id; ?>">
                </form>

            </div>

        <?php
        } else { ?>
            <div id="uname">Postet av: <?php
                                        $un = getUser($conn, $row1['usersId']);
                                        echo $un['usersName'];
                                        ?></div>
            <div class="kontakt">
                <a class="kntkt" <?php if (isset($_SESSION['userid'])) { ?> href="sendmsg.php?ad_id=<?php echo $ad_id . "&to_id=" . $to_id; ?>"> <?php } else { ?> href="login.php"> <?php }
                                                                                                                                                                                        ?> Kontakt
                </a>
            </div>
        <?php }
        ?>





        <script>
            var address = <?php echo (json_encode($address)); ?>;
            mapboxgl.accessToken = 'pk.eyJ1Ijoid2FyZXNhIiwiYSI6ImNsYXRvaW9jMzAyOHkzcm55M291emFzMnEifQ.V02tpKc9ruk40khemdFumQ';
            const mapboxClient = mapboxSdk({
                accessToken: mapboxgl.accessToken
            });
            mapboxClient.geocoding
                .forwardGeocode({
                    query: address,
                    autocomplete: false,
                    limit: 1
                })
                .send()
                .then((response) => {
                    if (
                        !response ||
                        !response.body ||
                        !response.body.features ||
                        !response.body.features.length
                    ) {
                        console.error('Invalid response:');
                        console.error(response);
                        return;
                    }
                    const feature = response.body.features[0];

                    const map = new mapboxgl.Map({
                        container: 'map',
                        // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
                        style: 'mapbox://styles/mapbox/streets-v12',
                        center: feature.center,
                        zoom: 15,
                        interactive: false
                    });

                    // Create a marker and add it to the map.
                    new mapboxgl.Marker().setLngLat(feature.center).addTo(map);
                });
        </script>
</section>

<!-- Description -->
</div>