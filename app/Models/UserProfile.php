<?php

namespace App\Models;
use App\Models\User;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company',
        'job',
        'country',
        'address',
        'phone',
        'Facebook',
        'Twitter',
        'LinkedIn',
        'Instagram',
        'image'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
