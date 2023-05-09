<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Laravel\Sanctum\HasApiTokens;

class Usager extends Authenticatable
{
    protected $table = 'usagers';
    use HasFactory;

    protected $fillable = ['id','email', 'password'];
    protected $hidden = ['password', 'remember_token'];

    public function isAdminOrSuperAdmin()
    {
        return $this->isAdmin() || $this->isSuperAdmin();
    }
    
    public function isAdmin()
    {
        return $this->role === 'Admin';
    }
    
    public function isSuperAdmin()
    {
        return $this->role === 'SuperAdmin';
    }
    

}
