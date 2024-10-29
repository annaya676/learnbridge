<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Lob;
use App\Models\Course;
use App\Models\QuizQuestion;
use App\Models\Category;
use App\Models\Module;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Hash;

use Yajra\DataTables\DataTables;

class CourseController extends Controller
{
   
    public function datatables()
    {
         $datas = Course::orderBy('id', 'desc')->get();
         //--- Integrating This Collection Into Datatables

         return Datatables::of($datas)
         
                ->addColumn('category_id', function(Course $data) {
                    return ($data->category)?$data->category->name:'';
                })     
                ->addColumn('image', function(Course $data) {
                    return '<img style="height:50px;" src="'.asset('public/uploads/thumb/'.$data->image).'">';
                }) 
                ->addColumn('status', function(Course $data) {
                    // $role = $data->role_id == 0 ? 'No Role' : $data->role->name;
                    $alertmsg="return confirm('Are you sure you want to update the status?')";

                    return ($data->status == 1)?

                    ' <a href="'.route('course.status.update',['id1' => $data->id, 'id2' => 0]).'" 
                    class="text-13 py-2 px-8 bg-success-50 text-success-600 d-inline-flex align-items-center gap-8 rounded-pill"
                        onclick="'.$alertmsg.'">
                    <span class="w-6 h-6 bg-success-600 rounded-circle flex-shrink-0"></span>
                    Publish
                    </a>'
                    :
                    '<a href="'.route('course.status.update',['id1' => $data->id, 'id2' => 1]).'"  
                    class="text-13 py-2 px-8 bg-warning-50 text-warning-600 d-inline-flex align-items-center gap-8 rounded-pill"
                        onclick="'.$alertmsg.'">
                    <span class="w-6 h-6 bg-warning-600 rounded-circle flex-shrink-0"></span>
                    Unpublish
                    </a>'
                    ;
                }) 
                ->addColumn('action', function(Course $data) {
                    return '<a href="'.route('course.edit',$data->id).'" class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">Edit</a>';
                }) 
                ->rawColumns(['category_id','image','status','action'])         
                ->toJson(); //--- Returning Json Data To Client Side
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.course.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lobs = Lob::all();
        $smes = Admin::where('role_id',2)->orderBy('name', 'asc')->get();
        $category = Category::orderBy('id', 'desc')->get();

        return view('admin.course.create',compact('lobs','smes','category'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ini_set('memory_limit', '2048M');
         $request->validate([
            'course_name' => 'required',
            'description' => 'required',
            'author' => 'required',
            'category_id' => 'required',
            'sme_id' => 'required|array',
            'lob_id' => 'required|array',
            'image' => 'required|file|mimes:png,gpeg,jpg|max:2048',
            // 'assignment' => 'file|mimes:pdf,docx,doc|max:2048',
            'assignment' => 'file|mimes:zip,pdf,docx,doc,xlsx|max:20480',
            ],
        [
            'lob_id.required' => 'Please select your LOB.',
            'sme_id.required' => 'Please select your SME.',
        ]);

        // Upload the file
        $file = $request->file('image');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/thumb'), $fileName);

        $assignmentfile = $request->file('assignment');
        if($assignmentfile){
            $assignmentName = time() . '.' . $assignmentfile->getClientOriginalExtension();
            $assignmentfile->move(public_path('uploads/assignment'), $assignmentName);
        }else{
            $assignmentName ='';
        }
        
        $course = new Course();

        $course->category_id = $request->category_id;
        $course->author = $request->author;
        $course->uploader = Auth::guard("admin")->user()->id;
        $course->course_name = $request->course_name;
        $course->description = $request->description;
        $course->sme_id = implode(",",$request->sme_id);
        $course->lob_id = implode(",",$request->lob_id);
        $course->course_id = rand(1000,9999);
        $course->image =$fileName;
        $course->assignment =$assignmentName;
        $course->status =0;
        $course->save();

        return redirect()->route('course.edit', $course->id)->with('success','course create successfully');
        // return redirect()->back()->with('success','course create successfully');    

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $course = Course::findOrFail($id);
            $lobs = Lob::all();
            $smes = Admin::where('role_id',2)->orderBy('name', 'asc')->get();    
            $category = Category::orderBy('id', 'desc')->get();           

            $selected_sme_id = explode(",",$course->sme_id);
            $selected_lob_id = explode(",",$course->lob_id);

            return view('admin.course.edit', compact('category','selected_sme_id','selected_lob_id','smes','lobs','course'));  
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('course')->with('error', 'course not found');
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
        ini_set('memory_limit', '2048M');
         $request->validate([
            'course_name' => 'required',
            'description' => 'required',
            'author' => 'required',
            'category_id' => 'required',
            'sme_id' => 'required|array',
            'lob_id' => 'required|array',
            'image' => 'file|mimes:png,gpeg,jpg|max:2048',
            'assignment' => 'file|mimes:zip,pdf,docx,doc,xlsx|max:20480',
            ],
        [
            'lob_id.required' => 'Please select your LOB.',
            'sme_id.required' => 'Please select your SME.',
        ]);

        $course = Course::find($id);

         // Upload the file
        if($request->hasFile('image')){
            $imagePath = public_path('uploads/thumb/' . $course->image);
            if (file_exists($imagePath)) {
                // Remove the old image
                unlink($imagePath);
            }
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/thumb'), $fileName);
            $course->image =$fileName;
        }
         
        if($request->hasFile('assignment')){
            if($course->assignment){
            $assignmentPath = public_path('uploads/assignment/' . $course->assignment);
            if (file_exists($assignmentPath)) {
                // Remove the old image
                unlink($assignmentPath);
            }}
             $assignmentfile = $request->file('assignment');
             $assignmentName = time() . '.' . $assignmentfile->getClientOriginalExtension();
             $assignmentfile->move(public_path('uploads/assignment'), $assignmentName);
             $course->assignment =$assignmentName;
        }

        $course->category_id = $request->category_id;
        $course->author = $request->author;
        $course->uploader = Auth::guard("admin")->user()->id;
        $course->course_name = $request->course_name;
        $course->description = $request->description;
        $course->sme_id = implode(",",$request->sme_id);
        $course->lob_id = implode(",",$request->lob_id);
        $course->update();

        return redirect()->back()->with('success','course update successfully');
    }

    public function updateStatus($id,$status){

            // Update the status
            $admin = Course::find($id);
            $admin->status = $status;
            $admin->update();

            // Return a success message
            return redirect()->back()->with('success','Status updated successfully!');    

    
    }

  
    /**
     * Quiz function.
     */

    public function quiz_datatables($course_id)
    {
         //--- Integrating This Collection Into Datatables
         $datas = QuizQuestion::where('course_id',$course_id)->orderBy('id', 'asc')->get();

         return Datatables::of($datas)
               
                ->addColumn('action', function(QuizQuestion $data) {
                    // return '<a href="'.route('course.edit',$data->id).'" class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">Edit</a>';
                    return '<button  onclick="editQuiz(' . $data->id . ')" class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">Edit</button>';
   
                }) 
                ->rawColumns(['action'])         
                ->toJson(); //--- Returning Json Data To Client Side
    }

    public function quiz($id)
    {
        try {
            $course = Course::findOrFail($id);
            return view('admin.course.create_quiz', compact('course'));  
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('course')->with('error', 'course not found');
        } catch (\Illuminate\Database\QueryException $e) {
            abort(500);
        } catch (\Exception $e) {
            abort(500);
        }

   
    }

    public function importQuizCsv(Request $request, $course_id)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv',
        ]);

