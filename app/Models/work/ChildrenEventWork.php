<?php

namespace App\Models\work;

use App\Models\common\ChildrenEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChildrenEventWork extends ChildrenEvent
{
    use HasFactory;

    protected $table = 'children_event';

    protected $fillable = [
        'event_id',
        'date_olympiad',
        'address',
        'class_id',
    ];


}
