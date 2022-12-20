@extends('layouts.vertical', ['title' => 'Update Settings'])

@section('content')

<style type="text/css">
    .note-popover.popover.in.note-table-popover.bottom {
    display: none;
}
.popover-content.note-children-container {
    display: none;
}
</style>
    <!-- Start Content-->
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Settings</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Update Settings</a></li>
                            
                        </ol>
                    </div>
                    <h4 class="page-title">Update Settings</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

         

        


        <div class="row">
            <div class="col-lg-12">
                   @if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> Something went wrong.<br><br>
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
            
                <div class="card">
                    <div class="card-body">

                        

                        <form action="{{route('setting.update')}}" enctype="multipart/form-data" method="post">
                        @csrf
                            <div class="form-group mb-3">
                                <label for="example-input-small">Tiktok</label>
                                <input type="text" id="example-input-small" name="tiktok" class="form-control form-control-sm first" value="{{$edit->tiktok}}" >
                            </div>

                            <div class="form-group mb-3">
                                <label for="example-input-small">Facebook</label>
                                <input type="text" id="example-input-small" name="facebook" class="form-control form-control-sm first" value="{{$edit->facebook}}" >
                            </div>

                            <div class="form-group mb-3">
                                <label for="example-input-small">Youtube</label>
                                <input type="text" id="example-input-small" name="youtube" class="form-control form-control-sm first" value="{{$edit->youtube}}" >
                            </div>

                            <div class="form-group mb-3">
                                <label for="example-input-small">Instagram </label>
                                <input type="text" id="example-input-small" name="instagram" class="form-control form-control-sm first" value="{{$edit->instagram}}" >
                            </div>

                            <div class="form-group mb-3">
                                <label for="example-input-small">Phone </label>
                                <input type="text" id="example-input-small" name="phone" class="form-control form-control-sm first" value="{{$edit->phone}}" >
                            </div>
                            

                            <div class="form-group mb-3">
                                <label for="example-input-small">Description <code>*</code></label>
                                 <textarea class="form-control summernote" name="description" id="long_desc" required>{{$edit->footer_about_content}}</textarea>
                            </div>

                     
                             

                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                                <a href="window.history.back();"  class="btn btn-danger waves-effect waves-light">Back</a>
                            </div>

                             
                        </form>

                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end col -->

            
        </div>
        <!-- end row -->


        
        
    </div> <!-- container -->
   
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css">

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>

<script type="text/javascript">
    $(document).ready(function() {

    $(".first").keyup(function(e) {

    val = $(this).val();
    val = val.replace(/\s/g, '-').toLowerCase();

    $(".second").val( val );
    });


   $('.summernote').summernote({
                height: 350,
                minHeight: null,
                maxHeight: null,
                focus: false
            });
            $('.inline-editor').summernote({
                airMode: true
            });
});
</script>
@endsection