@extends('layouts.vertical', ['title' => 'Add Service Type'])
@section('content')
<!-- Start Content-->
<div class="container-fluid">
   <!-- start page title -->
   <div class="row">
      <div class="col-12">
         <div class="page-title-box">
            <div class="page-title-right">
               <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Service Types</a></li>
                  <li class="breadcrumb-item"><a href="javascript: void(0);">Add Service Type</a></li>
               </ol>
            </div>
            <h4 class="page-title">Add Service Type</h4>
         </div>
      </div>
   </div>
   <!-- end page title --> 
   <div class="row">
      <div class="col-lg-12 card">
         @if ($errors->any())
         <div class="alert alert-danger">
            <ul>
               @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
               @endforeach
            </ul>
         </div>
         @endif
         
         <form method="POST" action="{{ route('services.store') }}" enctype="multipart/form-data" name="gift_store">
            {{ csrf_field() }}
            <div class="card-body">
               <div class="form-group">
                  <div class="row">

                      <div class="col-sm-6 mt-2">
                        <label for="exampleInputName1">Service Name <code>*</code></label>
                         <input type="text" name="name" class="form-control"   required="" placeholder="Service Name">
                     </div>

                     
                     <div class="col-sm-6 mt-2">
                        <label for="exampleInputName1">Need Availability <code>*</code></label>
                         <select class="form-control gift" name="need_availability" required="">
                             <option value="">Select</option>
                             <option value="1">Yes</option>
                             <option value="0">No</option>
                         </select>
                     </div>

                     <div class="col-sm-6 mt-2">
                        <label for="exampleInputName1">Service Type  <code>*</code></label>
                         <select class="form-control gift" name="type_id" required="">
                             <option value="">Select</option>
                             @foreach($services as  $service)
                             <option value="{{$service->id}}">{{$service->servive_name}}</option>
                              @endforeach
                         </select>
                     </div> 

                     <div class="col-sm-6 mt-2">
                        <label for="exampleInputName1">Color picker</label>
                         <input type="color" name="color_code" class="form-control"   required="" placeholder="Title">
                     </div>

                       

                      

                     <div class="col-sm-6 mt-2">
                        <label for="exampleInputName1" >Description</label>
                          <textarea class="form-control" name="description"></textarea>
                     </div>
                     <div class="col-sm-6 mt-2">
                        <label for="exampleInputName1">Status <code>*</code></label>
                         <select class="form-control" name="status" required="">
                             <option disabled="">Select</option>
                             <option value="1">Active</option>
                             <option value="0">In-Active</option>
                         </select>
                     </div>
                  </div>
               </div>
            </div>
      </div>
      <div class="card-footer">
      <button type="submit" class="btn btn-primary" value="1" name="exit">Save and Exit</button>
       
      <a href="javascript:;" class="btn btn-danger" onclick="history.back()" >Back</a>
      </div>
      </form>
   </div>
   <!-- end col -->
</div>
<!-- end row -->
</div> <!-- container -->
@endsection
@section('script')
<script type="text/javascript">
  $(document).ready(function(){
    $('.gift').change(function(){
      let selectedVal= $(this).val();
      if(selectedVal=='Animated Gift'){
        $('.gif').show();
      }else{
        $('.gif').hide();
      }
    });
  });
</script>
@endsection