<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'email',
        'address',
        'date_of_birth',
        'role_id'
    ];
    public function role()
    {

        return $this->belongsTo(Role::class);
    }
   
}
