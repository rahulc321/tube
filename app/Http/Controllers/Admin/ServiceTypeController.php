<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceType;
use App\Models\Service;

class ServiceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $this->data['serviceType'] =  ServiceType::orderBy('id','DESC')->get();
        return view('admin.services.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $this->data['services'] =  Service::get();
        return view('admin.services.add',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
        $store = new ServiceType;
        $store->name = $request->name;
        $store->type_id = $request->type_id;
        $store->need_availability = $request->need_availability;
        $store->color_code = $request->color_code;
        $store->description = $request->description;
        $store->status = $request->status;
        $store->save();
        \Session::flash('message', 'You have successfully added.'); 
        return redirect()->route('services.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo '>>>'.$id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['services'] =  Service::get();
        $this->data['edit'] =  ServiceType::where('id',$id)->first();
        return view('admin.services.edit',$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $store = ServiceType::where('id',$id)->first();
        $store->name = $request->name;
        $store->type_id = $request->type_id;
        $store->need_availability = $request->need_availability;
        $store->color_code = $request->color_code;
        $store->description = $request->description;
        $store->status = $request->status;
        $store->save();
        \Session::flash('message', 'You have successfully updated.'); 
        return redirect()->route('services.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {   
        //echo 'delete';die;
        ServiceType::where('id',$id)->delete();
       \Session::flash('message', 'You have successfully deleted.'); 
        return redirect()->route('services.index');
    }
}
