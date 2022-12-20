<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pages;
use App\Models\Language;
use App\Models\Setting;
use App\Models\Country;
use App\Models\Category;
use Validator;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['pages'] =  Pages::orderby('id','DESC')->get();
        return view('admin.pages.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['country'] =  Country::where('status',1)->get();
        $this->data['category'] =  Category::where('status',1)->get();
        return view('admin.pages.add',$this->data);
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
        'description' => 'required',
        'slug' => 'required|unique:pages,slug',
        'countryId' => 'required|unique:pages,countryId',
        
         
        ]);


        $makeSlug = strtolower($request->title);
        $store = new Pages;
        $store->title = $request->title;
        //$store->slug = str_replace(' ','-',$makeSlug);
        $store->slug = $request->slug;
        $store->countryId = $request->countryId;
        $store->category = $request->category;
        $store->data = $request->description;
        $store->status = $request->status;
        $store->save();
        \Session::flash('message', 'You have successfully added.'); 
       return redirect()->route('page.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function header($id,$val)
    {
        $store = Pages::where('id',$id)->first();
        $store->header = $val;
        $store->save();

         \Session::flash('message', 'Now this page showing in header menu.'); 
        if($val==0){
            \Session::flash('message', 'Page removed from header menu.');
        }
           
       return redirect()->route('page.index');
    }

     public function footer($id,$val)
    {
        $store = Pages::where('id',$id)->first();
        $store->footer = $val;
        $store->save();

         \Session::flash('message', 'Now this page showing in footer menu.'); 
        if($val==0){
            \Session::flash('message', 'Page removed from footer menu.');
        }
           
       return redirect()->route('page.index');
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
        $this->data['category'] =  Category::where('status',1)->get();
        $this->data['edit'] =  Pages::where('id',$id)->first();
        return view('admin.pages.edit',$this->data);
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
        'description' => 'required',
        'slug' => 'required|unique:pages,slug,'.$id,
        'countryId' => 'required|unique:pages,countryId,'.$id,
        
         
        ]);
       // echo json_encode($request->description);die;
        $makeSlug = strtolower($request->title);
        $store = Pages::where('id',$id)->first();
        $store->title = $request->title;
        $store->slug = str_replace(' ','-',$makeSlug);
        $store->countryId = $request->countryId;
        $store->category = $request->category;
        $store->data = $request->description;
        $store->status = $request->status;
        $store->save();
        \Session::flash('message', 'You have successfully updated.'); 
       return redirect()->route('page.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletePage($id)
    {
        Pages::where('id',$id)->delete();
       \Session::flash('message', 'You have successfully deleted.'); 
        return redirect()->route('page.index');
    }


    public function settings(Request $request)
    {
         
        $this->data['edit'] =  Setting::where('id',1)->first();
        return view('admin.settings.add',$this->data);
    }
     public function settingUpdate(Request $request)
    {
        $update =  Setting::where('id',1)->first();
        $update->tiktok = $request->tiktok;
        $update->facebook = $request->facebook;
        $update->youtube = $request->youtube;
        $update->instagram = $request->instagram;
        $update->phone = $request->phone;
        $update->footer_about_content = $request->description;
        $update->save();
        \Session::flash('message', 'You have successfully updated.'); 
        return redirect()->route('admin.setting');
    }
}
