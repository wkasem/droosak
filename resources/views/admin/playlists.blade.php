@extends('layout')

@section('title' , Lang::get('nav.videos'))

@section('content')


<Playlists data='{{ json_encode($playlists) }}' data2='{{ json_encode($stages) }}' parent='0'></Playlists>

@endsection
