<?php

namespace App\Http\Controllers;

use App\Models\common\Subject;
use App\Models\work\SubjectWork;
use Illuminate\Http\Request;
use App\Models\work\ChildrenEventWork;
use Illuminate\Support\Facades\DB;

class ChildrenEventController extends Controller
{
    public function __invoke(Request $request)
    {
        return "Welcome to Vsoch";
    }

    public function show($id)
    {
        $childrenEvent = DB::table('children_event')->find($id);
        $event = DB::table('event')->find($childrenEvent->event_id);
        $subject = DB::table('subject')->find($event->subject_id);
        $class = DB::table('class')->find($childrenEvent->class_id);

        $result = [
            'name_subject' => $subject->name,
            'tour' =>  $event->tour,
            'class' => $class->name,
            'date_olympiad' => $childrenEvent->date_olympiad,
            'address' => $childrenEvent->address
        ];

        return response()->json($result, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
    }

    public function integrityСheck()
    {
        $events = DB::table('children_event')->pluck('id');

        return response()->json($events, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
    }

    public function showAllEvents()
    {
        $events = DB::table('children_event')->pluck('id');

        $result = [];
        foreach ($events as $event)
            $result[] = $this->show($event);

        return response()->json($result, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
        JSON_UNESCAPED_UNICODE);
    }

    public function showEventsforSubject($subject)
    {
        $subjectWork = DB::table('subject')->where('name', $subject)->first();
        if (is_null($subjectWork))
            return abort(404);

        $events = DB::table('children_event')->join('event','children_event.event_id', '=', 'event.id')->where('event.subject_id', '=', $subjectWork->id)->pluck('children_event.id');

        $result = [];
        foreach ($events as $event)
            $result[] = $this->show($event);

        return response()->json($result, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
    }

    public function showEventsforClass($class)
    {
        $classWork = DB::table('class')->where('number', $class)->first();
        if (is_null($classWork))
            return abort(404);

        $events = DB::table('children_event')->where('class_id', '>=', $classWork->id)->pluck('id');

        $result = [];
        foreach ($events as $event)
            $result[] = $this->show($event);

        return response()->json($result, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
    }
}
