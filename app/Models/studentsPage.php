<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class studentsPage extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    
    
    public $timestamps = true;
   
    protected $fillable = [ 'user_id','studentID','firstname', 'lastname', 'gender','birthday','age', 'birthplace','phone','email','address'];


     //relationship to user model/admin 
     public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

     public function students(){
        return $this->hasMany(students::class);
    }
}
