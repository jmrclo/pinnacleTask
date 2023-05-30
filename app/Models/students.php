<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class students extends Model 
{
    use HasFactory;
    protected $primaryKey = 'id';
    
    
    public $timestamps = true;
   
    /*
        created_by = kung sinong nag-create / created_by

        user_id = ito id ng student doon sa users table
    */ 
    protected $fillable = [ 'user_id','studentID','firstname', 'lastname', 'gender','birthday','age', 'birthplace','phone','email','address'];


     //relationship to user model/admin 
     public function user() {
        return $this->hasOne(User::class);
    }

    public function studentsPage() {
        return $this->hasOne(User::class);
    }


}
