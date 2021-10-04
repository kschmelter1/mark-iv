jQuery(document).ready(function( $ ) {
  "use strict";

if (window.innerWidth > 1199) {
  google.maps.event.addDomListener(window, "load", startGmap);
}

function parseHtmlEntities(str) {
    return str.replace(/&#([0-9]{1,3});/gi, function(match, numStr) {
        var num = parseInt(numStr, 10); // read num as normal number
        return String.fromCharCode(num);
    });
}

function startGmap() { // &categories=5
  const siteURL = WPURLS.siteurl;
  let jsonURL = siteURL+'/wp-json/wp/v2/location/?per_page=100'; // 100 is the max Wordpress will print out
  if (typeof(WPURLS.archive) != "undefined" && WPURLS.archive != null) {
    jsonURL = siteURL+'/wp-json/wp/v2/location/?per_page=100&categories='+WPURLS.archive;
  }

  $.getJSON(jsonURL, function(data) {
      //data is the JSON string
      setupMap(data);
  });
}

function setupMap(data) {
  const mapDiv = document.getElementById("g-map-wrap");
  if (mapDiv === null) {return;}
  const locations = data;
  let markers = [];
  let currentFilter = null;
  let map;
  let bounds = new google.maps.LatLngBounds();;

  mapDiv.classList.add("active"); // Add CSS to map div so it's visible

  function initMap() {
    // Assigning center is unecessary; using fitBounds to assign center based on markers
    map = new google.maps.Map(mapDiv, {
      //center: {lat: 43.156578, lng: -77.608849},
      //zoom: 11,
      mapTypeControl: false,
      streetViewControl: false,
      //gestureHandling: 'none',
      zoomControl: true
    });

    //Calls function to populate the map with markers
    setMarkers(map);

    //now fit the map to the newly inclusive bounds
    map.fitBounds(bounds);

    // Add click listener to filter buttons
    $('.map-btn').on('click', function (ev) {
      ev.preventDefault(); // Prevent button from going to link while map is active
      $('.map-btn').removeClass('active');
      const category = this.getAttribute("data-cat");
      if (currentFilter != category) {
        $(this).addClass('active');
      }
      filterMarkers(category);
    });

  } // initMap

  function setMarkers(map) {

    // Set up icon images [ live = 4, work = 5, play = 6] - category id's in wordpress
    const iconBase = '/wp-content/themes/mark-iv/img/';
    const iconSize = 50;
    const icons = {
          work: {
            icon: {
              url: iconBase + 'marker-blue.png',
              scaledSize: new google.maps.Size(iconSize, iconSize),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(0, iconSize)
            }
          },
          live: {
            icon: {
              url: iconBase + 'marker-orange.png',
              scaledSize: new google.maps.Size(iconSize, iconSize),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(0, iconSize)
            }
          },
          play: {
            icon: {
              url: iconBase + 'marker-green.png',
              scaledSize: new google.maps.Size(iconSize, iconSize),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(0, iconSize)
            }
          },
          default: {
            icon: {
              url: iconBase + 'marker-default.png',
              scaledSize: new google.maps.Size(iconSize, iconSize),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(0, iconSize)
            }
          }
        };

    function getCat (catID) {
      let cat;
      if (catID.includes(5)) {
        cat = "work";
      } else if (catID.includes(4)) {
        cat = "live";
      } else if (catID.includes(6)) {
        cat = "play";
      } else {
        cat = "default";
      }
      return cat;
    }

    // Declare one infowindow so it will close when multiple markers are clicked
    let infowindow = new google.maps.InfoWindow();

    // Create Markers
    for (let i = 0; i < locations.length; i++) {
          const lat = locations[i].acf.geo_lat;
          const long = locations[i].acf.geo_lng;
          const type = getCat(locations[i].categories);
          const title = parseHtmlEntities(locations[i].title.rendered);
          const addr = locations[i].acf.address;
          let link = "";
          if (locations[i].acf.external_link) {
            link = '<a class="gmap-info-link" href="'+locations[i].acf.external_link+'" target="_blank">'+
              'Visit Website >'+'</a>';
          } else {
            link = '<a class="gmap-info-link" href="'+locations[i].link+'">'+
              'More Information >'+'</a>';
          }

          const content = '<div class="gmap-info">'+
            '<div class="gmap-info-title">'+title+'</div>'+
            '<div class="gmap-info-address">'+addr.street+'<br>'+
            addr.city+', '+addr.state+' '+addr.zip+'</div>'+
            '<div class="gmap-info-link">'+link+'</div>'+
            '</div>';

          //console.log(title+' '+lat+' '+long);
          //console.log(locations[i]);

          const marker = new google.maps.Marker({
            position: new google.maps.LatLng(lat, long),
            icon: icons[type].icon,
            map: map,
            title: title,
            category: type,
            animation: google.maps.Animation.DROP
          });

          marker.addListener('click', function() {
            infowindow.setContent(content);
            infowindow.open(map, marker);
          });

          // Fill array for filtering later
          markers.push(marker);

          //extend the bounds to include each marker's position
          bounds.extend(marker.position);
        };

  } // setMarkers

  function filterMarkers(category) {
    if (currentFilter != category) {
      currentFilter = category;
      for (let i = 0; i < markers.length; i++) {
          if (markers[i].category == category) {
            markers[i].setAnimation(google.maps.Animation.DROP);
            markers[i].setVisible(true);
          } else {
            markers[i].setAnimation(null);
            markers[i].setVisible(false);
          }
      }
    } else {
      // Clears all filters when active filter is clicked again
      currentFilter = null;
      for (let i = 0; i < markers.length; i++) {
        markers[i].setVisible(true);
      }
    }
  }

  // Call functions
  initMap();
} // setupMap

});
