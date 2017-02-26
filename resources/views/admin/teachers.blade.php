@extends('layout')

@section('title' , Lang::get('nav.teachers'))

@section('content')


<Teachers data='{{ json_encode($teachers)}}' tdir='{{ tdir() }}'></Teachers>

@endsection
