@extends('layout')

@section('title' , Lang::get('exams.'.$exam->title))

@section('content')

<Exam data='{{ json_encode($exam) }}' t="{{ Lang::get('exams.'.$exam->title)}}"
      locked='{{ $locked }}'></Exam>
@endsection
