<?php

namespace App\Models\work;

use App\Models\common\Subject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectWork extends Subject
{
    use HasFactory;

    protected $table = 'subject';
    protected $fillable = [
        'name',
    ];
}
