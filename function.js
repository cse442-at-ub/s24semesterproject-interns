let currentmap;
let service;
let infowindow;

function intitMap() {
    var location = { lat: 43.0018, lng: -78.788173 };
    var service;
    var currentmap;
    /*var map = new google.maps.Map(document.getElementById("map"),{
        map:map,
        zoom:4,
        center:location
    });*/

    infowindow = new google.maps.InfoWindow();

    currentmap = new google.maps.Map(
        document.getElementById('map'), { center: location, zoom: 15 });

    var request = {
        query: 'University At Buffalo',
        fields: ['name', 'geometry'],
    };

    var service = new google.maps.places.PlacesService(currentmap);
    var getl;
    service.findPlaceFromQuery(request, function (results, status) {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
            getl = results[0]
            for (var i = 0; i < results.length; i++) {
                //createMarker(results[i]);
                currentmap.setCenter(results[0].geometry.location);
                const marker = new google.maps.Marker({
                    currentmap,
                    position: results[i].geometry.location,
                });
                google.maps.event.addListener(marker, "click", () => {
                    infowindow.setContent(results[0].name || "");
                    infowindow.open(currentmap);
                });
            }
        }
    });
    service.nearbySearch(
        { location: location, radius: 500, type: "store" },
        (results, status, pagination) => {
            if (status !== "OK" || !results) return;
            addPlaces(results, currentmap);
        },
    );

}


function addPlaces(places, map) {
    const placesList = document.getElementById("places");

    for (const place of places) {
        if (place.geometry && place.geometry.location) {
            const image = {
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25),
            };

            new google.maps.Marker({
                map,
                icon: image,
                title: place.name,
                position: place.geometry.location,
            });

            const li = document.createElement("li");

            li.textContent = place.name;
            placesList.appendChild(li);
            li.addEventListener("click", () => {
                map.setCenter(place.geometry.location);
                map.setZoom(20)
            });
        }
    }
}