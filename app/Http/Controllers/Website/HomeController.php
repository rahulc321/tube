<?php

namespace App\Http\Controllers\Website;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use App\Models\Pages;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
        $this->data['pages'] =  Pages::where('slug','home')->first();
        return view('website.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pageLng($c,$cat,$pageSlug)
    {   
         
        $this->data['pages'] =  Pages::where('slug',$pageSlug)->where('category',$cat)->where('countryId',$c)->first();
        if($this->data['pages']){
            return view('website.page',$this->data);
        }else{
            return redirect('/');
        }
    }
     public function pageLng2($c,$pageSlug)
        {   
             
            $this->data['pages'] =  Pages::where('slug',$pageSlug)->where('countryId',$c)->first();
            if($this->data['pages']){
                return view('website.page',$this->data);
            }else{
                return redirect('/');
            }
        }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
