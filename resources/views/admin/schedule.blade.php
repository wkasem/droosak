@extends('layout')

@section('title' , Lang::get('nav.schedule'))


@section('content')

<Schedule data='{{ json_encode($schedule)}}' dir='{{ tdir() }}'></Schedule>
@endsection
