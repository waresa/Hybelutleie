// Change nav menu color if on that page!
let pageUrl = window.location.pathname;
let getNav = document.querySelectorAll("nav div ul li a");

for (let i = 0; i < getNav.length; i++) {
    // Get URL info
    let pageUrlName = pageUrl.split("/");
    let pageUrlLength = pageUrlName.length - 1;
    // Get links info
    let pageNav = getNav[i].pathname;
    let pageNavName = pageNav.split("/");
    let pageNavLength = pageNavName.length - 1;
    let pageFinalName = pageNavName[pageNavLength];
    let pageNavExists = pageUrl.includes(pageFinalName);
    // Change links color
    if (pageNavExists == true) {
        getNav[i].style.cssText = "color: red;";
    } else if (pageUrlName[pageUrlLength] == "") {
        getNav[0].style.cssText = "color: red;";
    }
}



// var address = <?php echo (json_encode($address)); ?>;
// mapboxgl.accessToken = 'pk.eyJ1Ijoid2FyZXNhIiwiYSI6ImNsYXRvaW9jMzAyOHkzcm55M291emFzMnEifQ.V02tpKc9ruk40khemdFumQ';
// const mapboxClient = mapboxSdk({
//     accessToken: mapboxgl.accessToken
// });
// mapboxClient.geocoding
//     .forwardGeocode({
//         query: address,
//         autocomplete: false,
//         limit: 1
//     })
//     .send()
//     .then((response) => {
//         if (!response ||
//             !response.body ||
//             !response.body.features ||
//             !response.body.features.length
//         ) {
//             console.error('Invalid response:');
//             console.error(response);
//             return;
//         }
//         const feature = response.body.features[0];

//         const map = new mapboxgl.Map({
//             container: 'map',
//             // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
//             style: 'mapbox://styles/mapbox/streets-v12',
//             center: feature.center,
//             zoom: 15
//         });

//         // Create a marker and add it to the map.
//         new mapboxgl.Marker().setLngLat(feature.center).addTo(map);
//     });