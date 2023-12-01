<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Создаем таблицы
        //----------------------------

        // Добавляем таблицы справочники: предметы, класс участи
        Schema::create('subject', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name')->charset('utf8mb4');
        });

        Schema::create('class', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name')->charset('utf8mb4');
        });

        // Добавляем основные таблицы: мероприятие, информация для детей об участии в олимпиаде,
        //          доп информация для участиников которые побывали на олимпиаде (про показ работ и апелляции)
        Schema::create('event', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->bigInteger('subject_id')->unsigned();
            $table->integer('tour');
            $table->integer('status')->comment('Статус тура: 0 - промежуточный, 1 - последний');

            $table->foreign('subject_id')->references('id')->on('subject');
        });

        Schema::create('children_event', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->bigInteger('event_id')->unsigned();
            $table->dateTime('date_olympiad')->comment('Дата проведения тура для участников');
            $table->string('address')->nullable();
            $table->bigInteger('class_id')->unsigned()->comment('Класс участия');

            $table->foreign('event_id')->references('id')->on('event');
            $table->foreign('class_id')->references('id')->on('class');
        });

        Schema::create('important_dates', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->bigInteger('children_event_id')->unsigned();
            $table->date('end_checked_work')->nullable()->comment('Дата окончания проверки работ участников');
            $table->date('statement_points')->nullable()->comment('Дата объявления баллов');
            $table->dateTime('showing_works')->nullable()->comment('Дата и время показа участникам проверенных работ');
            $table->string('address_showing_works')->nullable()->comment('Адрес показа проверенных работ');
            $table->dateTime('petition_appeal')->nullable()->comment('Дата и время приема заявлений участников на апелляцию');
            $table->string('address_petition_appeal')->nullable()->comment('Адрес приема заявлений участников на апелляцию');
            $table->dateTime('appeal')->nullable()->comment('Дата и время апелляции');
            $table->string('address_appeal')->nullable()->comment('Адрес апелляции');
            $table->date('publication')->nullable()->comment('Дата публикации итоговых результатов');

            $table->foreign('children_event_id')->references('id')->on('children_event');
        });


        // Добавляем данные
        //----------------------------

        DB::table('subject')->insert(['name' => 'Французский язык']);
        DB::table('subject')->insert(['name' => 'Искусство (МХК)']);
        DB::table('subject')->insert(['name' => 'Астрономия']);
        DB::table('subject')->insert(['name' => 'Испанский язык']);
        DB::table('subject')->insert(['name' => 'Русский язык']);
        DB::table('subject')->insert(['name' => 'Химия']);
        DB::table('subject')->insert(['name' => 'Информатика']);
        DB::table('subject')->insert(['name' => 'История']);
        DB::table('subject')->insert(['name' => 'Биология']);
        DB::table('subject')->insert(['name' => 'Экономика']);
        DB::table('subject')->insert(['name' => 'Физика']);
        DB::table('subject')->insert(['name' => 'Математика']);
        DB::table('subject')->insert(['name' => 'Обществознание']);
        DB::table('subject')->insert(['name' => 'Итальянский язык']);
        DB::table('subject')->insert(['name' => 'Китайский язык']);
        DB::table('subject')->insert(['name' => 'Экология']);
        DB::table('subject')->insert(['name' => 'Немецкий язык']);
        DB::table('subject')->insert(['name' => 'Литература']);
        DB::table('subject')->insert(['name' => 'География']);
        DB::table('subject')->insert(['name' => 'Физическая культура']);
        DB::table('subject')->insert(['name' => 'Право']);
        DB::table('subject')->insert(['name' => 'Технология']);
        DB::table('subject')->insert(['name' => 'Английский язык']);
        DB::table('subject')->insert(['name' => 'Основы безопасности жизнедеятельности (ОБЖ)']);

        DB::table('class')->insert(['name' => '7-8 класс']);
        DB::table('class')->insert(['name' => '9 класс']);
        DB::table('class')->insert(['name' => '10 класс']);
        DB::table('class')->insert(['name' => '11 класс']);

        DB::table('event')->insert(['subject_id' => '1', 'tour' => '1', 'status' => '0']);
        DB::table('event')->insert(['subject_id' => '1', 'tour' => '2', 'status' => '1']);
        DB::table('event')->insert(['subject_id' => '2', 'tour' => '1', 'status' => '1']);
        DB::table('event')->insert(['subject_id' => '3', 'tour' => '1', 'status' => '1']);
        DB::table('event')->insert(['subject_id' => '4', 'tour' => '1', 'status' => '0']);
        DB::table('event')->insert(['subject_id' => '4', 'tour' => '2', 'status' => '1']);
        DB::table('event')->insert(['subject_id' => '5', 'tour' => '1', 'status' => '1']);
        DB::table('event')->insert(['subject_id' => '6', 'tour' => '1', 'status' => '0']);
        DB::table('event')->insert(['subject_id' => '6', 'tour' => '2', 'status' => '1']);
        DB::table('event')->insert(['subject_id' => '7', 'tour' => '1', 'status' => '0']);
        DB::table('event')->insert(['subject_id' => '7', 'tour' => '2', 'status' => '1']);
        DB::table('event')->insert(['subject_id' => '8', 'tour' => '1', 'status' => '0']);
        DB::table('event')->insert(['subject_id' => '8', 'tour' => '2', 'status' => '1']);
        DB::table('event')->insert(['subject_id' => '9', 'tour' => '1', 'status' => '0']);
        DB::table('event')->insert(['subject_id' => '9', 'tour' => '2', 'status' => '1']);
        DB::table('event')->insert(['subject_id' => '10', 'tour' => '1', 'status' => '1']);
        DB::table('event')->insert(['subject_id' => '11', 'tour' => '1', 'status' => '0']);
        DB::table('event')->insert(['subject_id' => '11', 'tour' => '2', 'status' => '1']);
        DB::table('event')->insert(['subject_id' => '12', 'tour' => '1', 'status' => '0']);
        DB::table('event')->insert(['subject_id' => '12', 'tour' => '2', 'status' => '1']);
        DB::table('event')->insert(['subject_id' => '13', 'tour' => '1', 'status' => '0']);
        DB::table('event')->insert(['subject_id' => '13', 'tour' => '2', 'status' => '1']);
        DB::table('event')->insert(['subject_id' => '14', 'tour' => '1', 'status' => '0']);
        DB::table('event')->insert(['subject_id' => '14', 'tour' => '2', 'status' => '1']);
        DB::table('event')->insert(['subject_id' => '15', 'tour' => '1', 'status' => '0']);
        DB::table('event')->insert(['subject_id' => '15', 'tour' => '2', 'status' => '1']);
        DB::table('event')->insert(['subject_id' => '16', 'tour' => '1', 'status' => '0']);
        DB::table('event')->insert(['subject_id' => '16', 'tour' => '2', 'status' => '1']);
        DB::table('event')->insert(['subject_id' => '17', 'tour' => '1', 'status' => '0']);
        DB::table('event')->insert(['subject_id' => '17', 'tour' => '2', 'status' => '1']);
        DB::table('event')->insert(['subject_id' => '18', 'tour' => '1', 'status' => '1']);
        DB::table('event')->insert(['subject_id' => '19', 'tour' => '1', 'status' => '1']);
        DB::table('event')->insert(['subject_id' => '20', 'tour' => '1', 'status' => '0']);
        DB::table('event')->insert(['subject_id' => '20', 'tour' => '2', 'status' => '1']);
        DB::table('event')->insert(['subject_id' => '21', 'tour' => '1', 'status' => '1']);
        DB::table('event')->insert(['subject_id' => '22', 'tour' => '1', 'status' => '0']);
        DB::table('event')->insert(['subject_id' => '22', 'tour' => '2', 'status' => '1']);
        DB::table('event')->insert(['subject_id' => '23', 'tour' => '1', 'status' => '0']);
        DB::table('event')->insert(['subject_id' => '23', 'tour' => '2', 'status' => '1']);
        DB::table('event')->insert(['subject_id' => '24', 'tour' => '1', 'status' => '0']);
        DB::table('event')->insert(['subject_id' => '24', 'tour' => '2', 'status' => '1']);

        DB::table('children_event')->insert(['event_id' => '1', 'date_olympiad' => '2024-01-10 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '1', 'date_olympiad' => '2024-01-10 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '1', 'date_olympiad' => '2024-01-10 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '2', 'date_olympiad' => '2024-01-11 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '2', 'date_olympiad' => '2024-01-11 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '2', 'date_olympiad' => '2024-01-11 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '3', 'date_olympiad' => '2024-01-13 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '3', 'date_olympiad' => '2024-01-13 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '3', 'date_olympiad' => '2024-01-13 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '4', 'date_olympiad' => '2024-01-15 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '4', 'date_olympiad' => '2024-01-15 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '4', 'date_olympiad' => '2024-01-15 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '5', 'date_olympiad' => '2024-01-16 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '5', 'date_olympiad' => '2024-01-16 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '5', 'date_olympiad' => '2024-01-16 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '6', 'date_olympiad' => '2024-01-17 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '6', 'date_olympiad' => '2024-01-17 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '6', 'date_olympiad' => '2024-01-17 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '7', 'date_olympiad' => '2024-01-18 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '7', 'date_olympiad' => '2024-01-18 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '7', 'date_olympiad' => '2024-01-18 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '8', 'date_olympiad' => '2024-01-19 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '8', 'date_olympiad' => '2024-01-19 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '8', 'date_olympiad' => '2024-01-19 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '9', 'date_olympiad' => '2024-01-20 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '9', 'date_olympiad' => '2024-01-20 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '9', 'date_olympiad' => '2024-01-20 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '10', 'date_olympiad' => '2024-01-22 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '10', 'date_olympiad' => '2024-01-22 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '10', 'date_olympiad' => '2024-01-22 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '11', 'date_olympiad' => '2024-01-23 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '11', 'date_olympiad' => '2024-01-23 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '11', 'date_olympiad' => '2024-01-23 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '12', 'date_olympiad' => '2024-01-24 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '12', 'date_olympiad' => '2024-01-24 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '12', 'date_olympiad' => '2024-01-24 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '13', 'date_olympiad' => '2024-01-25 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '13', 'date_olympiad' => '2024-01-25 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '13', 'date_olympiad' => '2024-01-25 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '14', 'date_olympiad' => '2024-01-27 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '14', 'date_olympiad' => '2024-01-27 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '14', 'date_olympiad' => '2024-01-27 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '15', 'date_olympiad' => '2024-01-26 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '15', 'date_olympiad' => '2024-01-26 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '15', 'date_olympiad' => '2024-01-26 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '16', 'date_olympiad' => '2024-01-29 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '16', 'date_olympiad' => '2024-01-29 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '16', 'date_olympiad' => '2024-01-29 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '17', 'date_olympiad' => '2024-01-30 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '17', 'date_olympiad' => '2024-01-30 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '17', 'date_olympiad' => '2024-01-30 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '18', 'date_olympiad' => '2024-01-31 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '18', 'date_olympiad' => '2024-01-31 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '18', 'date_olympiad' => '2024-01-31 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '19', 'date_olympiad' => '2024-02-01 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '19', 'date_olympiad' => '2024-02-01 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '19', 'date_olympiad' => '2024-02-01 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '20', 'date_olympiad' => '2024-02-02 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '20', 'date_olympiad' => '2024-02-02 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '20', 'date_olympiad' => '2024-02-02 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '21', 'date_olympiad' => '2024-02-03 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '21', 'date_olympiad' => '2024-02-03 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '21', 'date_olympiad' => '2024-02-03 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '22', 'date_olympiad' => '2024-02-06 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '22', 'date_olympiad' => '2024-02-06 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '22', 'date_olympiad' => '2024-02-06 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '23', 'date_olympiad' => '2024-02-07 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '23', 'date_olympiad' => '2024-02-07 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '23', 'date_olympiad' => '2024-02-07 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '24', 'date_olympiad' => '2024-02-06 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '24', 'date_olympiad' => '2024-02-06 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '24', 'date_olympiad' => '2024-02-06 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '25', 'date_olympiad' => '2024-02-07 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '25', 'date_olympiad' => '2024-02-07 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '25', 'date_olympiad' => '2024-02-07 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '26', 'date_olympiad' => '2024-02-08 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '26', 'date_olympiad' => '2024-02-08 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '26', 'date_olympiad' => '2024-02-08 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '27', 'date_olympiad' => '2024-02-09 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '27', 'date_olympiad' => '2024-02-09 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '27', 'date_olympiad' => '2024-02-09 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '28', 'date_olympiad' => '2024-02-10 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '28', 'date_olympiad' => '2024-02-10 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '28', 'date_olympiad' => '2024-02-10 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '29', 'date_olympiad' => '2024-02-12 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '29', 'date_olympiad' => '2024-02-12 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '29', 'date_olympiad' => '2024-02-12 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '30', 'date_olympiad' => '2024-02-13 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '30', 'date_olympiad' => '2024-02-13 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '30', 'date_olympiad' => '2024-02-13 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '31', 'date_olympiad' => '2024-02-15 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '31', 'date_olympiad' => '2024-02-15 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '31', 'date_olympiad' => '2024-02-15 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '32', 'date_olympiad' => '2024-02-16 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '32', 'date_olympiad' => '2024-02-16 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '32', 'date_olympiad' => '2024-02-16 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '33', 'date_olympiad' => '2024-02-17 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '33', 'date_olympiad' => '2024-02-17 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '33', 'date_olympiad' => '2024-02-17 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '34', 'date_olympiad' => '2024-02-19 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '34', 'date_olympiad' => '2024-02-19 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '34', 'date_olympiad' => '2024-02-19 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '35', 'date_olympiad' => '2024-02-20 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '35', 'date_olympiad' => '2024-02-20 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '35', 'date_olympiad' => '2024-02-20 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '36', 'date_olympiad' => '2024-02-21 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '36', 'date_olympiad' => '2024-02-21 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '36', 'date_olympiad' => '2024-02-21 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '37', 'date_olympiad' => '2024-02-26 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '37', 'date_olympiad' => '2024-02-26 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '37', 'date_olympiad' => '2024-02-26 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '38', 'date_olympiad' => '2024-02-27 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '38', 'date_olympiad' => '2024-02-27 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '38', 'date_olympiad' => '2024-02-27 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '39', 'date_olympiad' => '2024-02-28 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '39', 'date_olympiad' => '2024-02-28 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '39', 'date_olympiad' => '2024-02-28 10:00', 'class_id' => '4']);
        DB::table('children_event')->insert(['event_id' => '40', 'date_olympiad' => '2024-02-29 10:00', 'class_id' => '2']);
        DB::table('children_event')->insert(['event_id' => '40', 'date_olympiad' => '2024-02-29 10:00', 'class_id' => '3']);
        DB::table('children_event')->insert(['event_id' => '40', 'date_olympiad' => '2024-02-29 10:00', 'class_id' => '4']);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('important_dates');
        Schema::dropIfExists('children_event');
        Schema::dropIfExists('class');
        Schema::dropIfExists('event');
        Schema::dropIfExists('subject');
    }
}
