@extends('layouts.vertical', ['title' => 'Add Country'])

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Country</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Add Country</a></li>
                            
                        </ol>
                    </div>
                    <h4 class="page-title">Add Country</h4>
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

                        

                        <form action="{{route('country.store')}}" enctype="multipart/form-data" method="post">
                        @csrf
                            <div class="form-group mb-3">
                                <label for="example-input-small">Name <code>*</code></label>
                                <input type="text" id="example-input-small " name="name" class="form-control form-control-sm first" placeholder="Name" required="">
                            </div>

                            <div class="form-group mb-3">
                                <label for="example-input-small">Slug <code>*</code></label>
                                <input type="text" id="example-input-small " name="slug" class="form-control form-control-sm second" placeholder="Slug" required="">
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(".first").keyup(function(e) {

    val = $(this).val();
    val = val.replace(/\s/g, '-').toLowerCase();

    $(".second").val( val );
    });
    </script>

@endsection