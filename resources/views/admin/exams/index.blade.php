@extends('layout')

@section('title' , Lang::get('nav.exams'))

@section('styles')

<style>
.card-panel{
      padding-right: 0;
}
.title{
      line-height: 2.125!important;
      text-align: center;
}
.box{
  padding: 0;
}
</style>

@endsection

@section('content')
<div class="box" >
  <table class="table">
    <tbody>
      @foreach($exams->where('monthly' , '!=' , 1) as $exam)
      <tr>
        <td>
          <p>
            <a href="{{ route('admin.exams.edit' , ['id' => $exam->id])}}"  class="title is-5">
              @lang('exams.'.$exam->title)
            </a>
          </p>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@foreach($monthly as $year => $month)
<div class="columns">
  <div class="column">
    <section class="section">
      <div class="container">
        <div class="heading">
          <h1 class="title">{{ $year }}</h1>
        </div>
        <table class="table">
          <tbody>
            @foreach($month as $exam)
            <tr>
              <td>
                <p>
                  <a href="{{ route('admin.exams.edit' , ['id' => $exam->id])}}"  class="title is-5">
                    @lang('exams.'.$exam->title)
                  </a>
                </p>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </section>
  </div>
</div>
@endforeach


@endsection
