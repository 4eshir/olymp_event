<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\work\SubjectWork;
use Illuminate\Support\Facades\DB;

class SubjectController
{
    public function show($id)
    {
        $subject = SubjectWork::findOrFail($id);
        return $subject->name;
    }

    public function showAll()
    {
        $subjects = DB::table('subject')->get();
        return response()->json($subjects, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
    }
}
