@extends('layout')


@section('title' , $video->title)


@section('styles')

<script src="https://vjs.zencdn.net/5.16.0/video.js"></script>
<link href="https://vjs.zencdn.net/5.16.0/video-js.css" rel="stylesheet">

@endsection

@section('content')

<Player data='{{ json_encode($video)}}'></Player>

@endsection
