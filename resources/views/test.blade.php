@extends('layouts.master')

@section('content')
<div class="content-wrapper ScrollStyle vl table-dark">
<div class="container">
  <br>
  <div class="col-md-6 table-dark">
           <!-- USERS LIST -->
           <div class="box box-danger table-dark">
             <div class="box-header with-border">
               <h3 class="box-title" style="color:white" >Lates Videos</h3>

               <div class="box-tools pull-right">
                 <span class="label label-dark"><a href="/admin/all/videos" class="small-box-footer" style="text-decoration:underline;color:white">More info <i class="fa fa-arrow-circle-right"></i></a></span>
                 <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                 </button>
                 <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                 </button>
               </div>
             </div>
             <!-- /.box-header -->
             <?php $y=0; ?>
             <div class="box-body no-padding table-dark">
               <table class="table table-dark" border="1px solid white">
                 <thead class="alert-success">
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
</div>         <!-- /.col -->
</div>
</div>
<script>
    $(document).ready(function () {
        $("#col").change(function () {
            var color = $(this);
            alert(color.val());
        });
    });
</script>

@endsection
