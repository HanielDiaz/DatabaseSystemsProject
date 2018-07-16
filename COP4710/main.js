function Cancel(url){
  window.location.href = url;
}

function Login(url){
  window.location.href = url;
}


function initMap() {
  // The location of Uluru
  var uluru = {lat: 28.6024, lng: -81.2001};
  // The map, centered at Uluru
  var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 15, center: uluru});
  // The marker, positioned at Uluru
  var marker = new google.maps.Marker({position: uluru, map: map});
}
