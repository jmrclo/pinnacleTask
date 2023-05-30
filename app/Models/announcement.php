<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class announcement extends Model
{
    use HasFactory,SoftDeletes;
    protected $primaryKey = 'id';
    public $timestamps = true;
   
    protected $fillable = [ 'title','content', 'start_date', 'end_date','deleted_at'];

    public function scopeFilter($query, array $filters){
        
        if($filters['search'] ?? false){
            $query->where('title' , 'like', '%' .request('search') .'%')
                ->orWhere('content' , 'like', '%' .request('search') .'%')
                ->orWhere('start_date' , 'like', '%' .request('search') .'%')
                ->orWhere('end_date' , 'like', '%' .request('search') .'%');

        }
    }

            //relationship to user model/admin 
            public function user() {
                return $this->belongsTo(User::class, 'user_id');
            }
 

}
