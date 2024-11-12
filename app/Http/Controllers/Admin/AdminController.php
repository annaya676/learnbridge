<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Hash;

use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
  
    public function datatables()
    {
         $datas = Admin::where('role_id',1)->orderBy('id', 'asc')->get();
         //--- Integrating This Collection Into Datatables

         return Datatables::of($datas)
                            ->addColumn('status', function(Admin $data) {
                                // $role = $data->role_id == 0 ? 'No Role' : $data->role->name;
                                $alertmsg="return confirm('Are you sure you want to update the status?')";
                                if($data->is_super_admin==1){
                                    return ($data->status == 1)?
                                    '<a href="#" class="text-13 py-2 px-8 bg-success-50 text-success-600 d-inline-flex align-items-center gap-8 rounded-pill">
                                    <span class="w-6 h-6 bg-success-600 rounded-circle flex-shrink-0"></span>
                                    Active
                                    </a>'
                                    :
                                    '<a href="#" class="text-13 py-2 px-8 bg-warning-50 text-warning-600 d-inline-flex align-items-center gap-8 rounded-pill">
                                    <span class="w-6 h-6 bg-warning-600 rounded-circle flex-shrink-0"></span>
                                    Inactive
                                    </a>'
                                    ;
                                }else{

                                return ($data->status == 1)?
                                '  <a href="'.route('admin.status.update',['id1' => $data->id, 'id2' => 0]).'" 
                                class="text-13 py-2 px-8 bg-success-50 text-success-600 d-inline-flex align-items-center gap-8 rounded-pill"
                                    onclick="'.$alertmsg.'">
                                <span class="w-6 h-6 bg-success-600 rounded-circle flex-shrink-0"></span>
                                Active
                                </a>'
                                :
                                '<a href="'.route('admin.status.update',['id1' => $data->id, 'id2' => 1]).'"  
                                class="text-13 py-2 px-8 bg-warning-50 text-warning-600 d-inline-flex align-items-center gap-8 rounded-pill"
                                    onclick="'.$alertmsg.'">
                                <span class="w-6 h-6 bg-warning-600 rounded-circle flex-shrink-0"></span>
                                Inactive
                                </a>'
                                ;
                                }
                            }) 
                            ->addColumn('action', function(Admin $data) {
                                return '<a href="'.route('admin.edit',$data->id).'" class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">
                                <img src="'.asset('public/assets/images/new_icons/Edit.svg').'" alt="edit" class="h-32 w-32 rounded-circle">                     
                                </a>
                                <a href="'.route('admin.changepassword',$data->id).'" class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white"> 
                                <img src="'.asset('public/assets/images/new_icons/Change Password.svg').'" alt="Change" class="h-32 w-32 rounded-circle">                     
                                </a>';
                              }) 
                            ->rawColumns(['status','action'])         
                            ->toJson(); //--- Returning Json Data To Client Side
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.admin.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admin.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            "email" => ["required","email",'regex:/@evalueserve\.com$/i','unique:admins'],
            'phone' => ['required','digits:10','numeric','unique:admins'],
            'password' => 'required',
            ], [
                'email.regex' => 'The email must be a valid @evalueserve.com address.',
                ]
            );
        

       
        $admin = new Admin();
        $token=hash('sha256',time());

        $input = $request->all();
        $input['password']=Hash::make($request->input('password'));
        $input['token']=$token;
        $input['role_id'] = 1;
        $input['lob_id'] = 0;
        $input['status'] = 1;
        $admin->fill($input)->save();


        return redirect()->back()->with('success','Admin create successfully');    

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $admin = Admin::findOrFail($id);
            return view('admin.admin.edit', compact('admin'));  
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('admin.list')->with('error', 'admin not found');
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
            'name' => 'required',
            'email' => 'required|string|email|max:255|regex:/@evalueserve\.com$/i|unique:admins,email,' . $id,
            'phone' => 'required|numeric|digits:10|unique:admins,phone,' . $id,
           ], [
            'email.regex' => 'The email must be a valid @evalueserve.com address.',
            ]
        );

       
        $admin = Admin::find($id);
        $admin->update($validatedData);
        
        return redirect()->back()->with('success','Admin update successfully');
    }

    public function updateStatus($id,$status){

            // Update the status
            $admin = Admin::find($id);
            if($admin->is_super_admin!=1){
                $admin->status = $status;
                $admin->update();
            }
           
            // Return a success message
            return redirect()->back()->with('success','Status updated successfully!');    

    
    }

    public function changepassword($id)
    {
        try {
            $admin = Admin::findOrFail($id);
            return view('admin.admin.changepassword', compact('admin'));  
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('admin.list')->with('error', 'Admin not found');
        } catch (\Illuminate\Database\QueryException $e) {
            abort(500);
        } catch (\Exception $e) {
            abort(500);
        }

   
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatepassword(Request $request, $id)
    {
        $validatedData = $request->validate([
            'password' => 'required',
             "confirm_password" => ["required","same:password"],
        ]
        );

 
        $admin = Admin::find($id);
        $admin->password=Hash::make($request->input('password'));
        $admin->update();
        // Return a success message
        return redirect()->back()->with('success','Password updated successfully!');    

    }


}
