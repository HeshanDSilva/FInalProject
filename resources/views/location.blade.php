@extends('layouts.master')

@section('content')
<div class="content-wrapper ScrollStyle vl table-dark">
  <div id="map">

  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    var device = <?php echo $device; ?>;
    var colombo = {lat:6.9271, lng:79.8612};
    var latlang;
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 8,
      center: colombo
    });

    for(i=0;i<device.length;i++){
      latlang = {lat: device[i].latitude, lng: device[i].longitude};
      if(device[i].state == 'Pending'){
        PendingMarker(latlang);
      }

      else if(device[i].state == 'Active'){
        ActiveMarker(latlang);
      }
      else {
        DissabledMarker(latlang);
      }
    };

    function PendingMarker(position){
      var marker = new google.maps.Marker({
      position: position,
      map: map,
      animation: google.maps.Animation.DROP,
      icon:"/Icons/orangeMarker.png"
     });
   };

   function ActiveMarker(position){
     var marker = new google.maps.Marker({
     position: position,
     map: map,
     animation: google.maps.Animation.DROP,
     icon:"/Icons/greenMarker.png"
    });
  };

  function DissabledMarker(position){
    var marker = new google.maps.Marker({
    position: position,
    map: map,
    animation: google.maps.Animation.DROP,
    icon:"/Icons/redMarker.png",
   });
 };

});
</script>
@endsection
