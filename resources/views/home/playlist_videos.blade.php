@extends('layout')


@section('content')


<Watching data='{{ json_encode($playlist)}}'></Watching>

@endsection
