(g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})({
    key: "My_key",
    v: "weekly",
    // Use the 'v' parameter to indicate the version to use (weekly, beta, alpha, etc.).
            // Add other bootstrap parameters as needed, using camel case.
});

let currentmap;
let rlocation
 // initMap is now async
 async function initMap() {
    //Location for testing, UB North
    const location = { lat: 43.0018, lng: -78.788173 };
    //const location = { lat: 23, lng: -78.788173 }
    // Request libraries when needed, not in the script tag.
    const { Map } = await google.maps.importLibrary("maps");
    const {Place} = await google.maps.importLibrary("places");
    const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");
    
    //Create New Map
    const currentmap = new Map(document.getElementById("map"), {
        center: { lat: 43.0018, lng: -78.788173 },
        zoom: 15,
        mapId: "TeamInternsMap",
    });
    //Create marker on location
    
    const request = {
        //query: 'University At Buffalo',
        query: 'Buffalo, NY',
        fields: ['name', 'geometry'],
    };
    var service = new google.maps.places.PlacesService(currentmap);

    service.findPlaceFromQuery(request, function (results, status) {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
            getl = results[0]
            //location = results[0].geometry.location
            marker = new AdvancedMarkerElement({
                map: currentmap,
                position:  results[0].geometry.location,
            });

            currentmap.setCenter(results[0].geometry.location);
            var service = new google.maps.places.PlacesService(currentmap);
            service.nearbySearch(
                { location: results[0].geometry.location, radius: 4500, type: ["restaurant"], keyword: ["American"]},
                (results, status, pagination) => {
                    if (status !== "OK" || !results) return;
                    addPlaces(results, currentmap);
                },
            );
        }
    });
}

async function addPlaces(places, map) {
    const placesList = document.getElementById("places");

    for (const place of places) {
        if (place.geometry && place.geometry.location) {
            const { AdvancedMarkerElement } = await google.maps.importLibrary("marker");
            marker = new AdvancedMarkerElement({
                map: map,
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
initMap();