        $file = $request->file('file');

        $batchSize = 1000;
        $batch = [];

        $handle = fopen($file->getRealPath(), 'r');

        $i = 0;

        $batch = [];
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        
            if ($i < $batchSize && $i > 0) {
                $batch[] = [
                    'course_id' => $course_id,
                    'question' => $data[0],
                    'option_a' => $data[1],
                    'option_b' => $data[2],
                    'option_c' => $data[3],
                    'option_d' => $data[4],
                    'correct_answer' => $data[5],
                ];

                QuizQuestion::insert($batch);
                $batch = [];
            }
            $i++;
        }
      
    $course=Course::find($course_id);
    $course->isquiz=1;
    $course->update();
     return redirect()->back()->with('success','quiz update successfully');
    }

    public function editQuiz(Request $request)
    {
        $quiz = QuizQuestion::find($request->id);

        return response()->json($quiz);
    }

    public function quizupdate(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'option_a' => 'required',
            'option_b' => 'required',
            'option_c' => 'required',
            'option_d' => 'required',
            'correct_answer' => 'required',
        ]);

        $input = $request->all();

        $quiz = QuizQuestion::find($input['quiz_id']);

        $quiz->question = $input['question'];
        $quiz->option_a = $input['option_a'];
        $quiz->option_b = $input['option_b'];
        $quiz->option_c = $input['option_c'];
        $quiz->option_d = $input['option_d'];
        $quiz->correct_answer = $input['correct_answer'];
        $quiz->update();

        // return response()->json(['message' => $input['quiz_id']]);
        return response()->json(['status'=>'success','message' => 'Quiz updated successfully']);
    }


    /**
     * Course Module 
     */


    public function module_datatables($course_id)
    {
         //--- Integrating This Collection Into Datatables
         $datas = Module::where('course_id',$course_id)->orderBy('id', 'asc')->get();

         return Datatables::of($datas)
               
                ->addColumn('action', function(Module $data) {
                    return '<a href="'.route('course.editmodule',['id1' => $data->id, 'id2' => $data->course_id]).'" class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">Edit</a>';
   
                }) 
                ->rawColumns(['action'])         
                ->toJson(); //--- Returning Json Data To Client Side
    }

    public function module($id)
    {
        try {
            $course = Course::findOrFail($id);
            return view('admin.course.list_module', compact('course'));  
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('course')->with('error', 'course not found');
        } catch (\Illuminate\Database\QueryException $e) {
            abort(500);
        } catch (\Exception $e) {
            abort(500);
        }

   
    }
    public function create_module($id)
    {
        try {
            $course = Course::findOrFail($id);
            return view('admin.course.create_module', compact('course'));  
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('course')->with('error', 'course not found');
        } catch (\Illuminate\Database\QueryException $e) {
            abort(500);
        } catch (\Exception $e) {
            abort(500);
        }

   
    }

    public function modulestore(Request $request, $course_id)
    {
        ini_set('memory_limit', '2048M');
        ini_set('upload_max_filesize', '600M');
        ini_set('post_max_size', '600M');

        $request->validate([
            'module_name' => 'required',
            'duration' => 'required',
            'description' => 'required',
            'video' => 'required_without:pdf|mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4|max:512000', // 500MB max file size
            'pdf' => 'required_without:video|file|mimes:pdf',
            // 'pdf' => 'required_without:video|file|mimes:pdf,ppt,pptx',
        ]);

        $videofilename ='';
        if($request->hasFile('video')){
            $video = $request->file('video');
            $videofilename = time() . '.' . $video->getClientOriginalExtension();
            $video->move(public_path('uploads/videos'), $videofilename);
        }
        $pdffilename ='';
        if($request->hasFile('pdf')){
            $pdf = $request->file('pdf');
            $pdffilename = time() . '.' . $pdf->getClientOriginalExtension();
            $pdf->move(public_path('uploads/docs'), $pdffilename);
        }


        $module = new Module();
        $module->course_id = $course_id;
        $module->module_name = $request->module_name;
        $module->description = $request->description;
        $module->duration = $request->duration;
        $module->video = $videofilename;
        $module->document = $pdffilename;
        $module->save();


    
        return redirect()->back()->with('success','module update successfully');
    }

    public function editmodule($module_id, $course_id)
    {
        try {
            $course = Course::findOrFail($course_id);
            $module = Module::findOrFail($module_id);
            
            return view('admin.course.edit_module', compact('course','module'));  
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('course')->with('error', 'course not found');
        } catch (\Illuminate\Database\QueryException $e) {
            abort(500);
        } catch (\Exception $e) {
            abort(500);
        }

    }

    public function moduleupdate(Request $request, $module_id)
    {
        ini_set('memory_limit', '2048M');
        ini_set('upload_max_filesize', '600M');
        ini_set('post_max_size', '600M');

        $request->validate([
            'module_name' => 'required',
            'duration' => 'required',
            'description' => 'required',
            'video' => 'mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4|max:512000', // 500MB max file size
            'pdf' => 'file|mimes:pdf',
        ]);


        $module = Module::find($module_id);

        // Upload the file          
        if($request->hasFile('video')){
            if($module->video){
            $videoPath = public_path('uploads/videos/' . $module->video);
            if (file_exists($videoPath)) {
                // Remove the old image
                unlink($videoPath);
            } }
            $video = $request->file('video');
            $videofilename = time() . '.' . $video->getClientOriginalExtension();
            $video->move(public_path('uploads/videos'), $videofilename);
            $module->video =$videofilename;

        }

        if($request->hasFile('pdf')){
            if($module->document){
            $pdfPath = public_path('uploads/docs/' . $module->document);
            if (file_exists($pdfPath)) {
                // Remove the old image
                unlink($pdfPath);
            } }
            $pdf = $request->file('pdf');
            $pdffilename = time() . '.' . $pdf->getClientOriginalExtension();
            $pdf->move(public_path('uploads/docs'), $pdffilename);
            $module->document = $pdffilename;
        }



        $module->module_name = $request->module_name;
        $module->description = $request->description;
        $module->duration = $request->duration;
        $module->update();
        return redirect()->back()->with('success','module update successfully');
    }
 

     
}
