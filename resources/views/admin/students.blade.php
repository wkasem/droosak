@extends('layout')

@section('title' , Lang::get('nav.students'))

@section('content')


<Students data='{{ json_encode($students) }}' tdir='{{ tdir() }}'></Students>

@endsection
