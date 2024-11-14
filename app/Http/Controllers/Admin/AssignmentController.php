<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Coursemap;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Module;
use Validator;
use Auth;
use Yajra\DataTables\DataTables;
use App\Mail\Websitemail;
use Illuminate\Support\Facades\Mail;

class AssignmentController extends Controller
{
   

    
    public function datatables()
    {
        $status=array(1,2,3,4);
        if ( auth('admin')->user()->role_id == 1 ){
            $datas = Coursemap::whereIn('assignment_status', $status)->orderBy('updated_at', 'desc')->with('course','user','lob')->get();
        }else{
            $smeIdToFind=  Auth::guard('admin')->user()->id;
            $courseIds = Course::whereRaw("FIND_IN_SET($smeIdToFind, sme_id) > 0")->where('status', 1)->get('id');
            $datas = Coursemap::whereIn('course_id', $courseIds)->whereIn('assignment_status', $status)->orderBy('assignment_upload_date', 'desc')->with('course','user','lob')->get();   
        }
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                ->addColumn('user_name', function(Coursemap $data) {
                    return $data->user->name;
                }) 

                ->addColumn('course_name', function(Coursemap $data) {
                    return $data->course->course_name;
                }) 
                
                ->addColumn('lob_id', function(Coursemap $data) {
                    return $data->lob->name;

                }) 
                ->addColumn('assignment_file', function(Coursemap $data) {
                    return '<a href="'.asset('uploads/assignment/'.$data->assignment_file).'" target="_blank" class="py-9 w-100 "><i class="ph ph-download"></i> Download </a>';

                }) 
                ->addColumn('assign_sme', function(Coursemap $data) {
                    $selected_sme_id = explode(",",$data->course->sme_id);
                    $smes = Admin::whereIn('id', $selected_sme_id)->where('role_id',2)->get();   
                    $sme_option='<select  class="sme-select" data-id="'.$data->id.'"><option value="">Select SME</option>';
                    foreach ($smes as $key => $sme) {
                    $sme_option .= '<option value="'.$sme->id.'">'.$sme->name.'</option>';
                    }
                    $sme_option .='</select>';

                    return $sme_option;
                }) 
                ->addColumn('assignment_assign', function(Coursemap $data) {
                    return ($data->sme)?$data->sme->name:'';
                }) 
                
                ->addColumn('assignment_status', function(Coursemap $data) {
                
                    $alertmsg='';//"return confirm('Are you sure you want to update the status?')";
                    $status='';
                    if($data->assignment_status == 1){

                        $status= '<a href="#" 
                            class="text-13 py-2 px-8 bg-success-50 text-success-600 d-inline-flex align-items-center gap-8 rounded-pill"
                            onclick="'.$alertmsg.'">
                            <span class="w-6 h-6 bg-success-600 rounded-circle flex-shrink-0"></span>
                            Completed
                            </a>';
                    }elseif($data->assignment_status == 2){
                    
                        $status= '<a href="#"  
                            class="text-13 py-2 px-8 bg-warning-50 text-warning-600 d-inline-flex align-items-center gap-8 rounded-pill"
                                onclick="'.$alertmsg.'">
                            <span class="w-6 h-6 bg-warning-600 rounded-circle flex-shrink-0"></span>
                            In Review
                            </a>' ;
                    }elseif($data->assignment_status == 3){
                            
                        $status= '<a href="#"  
                                class="text-13 py-2 px-8 bg-danger-50 text-danger-600 d-inline-flex align-items-center gap-8 rounded-pill"
                                    onclick="'.$alertmsg.'">
                                <span class="w-6 h-6 bg-danger-600 rounded-circle flex-shrink-0"></span>
                                Rework
                                </a>' ;
                    }
                    return $status;
                }) 
                ->addColumn('action', function(Coursemap $data) {
                    // if (Auth::guard("admin")->user()->role_id == 1) {       
                    //     return '';
                    // }else{
                        return '<a href="'.route('assignment.edit',$data->id).'" class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">
                        <img src="'.asset('public/assets/images/new_icons/Edit.svg').'" alt="edit" class="h-32 w-32 rounded-circle">                     
                                </a>';
                   // }
                }) 
                ->rawColumns(['assignment_assign','assign_sme','user_name','course_name','assignment_file','assignment_status','action'])         
                ->toJson(); //--- Returning Json Data To Client Side
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return view('admin.assignment.index');

    }

   
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $data = Coursemap::findOrFail($id);
            return view('admin.assignment.edit', compact('data'));  
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('assignment')->with('error', 'assignment not found');
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
         $request->validate([
            'status' => 'required',
            'smefile' => 'file|mimes:zip,pdf,docx,doc,xlsx|max:2048',
        ]);
       
