<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Admin;
use App\Models\Course;
use App\Models\User;
use App\Models\Coursemap;
use App\Mail\Websitemail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class FrontController extends Controller
{
   
   
    public function about_sss(){

        return view("page.about");
    }
    // public function about(){
    //     $user_id=37;

    // public function userActivationMail($user_id){  ///DONE
    //     // Event: To be triggered after the User activation mail
    //     $user = User::find($user_id);
    //     $courses = Coursemap::where('user_id', $user_id)->with('course')->get();


    //     $email_send_to=$user->email ;
    //     $CC_email='learnbridge@university.com';
    //     $subject  ='LearnBridge – Navigation Guide and Course List';

    //     $message  ='<h2>Hi '.$user->name.',</h2>';

    //     $message  .='<p>University is happy to be your learning partner.</p>';

    //     $message  .='<p>LearnBridge is University Learning Platform. Via the learning offerings,our aim is to equip you with knowledge and skills that will be the foundation of your journey at University.</p>';

    //     $message  .='<p>The following courses are mapped on LearnBridge for you and need to be completed by <date should be 1-day before DoJ>:</p>';
    //     foreach ($courses as $key => $list) {
    //     $message  .='<p>'.($key+1).'. '.$list->course->course_name.'</p>';
    //     }
    //     $message  .='<p>Your access will be deactivated on <date should be 1-day before DoJ>.</p>';

    //     $message  .='<p>In case of any questions, please write to learnbridge@university.com.</p>';

    //     Mail::to($email_send_to)->cc($CC_email)->send(new Websitemail($subject,$message));
    //     return 'Email sent successfully!';

    // }

    // public function userAssignmentSubmission($course_id,$user_id){ //DONE
    //     // Event: To be triggered upon Assignment Submission
    
    //     $link =route('login');
    //     $user = User::find($user_id);
    //     $courses = Course::where('id', $course_id)->first();
    //     $sme_ids =  explode(",",$courses->sme_id);
    //     $sme_email = Admin::whereIn('id', $sme_ids)->where('role_id',2)->orderBy('id', 'desc')->pluck('email')->implode(',');
    //     $sme_name = Admin::whereIn('id', $sme_ids)->where('role_id',2)->orderBy('id', 'desc')->pluck('name')->implode(', ');

    //     $email_send_to=$sme_email;
    //     $CC_email='learnbridge@university.com';
    //     $subject  ='LearnBridge – Assignment Submission by '.$user->name.','.$user->lob->name;
    //     $message  ='<h2>Hi '.$sme_name.','.$user->name.',</h2>';

    //     $message  .='<p>An assignment for Course '.$courses->course_name.' has been submitted by '.$user->name.','.$user->lob->name.' on '.date('d-m-Y').'.</p>';

    //     $message  .='<p>Please access LearnBridge to review the submitted assignment.</p>';

    //     $message  .='<p>To access LearnBridge <a href='.$link.'> Click Here </a></p>';
        
    //     Mail::to($email_send_to)->cc($CC_email)->send(new Websitemail($subject,$message));
    //     return 'Email sent successfully!';

    // }


        // public function userAssignmentStatusCompleted($course_id,$user_id){//DONE
        //     //    Event: To be triggered upon Assignment Submission by SME as ‘Completed’
        //     $user = User::find($user_id);
        //     $courses = Course::where('id', $course_id)->first();

        //     $email_send_to=$user->email ;
        //     $CC_email='learnbridge@university.com';
        //     $subject  =' LearnBridge – Update on Assignment shared by SME';

        //     $message  ='<h2> Hi '.$user->name.',</h2>';

        //     $message  .='<p>Your Assignment for course '.$courses->course_name.'  has been marked as completed by the SME.</p>';

        //     $message  .='<p>Congratulations! You have successfully completed the course on '.$courses->course_name.' .</p>';

        //     Mail::to($email_send_to)->cc($CC_email)->send(new Websitemail($subject,$message));
        //     return 'Email sent successfully!';

        // }



    // public function userAssignmentStatusRework($course_id,$user_id){ //DONE
    //     //Event: To be triggered upon Assignment Submission by SME as ‘Rework Required’
    //     $user = User::find($user_id);
    //     $courses = Course::where('id', $course_id)->first();
    //     $email_send_to=$user->email;
    //     $CC_email='learnbridge@university.com';
    //     $subject  ='LearnBridge – Update on Assignment shared by SME';

    //     $message  ='<h2>Hi '.$user->name.',</h2>';

    //     $message  .='<p>Your Assignment for course '.$courses->course_name.'  has been marked as ‘Rework Required’ by the SME.</p>';

    //     $message  .='<p>Please read the comments shared and the file submitted (as applicable) by the SME to rework.</p>';

    //     $message  .='<p>The assignment will need to be resubmitted post rework for a re-evaluation by the SME.</p>';

    //     Mail::to($email_send_to)->cc($CC_email)->send(new Websitemail($subject,$message));

    //     return 'Email sent successfully!';

    // }

   
    public function completionAllCoursesSendUser($user_id){ //cron email
        // Event:Upon completion of all mandated courses 
            $user = User::find($user_id);
            $doj = \Carbon\Carbon::create($user->doj)->subDays(1)->format('d-m-Y') ;
            $email_send_to=$user->email ;
            $CC_email='learnbridge@university.com';
            $subject  ='LearnBridge – Continue Learning!';
    
            $message  ='<h2>Hi '.$user->name.',</h2>';
            $message  .='<p>Congratulations! You have successfully completed all mandated courses mapped to you on LearnBridge.</p>';
            $message  .='<p>We encourage you to continue your learning journey with us – feel free to access courses in the ‘Learn More’ section.</p>';

            $message  .='<p>We look forward to you joining us!</p>';
        
            Mail::to($email_send_to)->cc($CC_email)->send(new Websitemail($subject,$message));
            return 'Email sent successfully!';
    
        }

        
    public function beforeDoJ7daySendUser(){ //cron email
        //    Event: 7-days before DoJ send to user 
        $sevenDaysAgo = \Carbon\Carbon::now()->addDays(7)->toDateString();
        $users = User::whereDate('doj', '=', $sevenDaysAgo)->get();
        foreach($users as $user){
        $doj = \Carbon\Carbon::create($user->doj)->subDays(1)->format('d-m-Y') ;
        $email_send_to=$user->email ;
        $CC_email='learnbridge@university.com';
        $subject  ='LearnBridge – Account Deactivation '.$doj;

        $message  ='<h2>Hi '.$user->name.',</h2>';
        $message  .='<p>Your LearnBridge account will be deactivated on '.$doj.'.</p>';
        $message  .='<p>Please ensure that all:</p>';
        $message  .='<p>• courses are completed </p>';
        $message  .='<p>• all assignments are submitted </p>';
        $message  .='<p>We look forward to you joining us soon!</p>';

        Mail::to($email_send_to)->cc($CC_email)->send(new Websitemail($subject,$message));
        }
        return 'Email sent successfully!';

    }

    
    // public function accountDeactivation(){ //cron email
    // //  Event: All courses mapped to a user are complete before DoJ

    //     $user_id=22;
    //     $user = User::find($user_id);
    
    //     $email_send_to=$user->email ;
    //     $CC_email='learnbridge@university.com';
    //     $subject  ='LearnBridge – Account Deactivation';

    //     $message  ='<h2> Hi '.$user->name.',</h2>';

    //     $message  .='<p>Congratulations! You have successfully completed all courses mapped to you on LearnBridge.</p>';

    //     $message  .='<p>Your account has been deactivated.</p>';

    //     $message  .='<p>We look forward to you joining us soon!</p>';

    //     Mail::to($email_send_to)->cc($CC_email)->send(new Websitemail($subject,$message));

    //     return 'Email sent successfully!';

    // }

    // public function about(){

    public function beforeDoJ7daySendSme($user_id){ //beforeDoJ7daySendSme  //cron email
        //  Event: 7-Days before Users’ DoJ send to sme  .. get By LOB
   $sevenDaysAgo = \Carbon\Carbon::now()->addDays(1)->toDateString();
        $users = User::whereDate('doj', '=', $sevenDaysAgo)->get();
        foreach($users as $user){
       
            $courseMaps = Coursemap::where('user_id', $user->id)->with('course')->get();
            $sme_ids=array();
            foreach( $courseMaps as  $map){
 
        $courses = Course::where('id', $map->course_id)->first();
        $sme_id =  explode(",",$courses->sme_id);
        $sme_ids=  array_merge($sme_ids,$sme_id);
        // $sme_email = Admin::whereIn('id', $sme_ids)->where('role_id',2)->orderBy('id', 'desc')->pluck('email')->implode(',');
        // $sme_name = Admin::whereIn('id', $sme_ids)->where('role_id',2)->orderBy('id', 'desc')->pluck('name')->implode(', ');
    }

    dd( $sme_ids );      

            // dd( $course);
        // To: <SMEs with open Assignments>
        // $email_send_to=$user->email ;
        // $CC_email='learnbridge@university.com';
        // $subject  ='LearnBridge – Account Deactivation';
        
        // $message  ='<h2> <SME1, SME2, SME3></h2>';
        // $message  .='<p>Please access the SME page on LearnBridge to action any/all assignments pending for you.</p>';

        // $message  .='<p>The following user accounts are going to be deactivated within the next 7-days:</p>';
        // $message  .='<p>1. <User email ID, LoB> and <DoJ></p>';
        // $message  .='<p>2. <User email ID, LoB> and <DoJ></p>';
        // $message  .='<p>3. <User email ID, LoB> and <DoJ></p>';

        // $message  .='<p>All actions need to be closed on the account 1-day before their date of joining.</p>';

        //   Mail::to($email_send_to)->cc($CC_email)->send(new Websitemail($subject,$message));
        }
        // return 'Email sent successfully!';

    }

    public function about(){

    // public function changeLoBMail(){ 
        //  Event: Change in LoB
    
            $user_id=37;
            $user = User::find($user_id);
            $doj = \Carbon\Carbon::create($user->doj)->subDays(1)->format('d-m-Y') ;

            $email_send_to=$user->email ;
            $CC_email='learnbridge@university.com';
            $subject  ='LearnBridge – Update in Learning Plan';
    
            $message  ='<h2> Hi '.$user->name.',</h2>';
    
            $message  .='<p>With the change in the Line of Business that you will be joining. The learning plan in line with the Line of Business is now accessible to you in the mandatory training section.</p>';
    
            $message  .='<p>Please keep in mind that your access to LearnBridge will be deactivated on '.$doj.'.</p>';
    
    
          $send=  Mail::to($email_send_to)->cc($CC_email)->send(new Websitemail($subject,$message));
    // print_r($send);
            return true;
    
        }
     
    // public function UserActivatedEmail($user_id,$password){  DONE
    //     // Event: User Activated on LearnBridge , user create send this mail

    //     $user = User::find($user_id);
    //     $email_send_to=$user->email ;
    //     $CC_email='learnbridge@university.com';
    //     $subject  ='Welcome to University! Access credentials for LearnBridge.';
    //     $link =route('dashboard');

    //     $message  ='<h2>Hi '.$user->name.'</h2>';
    //     $message  .='<p>Thank you for choosing to be a part of University! We are happy to share that your access to the University pre-joining Learning Portal – LearnBridge is active.</p><br/>';
    //     $message  .='<p>To access the portal, please use the following credentials:</p>';
    //     $message  .='<p><b>Link:</b> <a href='.$link.'> Click Here </a></p>';
    //     $message  .='<p><b>Username:</b> '.$user->email.'</p>';
    //     $message  .='<p><b>Password:</b> '.$password.'</p>';
    //     $message  .='<p>Please keep a check on your email for the list of courses mapped to you and the navigation guide.</p><br/>';
    //     $message  .='<p><b>Important:</b> The password is auto generated and cannot be changed. In case you are unable to log-in, write to <Mailbox Name> along with a screenshot of the error.</p>';

    //     Mail::to($email_send_to)->cc($CC_email)->send(new Websitemail($subject,$message));
    //     return 'Email sent successfully!';

    // }

}
