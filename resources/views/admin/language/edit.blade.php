@extends('layouts.vertical', ['title' => 'Edit Language'])

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Languages</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Edit Language</a></li>
                            
                        </ol>
                    </div>
                    <h4 class="page-title">Edit Language</h4>
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
                        

                        <form action="{{ route('language.update',[$edit->id]) }}" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        @csrf
                            <div class="form-group mb-3">
                                <label for="example-input-small">Language Name <code>*</code></label>
                                <input type="text" id="example-input-small" name="language_name" class="form-control form-control-sm" placeholder="Language Name" required="" value="{{$edit->language_name}}">
                            </div>

                            <div class="form-group mb-3">
                                <label for="example-input-small">Code <code>*</code></label>
                                <input type="text" id="example-input-small" name="code" class="form-control form-control-sm" placeholder="Code" required="" value="{{$edit->code}}">
                            </div>


                              <div class="form-group mb-3">
                                <label for="example-input-normal">Country</label>
                                 <select name="countryId" class="form-control" required="">
                                    @foreach($country as $data)
                                     <option value="{{$data->id}}" {{($data->id == $edit->countryId) ? 'selected' : ''}}>{{$data->name}}</option>
                                    @endforeach
                                 </select>  
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