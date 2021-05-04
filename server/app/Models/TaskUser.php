<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'task_id'
    ];
    protected $table = 'task_user';
}


// Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Relations\Pivot;
//class TaskUser extends Pivot
//{
//    use HasFactory;
//    protected $fillable = [
//        'user_id', 'task_id'
//    ];
//
//    protected $table = 'task_user';
//
//    public static function boot(){
//
//        parent::boot();
//
//        static::created(function ($item){
//            dd('created event',$item);
//        });
//
//        static::deleted(function ($item){
//            dd('delete event',$item);
//        });
//
//    }
//
//
//}
