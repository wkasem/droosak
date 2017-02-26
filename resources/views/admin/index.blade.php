@extends('layout')

@section('title' , Lang::get('nav.home'))

@section('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>

@endsection

@section('content')

<Dashboard data='{{ json_encode($welcome) }}' dir='{{ tdir() }}'></Dashboard>
@endsection
