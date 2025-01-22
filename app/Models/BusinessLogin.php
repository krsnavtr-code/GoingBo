<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessLogin extends Model
{
    use HasFactory;

    // Define the table if it's not the default 'business_login_profiles'
    protected $table = 'business_login_profiles';

    // Define which columns are mass assignable
    protected $fillable = [
        'company_name',
        'contact_no',
        'email',
        'city',
        'username',
        'password',
        'business_type',
    ];


}
