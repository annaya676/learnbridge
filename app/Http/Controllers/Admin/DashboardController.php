<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\User;
use App\Models\Course;
use App\Models\Lob;
use App\Models\Coursemap;

class DashboardController extends Controller
{
   
    public function previewPDF($filename)
    {
            $path = public_path("uploads/docs/$filename");

            // Check if file exists
            if (!file_exists($path)) {
                abort(404);
            }
            // Get MIME type and return for inline preview
            $mimeType = mime_content_type($path);
            return response()->file($path, [
                'Content-Type' => $mimeType,
                'Content-Disposition' => 'inline'
            ]);

    }

    public function previewVideo($filename)
    {
         
            $path = public_path("uploads/videos/$filename");

            // Check if file exists
            if (!file_exists($path)) {
                abort(404);
            }
            // Get MIME type and return for inline preview
            $mimeType = mime_content_type($path);
            return response()->file($path, [
                'Content-Type' => $mimeType,
                'Content-Disposition' => 'inline'
            ]);
      
    }

    public function dashboard(){
        // Course Completion & Inprogress report
        // assignment
        // User Details
        // Course Catalogue Report
        $assignment=Coursemap::where('assignment_status', 1)->count();
        $userDetails = User::count();
        $courseCompletion = Coursemap::count();
        $courseCatalogue=Course::where('status', 1)->count();
        return view("admin.dashboard",compact('assignment','userDetails','courseCompletion','courseCatalogue'));
    }


    public function profile($slug='')
    {
        // dd($slug);
        $data = Auth::guard('admin')->user();
        return view('admin.profile',compact('data','slug'));
    }

    public function profileupdate(Request $request)
    {
        $id=Auth::guard('admin')->user()->id;
        $request->validate([
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $id,
            'phone' => 'required|numeric|digits:10|unique:admins,phone,' . $id,
            ]
        );
       
        $input = $request->all();
        $data = Auth::guard('admin')->user();
           
        $data->update($input);

        return redirect()->back()->with('success','profile updated successfully');    

    }

    public function updatepassword(Request $request)
    {
        
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required',
            "confirm_password" => ["required","same:new_password"],
        ]
        );

        if (!Hash::check($request->current_password, Auth::guard('admin')->user()->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $admin = Auth::guard('admin')->user();
        $admin->password=Hash::make($request->input('password'));
        $admin->update();
        // Return a success message
        return redirect()->back()->with('success','password updated successfully!');    

    }

 

}
