<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
  
    public function datatables()
    {
         $datas = Category::orderBy('id', 'desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->addColumn('image', function(Category $data) {
                                if($data->image!=''){
                                    return '<img style="height:50px;" src="'.asset('public/uploads/category/'.$data->image).'">';

                                }else{
                                    return '';
                                }
                            }) 
                            ->addColumn('status', function(Category $data) {
                                // $role = $data->role_id == 0 ? 'No Role' : $data->role->name;
                          
                                $alertmsg="return confirm('Are you sure you want to update the status?')";

                                return ($data->status == 1)?

                            '  <a href="'.route('categories.status.update',['id1' => $data->id, 'id2' => 0]).'" 
                            class="text-13 py-2 px-8 bg-success-50 text-success-600 d-inline-flex align-items-center gap-8 rounded-pill"
                                    onclick="'.$alertmsg.'">
                                <span class="w-6 h-6 bg-success-600 rounded-circle flex-shrink-0"></span>
                                Active
                                </a>'
                                :
                                '<a href="'.route('categories.status.update',['id1' => $data->id, 'id2' => 1]).'"  
                                class="text-13 py-2 px-8 bg-warning-50 text-warning-600 d-inline-flex align-items-center gap-8 rounded-pill"
                                    onclick="'.$alertmsg.'">
                                <span class="w-6 h-6 bg-warning-600 rounded-circle flex-shrink-0"></span>
                                Inactive
                                </a>'
                                ;

                            }) 
                            ->addColumn('action', function(Category $data) {
                                return '<a href="'.route('categories.edit',$data->id).'" class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">
                                <img src="'.asset('public/assets/images/new_icons/Edit.svg').'" alt="edit" class="h-32 w-32 rounded-circle">                     
                                </a>';
                              }) 
                            ->rawColumns(['status','action','image'])         
                            ->toJson(); //--- Returning Json Data To Client Side
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.categories.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    // dd($request);
        $validatedData = $request->validate([
            'name' => 'required|unique:categories',
            'subset' => 'required',
            'image' => 'required|file|mimes:png,gpeg,jpg|max:2048',
        ]);

        // Upload the file
        $fileName ='';
        if($request->hasFile('image')){   
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/category'), $fileName);
        }
            
        $category = new Category();
        $category->name = $request->name;
        $category->subset = $request->subset;
        $category->image =$fileName;
        $category->status =1;
        $category->save();

        return redirect()->back()->with('success','Category create Successfully');    

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $category = Category::findOrFail($id);
            return view('admin.categories.edit', compact('category'));  
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('categories')->with('error', 'Category not found');
        } catch (\Illuminate\Database\QueryException $e) {
            abort(500);
        } catch (\Exception $e) {
            abort(500);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories,name,' . $id,
            'subset' => 'required',
            'image' => 'file|mimes:png,gpeg,jpg|max:2048',
        ]);
       
       
        $category = Category::find($id);

         // Upload the file
         if($request->hasFile('image')){
            $imagePath = public_path('uploads/category/' . $category->image);
            if (file_exists($imagePath) && $category->image!='') {
                // Remove the old image
                unlink($imagePath);
            }
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/category'), $fileName);
            $category->image =$fileName;
        }
        $category->subset = $request->subset;
        $category->name = $request->name;
        $category->update();

        return redirect()->back()->with('success','Category update Successfully');
    }



    public function updateStatus($id,$status){

        // Update the status
        $category = Category::find($id);
        $category->status = $status;
        $category->update();

        // Return a success message
        return redirect()->back()->with('success','Status updated successfully!');    
    }



}