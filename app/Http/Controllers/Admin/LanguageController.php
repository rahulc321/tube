<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Country;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['languages'] =  Language::orderBy('id','DESC')->get();
        return view('admin.language.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $this->data['country'] =  Country::where('status',1)->get();
        return view('admin.language.add',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            "language_name" => 'required|unique:languages,language_name,',
            "code" => 'required|unique:languages,code,',
        ]);

        $store = new Language;
        $store->language_name = $request->language_name;
        $store->code = $request->code;
        $store->countryId = $request->countryId;
        $store->status = $request->status;
        $store->save();
        \Session::flash('message', 'You have successfully added.'); 
        return redirect()->route('language.index');
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
        $this->data['country'] =  Country::where('status',1)->get();
        $this->data['edit'] =  Language::where('id',$id)->first();
        return view('admin.language.edit',$this->data);
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

        $this->validate($request, [
            "language_name" => 'required|unique:languages,language_name,'.$id,
            "code" => 'required|unique:languages,code,'.$id,
        ]);

        $store = Language::where('id',$id)->first();
        $store->language_name = $request->language_name;
        $store->code = $request->code;
        $store->countryId = $request->countryId;
        $store->status = $request->status;
        $store->save();
        \Session::flash('message', 'You have successfully updated.'); 
        return redirect()->route('language.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteLang($id)
    {
        Language::where('id',$id)->delete();
       \Session::flash('message', 'You have successfully deleted.'); 
        return redirect()->route('language.index');
    }
}
