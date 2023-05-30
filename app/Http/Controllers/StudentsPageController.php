<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\students;
use App\Models\announcement;
use App\Models\studentsPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class StudentsPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(students $students)

    {
        students::all();
        return view('students.studentboard',['announcements' => announcement::latest()->filter(request(['search']))->get()
    ],['students' => $students]);
    }
   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(students $students, User $user)
            {

              
                $studentsID = $students->studentID;
    

                $userData = $user->where('studentID',$studentsID)->first();

            // dd($userData);
                return view('students.studProfile', [
                    'students' => $students
                ]);
            }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(students $students)

    {
        students::all();
    
       return view('students.studProfile', [
            'students' => $students
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, students $students)
    {
        if($students->id != auth()->id()){
            abort(403,'unauthorized action');
        }
        

        $formFields = $request->validate([

            'user_id' => Auth::user(),
           
            'gender' => 'required',
            'birthday' => 'before:yesterday',
            'age' => 'required',
            'birthplace' => 'required',
            'phone' => 'required',
            'email' => ['required', 'email'],
            'address' => 'required'
            
           ]);

           if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        
           $students->update($formFields);
           Alert::success('Success', 'Student updated successfuly!');

           return back()->with('Success', 'Student Updated successfuly!');
        
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(studentsPage $studentsPage)
    {
        //
    }
}
