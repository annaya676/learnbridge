<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lob;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Yajra\DataTables\DataTables;

class LobController extends Controller
{
    
    public function datatables()
    {
         $datas = Lob::orderBy('id', 'desc')->get();
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                            ->addColumn('status', function(Lob $data) {
                                // $role = $data->role_id == 0 ? 'No Role' : $data->role->name;
                          
                                $alertmsg="return confirm('Are you sure you want to update the status?')";

                                return ($data->status == 1)?

                            '  <a href="'.route('lob.status.update',['id1' => $data->id, 'id2' => 0]).'" 
                            class="text-13 py-2 px-8 bg-success-50 text-success-600 d-inline-flex align-items-center gap-8 rounded-pill"
                                    onclick="'.$alertmsg.'">
                                <span class="w-6 h-6 bg-success-600 rounded-circle flex-shrink-0"></span>
                                Active
                                </a>'
                                :
                                '<a href="'.route('lob.status.update',['id1' => $data->id, 'id2' => 1]).'"  
                                class="text-13 py-2 px-8 bg-warning-50 text-warning-600 d-inline-flex align-items-center gap-8 rounded-pill"
                                    onclick="'.$alertmsg.'">
                                <span class="w-6 h-6 bg-warning-600 rounded-circle flex-shrink-0"></span>
                                Inactive
                                </a>'
                                ;

                            }) 
                            ->addColumn('action', function(Lob $data) {
                                return '<a href="'.route('lob.edit',$data->id).'" class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">Edit</a>';
                              }) 
                            ->rawColumns(['status','action'])         
                            ->toJson(); //--- Returning Json Data To Client Side
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.lob.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.lob.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
       
        Lob::create($validatedData);
        return redirect()->back()->with('success','LOB create Successfully');    

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $lob = Lob::findOrFail($id);
            return view('admin.lob.edit', compact('lob'));  
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('lob')->with('error', 'Lob not found');
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
            'description' => 'required',
        ]);
       
        $lob = Lob::find($id);
        $lob->update($validatedData);
        return redirect()->back()->with('success','LOB update Successfully');
    }



    public function updateStatus($id,$status){

        // Update the status
        $lob = Lob::find($id);
        $lob->status = $status;
        $lob->update();

        // Return a success message
        return redirect()->back()->with('success','Status updated successfully!');    
    }



}
