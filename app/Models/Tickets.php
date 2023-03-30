<?php

namespace App\Models;

use App\Traits\Enums;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    use HasFactory, Enums;

    protected $enumStatuses = [
        'Open', 'In Progress', 'Closed', 'On Hold', 'Cancelled',
    ];
    public static function code()
    {
        return substr(str_shuffle("QWERTYUIPASDFGHJKLZXCVBNM23456789"), 0, 8);
    }
}
