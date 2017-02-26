@extends('layout')

@section('title' , $playlist->get('title'))

@section('content')


<Videos data='{{ json_encode($playlist)}}'></Videos>

@endsection
