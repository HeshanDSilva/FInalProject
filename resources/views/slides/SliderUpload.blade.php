@extends('layouts.master')

@section('content')
<div class="content-wrapper ScrollStyle vl table-dark">
  <br>
  <div class="container">
  <div class="page-header text-center table-dark" style="border-radius:8px;border:2px solid #85144b;">
    <h3>Add Sliders Here</h3>
  </div>
  </div>
<div class="container">
  @include('inc.Errors')
</div>
<div class="row">
<div class="col-md-6">
    <div class="container">
      {!! Form::open(["url" => "/Upload/submit","files" => true,"id" => "formcontrol","enctype"=>"multipart/form-data","id"=>"UploadForm"]) !!}

        <div class="form-group">
          {{Form::label("Category", "Category")}}
          <select class="form-control" name="Category">
            <option selected="selected">Select Category</option>
            @foreach($category as $categories)
              <option value="{{$categories->category_name }}">{{$categories->category_name }}</option>
            @endforeach
          </select>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              {{Form::label("TranTime", "Transition Time")}}
              {{Form::number("TransitionTime",30,["class" => "form-control"])}}
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              {{Form::label("Screen", "Screen")}}
              {{Form::select("Screen", ["Screen_1" => "Screen_1", "Screen_2" => "Screen_2"], null, ["placeholder" => "Select Screen","class" => "form-control"])}}
            </div>
          </div>

      </div>
        <div class="form-group">
          {{Form::label("Expire Date", "Expire Date")}}
          {{Form::date("ExpireDate", \Carbon\Carbon::now(),["class" => "form-control"])}}
        </div>



    <div class="container" id="field">
      <div class="row">
          <div class="col-md-6">
            <div class="form-group" name="image">
              {{Form::label("Image", "Image")}}
              {{Form::file("image[]",["id" => "uploadingimage","onchange"=>"readURL(this)"])}}
            </div>

          </div>
          <div class="col-md-6">
            <div class="form-group">
              <br>
                {{Form::button("Add More",["class" => "btn add-more btn-outline-info","id"=>"b1"])}}
            </div>
          </div>
      </div>
    </div>
        <div class="form-group">
        <div class="progress">
          <div id="progress-bar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
        </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-md-2">

            </div>
            <div class="col-md-4">
              {{Form::submit('Submit',['class' => 'btn btn-lg send-data btn-block btn-success'])}}
            </div>
            <div class="col-md-6" id="loading" style="display:none">
              <p><img src="/images/loading.gif"  alt="Uploaded image" width="45" height="45"> Uploading...</p>
            </div>
          </div>
        </div>

        {!! Form::close() !!}
    </div>
    <div class="alert alert-danger" style="display:none"></div>
  </div>
  <div class="col-md-6">
        <br>
          <img src="/images/placeholder.png" id="blah" alt="Uploaded image" width="500" height="500">
  </div>
</div>
<br>
</div>


<script type="text/javascript">
$(document).ready(function(){
  $('form').on('submit',function(event){
    $('#loading').show();
    event.preventDefault();
    var form = document.getElementById('UploadForm');
    var formData = new FormData(form);
    $.ajax({
          xhr : function(){
          var xhr = new window.XMLHttpRequest();
          xhr.upload.addEventListener('progress',function(e){
              if(e.lengthComputable){
                console.log('Bytes Loaded: '+e.loaded);
                console.log('Total Size: '+e.total);
                console.log('Percentage Uploaded: '+(e.loaded/e.total));
                var percent = Math.round((e.loaded/e.total)*100);

                $('#progress-bar').attr('aria-valuenow',percent).css('width',percent +'%').text(percent + '%');
              }
          });
          return xhr;
        },
        type : 'POST',
        url : '/Upload/submit',
        data : formData,
        processData : false,
        contentType : false,
        success : function(){
          $('#loading').hide();
          swal({
              title: "Success!",
              text: "Sliders Uploaded!",
              type: "success",
              timer: 10000,
              }, function(){
              window.location.href = "/Upload";
          });
        },
        error: function (data) {
          $('#loading').hide();
            swal({
              title: "WARNING!",
              text: "Some Fileds Are Missing\n       Try Again!",
              type: "warning",
              timer: 10000,
            }, function(){
              window.location.href = "/Upload";
            });
      },

});
});
});
</script>



<script type="text/javascript">
var max;
max=1;
$(document).ready(function(){
  $(".add-more").click(function(e){
    if(max<5){
    e.preventDefault();
    $("#field").append( '  <div class="row"><div class="col-md-6 col-lg-6"><div class="form-group" >{{Form::label("Image", "Image")}}{{Form::file("image[]",["onchange"=>"readURL(this)"])}}</div></div><div class="col-md-6 col-lg-6"><br><div class="form-group">{{Form::button("Remove",["class" => "btn remove btn-outline-danger","id"=>"remove"])}}</div></div></div>' );
    max++;
  }
  });


  $("#field").on('click','#remove',function(e){
    $(this).parent('div').parent('div').parent('div').remove();
    max--;
  });


});
</script>

<script type="text/javascript">
function readURL(input) {
        if (input.files) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
