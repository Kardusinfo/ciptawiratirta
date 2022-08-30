<?php
namespace App;

use Illuminate\Support\Facades\App;

class Department extends \App\Models\Department
{
    protected $dateFormat = 'Y-m-d H:i:sO';
}