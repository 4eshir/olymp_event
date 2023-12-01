<?php

namespace App\Models\work;

use App\Models\common\Event;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventWork extends Event
{
    use HasFactory;

    protected $table = 'event';
    protected $fillable = [
        'subject_id',
        'tour',
        'status',
    ];
}
