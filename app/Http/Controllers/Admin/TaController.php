<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Lob;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Hash;

use Yajra\DataTables\DataTables;

class TaController extends Controller
{
   
    public function datatables()
    {
         $datas = Admin::where('role_id',3)->orderBy('id', 'desc')->get();
         //--- Integrating This Collection Into Datatables

         return Datatables::of($datas)
                            ->addColumn('status', function(Admin $data) {
                                $alertmsg="return confirm('Are you sure you want to update the status?')";

                                return ($data->status == 1)?

                            '  <a href="'.route('ta.status.update',['id1' => $data->id, 'id2' => 0]).'" 
                            class="text-13 py-2 px-8 bg-success-50 text-success-600 d-inline-flex align-items-center gap-8 rounded-pill"
                                    onclick="'.$alertmsg.'">
                                <span class="w-6 h-6 bg-success-600 rounded-circle flex-shrink-0"></span>
                                Active
                                </a>'
                                :
                                '<a href="'.route('ta.status.update',['id1' => $data->id, 'id2' => 1]).'"  
                                class="text-13 py-2 px-8 bg-warning-50 text-warning-600 d-inline-flex align-items-center gap-8 rounded-pill"
                                    onclick="'.$alertmsg.'">
                                <span class="w-6 h-6 bg-warning-600 rounded-circle flex-shrink-0"></span>
                                Inactive
                                </a>'
                                ;
                            }) 
                            ->addColumn('action', function(Admin $data) {
                                return '<a href="'.route('ta.edit',$data->id).'" class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">
                                <img src="'.asset('public/assets/images/new_icons/Edit.svg').'" alt="edit" class="h-32 w-32 rounded-circle">                     
                                </a>
                                <a href="'.route('ta.changepassword',$data->id).'" class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">
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
        return view('admin.ta.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lobs = Lob::all();
        return view('admin.ta.create',compact('lobs'));

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
           ], [
            'email.regex' => 'The email must be a valid @evalueserve.com address.',
            ]
        );
       

        $pass=1234;
        $token=hash('sha256',time());

        $sme = new Admin();
        $input = $request->all();
        $input['password']=Hash::make($pass);
        $input['token']=$token;
        $input['role_id'] = 3;
        $input['status'] = 1;
        $sme->fill($input)->save();

        return redirect()->back()->with('success','TA create Successfully');    

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $lobs = Lob::all();
            $sme = Admin::findOrFail($id);
            return view('admin.ta.edit', compact('sme','lobs'));  
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('sme')->with('error', 'TA not found');
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

        $sme = Admin::find($id);
        $sme->update($validatedData);
        return redirect()->back()->with('success','TA update Successfully');
    }

    public function updateStatus($id,$status){
            // Update the status
            $sme = Admin::find($id);
            $sme->status = $status;
            $sme->update();
            // Return a success message
            return redirect()->back()->with('success','status updated successfully!');    
    }


    public function changepassword($id)
    {
        try {
            $sme = Admin::findOrFail($id);
            return view('admin.ta.changepassword', compact('sme'));  
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('sme')->with('error', 'TA not found');
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

 
        $sme = Admin::find($id);
        $sme->password=Hash::make($request->input('password'));
        $sme->update();
        // Return a success message
        return redirect()->back()->with('success','password updated successfully!');    

    }



}
