<?php

namespace App\Models\work;

use App\Models\common\ImportantDates;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ImportantDatesWork extends ImportantDates
{
    use HasFactory;

    protected $table = 'important_dates';
    protected $fillable = [
        'children_event_id',
        'end_checked_work',
        'statement_points',
        'showing_works',
        'address_showing_works',
        'petition_appeal',
        'address_petition_appeal',
        'appeal',
        'address_appeal',
        'publication',
    ];
}
