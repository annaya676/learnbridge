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
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;


class ReportsController extends Controller
{
    
    public function assignmentExport(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $status=array(1,2,3,4);       
        if ($start_date && $end_date) {
            if( $end_date == date('Y-m-d')){
                $end_date = Carbon::tomorrow();
            }
            $datas = Coursemap::whereBetween('assignment_upload_date', [$start_date, $end_date])->whereIn('assignment_status', $status)->orderBy('assignment_upload_date', 'desc')->with('course','user','lob')->get();   
        } else{
            $datas = Coursemap::whereIn('assignment_status', $status)->orderBy('assignment_upload_date', 'desc')->with('course','user','lob')->get();   
        }
        // Prepare CSV content
        $csvContent = "User Name,Course Name,LOB,Assigned,User Assignment Submit Date,SME Submission Date,Status\n"; // CSV header

        foreach ($datas as $data) {
            $user_assignment_submit_date = $data->assignment_upload_date!=''?Carbon::create($data->assignment_upload_date)->format('d M Y'):'';		
            $sme_submission_date = $data->sme_submission_date!=''?Carbon::create($data->sme_submission_date)->format('d M Y'):'';	
            
            $smename=  ($data->sme)?$data->sme->name:'';
            $status='';
            if($data->assignment_status == 1){
            $status= 'Completed';
            }elseif($data->assignment_status == 2){
            $status= 'In Review' ;
            }elseif($data->assignment_status == 3){
            $status= 'Rework' ;
            }
            $csvContent .= "{$data->user->name},{$data->course->course_name},{$data->lob->name},{$smename},{$user_assignment_submit_date},{$sme_submission_date},{$status}\n"; // Custom CSV row
        }

        // Define the response headers
        return Response::make($csvContent, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="assignment.csv"',
        ]);
    }

    public function assignmentDatatables(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $status=array(1,2,3,4);       
        if ($start_date && $end_date) {
            if( $end_date == date('Y-m-d')){
                $end_date = Carbon::tomorrow();
            }
            $datas = Coursemap::whereBetween('assignment_upload_date', [$start_date, $end_date])->whereIn('assignment_status', $status)->orderBy('assignment_upload_date', 'desc')->with('course','user','lob')->get();   
        } else{
            $datas = Coursemap::whereIn('assignment_status', $status)->orderBy('assignment_upload_date', 'desc')->with('course','user','lob')->get();   
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
                
                ->rawColumns(['assignment_assign','assign_sme','user_name','course_name','assignment_status'])         
                ->toJson(); //--- Returning Json Data To Client Side
    }

    public function assignment()
    { 
        return view("admin.reports.assignment");
    }

    public function courseCompletionExport(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        if ($start_date && $end_date) {
            if( $end_date == date('Y-m-d')){
                $end_date = Carbon::tomorrow();
            }
            $datas = Coursemap::whereBetween('created_at', [$start_date, $end_date])->orderBy('id', 'desc')->with('course','user','lob')->get();   
        }else{
            $datas = Coursemap::orderBy('id', 'desc')->with('course','user','lob')->get();   
        }
        // Prepare CSV content
        $csvContent = "User Name,User Id,Email ID,Course Title,Course Code,Course Start Date,Is Assessment Available,Assessment Status,Assessment Date,Quiz,Course Completion Date,Course Status,Duration (minutes),Date of Joining,Designation,Level,Sub LoB,Trf No\n"; // CSV header
     
        foreach ($datas as $data) {
            $module_duration = $data->course->module->sum('duration');
            $Quiz = $data->course->isquiz==1?'Yes':'';
            $assignment = $data->course->assignment!=''?'Yes':'No';
            $assignment_status=$data->course->assignment!=''?'Pending':'';
            $AssessmentDate = $data->assignment_upload_date!=''?Carbon::create($data->assignment_upload_date)->format('d M Y'):'';	
            $updated_at = $data->updated_at!=''?Carbon::create($data->updated_at)->format('d M Y'):'';	
            $DateofJoining = Carbon::create($data->user->doj)->format('d M Y');	
            $CourseStartDate = Carbon::create($data->created_at)->format('d M Y');	

            if($data->assignment_status == 1){
                $assignment_status= 'Completed';
            }elseif($data->assignment_status == 2){
                $assignment_status= 'In Review' ;
            }elseif($data->assignment_status == 3){
                $assignment_status= 'Rework' ;
            }else{
               $AssessmentDate = '';	 
            }
            
            $UserName = $data->user->name;
            $UserId = $data->user->id;
            $EmailID = $data->user->email;
            $CourseTitle = $data->course->course_name;
            $CourseCode = $data->course->course_id;	
            $IsAssessmentAvailable =  $assignment;
            $AssessmentStatus = $assignment_status;
            $CourseCompletionDate = $data->is_complete==1?$updated_at:'';
            $CourseStatus = $data->is_complete==1?'Completed':'In progress';
            $CourseDuration = $module_duration;
            $Designation = $data->user->designation;
            $Level = $data->user->level;
            $SubLoB = $data->user->sub_lob;  
            $trfNo =$data->user->trf;
            $csvContent .= "{$UserName},{$UserId},{$EmailID},{$CourseTitle},{$CourseCode},{$CourseStartDate},{$IsAssessmentAvailable},{$AssessmentStatus},{$AssessmentDate},{$Quiz},{$CourseCompletionDate},{$CourseStatus},{$CourseDuration},{$DateofJoining},{$Designation},{$Level},{$SubLoB},{$trfNo}\n"; // Custom CSV row
        }

        // Define the response headers
        return Response::make($csvContent, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="course-completion.csv"',
        ]);
    }
    
    public function courseCompletionDatatables(Request $request)
    {
      
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        if ($start_date && $end_date) {
            if( $end_date == date('Y-m-d')){
                $end_date = Carbon::tomorrow();
            }
            $datas = Coursemap::whereBetween('created_at', [$start_date, $end_date])->orderBy('id', 'desc')->with('course','user','lob')->get();   
        }else{
            $datas = Coursemap::orderBy('id', 'desc')->with('course','user','lob')->get();   
        }
         //--- Integrating This Collection Into Datatables
         return Datatables::of($datas)
                ->addColumn('user_name', function(Coursemap $data) {
                    return $data->user->name;
                }) 
                ->addColumn('id', function(Coursemap $data) {
                    return $data->user->id;
                }) 
                ->addColumn('email', function(Coursemap $data) {
                    return $data->user->email;
                }) 
                ->addColumn('course_id', function(Coursemap $data) {
                    return $data->course->course_id;
                }) 
                ->addColumn('course_name', function(Coursemap $data) {
                    return $data->course->course_name;
                }) 
                ->addColumn('course_start_date', function(Coursemap $data) {
                    return $data->updated_at;
                }) 
                ->addColumn('IsAssessmentAvailable', function(Coursemap $data) {
                    return $data->assignment!=''?'Yes':'No';
                })       
                ->addColumn('assignment_status', function(Coursemap $data) {
                    $assignment_status='';
                    if($data->assignment_status == 1){
                    $assignment_status= 'Completed';
                    }elseif($data->assignment_status == 2){
                    $assignment_status= 'In Review' ;
                    }elseif($data->assignment_status == 3){
                    $assignment_status= 'Rework' ;
                    }
                    return $assignment_status;
                })  
                ->addColumn('assignment_upload_date', function(Coursemap $data) {
                return $data->assignment_upload_date;	
                })  
                ->addColumn('is_complete', function(Coursemap $data) {
                return $data->is_complete==1?$data->updated_at:'';
                })  
                ->addColumn('course_status', function(Coursemap $data) {
                return $data->course->status == 1?'Active':'Inactive';
                })  
                ->addColumn('module_duration', function(Coursemap $data) {
                return $data->course->module->sum('duration').'min';
                })  
                ->addColumn('doj', function(Coursemap $data) {
                return $data->user->doj;
                })  
                ->addColumn('designation', function(Coursemap $data) {
                return $data->user->designation;
                })  
                ->addColumn('level', function(Coursemap $data) {
                return $data->user->level;
                })  
               ->addColumn('sub_lob', function(Coursemap $data) {
                return $data->user->sub_lob;
                })  
                  
                ->addColumn('course_status', function(Coursemap $data) {
                
                    if($data->course->status == 1){

                        $status= '<a href="#" 
                            class="text-13 py-2 px-8 bg-success-50 text-success-600 d-inline-flex align-items-center gap-8 rounded-pill">
                            <span class="w-6 h-6 bg-success-600 rounded-circle flex-shrink-0"></span>
                            Active
                            </a>';
                    }else{
                    
                        $status= '<a href="#"  
                            class="text-13 py-2 px-8 bg-warning-50 text-warning-600 d-inline-flex align-items-center gap-8 rounded-pill">
                            <span class="w-6 h-6 bg-warning-600 rounded-circle flex-shrink-0"></span>
                            Inactive
                            </a>' ;
                    }
                    return $status;
                }) 
                
                ->rawColumns(['user_name','id','email', 'course_id', 'course_name', 'course_start_date','IsAssessmentAvailable','assignment_status','assignment_upload_date','is_complete','course_status','module_duration','doj','designation','level','sub_lob','lob_id','assignment_assign','course_status'])         
                ->toJson(); //--- Returning Json Data To Client Side
    }

    public function courseCompletion()
    {
       //Course Completion & Inprogress report
        return view("admin.reports.course-completion");
    }

    public function userDetailsExport(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        if ($start_date && $end_date) {
            if( $end_date == date('Y-m-d')){
                $end_date = Carbon::tomorrow();
            }
            $datas = User::whereBetween('created_at', [$start_date, $end_date])->orderBy('id', 'desc')->with('lob')->get();
        } else{
            $datas = User::orderBy('id', 'desc')->with('lob')->get();
        }
        $csvContent = "User Id,Name,Gender,Designation,Level,LoB,Sub-Lob,College Name,Location,Specialization,College Location,Contact Number,Email Id,Offer Release Spoc,User Status,DOJ,TRF,Joiner Status,Creation date,Created By\n"; // CSV header
        foreach ($datas as $data) {
            $lobname=  ($data->lob)?$data->lob->name:'';
            $creation_date=Carbon::create($data->created_at)->format('d M Y');	
            $created_By=$data->createdby->email;
            if($data->status == 1){
            $status= 'Active';
            }else{
            $status= 'Inactive' ;
            }
            
            $DateofJoining = Carbon::create($data->doj)->format('d M Y');	            

            $csvContent .= "{$data->id},{$data->name},{$data->gender},{$data->designation},{$data->level},{$lobname},{$data->sub_lob},{$data->college_name},{$data->location},{$data->specialization},{$data->college_location},{$data->phone},{$data->email},{$data->offer_release_spoc},{$status},{$DateofJoining},{$data->trf},{$data->joiner_status},{$creation_date},{$created_By}\n"; // Custom CSV row
        }


        // Define the response headers
        return Response::make($csvContent, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="user-details.csv"',
        ]);
    }
    
    public function userDetailsDatatables(Request $request)
    {
       
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        
        if ($start_date && $end_date) {
            if( $end_date == date('Y-m-d')){
                $end_date = Carbon::tomorrow();
            }
            $datas = User::whereBetween('created_at', [$start_date, $end_date])->orderBy('id', 'desc')->with('lob')->get();
        } else{
            $datas = User::orderBy('id', 'desc')->with('lob')->get();
        }
         //--- Integrating This Collection Into Datatables

        return Datatables::of($datas)
                            ->addColumn('lob_id', function(User $data) {
                                return $data->lob->name;
                            })  
                            ->addColumn('doj', function(User $data) {
                                return Carbon::create($data->doj)->format('d M Y');
                            }) 
                            
                           ->addColumn('status', function(User $data) {
                               // $role = $data->role_id == 0 ? 'No Role' : $data->role->name;
                               $alertmsg="return confirm('Are you sure you want to update the status?')";

                               return ($data->status == 1)?

                           '  <a href="'.route('user.status.update',['id1' => $data->id, 'id2' => 0]).'" 
                           class="text-13 py-2 px-8 bg-success-50 text-success-600 d-inline-flex align-items-center gap-8 rounded-pill"
                                   onclick="'.$alertmsg.'">
                               <span class="w-6 h-6 bg-success-600 rounded-circle flex-shrink-0"></span>
                               Active
                               </a>'
                               :
                               '<a href="'.route('user.status.update',['id1' => $data->id, 'id2' => 1]).'"  
                               class="text-13 py-2 px-8 bg-warning-50 text-warning-600 d-inline-flex align-items-center gap-8 rounded-pill"
                                   onclick="'.$alertmsg.'">
                               <span class="w-6 h-6 bg-warning-600 rounded-circle flex-shrink-0"></span>
                               Inactive
                               </a>'
                               ;
                           }) 
                           ->rawColumns(['status','lob_id'])         
                           ->toJson(); //--- Returning Json Data To Client Side
    }

    public function userDetails()
    {   
        
        //User Details
        return view("admin.reports.user-details");
    }

    public function courseCatalogueExport(Request $request)
    {
        
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        if ($start_date && $end_date) {
            if( $end_date == date('Y-m-d')){
                $end_date = Carbon::tomorrow();
            }
            $datas = Course::whereBetween('created_at', [$start_date, $end_date])->orderBy('id', 'desc')->get();   
        } else{
            $datas = Course::orderBy('id', 'desc')->get();   
        }

        // Prepare CSV content

        // Module Name
        // Description	
        // IsApplicable To LoB Name

        $csvContent = "Course Code,Category Name,Course Name,Duration (minutes),Is Active,Is Assessment,Is Quiz, Total Modules,Author,Created By,Created Date\n"; 
        
        foreach ($datas as $data) {
            $module_duration = $data->module->sum('duration');
            $total_modules = $data->module->count();
            $assignment = $data->assignment!=''?'Yes':'No';
            $isquiz = $data->isquiz==1?'Yes':'No';
            
            if($data->status == 1){
            $status= 'Active';
            }else{
            $status= 'Deactive' ;
            } 
            
            $created_at =Carbon::create($data->created_at )->format('d M Y');	

            $csvContent .= "{$data->course_id},{$data->category->name},{$data->course_name},{$module_duration},{$status},{$assignment },{$isquiz},{$total_modules},{$data->author},{$data->updateby->name},{$created_at}\n"; // Custom CSV row
        }

        // Define the response headers
        return Response::make($csvContent, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="course-catalogue.csv"',
        ]);
    }
    
    public function courseCatalogueDatatables(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        if ($start_date && $end_date) {
            if( $end_date == date('Y-m-d')){
                $end_date = Carbon::tomorrow();
            }
            $datas = Course::whereBetween('created_at', [$start_date, $end_date])->orderBy('id', 'desc')->get();   
        } else{
            $datas = Course::orderBy('id', 'desc')->get();   
        }
  
         //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)      
 
                ->addColumn('is_assignment', function(Course $data) {
                    return $data->assignment!=''?'Yes':'No';
                }) 
                ->addColumn('module_duration', function(Course $data) {
                    return $data->module->sum('duration').'min';
                }) 
                ->addColumn('total_modules', function(Course $data) {
                    return $data->module->count();
                })   
                ->addColumn('status', function(Course $data) {
                
                    if($data->status == 1){

                        $status= '<a href="#" 
                            class="text-13 py-2 px-8 bg-success-50 text-success-600 d-inline-flex align-items-center gap-8 rounded-pill"
                           >
                            <span class="w-6 h-6 bg-success-600 rounded-circle flex-shrink-0"></span>
                            Active
                            </a>';
                    }else{
                        $status= '<a href="#"  
                                class="text-13 py-2 px-8 bg-danger-50 text-danger-600 d-inline-flex align-items-center gap-8 rounded-pill"
                                 >
                                <span class="w-6 h-6 bg-danger-600 rounded-circle flex-shrink-0"></span>
                                Deactive
                                </a>' ;
                    }
                    return $status;
                }) 
                
                ->rawColumns(['is_assignment','module_duration','total_modules','status'])         
                ->toJson(); //--- Returning Json Data To Client Side
    }

    public function courseCatalogue()
    {
        //Course Catalogue Report
        return view("admin.reports.course-catalogue");
    }

 

}
