<?php

namespace App\Models\work;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClassChildrenEventWork extends ChildrenEventWork
{
    use HasFactory;

    protected $table = 'class';
    protected $fillable = [
        'name',
    ];
}
