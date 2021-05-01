<?php

namespace App;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'done'];

    public function users(){

        return $this->belongsToMany(User::class);

    }


}

