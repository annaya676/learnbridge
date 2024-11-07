<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Lob;
use App\Models\Coursemap;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Hash;
// use Maatwebsite\Excel\Facades\Excel;
// use App\Imports\UsersImport;
// use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use App\Mail\Websitemail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
   
    public function datatables(Request $request)
    {
        //  $datas = User::orderBy('id', 'desc')->get();
         //--- Integrating This Collection Into Datatables
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

         return Datatables::of($datas)
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
                            ->addColumn('action', function(User $data) {
                                $alertmsg="return confirm('Are you sure you want to revoke user?')";

                                if(Auth::guard("admin")->user()->role_id==3){

                                    return '<a   onclick="'.$alertmsg.'" href="'.route('user.revoke',$data->id).'" class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">Revoke</a>
                                    <a href="'.route('user.edit',$data->id).'" class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">Edit</a>';

                                }else{

                                    return '<a href="'.route('user.edit',$data->id).'" class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">Edit</a>
                                    <a href="'.route('user.changepassword',$data->id).'" class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">Change Password</a>';

                                }
                            
                            }) 
                            ->rawColumns(['status','action'])         
                            ->toJson(); //--- Returning Json Data To Client Side
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.user.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lobs = Lob::all();
        return view('admin.user.create',compact('lobs'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            "email" => ["required","email",'unique:users'],
            // 'phone' => ['required','min:10','max:12','numeric','unique:users'],
            'phone' => 'required|string|min:10|max:12|unique:users',

            'lob_id' => 'required',         
            'designation'=> 'required',
            'level'=> 'required',
            'doj'=> 'required',
            'gender'=> 'required',
            'sub_lob'=> 'required',
            'college_name'=> 'required',
            'location'=> 'required',
            'specialization'=> 'required',
            'college_location'=> 'required',	
            'offer_release_spoc'=> 'required',
            'trf'=> 'required',
            'qualification'=> 'required',
            'college_tier'=> 'required',
            ],
            [
            'lob_id.required' => 'Please select your LOB.',
            ]
        );
        
        $pass=rand(10000,99999);
        $token=hash('sha256',time());

        $user = new User();
        $input = $request->all();
        $input['password']=Hash::make($pass);
        $input['token']=$token;
        $input['offer_revoke']='';
        
        $input['status'] = 1;
        $user->fill($input)->save();

        // $this->userActivatedEmail($user->id,$pass);

        return redirect()->route('user')->with('success','user create successfully'); 

     
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $lobs = Lob::all();
            $user = User::findOrFail($id);
            return view('admin.user.edit', compact('user','lobs'));  
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('user')->with('error', 'user not found');
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
                'name' => 'required',
                'email' => 'required|string|email|max:255|unique:users,email,' . $id,
                'phone' => 'required|string|min:10|max:12|unique:users,phone,' . $id,
                'lob_id' => 'required',
                'designation'=> 'required',
                'level'=> 'required',
                'doj'=> 'required',
                'gender'=> 'required',
                'sub_lob'=> 'required',
                'college_name'=> 'required',
                'location'=> 'required',
                'specialization'=> 'required',
                'college_location'=> 'required',	
                'offer_release_spoc'=> 'required',
                'trf'=> 'required',
                'qualification'=> 'required',
                'college_tier'=> 'required',
            ],
         [
            'lob_id.required' => 'Please select your LOB.',
            ]
        );

        $user = User::find($id);
        $input = $request->all();
        $user->update($input);

        return redirect()->back()->with('success','update successfully');
    }

    public function updateStatus($id,$status){

            // Update the status
            $user = User::find($id);
            $user->status = $status;
            $user->update();

            // Return a success message
            return redirect()->back()->with('success','Status updated successfully!');    

    
    }

    public function revoke($id){

        // Update the revoke
        $user = User::find($id);
        $user->status = 2;
        $user->revokes = 1;
        $user->update();

        // Return a success message
        return redirect()->back()->with('success','Revoke updated successfully!');    


    }


    public function changepassword($id)
    {
        try {
            $user = User::findOrFail($id);
            return view('admin.user.changepassword', compact('user'));  
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('user')->with('error', 'user not found');
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

 
        $user = User::find($id);
        $user->password=Hash::make($request->input('password'));
        $user->update();
        // Return a success message
        return redirect()->back()->with('success','Password updated successfully!');    

    }

    public function bulkUpload()
    {
      
            return view('admin.user.bulkupload');
   
    }

    public function importUserCsv(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt|mimetypes:text/plain,text/csv,application/csv,application/excel,application/vnd.ms-excel',
        ]);

        $file = $request->file('file');

        $batchSize = 1000;
        $batch = [];

        $handle = fopen($file->getRealPath(), 'r');

        $i = 0;

        $batch = [];
        $count=0;
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        
            if ($i < $batchSize && $i > 0) {

                $checkemail = User::where('email', $data[2])->first();
                $checkphone = User::where('phone', $data[3])->first();
                $lob = Lob::where('name', $data[3])->first();
  
                if (!$checkemail && !$checkphone && $lob) {
                    $pass=1234;
                    $token=hash('sha256',time());
                    $DateofJoining = Carbon::create( $data[6])->format('Y-m-d');	            

                    $batch[] = [
                            'name' => $data[0], 
                            'email'=> $data[1], 
                            'phone' => $data[2], 
                            'lob_id' => $lob->id, 
                            'designation' => $data[4], 
                            'level' => $data[5], 
                            'doj' => $DateofJoining, 
                            'gender' => $data[7], 
                            'sub_lob' => $data[8], 
                            'college_name' => $data[9], 
                            'location' => $data[10], 
                            'specialization' => $data[11], 
                            'college_location' => $data[12], 
                            'offer_release_spoc'=> $data[13], 
                            'trf' => $data[14], 
                            'joiner_status'=>$data[15],
                            'qualification'=>$data[16],
                            'college_tier'=>$data[17],
                            'password'=>Hash::make($pass),
                            'token'=>$token,
                            'status' => 1
                    ];
                    User::insert($batch);
                    $batch = [];
                    $count++;
                }
            }
            $i++;
        }

    
     return redirect()->back()->with('success',$count.'Users upload successfully');
    }

    public function userActivatedEmail($user_id,$password){
        // Event: User Activated on LearnBridge , user create send this mail

        $user = User::find($user_id);
        $email_send_to=$user->email ;
        $CC_email='joshisummi@gmail.com';
        $subject  ='Welcome to University! Access credentials for LearnBridge.';
        $link =route('login');

        $message  ='<h2>Hi '.$user->name.'</h2>';
        $message  .='<p>Thank you for choosing to be a part of University! We are happy to share that your access to the University pre-joining Learning Portal – LearnBridge is active.</p><br/>';
        $message  .='<p>To access the portal, please use the following credentials:</p>';
        $message  .='<p><b>Link:</b> <a href='.$link.'> Click Here </a></p>';
        $message  .='<p><b>Username:</b> '.$user->email.'</p>';
        $message  .='<p><b>Password:</b> '.$password.'</p>';
        $message  .='<p>Please keep a check on your email for the list of courses mapped to you and the navigation guide.</p><br/>';
        $message  .='<p><b>Important:</b> The password is auto generated and cannot be changed. In case you are unable to log-in, write to <Mailbox Name> along with a screenshot of the error.</p>';

        Mail::to($email_send_to)->cc($CC_email)->send(new Websitemail($subject,$message));
        return true;

    }

    public function exportUser(Request $request)
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
        // $csvContent = "User Id,Name,Gender,Designation,Level,LoB,Sub-Lob,College Name,Location,Qualification,Specialization,College Location,Contact Number,Email Id,College Tier,Offer Release Spoc,User Status,DOJ,TRF,Joiner Status\n"; // CSV header
      
        $csvContent = "User Id,Name,Email Id,Contact Number,Gender,Level,Designation,LoB,Sub-Lob,Joining Location,Date of Joining,College Name,Qualification,Specialization,College Location,College Tier,Offer Release Spoc,Joining Status,TRF,Status\n";

        foreach ($datas as $data) {
            $lobname=  ($data->lob)?$data->lob->name:'';
            
            if($data->status == 1){
            $status= 'Active';
            }else{
            $status= 'Inactive' ;
            }
            
            $DateofJoining = Carbon::create($data->doj)->format('d M Y');	            
            $csvContent .= "{$data->id},{$data->name},{$data->email},{$data->phone},{$data->gender},{$data->level},{$data->designation},{$lobname},{$data->sub_lob},{$data->location},{$DateofJoining},{$data->college_name},{$data->qualification},{$data->specialization},{$data->college_location},{$data->college_tier},{$data->offer_release_spoc},{$data->joiner_status},{$data->trf},{$status}\n"; // Custom CSV row

            // $csvContent .= "{$data->id},{$data->name},{$data->gender},{$data->designation},{$data->level},{$lobname},{$data->sub_lob},{$data->college_name},{$data->location},{$data->qualification},{$data->specialization},{$data->college_location},{$data->phone},{$data->email},{$data->college_tier},{$data->offer_release_spoc},{$status},{$DateofJoining},{$data->trf},{$data->joiner_status}\n"; // Custom CSV row
        }


        // Define the response headers
        return Response::make($csvContent, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="user-details.csv"',
        ]);
    }
    


}
