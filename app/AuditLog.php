<?php
namespace App;

use Illuminate\Support\Facades\App;

class AuditLog extends \App\Models\AuditLog
{
    protected $dateFormat = 'Y-m-d H:i:sO';
}