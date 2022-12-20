<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Hash;
use Image;
use Session;
use app\Helpers\Helper;
use App\Models\User;
use App\Models\Category;
use App\Models\Language;
use Validator;
 

class AdminController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        // {\Schema::table('category', function($table){$table->string('abc')->nullable();});}
        // die;
        $this->data['categories'] = Category::orderby('id','desc')->get();
        return view('admin.category.index',$this->data);
    }

    // Add category

    public function addCategory(){
         return view('admin.category.add');
    } 

    // Store category
    public function storeCategory(Request $request){


        $validated = $request->validate([
        'name' => 'required|unique:category',
        //'file' => 'required|image|mimes:jpeg,png,jpg|max:2048',
         
        ]);

 
        if($request->file){
            $image = $request->file('file');
            $filename = str_replace(' ','', md5(time()).'_'.$image->getClientOriginalName());
            $FileEnconded=  \File::get($request->file);
            $path = 'category/'.$filename;
            \Storage::put($path, (string)$FileEnconded,'public');
        }

        $store = new Category;
        $store->name = $request->name;
       // $store->image = $filename;
        $store->status = $request->status;
        $store->save();

         
        Session::flash('message', 'You have successfully added.'); 
        return redirect('admin/category');
    }

    // Delete Category
    public function deleteCategory($id){
         $delete =  Category::where('id',$id)->first(); 
         $delete->delete(); 
         Session::flash('message', 'You have successfully deleted.'); 
        return redirect('admin/category'); 
    }
    // Edit Category
    public function editCategory($id){
        $this->data['edit'] =  Category::where('id',$id)->first(); 
        return view('admin.category.edit',$this->data);
    }


    // Update category
    public function updateCategory(Request $request,$id){

        $validated = $request->validate([
        'name' => 'required|unique:category,name,'.$id,
        //'file' => 'image|mimes:jpeg,png,jpg|max:2048',
         
        ]);

        $store =Category::where('id',$id)->first();
        if($request->file){
            $image = $request->file('file');
            $filename = str_replace(' ','', md5(time()).'_'.$image->getClientOriginalName());
            $FileEnconded=  \File::get($request->file);
            $path = 'category/'.$filename;
            \Storage::put($path, (string)$FileEnconded,'public');

            $store->image = $filename;
        }

        
        $store->name = $request->name;
        $store->status = $request->status;
        $store->save();
        Session::flash('message', 'You have successfully updated.'); 
        return redirect('admin/category');
    }
    

    
    
}
