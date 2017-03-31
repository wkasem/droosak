@extends('layout')

@section('title' , Lang::get('nav.schedule'))


@section('content')

<Schedule data='{{ json_encode($schedule)}}' data2='{{ json_encode($stages)}}'
          dir='{{ tdir() }}'></Schedule>
@endsection
