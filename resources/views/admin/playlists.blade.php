@extends('layout')

@section('title' , Lang::get('nav.videos'))

@section('content')


<Playlists data='{{ json_encode($playlists) }}'></Playlists>

@endsection
