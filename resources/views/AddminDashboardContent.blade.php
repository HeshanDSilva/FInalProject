@extends('layouts.master')

@section('content')
<div class="content-wrapper ScrollStyle vl" style="background-color:black">

<section class="content-header">
</section>
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-primary">
          <div class="inner">
            <?php $N=0; ?>
            @foreach($user as $users)
                <?php $N++; ?>
            @endforeach
            <h3>{{$N}}</h3>
            <p>Number Of Users</p>
          </div>
          <div class="icon">
              <i class="fa fa-address-book-o"></i>
          </div>
          <a href="/UserDetails" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-primary">
          <div class="pull-left image">

        </div>
          <div class="inner">
            <?php $M=0; ?>
            @foreach($image as $images)
                <?php $M++; ?>
            @endforeach
            <h3>{{$M}}</h3>
            <p>Number Of images</p>
          </div>
          <div class="icon">
            <i class="fa fa-file-photo-o"></i>
          </div>
          <a href="/admin/all/sliders" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-primary">
          <div class="inner">
            <?php $L=0; ?>
            @foreach($dvideo as $videos)
                <?php $L++; ?>
            @endforeach
            <h3>{{$L}}</h3>
            <p>Number of video </p>
          </div>
          <div class="icon">
            <i class="fa fa-file-movie-o"></i>
          </div>
          <a href="/admin/all/videos" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-primary">
          <div class="inner">
            <?php $P=0; ?>
            @foreach($news as $newss)
                <?php $P++; ?>
            @endforeach
            <h3>{{$P}}</h3>

            <p>Number of News</p>
          </div>
          <div class="icon">
            <i class="fa fa-drivers-license-o"></i>
          </div>
          <a href="/admin/all/news" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>

    <div class="row" >
    <div class="col-lg-4">
            <!--pie chart example -->
          <div class="form-group">
          <div style="padding-left:0px;">
            <div class="panel panel-default">
              <div class="panel-body">
                  <div id="donutchart" style="width:100%; height:250px;color:white" >
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
              <!--pie chart example -->
          <div class="form-group">
            <div style="padding-left:0px">
              <div class="panel panel-default">
                <div class="panel-body">
                    <div id="barchart_values" style="width:100%; height:250px;">
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
                <!--pie chart example -->
            <div class="form-group">
              <div style="padding-left:0px">
                <div class="panel panel-default" style="background-color:#292b2c">
                  <div class="panel-body">
                    <div class="row">
                      <div class="form-group col-md-1">
                      </div>
                      <div class="form-group col-md-3">
                        <button class="btn-sm Dealer btn-danger wave-effect btn-bordred wave-light" type="button" id="Dealer">Dealer</button>
                      </div>
                      <div class="col-md-4">
                        <button class="btn-sm Distributor btn-primary wave-effect btn-bordred wave-light" type="button" id="Distributor">Distributor</button>
                      </div>
                      <div class="col-md-4">
                        <button class="btn-sm Retail btn-warning wave-effect btn-bordred wave-light" type="button" id="Retail">Retail</button>
                      </div>
                    </div>
                      <div id="barchart_Data" style="width:100%; height:205px;">
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
    <div class="row" style="margin-top:5px">
    <div class="col-lg-6">
        <?php $today=\Carbon\Carbon::now(); ?>
        <?php $lastSeven=\Carbon\Carbon::now()->subDays(7); ?>
        <?php $x=0; ?>
    <div class="table-dark" style="margin:0px">
      <table class="table table-dark" border="1px solid white">
        <thead class="alert-success">
          <div class="container-fluid" style="text-align:center">
              <tr>
                <div class="row">
                  <div class="col-md-9">
                    <h5>Recent Sliders</h5>
                  </div>
                  <div class="col-md-3">
                    <a href="/admin/all/sliders" class="small-box-footer" style="text-decoration:underline;color:white">More info <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              </tr>
          </div>
        <tr>
          <th scope="col">ImageId</th>
          <th scope="col">exd_ate</th>
          <th scope="col">Category</th>
          <th scope="col">State</th>
        </tr>
      </thead>
      <tbody>
        @foreach($image as $images)
        @if ($images->created_at <= $today )
          @if ($images->created_at >= $lastSeven )
            <tr>
              <th scope="row">{{$images->id}}</th>
              <td>{{$images->expired_date}}</td>
              <td>@if ($images->category == 'Distributor')
                    <button style="background-color:#0000FF;border:none;">{{$images->category}}</button>
                 @elseif($images->category == 'Dealer')
                    <button style="background-color:red;border:none;">{{$images->category}}</button>
                @elseif($images->category == 'Retail')
                    <button style="background-color:yellow;border:none;">{{$images->category}}</button>
                @else
                    <button style="background-color:green;border:none;">{{$images->category}}</button>
                @endif
              </td>
              <td>{{$images->state}}</td>
            </tr>
            <?php $x++; ?>
            @endif
        @endif
            @if($x == 6)
                @break
            @endif
        @endforeach
        @if($x != 6)
            @for($i = $x;$i<6;$i++)
            <tr>
                <td>* * * * *</td>
                <td>* * * * *</td>
                <td><td><button style="background-color:yellow;border:none;">* * * * *</button></td></td>
                <td>* * * * * </td>
            </tr>
            @endfor
        @endif
      </tbody>
      </table>
    </div>
    </div>
    <div class="col-md-6">
        <div id="dmap" style="width:100%;height:370px">
        </div>
    </div>
  </div>

  <div class="row" style="margin-top:5px">
    <div class="col-md-6">
             <!-- USERS LIST -->
             <div class="box box-danger table-dark">
               <div class="box-header with-border">
                 <h3 class="box-title" style="color:white">Latest Members</h3>

                 <div class="box-tools pull-right">
                   <span class="label label-danger"></span>
                   <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                   </button>
                   <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                   </button>
                 </div>
               </div>
               <!-- /.box-header -->
               <?php $z = 0; ?>
               <div class="box-body no-padding table-dark">
                 <ul class="users-list clearfix">
                   @foreach($user as $users)
                   @if($users->type == 'admin' || $users->type == 'editor')
                     <li>
                       <img src="/images/{{$users->avatar}}" alt="User Image" style="width:100px; height:100px" class="rounded-circle">
                       <a class="users-list-name" href="#" style="color:white;text-decoration:none">
                         @if($users->online_state == 0)
                          <i class="fa fa-circle text-danger"></i>
                        @else
                          <i class="fa fa-circle text-success"></i>
                        @endif
                          {{$users->name}}</a>
                       <span class="users-list-date">{{$users->type}}</span>
                       <?php $z++; ?>
                     </li>
                   @endif
                   @if($z == 8)
                    @break
                  @endif
                   @endforeach
                 </ul>
                 <!-- /.users-list -->
               </div>
               <!-- /.box-body -->
               <div class="box-footer text-center table-dark">
                 <a href="/UserDetails" class="uppercase">View All Users</a>
               </div>
               <!-- /.box-footer -->
             </div>
             <!--/.box -->
  </div>
    <div class="col-lg-6">
        <!-- /.video -->
        <?php $today1=\Carbon\Carbon::now(); ?>
        <?php $lastSeven1=\Carbon\Carbon::now()->subDays(7); ?>
        <?php $y=0; ?>
        <div class="table-dark" style="margin:0px">
        <table class="table table-dark" border="1px solid white">
          <thead class="alert-success">
            <div class="container-fluid" style="text-align:center">
                <tr>
                  <div class="row">
                    <div class="col-md-9">
                      <h5>Recent Videos</h5>
                    </div>
                    <div class="col-md-3">
                      <a href="/admin/all/videos" class="small-box-footer" style="text-decoration:underline;color:white">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                </tr>
            </div>
          <tr>
            <th scope="col">video_id</th>
            <th scope="col">ex_date</th>
            <th scope="col">state</th>
            <th scope="col">category</th>
            <th scope="col">AddedBy</th>

          </tr>
        </thead>
        <tbody>
          <div class="container col-lg-12">
          @foreach($dvideo as $videos)
          @if ($videos->created_at <= $today1 )
            @if ($videos->created_at >= $lastSeven1 )

                <tr>
                <th scope="row">{{$videos->video_id}}</th>
                <td>{{$videos->expired_date}}</td>
                <td>{{$videos->state}}</td>
                <td>@if ($videos->category == 'Distributor')
                      <button style="background-color:#0000FF;border:none;">{{$videos->category}}</button>
                   @elseif($videos->category == 'Dealer')
                      <button style="background-color:red;border:none;">{{$videos->category}}</button>
                  @elseif($videos->category == 'Retail')
                      <button style="background-color:yellow;border:none;">{{$videos->category}}</button>
                  @else
                      <button style="background-color:green;border:none;">{{$videos->category}}</button>
                  @endif
                </td>
                <td>{{$videos->AddedBy}}</td>
              </tr>
              <?php $y++; ?>
              @endif
          @endif
          @if($y == 7)
              @break
          @endif
          @endforeach
          @if($y != 7)
              @for($j = $y;$j<7;$j++)
              <tr>
                  <td>* * * * *</td>
                  <td>* * * * *</td>
                  <td>* * * * * </td>
                  <td><button style="background-color:yellow;border:none;">* * * * *</button></td>
                  <td>* * * * * </td>
              </tr>
              @endfor
          @endif
        </div>
        </tbody>
      </table>
    </div>
    </div>
  </div>
