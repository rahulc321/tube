@extends('layouts.vertical', ['title' => 'Add Page'])

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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Add Page</a></li>
                            
                        </ol>
                    </div>
                    <h4 class="page-title">Add Page</h4>
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

                        

                        <form action="{{route('page.store')}}" enctype="multipart/form-data" method="post">
                        @csrf
                            <div class="form-group mb-3">
                                <label for="example-input-small">Page Title <code>*</code></label>
                                <input type="text" id="example-input-small" name="title" class="form-control form-control-sm first" placeholder="Page Title" required="">
                            </div>

                            <div class="form-group mb-3">
                                <label for="example-input-small">Page Slug <code>*</code></label>
                                <input type="text" id="example-input-small" name="slug" class="form-control form-control-sm second" placeholder="Page Slug" required="">
                            </div>

                            <div class="form-group mb-3">
                                <label for="example-input-normal">Country</label>
                                 <select name="countryId" class="form-control" required="">
                                 @foreach($country as $data)
                                     <option value="{{$data->slug}}">{{$data->name}}</option>
                                @endforeach
                                      
                                 </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="example-input-normal">Category</label>
                                 <select name="category" class="form-control">
                                 <option value=" ">Select</option>
                                 @foreach($category as $data)
                                     <option value="{{strtolower($data->name)}}">{{$data->name}}</option>
                                @endforeach
                                      
                                 </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="example-input-small">Description <code>*</code></label>
                                 <textarea class="form-control summernote" name="description" id="long_desc" required></textarea>
                            </div>

                     
                            <div class="form-group mb-3">
                                <label for="example-input-normal">Status</label>
                                 <select name="status" class="form-control" required="">
                                     <option value="1">Active</option>
                                     <option value="0">In-Active</option>
                                 </select>
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