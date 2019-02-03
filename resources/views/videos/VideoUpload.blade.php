@extends('layouts.master')

@section('content')
<div class="content-wrapper ScrollStyle vl table-dark">
  <br>
  <div class="container">
  <div class="page-header text-center table-dark" style="border-radius:8px;border:1px solid white;">
    <h3>Upload Videos Here</h3>
  </div>
  <div class="text-center" style="background-color:#000000">
    <p>The video you add here and required details will be uploaded to company's youtube channel. And video Id and other informations will write into the Video table in the database.
      All accesses to videos will be done by using the Video Id <p>
  </div>
  </div>
<div class="container">
  @include('inc.Errors')
</div>
<div class="container">
  {!! Form::open(["url" => "/upload/video","files" => true,"id" => "UploadForm","enctype"=>"multipart/form-data"]) !!}
    <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <div class="row">
          <div class="col-md-6">
            {{Form::label("Category", "Category")}}
            <select class="form-control" name="Category">
              <option selected="selected">Select Category</option>
              @foreach($category as $categories)
                <option value="{{$categories->category_name }}">{{$categories->category_name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6">
            {{Form::label("Expire Date", "Expire Date")}}
            {{Form::date("ExpireDate", \Carbon\Carbon::now(),["class" => "form-control"])}}
          </div>
        </div>
      </div>
        <div class="form-group">
          {{Form::label("Title", "Title")}}
          {{Form::text("Title",'',["placeholder" => "Enter Title of Video","class" => "form-control"])}}
        </div>
        <div class="form-group">
          {{Form::label("Description", "Description")}}
          {{Form::textarea("Description",'',["placeholder" => "Enter Description of Video","class" => "form-control", 'rows' => 7])}}
        </div>
    <p class="fa fa-arrow-circle-right" style="background-color:#000000"> The video duration must be less than 10 MB.</p>
    <div class="container" id="field">
      <div class="row">
          <div class="col-md-3">
          <div class="form-group" name="image">
              {{Form::label("Video", "Choose Video")}}
          </div>
          </div>
          <div class="col-md-9">
            <div class="form-group">
                {{Form::file("video",["id" => "uploadingvideo","onchange"=>"readURL(this)"])}}
            </div>
          </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="container">
      <video width="500" height="390" controls id="videoS" style="border:1px solid white">
          <source src="" type="video/mp4">
            Your browser does not support the video tag.
      </video>
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
        <div class="col-md-6" id="blah" style="display:none">
          <p><img src="/images/loading.gif"  alt="Uploaded image" width="45" height="45"> Uploading...</p>
        </div>
      </div>
    </div>
  </div>

</div>
  {!! Form::close() !!}
</div>
<br>
</div>

<script type="text/javascript">
$(document).ready(function(){
  $('form').on('submit',function(event){
    $('#blah').show();
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
        url : '/upload/video',
        data : formData,
        processData : false,
        contentType : false,
        success : function(){
          $('#blah').hide();
          swal({
              title: "Done!",
              text: "Videos Uploaded!",
              type: "success",
              timer: 10000,
              }, function(){
              window.location.href = "/video/upload/form";
          });
        },
        error: function (data) {
            $('#blah').hide();
            swal({
              title: "WARNING!",
              text: "Some Fileds Are Missing\n       Try Again!",
              type: "warning",
              timer: 10000,
            }, function(){
              window.location.href = "/video/upload/form";
            });
      },

});
});
});
</script>
<script type="text/javascript">
function readURL(input) {
        if (input.files) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#videoS')
                    .attr('src', e.target.result)
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
