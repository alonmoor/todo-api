<?php

namespace App;
use App\Models\Product;
use App\Models\TaskUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'done'];
//    protected $table = 'tasks';
//    protected $primaryKey = 'id';
//    protected $timestamps = true ;


    public function users(){

        return $this->belongsToMany(User::class);
//            ->using(TaskUser::class)
//            ->withTimestamps('status');

    }


}

