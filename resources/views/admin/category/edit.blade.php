@extends('layouts.vertical', ['title' => 'Edit Category'])

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Category</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Edit Category</a></li>
                            
                        </ol>
                    </div>
                    <h4 class="page-title">Edit Category</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

         

        


        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
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
                        

                        <form action="{{url('/admin/update-category',[$edit->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group mb-3">
                                <label for="example-input-small">Category Name</label>
                                <input type="text" id="example-input-small" name="name" class="form-control form-control-sm" placeholder="Category Name" required="" value="{{$edit->name}}">
                            </div>


                            

                            <div class="form-group mb-3">
                                <label for="example-input-normal">Status</label>
                                 <select name="status" class="form-control" required="">
                                     <option value="1" {{($edit->status == 1) ? 'selected' : ''}}>Active</option>
                                     <option value="0" {{($edit->status == 0) ? 'selected' : ''}}>In-Active</option>
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
@endsection