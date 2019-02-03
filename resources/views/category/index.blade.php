@extends('layouts.master')

@section('content')

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" />

<div class="content-wrapper ScrollStyle vl table-dark">
  <!-- Content Header (Page header) -->
  <!-- Main content -->
<section class="content">
<div id="content">
<div id="content-header">
@if (\Session::has('success'))
      <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert">×</button>
        <p>{{ \Session::get('success') }}</p>
     </div>
@endif
</div>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span5">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>

        </div>
        <div class="widget-content nopadding">



         <br>
         @if(Auth::user()->type =='admin')
         <div class="container">
           <div class="row">
             <div class="col-md-2">
                <h4>Category</h4>
             </div>
             <div class="col-md-1">
               <button type="submit" name="btn_submit" class="btn btn-sm btn-danger pull-right-container" data-toggle="modal" data-target="#myModal" tabindex="14"><i class="fa fa-plus"></i></button>
             </div>

           </div>
         </div>

           <div id="myModal" class="modal fade" tabindex="-1" style="color:black">
               <div class="modal-dialog" role="document">
                   <div class="modal-content">
                       <div class="modal-header">
                           <h4 class="modal-title">Add new Category</h4>
                       </div>
                       <div class="modal-body">
                           <form role="form" method="POST" action="{{url('categories')}}">
                               {{ csrf_field() }}
                               <div class="form-group">
                               <label class="control-label">Category :</label>
                                   <div>
                                   <input type="text" class="form-control" name="category_name"  />
                                   </div>
                               </div>

                                <div class="form-group">
                                   <div>
                                   <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                                       <button type="submit" class="btn btn-outline-success">
                                         Submit
                                       </button>
                                   </div>
                               </div>

                           </form>

                       </div>
                   </div><!-- /.modal-content -->
               </div><!-- /.modal-dialog -->
           </div><!-- /.modal -->
           @endif
</div>
</div>
</div>
</div>
</div>
   <br>
    <table id="datatable" class="table table-striped table-dark">
    <thead>
      <tr class="alert-success">
        <th style="text-align:center">ID</th>
        <th style="text-align:center">Name</th>
        <th style="text-align:center">Added By</th>
      </tr>
    </thead>
    <tbody>



      @foreach($categories as $catergary)
      <tr>
        <td style="text-align:center">{{$catergary['id']}}</td>
        <td style="text-align:center">{{$catergary['category_name']}}</td>
        <td style="text-align:center">{{$catergary['category_created_by']}}</td>
      </tr>
      @endforeach
    </tbody>
    </table>
  </div>
</section>
</div>


@endsection
