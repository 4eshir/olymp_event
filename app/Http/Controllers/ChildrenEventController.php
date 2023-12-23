<?php

namespace App\Http\Controllers;

use App\Models\common\ChildrenEvent;
use App\Models\common\Subject;
use App\Models\work\ClassChildrenEventWork;
use App\Models\work\SubjectWork;
use Illuminate\Http\Request;
use App\Models\work\ChildrenEventWork;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;

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
            'id' => $childrenEvent->id,
            'name_subject' => $subject->name,
            'subject_id' => $subject->id,
            'tour' => $event->tour,
            'class_id' => $class->id,
            'class' => $class->name,
            'class_number' => $class->number,
            'date_olympiad' => $childrenEvent->date_olympiad,
            'address' => $childrenEvent->address
        ];

        response()->json($result, 200, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
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
            'base_uri' => 'https://olymp.event.schooltech.ru/public/api/children_event/childrenEvent/index/',
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

        $response = $client->request('GET', '1');

        $data = json_decode($response->getBody(), true, 512, JSON_UNESCAPED_UNICODE);
        return $data["name_subject"];
    }

    public function test2()
    {
        $excelExport = [
            ['', '', 'A1', 'A2', 'A3'], // Заголовки столбцов
            ['', '', 'B4', 'B5', 'B6'], // Строка 2
            ['Данные', 'Данные', 'Данные', 'Данные', 'Данные'], // Строка 3
            ['', '', 'C4', 'C5', 'C6'], // Строка 4
            ['', '', 'D4', 'D5', 'D6'], // Строка 5
            ['', '', 'E4', 'E5', 'E6'], // Строка 6
        ];

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray($excelExport, null, 'A1');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('test.xlsx');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="test.xlsx"');
        header('Cache-Control: max-age=3600');
        header('Cache-Control: max-age=3600');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Expires: ' . gmdate('r', time() + 3600));
        readfile('test.xlsx');

        // Удалить файл после скачивания
        if (file_exists('test.xlsx')) {
            unlink('test.xlsx');
        }

        exit;
    }
}
