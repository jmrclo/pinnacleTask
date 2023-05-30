<?php

namespace App\Http\Controllers;

use Excel;
use Carbon\Carbon;
use App\Models\User;
use App\Helpers\Helper;
use App\Models\students;
use App\Charts\studentChart;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

use function PHPUnit\Framework\isEmpty;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(students $students)

    {
       
        return view('reports.students',['students' => auth()->user()->students()->get()
    ]);
    }

    public function index2()
    {   
        return view('index');
    }

    
    public function index3(Request $request)
    {   

        $lineColor = ['rgb(255, 99, 132)'];
        $bgcolor = ['rgb(54, 162, 235)','rgb(255, 99, 132)'];
        $students = students::orderBy('created_at')->pluck('id','created_at');
       
        $chart = new studentChart;
        $chart->labels($students->keys());
        $chart->dataset('Students', 'line', $students->values())->lineTension(0.1)->color($lineColor);
             
       
       $result = DB::select("SELECT
        SUM(CASE WHEN gender = 'Male' THEN 1 ELSE 0 END) as Male,
        SUM(CASE WHEN gender = 'Female' THEN 1 ELSE 0 END) as Female,
        COUNT(*) as genders FROM students");
            $data = "";
            foreach($result as $val){
         $data = [$val->Male, $val->Female];
         }   
             
         $chartData = $data;
       
        $chart2 = new studentChart;
        $chart2->labels(['male','female']);
        $chart2->dataset('genders', 'pie', $chartData)->backgroundColor($bgcolor);

        return view('dashboard', compact('chart','chart2'));
    }


    
    public function pdf(students $students)
    {
        $pdf = Pdf::loadView('pdf/studreports',['students'=>students::all()])->setPaper('a2', 'landscape');
        
        return $pdf->download('Reports.pdf');
       
    }


    public function export(students $students) 
    {
        
        $user= Auth::user();
        $user_id = $user->id;
        return $user_id = Excel::download(new UsersExport, 'Reports.xlsx');
    }

    public function import(Request $request) 
    {
       
        $request->validate(['students' =>['required']]);
        
        
        $file = $request->file('students')->store('import');
        $import = new UsersImport;
        $import->import($file);
        $failures = $import->failures();
        // dd($file);
        if ($failures->isNotEmpty()) {
            # code...
            return back()->withFailures($import->failures());
            
        }
         Alert::success('Success', 'Student imported successfuly!');
        return back()->withStatus('Success');
   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user)
    {


     $userData = students::where('firstname',$request["firstname"])->where('lastname',$request["lastname"])->where('birthday',$request["birthday"])->exists();

    

        if($userData){ 
            Alert::error('error', 'Student  duplicate!');
            return back()->withStatus('error','Student  duplicate!');
        }else{


        // $userData = $user->where('firstname')->first();
    //    dd($userData);

           $formFields = $request->validate([
            
           
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'birthday' => 'required',
            'age' => 'required',
            'birthplace' => 'required',
             'phone' => 'required',
            'email' => ['required', 'email', Rule::unique('students', 'Email'),'indisposable'],
            'address' => 'required'
            
           ]);  

           $user= Auth::user();
           $formFields['user_id'] = auth()->id();
           $currentYear = date('Y');
           
           $helperParams = array(
            'className' => new students,
            'column' => 'studentID',
            'prefix' => $currentYear.'A',
            'length' => 5
           );
           
           $studentID = Helper::IDGenerator($helperParams); /** Generate id */
        //    dd(Auth::user());
           $studentData = [
          
            'user_id' =>$user->id, 
        'studentID'=> $studentID,
        'firstname' => $request->firstname,
        'lastname' => $request->lastname,
        'gender' => $request->gender,
        'birthday'=> $request->birthday,
        'age'=> $request->age,
        'birthplace'=> $request->birthplace,
         'phone' => $request->phone,
        'email' => $request->email,
        'address' => $request->address,
        ];

      
          $student = students::create($studentData) ; 

          $userData = [

            'studentID' => $studentData['studentID'],
            'firstname' => $studentData['firstname'],
            'lastname' => $studentData['lastname'],
            'gender' => $studentData['gender'],
            'birthday' => $studentData['birthday'],
            'age' => $studentData['age'],
            'birthplace' => $studentData['birthplace'],
            'phone' => $studentData['phone'],
            'email' => $studentData['email'],
            'password' => Hash::make($studentData['lastname']),
            // other user attributes
        ];
        
        $user = User::create($userData);

    
        
        // Associate the user with the student
        // $student->user()->save($user);

        Alert::success('Success', 'Student created successfuly!');
          return redirect('/reports')->with('Success', 'Student created successfuly!');
    
    }
    }
          
           

    /**
     * Display the specified resource.
     */
    public function show(students $students)
    {   
          students::all();
        return view('students.studProfile', [
            'students' => $students
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(students $students)

    {
       return view('reports.edit', [
            'students' => $students
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, students $students , user $user)
    {
     
        $userData = students::where('firstname',$request["firstname"])->where('lastname',$request["lastname"])->where('birthday',$request["birthday"])->exists();

    

        if($userData){ 
            Alert::error('error', 'Student  duplicate!');
            return back()->withStatus('error','Student  duplicate!');
        }else{


        $studentsID = $students->studentID;


        if($students->user_id != auth()->id()){
            abort(403,'unauthorized action');
        }
        

        $formFields = $request->validate([

            'user_id' => Auth::user(),
            'studentID' => $studentsID,
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'birthday' => 'required',
            'age' => 'required',
            'birthplace' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required'
            
           ]);

           $user= Auth::user();
           $formFields['user_id'] = auth()->id();
        
           $studentData = [
          
            'user_id' =>$user->id, 
        'studentID'=> $studentsID,
        'firstname' => $request->firstname,
        'lastname' => $request->lastname,
        'gender' => $request->gender,
        'birthday'=> $request->birthday,
        'age'=> $request->age,
        'birthplace'=> $request->birthplace,
         'phone' => $request->phone,
        'email' => $request->email,
        'address' => $request->address,
        ];
          $students->update($studentData) ; 

          
       
        Alert::success('Success', 'Student updated successfuly!');
           return redirect('/reports')->with('Success', 'Student updated successfuly!');
        
        }
    }    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(students $students, User $user)
    {

        Alert::success('success', 'Student deleted successfuly!');
        if($students->user_id != auth()->id()){
            abort(403,'unauthorized action');
        }
    
        $studentsID = $students->studentID;
    

        $userData = $user->where('studentID',$studentsID)->first();
    
        $students->delete();


        if($userData){
            $userData->delete();
        }
       
       return redirect('/reports')->with('Success', 'Student created successfuly!');
    }

   



}
