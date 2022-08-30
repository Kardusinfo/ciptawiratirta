<?php
namespace App\Models;

use Illuminate\Support\Facades\App;

class User extends \App\User
{
    protected $dateFormat = 'Y-m-d H:i:sO';
}