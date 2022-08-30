<?php
namespace App;

use Illuminate\Support\Facades\App;

class Job extends \App\Models\Job
{
    protected $dateFormat = 'Y-m-d H:i:sO';
}