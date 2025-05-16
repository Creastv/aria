// Initialize the map
const map = L.map("map").setView([52.3105, 20.9793], 15); // Approximate coordinates for Legionowo area

// Add custom white map style
L.tileLayer("https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png", {
    attribution:
        '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
    subdomains: "abcd",
    maxZoom: 19,
}).addTo(map);
const olszankowaArea = L.circle([52.31, 20.9715], {
    // Adjusted longitude to move left
    radius: 500, // radius in meters
    color: "#f8a13f",
    fillColor: "#f8a13f",
    fillOpacity: 0.15,
    weight: 1,
}).addTo(map);

// Create a larger circular area with lighter color
const largerCircle = L.circle([52.31, 20.9715], {
    // Adjusted longitude to match inner circle
    radius: 1200,
    color: "#f8a13f",
    fillColor: "#f8a13f",
    fillOpacity: 0.1,
    weight: 1,
}).addTo(map);

// Add the logo as a separate marker
const logoIcon = L.icon({
    iconUrl: "assets/img/map/map-marker-2.svg",
    iconSize: [178, 105],
    iconAnchor: [90, 0],
    popupAnchor: [0, -25],
});

// Add the logo marker slightly above the main marker
const logoMarker = L.marker([52.311, 20.9715], { icon: logoIcon }).addTo(map);

// Create custom icon for the main location using orange pin
// const mainIcon = L.icon({
//     iconUrl: "assets/img/map/map-marker-2.svg",
//     iconSize: [178, 105],
//     iconAnchor: [90, 50],
//     popupAnchor: [0, -25],
// });

// Add the main marker for "Moja Olszankowa"
// const mainMarker = L.marker([52.312, 20.978], { icon: mainIcon }).addTo(map);
// mainMarker.bindPopup("<b>Moja Olszankowa</b><br>Osiedle mieszkaniowe").openPopup();

// Define different POI icons for each category
const transportIcon = L.icon({
    iconUrl: "assets/img/map/train.svg",
    iconSize: [46, 51],
    iconAnchor: [23, 51],
    popupAnchor: [0, -51],
});

const educationIcon = L.icon({
    iconUrl: "assets/img/map/school.svg",
    iconSize: [46, 51],
    iconAnchor: [23, 51],
    popupAnchor: [0, -51],
});

const shoppingIcon = L.icon({
    iconUrl: "assets/img/map/cart.svg",
    iconSize: [46, 51],
    iconAnchor: [23, 51],
    popupAnchor: [0, -51],
});

const theaterIcon = L.icon({
    iconUrl: "assets/img/map/mask.svg",
    iconSize: [46, 51],
    iconAnchor: [23, 51],
    popupAnchor: [0, -51],
});

const stationIcon = L.icon({
    iconUrl: "assets/img/map/train.svg",
    iconSize: [46, 51],
    iconAnchor: [23, 51],
    popupAnchor: [0, -51],
});

// Add POI markers with specific icons
const pois = [
    {
        position: [52.3135, 20.9753],
        name: "Przystanek autobusowy",
        icon: transportIcon,
    },
    {
        position: [52.3085, 20.9733],
        name: "Szkoła podstawowa nr 19",
        icon: educationIcon,
    },
    {
        position: [52.3145, 20.9783],
        name: "Centrum Handlowe Arena",
        icon: shoppingIcon,
    },
    {
        position: [52.3065, 20.9813],
        name: "Galeria Handlowa Kaskada",
        icon: shoppingIcon,
    },
    {
        position: [52.3095, 20.9833],
        name: "Teatr Muzyczny w Legionowie",
        icon: theaterIcon,
    },
    {
        position: [52.3075, 20.9773],
        name: "Dworzec Główny PKP w Legionowie",
        icon: stationIcon,
    },
];

// Add all POI markers to the map with their specific icons
pois.forEach((poi) => {
    L.marker(poi.position, { icon: poi.icon })
        .addTo(map)
        .bindPopup(`<b>${poi.name}</b>`);
});
