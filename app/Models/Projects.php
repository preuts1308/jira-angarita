<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Projects extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'start_date','manager_id'];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
}