<?php $today2=\Carbon\Carbon::now(); ?>
<?php $lastSeven2=\Carbon\Carbon::now()->subDays(7); ?>
<?php $z=0; ?>
<div class="table-dark" style="margin:0px">
    <table class="table table-dark" border="1px solid white">
      <thead class="alert-success">
        <div class="container-fluid" style="text-align:center">
            <tr>
              <div class="row">
                <div class="col-md-10">
                  <h5>Recent News</h5>
                </div>
                <div class="col-md-2">
                  <a href="/admin/all/news" class="small-box-footer" style="text-decoration:underline;color:white">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </tr>
        </div>
      <tr>
        <th scope="col">News_id</th>
        <th scope="col">News</th>
        <th scope="col">State</th>
        <th scope="col">AddedBy</th>

      </tr>
    </thead>
    <tbody>
      @foreach($news as $newss)
      @if ($newss->created_at <= $today2 )
        @if ($newss->created_at >= $lastSeven2 )

            <tr>
            <th scope="row">{{$newss->id}}</th>
            <td>{{$newss->head}} {{$newss->body}} {{$newss->tail}}</td>
            <td>
            @if($newss->state == "Pending")
              <button style="background-color:yellow;border:none;">{{$newss->state}}</button>
            @elseif($newss->state == "Current")
              <button style="background-color:green;border:none;">{{$newss->state}}</button>
            @elseif($newss->state == "Rejected")
              <button style="background-color:red;border:none;">{{$newss->state}}</button>
            @else
              <button style="background-color:blue;border:none;">{{$newss->state}}</button>
            @endif
          </td>
            <td>{{$newss->AddedBy}}</td>
          </tr>
          <?php $z++; ?>
          @endif
      @endif
      @if($z == 6)
          @break
      @endif
      @endforeach
      @if($z != 6)
          @for($j = $z;$j<6;$j++)
          <tr>
              <td>* * * * *</td>
              <td>* * * * *</td>
              <td>* * * * * </td>
              <td>* * * * * </td>
          </tr>
          @endfor
      @endif
    </tbody>
  </table>
  </div>
