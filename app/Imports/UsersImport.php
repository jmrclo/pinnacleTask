<?php

namespace App\Imports;

use App\Models\User;

use App\Helpers\Helper;
use App\Models\students;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersImport implements 
ToModel,
 WithHeadingRow,
 WithValidation,
  SkipsOnError, 
  SkipsOnFailure
{
    use Importable, SkipsErrors, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    
    public function model(array $row)
    {
    
        
     $userDataa = students::where('firstname',$row["firstname"])->where('lastname',$row["lastname"])->where('birthday',$row["birthday"])->exists();

    

     if($userDataa){ 
         Alert::error('error', 'Student  duplicate!');
         throw ValidationException::withMessages(['error']);
             }else{

         $user= Auth::user();
        
        $currentYear = date('Y');
           
        $helperParams = array(
         'className' => new students,
         'column' => 'studentID',
         'prefix' => $currentYear.'A',
         'length' => 5
        );
        
        $studentID = Helper::IDGenerator($helperParams);
       
        $userData = [

            'studentID' =>   $studentID,
            'firstname'    => $row['firstname'],
            'lastname'    => $row['lastname'],
            'gender'    => $row['gender'],
            'birthday'    => $row['birthday'],
            'age'    => $row['age'],
            'birthplace'    => $row['birthplace'],
            'phone'    => $row['phone'],
            'email'    => $row['email'],
            'password' => Hash::make($row['lastname']),
            
            
            // other user attributes
        ];
        
        $users = User::create($userData);






        return new students([ 

            // 'name'=> $row[1],
            // 'email'=> $row[2],
            // 'password'=> '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
           
            'studentID' =>   $studentID,
            'firstname'    => $row['firstname'],
            'lastname'    => $row['lastname'],
            'gender'    => $row['gender'],
            'birthday'    => $row['birthday'],
            'age'    => $row['age'],
            'birthplace'    => $row['birthplace'],
            'phone'    => $row['phone'],
            'email'    => $row['email'],
            'address'    => $row['address'],
            'user_id' => $user->id,
            
         ]);
       
    }
}

    

    public function rules(): array
    {
         return[
        
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'birthday' => 'required',
            'age'    => 'required',
            'birthplace' => 'required',
            'phone' => 'required',
            'email' => ['required', 'email', Rule::unique('students', 'email')],
            'address' => 'required'
         ];
      
         
    }
    



    

}
   

