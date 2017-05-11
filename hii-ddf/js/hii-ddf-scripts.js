     
function initMap() {
    var infoWindow = new google.maps.InfoWindow();
	
	var map = new google.maps.Map(document.getElementById('hiiddf_map'), {
				center: {lat: -31.563910, lng: 147.154312},
				scrollwheel: false,
				zoom: 8
			}),
		geocoder = new google.maps.Geocoder(),
		labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
		bounds = new google.maps.LatLngBounds(),
		markers = locations.map(function(location, i) {
			bounds.extend(location);
			var marker = new google.maps.Marker({
				position: location,
				label: labels[i % labels.length]
			}); 
			google.maps.event.addListener(marker, 'click', function(e){
				jQuery.ajax({
					url: hii_ddf.ajax_url,
					type: 'post',
					data: {
						action: 'get_listing_map_info',
						post_id: location.id
					},
					success: function(response) {
						infoWindow.setContent(response);				
						infoWindow.open(map,marker);
					}
				});
				
			});
			return marker;
        }),
        markerCluster = new MarkerClusterer(map, markers, {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
        
		
	map.fitBounds(bounds);      
	
	var styles = {
        default: null,
        silver: [
	          {
	            elementType: 'geometry',
	            stylers: [{color: '#f5f5f5'}]
	          },
	          {
	            elementType: 'labels.icon',
	            stylers: [{visibility: 'off'}]
	          },
	          {
	            elementType: 'labels.text.fill',
	            stylers: [{color: '#616161'}]
	          },
	          {
	            elementType: 'labels.text.stroke',
	            stylers: [{color: '#f5f5f5'}]
	          },
	          {
	            featureType: 'administrative.land_parcel',
	            elementType: 'labels.text.fill',
	            stylers: [{color: '#bdbdbd'}]
	          },
	          {
	            featureType: 'poi',
	            elementType: 'geometry',
	            stylers: [{color: '#eeeeee'}]
	          },
	          {
	            featureType: 'poi',
	            elementType: 'labels.text.fill',
	            stylers: [{color: '#757575'}]
	          },
	          {
	            featureType: 'poi.park',
	            elementType: 'geometry',
	            stylers: [{color: '#e5e5e5'}]
	          },
	          {
	            featureType: 'poi.park',
	            elementType: 'labels.text.fill',
	            stylers: [{color: '#9e9e9e'}]
	          },
	          {
	            featureType: 'road',
	            elementType: 'geometry',
	            stylers: [{color: '#ffffff'}]
	          },
	          {
	            featureType: 'road.arterial',
	            elementType: 'labels.text.fill',
	            stylers: [{color: '#757575'}]
	          },
	          {
	            featureType: 'road.highway',
	            elementType: 'geometry',
	            stylers: [{color: '#dadada'}]
	          },
	          {
	            featureType: 'road.highway',
	            elementType: 'labels.text.fill',
	            stylers: [{color: '#616161'}]
	          },
	          {
	            featureType: 'road.local',
	            elementType: 'labels.text.fill',
	            stylers: [{color: '#9e9e9e'}]
	          },
	          {
	            featureType: 'transit.line',
	            elementType: 'geometry',
	            stylers: [{color: '#e5e5e5'}]
	          },
	          {
	            featureType: 'transit.station',
	            elementType: 'geometry',
	            stylers: [{color: '#eeeeee'}]
	          },
	          {
	            featureType: 'water',
	            elementType: 'geometry',
	            stylers: [{color: '#c9c9c9'}]
	          },
	          {
	            featureType: 'water',
	            elementType: 'labels.text.fill',
	            stylers: [{color: '#9e9e9e'}]
	          }
			],
    	};
    map.setOptions({styles: styles.silver});
    
    
		
	var input = document.getElementById('ddf_search_listings');
	var options = {
		  types: ['(regions)'],
		  componentRestrictions: {country: 'ca'}
		};
		
	autocomplete = new google.maps.places.Autocomplete(input, options);
}


function geocodeAddress(address, geocoder, resultsMap) {
	geocoder.geocode({'address': address}, function(results, status) {
		if (status === 'OK') {
			resultsMap.setCenter(results[0].geometry.location);
			
			return results[0].geometry.location;
		} else {
			alert('Geocode was not successful for the following reason: ' + status);
		}
	});
}


