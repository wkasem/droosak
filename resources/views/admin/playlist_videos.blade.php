@extends('layout')

@section('title' , $playlist->get('title'))

@section('content')


<Videos data='{{ json_encode($playlist)}}'
        data2='{{ json_encode($teachers)}}'
        data3='{{ json_encode($playlists)}}'></Videos>

@endsection
