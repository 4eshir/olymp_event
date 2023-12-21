<?php

namespace App\Http\Controllers;

use App\Models\common\ChildrenEvent;
use App\Models\common\Subject;
use App\Models\work\SubjectWork;
use Illuminate\Http\Request;
use App\Models\work\ChildrenEventWork;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class ChildrenEventController extends Controller
{
    /*public function __invoke(Request $request)
    {
        return "Welcome to Vsoch";
    }*/

    public function show($id)
    {
        $childrenEvent = DB::table('children_event')->find($id);
        $event = DB::table('event')->find($childrenEvent->event_id);
        $subject = DB::table('subject')->find($event->subject_id);
        $class = DB::table('class')->find($childrenEvent->class_id);

        $result = [
            'name_subject' => $subject->name,
            'tour' => $event->tour,
            'class' => $class->name,
            'date_olympiad' => $childrenEvent->date_olympiad,
            'address' => $childrenEvent->address
        ];

        return $result;
            /*response()->json($result, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);*/
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

    public function showEventsforSubject($subject_id)
    {
        $subjectWork = DB::table('subject')->where('id', $subject_id)->first();
        if (is_null($subjectWork))
            return abort(404);

        $events = DB::table('children_event')->join('event','children_event.event_id', '=', 'event.id')->where('event.subject_id', '=', $subjectWork->id)->pluck('children_event.id');

        $result = [];
        foreach ($events as $event)
            $result[] = $this->show($event);

        return response()->json($result, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
    }

    public function showEventsforClass($class_id)
    {
        $classWork = DB::table('class')->where('id', $class_id)->first();
        if (is_null($classWork))
            return abort(404);

        $events = DB::table('children_event')->where('class_id', '>=', $classWork->id)->pluck('id');

        $result = [];
        foreach ($events as $event)
            $result[] = $this->show($event);

        return response()->json($result, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
    }

    public function showEventsforSubjectAndClass($subject_id, $class_id)
    {
        $subjectWork = DB::table('subject')->where('id', $subject_id)->first();
        if (is_null($subjectWork))
            return abort(404);

        $events = DB::table('children_event')->join('event','children_event.event_id', '=', 'event.id')->where('event.subject_id', '=', $subjectWork->id)->where('class_id', '=', $class_id)->pluck('children_event.id');

        $result = [];
        foreach ($events as $event)
            $result[] = $this->show($event);

        return response()->json($result, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
    }

    public function test()
    {
        /*$event = new ChildrenEvent();
        $response = $event->request('GET', 'https://olymp.event.schooltech.ru/public/show');
        $result = json_encode($response->getBody(), true);
        return $result;*/

        $client = new Client([
            'base_uri' => 'https://olymp.event.schooltech.ru/public/api/children_event/childrenEvent/',
            'headers' => [
                'Authorization' => 'Bearer ' . 'Token',
                'Content-Type' => 'application/json',
            ],
            'stream' => stream_context_create([
                'http' => [
                    'header' => 'Charset=utf-8',
                ],
            ]),
        ]);

        $response = $client->request('GET', 'all');

        $data = json_decode($response->getBody(), true, 512, JSON_UNESCAPED_UNICODE);
        return $data;
    }
}