        $data = Coursemap::findOrFail($id);
           
        if($request->hasFile('smefile')){
            if( $data->assignment_sme_file){
            $assignmentSmePath = public_path('uploads/assignment/' . $data->assignment_sme_file);
            if (file_exists($assignmentSmePath)) {
                unlink($assignmentSmePath);
            }}
             $assignmentfile = $request->file('smefile');
             $assignmentName = time() . '.' . $assignmentfile->getClientOriginalExtension();
             $assignmentfile->move(public_path('uploads/assignment'), $assignmentName);
             $data->assignment_sme_file =$assignmentName;
        }

        $data->assignment_status = $request->input('status');
        $data->assignment_remark = $request->input('remark');
        $data->sme_submission_date=date('Y-m-d');;     
        $data->update();

        if($data->assignment_status==1){
            $this->checkCourseComplete($data->course_id,$data->user_id);
            // $this->userAssignmentStatusCompleted($data->course_id,$data->user_id);//send email to user
        }

        if($data->assignment_status==2){  //send email to user
            // $this->userAssignmentStatusRework($data->course_id,$data->user_id);
        }

        return redirect()->route('assignment')->with('success','Update Successfully');
    }


    public function smeUpdate(Request $request)
    {

        $course = Coursemap::find($request->id);  // Find the user by ID
        if ($course) {
            $course->assignment_assign = $request->sme_id;  // Update status
            $course->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);


        
    }


    public function checkCourseComplete($course_id,$user_id){

        $details = Coursemap::where('user_id', $user_id)->where('course_id', $course_id)->with('course')->first();
        if($details){
            $is_read_docs = explode(",",$details->is_read_docs);
            $is_read_video = explode(",",$details->is_read_video);

            $documentLessons = Module::where('course_id', $course_id)
                                ->whereNotNull('document')
                                ->where('document', '!=', '')
                                ->pluck('id')->toArray();

            $videoLessons = Module::where('course_id', $course_id)
                            ->whereNotNull('video')
                            ->where('video', '!=', '')
                            ->pluck('id')->toArray();

            $quiz=true;
            if ($details->course->isquiz==1){
                    $quiz = $details->quiz_status==1?true:false;
            }
            $assignment=true;
            if ($details->course->assignment !=''){
                $assignment = $details->assignment_status==1?true:false;
            } 

            $matchDocs = empty(array_diff($documentLessons, $is_read_docs));
            $matchVideo = empty(array_diff($videoLessons, $is_read_video));
            if($matchDocs && $matchVideo && $quiz && $assignment){
                $details->is_complete = 1;
                $details->save();
            }
        }

    }

    public function userAssignmentStatusRework($course_id,$user_id){
        //Event: To be triggered upon Assignment Submission by SME as ‘Rework Required’
        $user = User::find($user_id);
        $courses = Course::where('id', $course_id)->first();
        $email_send_to=$user->email;
        $CC_email='learnbridge@university.com';
        $subject  ='LearnBridge – Update on Assignment shared by SME';

        $message  ='<h2>Hi '.$user->name.',</h2>';

        $message  .='<p>Your Assignment for course '.$courses->course_name.'  has been marked as ‘Rework Required’ by the SME.</p>';

        $message  .='<p>Please read the comments shared and the file submitted (as applicable) by the SME to rework.</p>';

        $message  .='<p>The assignment will need to be resubmitted post rework for a re-evaluation by the SME.</p>';

        Mail::to($email_send_to)->cc($CC_email)->send(new Websitemail($subject,$message));

        return true;

    }

    public function userAssignmentStatusCompleted($course_id,$user_id){
        //    Event: To be triggered upon Assignment Submission by SME as ‘Completed’
        $user = User::find($user_id);
        $courses = Course::where('id', $course_id)->first();

        $email_send_to=$user->email ;
        $CC_email='learnbridge@university.com';
        $subject  =' LearnBridge – Update on Assignment shared by SME';

        $message  ='<h2> Hi '.$user->name.',</h2>';

        $message  .='<p>Your Assignment for course '.$courses->course_name.'  has been marked as completed by the SME.</p>';

        $message  .='<p>Congratulations! You have successfully completed the course on '.$courses->course_name.' .</p>';

        Mail::to($email_send_to)->cc($CC_email)->send(new Websitemail($subject,$message));
        return true;

    }



}
