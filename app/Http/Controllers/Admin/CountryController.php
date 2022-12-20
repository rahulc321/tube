<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['country'] =  Country::orderBy('id','DESC')->get();
        return view('admin.country.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.country.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'name' => 'required|unique:countries',
        'slug' => 'required|unique:countries',
        ]);

        $store = new Country;
        $store->name = $request->name;
        $store->slug = $request->slug;
        $store->status = $request->status;
        $store->save();
        \Session::flash('message', 'You have successfully added.'); 
       return redirect()->route('country.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['edit'] =  Country::where('id',$id)->first();
        return view('admin.country.edit',$this->data);
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
        $validated = $request->validate([
        'name' => 'required|unique:countries,name,'.$id,
        'slug' => 'required|unique:countries,slug,'.$id,
        ]);

        $store = Country::where('id',$id)->first();
        $store->name = $request->name;
        $store->slug = $request->slug;
        $store->status = $request->status;
        $store->save();
        \Session::flash('message', 'You have successfully Updated.'); 
       return redirect()->route('country.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteCount($id)
    {
        Country::where('id',$id)->delete();
       \Session::flash('message', 'You have successfully deleted.'); 
        return redirect()->route('country.index');
    }
}
