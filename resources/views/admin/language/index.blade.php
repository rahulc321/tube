@extends('layouts.vertical', ['title' => 'Languages'])

@section('css')
    <!-- Plugins css -->
    <link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
 <?php error_reporting(0); ?>
    <!-- Start Content-->
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Languages</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Languages</h4>
                </div>
            </div>
        </div>     
        <!-- end page title --> 

        <div class="row">
            <div class="col-12">
                @if(Session::has('message'))
                <p class="alert alert-success">{{ Session::get('message') }}</p>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
                </ul>
                </div>
                @endif


                <div class="card">
                    <div class="card-body">
                     
                    <a href="{{route('language.create')}}" class="btn btn-success" style="float: right;">Add Language</a>
                     
                    <br>
                    <br>
                    <br>
                        <table id="basic-datatable" class="table dt-responsive table-hover table-bordered nowrap w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Language Name</th>
                                    <th>Code</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                     
                                </tr>
                            </thead>
                        
                        
                            <tbody>
                            @foreach($languages as $key=>$data)

                            <?php
                            //echo '<pre>';print_r($data->categoryName->cat_name);

                            ?>
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$data->language_name}}</td>
                                     

                                    <td>{{@$data->code}}</td>
                                    <td>
                                    @if($data->status == 1)
                                    <button type="button" class="btn btn-success btn-xs waves-effect waves-light">Active</button>
                                    @else
                                     <button type="button" class="btn btn-danger btn-xs waves-effect waves-light">In-Active</button>
                                    @endif

                                    </td>
                                    <td>
                                        <ul style="padding: initial;">
                                            
                                                <li title="Edit" style="display:inline;"><a href="{{route('language.edit',[$data->id])}}" class="btn btn-sm btn-info"><i class="fa fa-edit" style="cursor: pointer;">Edit</i></a></li>
                                                
                                            
                                                <li title="Delete" style="display:inline-block;"><a href="{{url('/admin/deleteLang',[$data->id])}}" class="btn btn-sm btn-danger"  onclick="return confirm('Are you sure you want to delete this?')"><i class="fas fa-trash" style="cursor: pointer;">Delete</i></a>
                                                </li>
                                             
                                        </ul>
                                    </td>
                                     
                                </tr>
                            @endforeach  
                            </tbody>
                        </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

   
        
    </div> <!-- container -->
@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/libs/pdfmake/pdfmake.min.js')}}"></script>

    <!-- Page js-->
    <script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>
@endsection