</section>
<!--
<script type="text/javascript">
   setTimeout(function(){
       location.reload();
   },60000);
</script>
-->
<script type="text/javascript">
  $(document).ready(function(){
    var device = <?php echo $device; ?>;
    var colombo = {lat:6.9271, lng:79.8612};
    var latlang;
    var map = new google.maps.Map(document.getElementById('dmap'), {
      zoom: 8,
      center: colombo,
      mapTypeId: 'satellite'
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

  <script type="text/javascript">
          var analytics = <?php echo $type; ?>;
          google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(drawChart);

          function drawChart() {
            var data = google.visualization.arrayToDataTable(analytics);
            var options ={
              title : 'percentage of type',
              colors: ['#0275d8', '#d9534f','#ffc200'],
              pieHole: 0.5,

              chart: {
            },
              chartArea: {
                backgroundColor: {
                  fill: '#292b2c',
                },
              },
              backgroundColor: {
                fill: '#292b2c',
              },
              pieSliceTextStyle: {
                color: 'black'
              },
              titleTextStyle: {
                  color: 'white',
                  fontName: 'calibri',
                  fontSize: 18,
                  bold: false,
                  italic: false
              },
                legend: {
                textStyle: { color: 'white' }
              },
            };

            var chart = new google.visualization.PieChart(
              document.getElementById('donutchart'));
                chart.draw(data, options);
              }
  </script>

  <script type="text/javascript">
          var Bar_analytics = <?php echo $location; ?>;
          google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(drawChart);

          function drawChart() {
            var data = google.visualization.arrayToDataTable(Bar_analytics);
            var view = new google.visualization.DataView(data);

                  var options = {
                    title: "Number Of Devices",
                    chartArea: {
                      backgroundColor: {
                        fill: '#292b2c',
                      },
                    },
                    backgroundColor: {
                      fill: '#292b2c',
                    },
                    pieSliceTextStyle: {
                      color: 'black'
                    },
                    titleTextStyle: {
                        color: 'white',
                        fontName: 'calibri',
                        fontSize: 18,
                        bold: false,
                        italic: false
                    },
                      legend: {
                      textStyle: { color: 'white' }
                    },
                    hAxis: {
                      titleTextStyle: {color: '#ffffff'},
                      textStyle:{color: 'white'},
                      title:'No of Devices'
                    },

                    vAxis: {
                        titleTextStyle: {color: '#ffffff'},
                        title: 'States',
                        textStyle:{
                        color: 'white'
                        }
                    }
            };
          var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
          chart.draw(view, options);
      }
</script>


<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

var data_analytics = <?php echo $retail; ?>;
function drawChart() {
  var data = google.visualization.arrayToDataTable(data_analytics);
  var options ={
    title : 'Promotions Related To Category',
    colors: ['#0275d8', '#d9534f','#ffc200'],

    chart: {
  },
    chartArea: {
      backgroundColor: {
        fill: '#292b2c',
      },
    },
    backgroundColor: {
      fill: '#292b2c',
    },
    pieSliceTextStyle: {
      color: 'black'
    },
    titleTextStyle: {
        color: 'white',
        fontName: 'calibri',
        fontSize: 14,
        bold: false,
        italic: false
    },
      legend: {
      textStyle: { color: 'white' }
    },
  };

  var chart = new google.visualization.PieChart(
    document.getElementById('barchart_Data'));
      chart.draw(data, options);
    }
</script>


<script type="text/javascript">
$(document).ready(function(){
  $(".Retail").click(function(e){
    e.preventDefault();
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    var data_analytics = <?php echo $retail; ?>;
    function drawChart() {
      var data = google.visualization.arrayToDataTable(data_analytics);
      var options ={
        title : 'Promotions Related To Category',
        colors: ['#0275d8', '#d9534f'],

        chart: {
      },
        chartArea: {
          backgroundColor: {
            fill: '#292b2c',
          },
        },
        backgroundColor: {
          fill: '#292b2c',
        },
        pieSliceTextStyle: {
          color: 'black'
        },
        titleTextStyle: {
            color: 'white',
            fontName: 'calibri',
            fontSize: 14,
            bold: false,
            italic: false
        },
          legend: {
          textStyle: { color: 'white' }
        },
      };

      var chart = new google.visualization.PieChart(
        document.getElementById('barchart_Data'));
          chart.draw(data, options);
        }
  });

});
</script>
<script type="text/javascript">
$(document).ready(function(){
  $(".Distributor").click(function(e){
    e.preventDefault();
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    var data_analytics = <?php echo $distributor; ?>;
    function drawChart() {
      var data = google.visualization.arrayToDataTable(data_analytics);
      var options ={
        title : 'Promotions Related To Category',
        colors: ['#0275d8', '#d9534f'],

        chart: {
      },
        chartArea: {
          backgroundColor: {
            fill: '#292b2c',
          },
        },
        backgroundColor: {
          fill: '#292b2c',
        },
        pieSliceTextStyle: {
          color: 'black'
        },
        titleTextStyle: {
            color: 'white',
            fontName: 'calibri',
            fontSize: 14,
            bold: false,
            italic: false
        },
          legend: {
          textStyle: { color: 'white' }
        },
      };

      var chart = new google.visualization.PieChart(
        document.getElementById('barchart_Data'));
          chart.draw(data, options);
        }
  });

});
</script>
<script type="text/javascript">
$(document).ready(function(){
  $(".Dealer").click(function(e){
    e.preventDefault();
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    var data_analytics = <?php echo $dealer; ?>;
    function drawChart() {
      var data = google.visualization.arrayToDataTable(data_analytics);
      var options ={
        title : 'Promotions Related To Category',
        colors: ['#0275d8', '#d9534f'],

        chart: {
      },
        chartArea: {
          backgroundColor: {
            fill: '#292b2c',
          },
        },
        backgroundColor: {
          fill: '#292b2c',
        },
        pieSliceTextStyle: {
          color: 'black'
        },
        titleTextStyle: {
            color: 'white',
            fontName: 'calibri',
            fontSize: 14,
            bold: false,
            italic: false
        },
          legend: {
          textStyle: { color: 'white' }
        },
      };

      var chart = new google.visualization.PieChart(
        document.getElementById('barchart_Data'));
          chart.draw(data, options);
        }
  });

});
</script>

@endsection
