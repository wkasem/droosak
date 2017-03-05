@extends('layout')

@section('title' , Lang::get('nav.home'))

@section('scripts')
<script src="https://code.highcharts.com/highcharts.js"></script>

@endsection

@section('content')

@if(student())
  @include('home.student')
@else
  @include('home.teacher')
@endif

@endsection
