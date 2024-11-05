<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\Coursemap;
use App\Models\Admin;
use App\Models\User;
use App\Models\Course;
use App\Models\QuizQuestion;
use App\Models\Module;
use App\Models\UserQuizAnswer;
use App\Models\Category;
use Carbon\Carbon;
use App\Mail\Websitemail;
use Illuminate\Support\Facades\Mail;

// use App\Mail\Websitemail;

use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
   
    public function previewPDF(Request $request, $filename)
    {
        
        $referer = $request->headers->get('referer');

        if ($referer && strpos($referer, url('/')) === 0) {
            // The request came from within your application
            // Handle it accordingly
            
            $path = public_path("uploads/docs/$filename");

            // Check if file exists
            if (!file_exists($path)) {
                abort(404);
            }

            // if (!request()->headers->has('referer') || !str_contains(request()->headers->get('referer'), env('APP_URL'))) {
            //     abort(403, 'Direct access is forbidden.');
            // }
            if (!$request->headers->has('origin') || !str_contains($request->headers->get('origin'), env('APP_URL'))) {
                abort(403, 'Direct access is forbidden.');
            }
            // Get MIME type and return for inline preview
                $mimeType = mime_content_type($path);
                return response()->file($path, [
                    'Content-Type' => $mimeType,
                    'Content-Disposition' => 'inline'
                ]);
        } else {
            abort(404);
        }
    }

    public function previewVideo(Request $request,$filename)
    {
        $referer = $request->headers->get('referer');

        if ($referer && strpos($referer, url('/')) === 0) {
            // The request came from within your application
            // Handle it accordingly
            
            $path = public_path("uploads/videos/$filename");

            // Check if file exists
            if (!file_exists($path)) {
                abort(404);
            }

            // if (!request()->headers->has('referer') || !str_contains(request()->headers->get('referer'), env('APP_URL'))) {
            //     abort(403, 'Direct access is forbidden.');
            // }

            if (!$request->headers->has('origin') || !str_contains($request->headers->get('origin'), env('APP_URL'))) {
                abort(403, 'Direct access is forbidden.');
            }
            
            // Get MIME type and return for inline preview
                $mimeType = mime_content_type($path);
                return response()->file($path, [
                    'Content-Type' => $mimeType,
                    'Content-Disposition' => 'inline'
                ]);
        } else {
            abort(404);
        }
    }
    
    public function dashboard(Request $request){
        
        $user_id=  Auth::guard('web')->user()->id;
        $lobIdToFind=  Auth::guard('web')->user()->lob_id;
      

        $lobCourses = Course::whereRaw("FIND_IN_SET($lobIdToFind, lob_id) > 0")->where('status', 1)->get();
      
         if($lobCourses){
           
            foreach($lobCourses as $lobCourse){
               $checkCourse = Coursemap::where('course_id', $lobCourse->id)->where('user_id', $user_id)->first();
               if(!$checkCourse) { 
                    $coursemap = new Coursemap();
                    $coursemap->course_id = $lobCourse->id;
                    $coursemap->user_id = $user_id;
                    $coursemap->lob_id= $lobIdToFind;
                    $coursemap->assignment_file='';
                    $coursemap->assignment_remark='';     
                    $coursemap->assignment_upload_date=date('Y-m-d');;     
                    $coursemap->save();
                }
            }

        }

        $myCourses = Coursemap::where('user_id', $user_id)->with('course')->get(); 
        $cat_ids=array();
        $course_completed_status=array();
        if($myCourses){
            /// check course is completed or not and course category id for category active or deactive
            foreach($myCourses as $myCourse){
                if($myCourse->course){

                    $cat_ids[]=$myCourse->course->category_id;
                    if (array_key_exists($myCourse->course->category_id,$course_completed_status))
                    {
                        if($course_completed_status[$myCourse->course->category_id] != 0){
                            if($myCourse->assignment_status > 0){
                                $course_completed_status[$myCourse->course->category_id]=1;
                            }else{
                                $course_completed_status[$myCourse->course->category_id]=$myCourse->is_complete;
                            }
                        }
                    }
                    else
                    {
                        if($myCourse->assignment_status > 0){
                            $course_completed_status[$myCourse->course->category_id]=1;
                        }else{
                            $course_completed_status[$myCourse->course->category_id]=$myCourse->is_complete;
                        }
                        
                    }
                }
            }
        }
     
        
        
        // Get the authenticated user
        $user = $request->user();

        // Get categories with the count of enrolled courses for the user
        $categories = Category::with(['courses.courseMaps' => function ($query) use ($user) {
            $query->where('user_id', $user->id); // Filter enrollments by user ID
        }])->get();

        // Prepare data for view
        $categoryData = $categories->map(function ($category) {
            return [
                'category_id' => $category->id,
                'category_image' => $category->image,
                'category_name' => $category->name,
                'category_subset' => $category->subset,
                'course_count' => $category->courses->filter(function ($course) {
                    return $course->courseMaps->isNotEmpty(); // Count only courses with enrollments
                })->count(),
                'enrolled_courses' => $category->courses->filter(function ($course) {
                    return $course->courseMaps->isNotEmpty(); // Get enrolled courses for this category
                }),
            ];
        });


        return view("user.dashboard",compact('course_completed_status','categoryData'));
    }

    public function courses($category_id){
        // dd($categoty_id);
        $user_id=  Auth::guard('web')->user()->id;


        $myCourses = Coursemap::where('user_id', $user_id)
            ->whereHas('course', function ($query) use ($category_id) {
                $query->where('category_id', $category_id);
            })->with('course') ->get();

        if ($myCourses->isEmpty()) {
            abort(404); // Show a 404 error if no data is found
        }
        $category = Category::where('id', $category_id)->orderBy('id', 'asc')->first();

        // dd($myCourses);
        return view("user.courses",compact('myCourses','category'));
    }

    public function checkCourseComplete($course_id){

        $user_id=  Auth::guard('web')->user()->id;
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
    
    public function course($course_id, $module_type='',$module_id=''){

        $user_id=  Auth::guard('web')->user()->id;
        $details = Coursemap::where('user_id', $user_id)->where('course_id', $course_id)->with('course')->first();
    
        if($module_id!=''){
        $lesson = Module::where('course_id', $course_id)->where('id', $module_id)->first();
        }else{
        $lesson = Module::where('course_id', $course_id)->first();
        }
        if($details && $lesson){
            $is_read_docs = explode(",",$details->is_read_docs);
            $is_read_video = explode(",",$details->is_read_video);
            $modules = $details->course->module;
            foreach ($modules as $key => $module) {
                $module->video_unlocked =false;
                $module->document_unlocked =false;
                if ($key == 0) {
                    // Always unlock the first lesson
                    $module->video_unlocked = true;
                    $module->document_unlocked =true;
                    // if($module->video !='' && !in_array($module->id, $is_read_video)){
                    //     $module->video_unlocked = true;
                    // }
                    // if($module->document !='' && !in_array($module->id, $is_read_docs)){
                    //     $module->document_unlocked =true;
                    // }
                } else {
                    
                    if(in_array($modules[$key - 1]->id, $is_read_video)){
                        if($module->video !=''){
                            $module->video_unlocked = true;
                            if(in_array($module->id, $is_read_video)){
                                $module->document_unlocked =true;
                            }
                        }elseif($module->document !=''){
                            $module->document_unlocked =true;
                        }
                    }
                    if(in_array($modules[$key - 1]->id, $is_read_docs)){
                        if($module->video !=''){
                            $module->video_unlocked = true;
                            if(in_array($module->id, $is_read_video)){
                                $module->document_unlocked =true;
                            }
                        }elseif($module->document !=''){
                            $module->document_unlocked =true;
                        }
                    }
                }
                if($module_id!=''){
                    if($module_id == $module->id){
                        if($module->video_unlocked == false && $module->document_unlocked == false){
                            return redirect()->back()->with('error', 'not found');   
                        }   
                    }
                }
            }

            ///check course is completed status update
            $this->checkCourseComplete($course_id);
            
            //// for quiz and video lock check
            $documentLessons = Module::where('course_id', $course_id)
                        ->whereNotNull('document')
                        ->where('document', '!=', '')
                        ->pluck('id')->toArray();

            $videoLessons = Module::where('course_id', $course_id)
                    ->whereNotNull('video')
                    ->where('video', '!=', '')
                    ->pluck('id')->toArray();
            $matchDocs = empty(array_diff($documentLessons, $is_read_docs));
            $matchVideo = empty(array_diff($videoLessons, $is_read_video));
           
            $quizUnlock=false;
            $assignmentUnlock=false;
            if($matchDocs && $matchVideo){
                $quizUnlock=true;
                if ($details->isquiz==1){
                        $assignmentUnlock = $details->quiz_status==1?true:false;
                }else{
                        $assignmentUnlock =true;       
                }
            }
            ///////for quiz and video lock check end

            return view("user.course_details",compact('assignmentUnlock','quizUnlock','module_id','module_type','details','lesson'));

        } else {
            return redirect()->back()->with('error', 'not found');
        } 
    }

    public function assignments_download($course_id){
        $user_id=  Auth::guard('web')->user()->id;
        $details = Coursemap::where('user_id', $user_id)->where('course_id', $course_id)->with('course')->first();

        if($details){

            $details->assignment_download_status = 1;
            $details->update();
            $url = public_path('uploads/assignment/'.$details->course->assignment);
            $filename = $details->course->course_name.'-assignment-'.$details->course->assignment;


            return Response::download($url, $filename);

         }
    }   

    public function assignments($course_id){
            $user_id=  Auth::guard('web')->user()->id;
            $details = Coursemap::where('user_id', $user_id)->where('course_id', $course_id)->with('course')->first();
          
           if($details){
                return view("user.assignments",compact('details'));
             }else {
                return redirect()->back()->with('error', 'not found');
            } 
    }

    public function assignments_upload(Request $request, $courseId){
        $request->validate( [
            'file' => 'required',
        ]);

        $user_id=  Auth::guard('web')->user()->id;
        $details = Coursemap::where('user_id', $user_id)->where('course_id', $courseId)->with('course')->first();
        if($details){

            if($request->hasFile('file')){
                if( $details->assignment_file!==''){
                    $imagePath = public_path('uploads/assignment/' .  $details->assignment_file);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);  // Remove the old image
                    }
                }
                $file = $request->file('file');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/assignment'), $fileName);
                $details->assignment_file =$fileName;
                $details->assignment_status =2;//for review
                $details->assignment_upload_date=date('Y-m-d');;     
                $details->update();

                // $this->userAssignmentSubmission($details->course_id,$user_id);
               
                
                return redirect()->route('user.assignments', $details->course_id)->with('success','upload successfully');
           
            }else{
                return redirect()->back()->with('error', 'assignment not upload'); 
            }

        }else {
            return redirect()->back()->with('error', 'course found');
        } 



    }

    public function showQuiz($course_id,$questionindex=''){
            $user_id=  Auth::guard('web')->user()->id;
            $details = Coursemap::where('user_id', $user_id)->where('course_id', $course_id)->with('course')->first();
            $questionindex=0;
            if($details){
                if ($details->quiz_status == 1){
                    return redirect()->back()->with('error', 'not found');
                }
                $questionCount  = QuizQuestion::where('course_id', $course_id)->count();
                $question = QuizQuestion::where('course_id', $course_id)->orderBy('created_at', 'asc')->first();

                UserQuizAnswer::where('user_id', auth()->id())->where('course_id', $course_id)->delete();
                $selectedAns= '';

                return view("user.quiz.index",compact('selectedAns','questionCount','questionindex','details','question'));
            }else {
                return redirect()->back()->with('error', 'not found');
            } 
    }

    public function showQuestion($courseId, $questionindex=0)
    {

        $user_id=  Auth::guard('web')->user()->id;
        $details = Coursemap::where('user_id', $user_id)->where('course_id', $courseId)->with('course')->first();
        if($details){
            $questionCount  = QuizQuestion::where('course_id', $courseId)->count();
          
            $questions = QuizQuestion::where('course_id', $courseId)->orderBy('created_at', 'asc')->get();
            

            if ($questionindex >= 0 && $questionindex < $questions->count()) {
                $question = $questions[$questionindex];
                // Now you can use $question
            } else{
                return redirect()->back()->with('error', 'not found');
            }
            $userAnswers = UserQuizAnswer::where('user_id', auth()->id())->where('question_id', $question->id)->where('course_id', $courseId)->with('questions')->first();
            if($userAnswers){
                $selectedAns= $userAnswers->answer;
            }else{
                $selectedAns= '';
            }

            return view('user.quiz.index', compact('selectedAns','questionCount','questionindex','details', 'question'));
        }else {
            return redirect()->back()->with('error', 'not found');
        } 
    }

    public function storeAnswer(Request $request, $courseId, $questionId)
    {
        $request->validate([
            'answer' => 'string',
        ]);

        UserQuizAnswer::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'course_id'=>$courseId,
                'question_id' => $questionId,
            ],
            ['answer' => $request->input('answer')]
        );
        $questionindex =$request->input('questionindex');
        if ($questionindex != 0) {
            return redirect()->route('quiz.question', [$courseId, $questionindex]);
        } else {

            $user_id=  Auth::guard('web')->user()->id;
            $coursedetails = Coursemap::where('user_id', $user_id)->where('course_id', $courseId)->with('course')->first();
            $questions = QuizQuestion::where('course_id', $courseId)->get();
            $userAnswers = UserQuizAnswer::where('user_id', auth()->id())->where('course_id', $courseId)->with('questions')->get();
            $score = 0;
            foreach ($userAnswers as $userAnswer) {
                if ($userAnswer->answer == $userAnswer->questions->correct_answer) {
                    $score++;
                }
            }
            $scorePercentage=($score *100) / $questions->count();
            
            if($scorePercentage >= 80){
                $coursedetails->quiz_score = $score;
                $coursedetails->quiz_status = 1;
                $coursedetails->update();
                $this->checkCourseComplete($courseId);
            }else{
                $coursedetails->quiz_score = $score;
                $coursedetails->quiz_status = 2;
                $coursedetails->update();
            }
            return redirect()->route('quiz.result', $courseId);
        }
    }

    public function showResult($courseId)
    {

        $user_id=  Auth::guard('web')->user()->id;
        $coursedetails = Coursemap::where('user_id', $user_id)->where('course_id', $courseId)->with('course')->first();
        if($coursedetails){
            $questions = QuizQuestion::where('course_id', $courseId)->get();
            $userAnswers = UserQuizAnswer::where('user_id', auth()->id())->where('course_id', $courseId)->with('questions')->get();
           

            return view('user.quiz.result', compact('userAnswers','questions','coursedetails'));
        }else {
            return redirect()->back()->with('error', 'not found');
        } 
    }

    public function retakeQuiz($courseId)
    {
        $user_id=  Auth::guard('web')->user()->id;
        $coursedetails = Coursemap::where('user_id', $user_id)->where('course_id', $courseId)->with('course')->first();
        if($coursedetails){
            if ($coursedetails->quiz_status != 1){
                UserQuizAnswer::where('user_id', auth()->id())->where('course_id', $courseId)->delete();
                return redirect()->route('quiz.index', $courseId);
            }else {
                return redirect()->back()->with('error', 'not found');
            } 
        }else {
            return redirect()->back()->with('error', 'not found');
        } 
       
    }

    public function updatePdfReadStatus(Request $request,$course_id,$module_id){
        $user_id=  Auth::guard('web')->user()->id;
        $details = Coursemap::where('user_id', $user_id)->where('course_id', $course_id)->with('course')->first();

        if ($details) {
            $is_read_docs = ($details->is_read_docs!='')?explode(",",$details->is_read_docs):array();
            $is_read_docs[]=$module_id;

            $details->is_read_docs = implode(',',array_unique($is_read_docs));
            $details->save();

            return response()->json(['message' => 'Status updated successfully']);
        }

        return response()->json(['message' => 'Invalid request'], 400);
    }
    
    public function updateVideoReadStatus(Request $request,$course_id,$module_id){
        $user_id=  Auth::guard('web')->user()->id;
        $details = Coursemap::where('user_id', $user_id)->where('course_id', $course_id)->with('course')->first();

        if ($details) {
            $is_read_video = ($details->is_read_video!='')?explode(",",$details->is_read_video):array();
            $is_read_video[]=$module_id;

            $details->is_read_video = implode(',',array_unique($is_read_video));
            $details->save();

            return response()->json(['message' => 'Status updated successfully']);
        }

        return response()->json(['message' => 'Invalid request'], 400);
    }

    public function userAssignmentSubmission($course_id,$user_id){
        // Event: To be triggered upon Assignment Submission
    
        $link =route('login');
        $user = User::find($user_id);
        $courses = Course::where('id', $course_id)->first();
        $sme_ids =  explode(",",$courses->sme_id);
        $sme_email = Admin::whereIn('id', $sme_ids)->where('role_id',2)->orderBy('id', 'desc')->pluck('email')->implode(',');
        $sme_name = Admin::whereIn('id', $sme_ids)->where('role_id',2)->orderBy('id', 'desc')->pluck('name')->implode(', ');

        $email_send_to=$sme_email;
        $CC_email='joshisummi@gmail.com';
        $subject  ='LearnBridge – Assignment Submission by '.$user->name.','.$user->lob->name;
        $message  ='<h2>Hi '.$sme_name.','.$user->name.',</h2>';

        $message  .='<p>An assignment for Course '.$courses->course_name.' has been submitted by '.$user->name.','.$user->lob->name.' on '.date('d-m-Y').'.</p>';

        $message  .='<p>Please access LearnBridge to review the submitted assignment.</p>';

        $message  .='<p>To access LearnBridge <a href='.$link.'> Click Here </a></p>';
        
        Mail::to($email_send_to)->cc($CC_email)->send(new Websitemail($subject,$message));
        return true;

    }


}
