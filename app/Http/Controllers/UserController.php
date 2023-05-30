<?php

namespace App\Http\Controllers;

use App\Models\students;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;



class UserController extends Controller
{
    //register
    public function create()
    {
        return view('users.register');
    }

    //create new user
    public function store(Request $request){

        
            $formFields = $request->validate([

                'studentID' => 'required',
                'firstname' => 'required',
                'lastname' => 'required',
                'gender' => 'required',
                'birthday' => 'before:yesterday',
                'age' => 'required',
                'birthplace' => 'required',
                'phone' => 'required',
                'email' => ['required', 'email', Rule::unique('users', 'Email')],

                'password' => 'required|confirmed|min:3'

            ]);

                
                //hash password
                $formFields['password'] = bcrypt($formFields['password']);
                
                //create user
                $user = User::create($formFields);

                //login
                // auth()->login($user);
                Alert::success('success', 'Sign up successfuly!');
                return redirect('/')->with('success', 'Sign up Ocakes');

    }

        //logout
        public function logout(Request $request)
        {
            Alert::success('success', 'you have logged out!');
            auth()->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/')->with('success', 'you have logged out');
        }
        //login
        public function login()
        {
            
            return view('users.login');
        }

        //auth user 
        public function authenticate(Request $request)
        {
            Alert::success('success', 'you are now logged in');
            
          
            $formFields = $request->validate([

                'studentID' => 'required',

                'password' => 'required'

            ]);
            
            
            
            if(auth()->attempt($formFields)){
                if( auth()->user()->role =='1'){
                
                    $request->session()->regenerate();
                    return redirect('/')->with('success', 'you are now logged in');
                }
                else if (auth()->user()->role =='0'){
                    
                    return redirect('/main')->with('success', 'you are now logged in');
                }
                else {
                    return redirect('/');
            }         
        }else{
            Alert::error('error', 'Invalid Credentials');
                 return back()->with('error',['studentID' => 'Invalid Credentials'])->onlyInput('studentID');
        }
      
}

public function show(students $students)
{
    students::all();
    return view('students.studProfile', [
        'students' => $students
    ]);
}

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
       Alert::success('Success', 'Student Updated successfuly!');
       return back()->with('Success', 'Student Updated successfuly!');
    
    }



}

