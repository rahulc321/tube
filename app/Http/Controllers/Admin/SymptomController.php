<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Symptoms;
use App\Models\Category;


class SymptomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['symptoms'] =  Symptoms::with('categoryName')->orderBy('symptom_name','ASC')->get();
        return view('admin.symptoms.index',$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['categories'] =  Category::where('status',1)->get();
        return view('admin.symptoms.add',$this->data);
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
        'symptom_name' => 'required|unique:symptoms',
        'file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
         
        ]);


        if($request->file){
            $image = $request->file('file');
            $filename = str_replace(' ','', md5(time()).'_'.$image->getClientOriginalName());
            $FileEnconded=  \File::get($request->file);
            $path = 'symptoms/'.$filename;
            \Storage::put($path, (string)$FileEnconded,'public');
        }


        $store = new Symptoms;
        $store->symptom_name = $request->symptom_name;
        $store->image = $filename;
        $store->category_id = $request->category_id;
        $store->status = $request->status;
        $store->save();
        \Session::flash('message', 'You have successfully added.'); 
       return redirect()->route('symptoms.index');
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
        $this->data['categories'] =  Category::where('status',1)->get();
        $this->data['edit'] =  Symptoms::where('id',$id)->first();
        return view('admin.symptoms.edit',$this->data);
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
        //'cat_name' => 'required|unique:category',
        'file' => 'image|mimes:jpeg,png,jpg|max:2048',
         
        ]);

        $store =Symptoms::where('id',$id)->first();
        if($request->file){
            $image = $request->file('file');
            $filename = str_replace(' ','', md5(time()).'_'.$image->getClientOriginalName());
            $FileEnconded=  \File::get($request->file);
            $path = 'symptoms/'.$filename;
            \Storage::put($path, (string)$FileEnconded,'public');

            $store->image = $filename;
        }

        
        $store->symptom_name = $request->symptom_name;
        $store->status = $request->status;
        $store->category_id = $request->category_id;
        $store->save();
        \Session::flash('message', 'You have successfully updated.'); 
        return redirect()->route('symptoms.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteSymptoms($id)
    {
        Symptoms::where('id',$id)->delete();
       \Session::flash('message', 'You have successfully deleted.'); 
        return redirect()->route('symptoms.index');
    }
}
