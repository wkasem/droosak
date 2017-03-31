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
      @foreach($exams['fixed'] as $exam)
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

<div class="columns">
  <div class="column">
    <section class="section">
      <div class="container">
        <div class="heading">
          <h1 class="title">{{ date('Y') }} -- @lang('exams.'. date('n'))</h1>
        </div>
        <table class="table">
          @foreach($exams['monthly'] as $exam)
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
        </table>
          @if($stages->count())
            <form action="{{ route('createExam')}}" method="post" class="field is-grouped">
              {{ csrf_field() }}
              <p class="control is-expanded">
                <span class="select">
                  <select name="stage_id">
                    @foreach($stages as $stage)
                      <option value="{{ $stage->id }}">
                        {{ Lang::get('exams.'.$stage->title)}}
                      </option>
                    @endforeach
                  </select>
                </span>
              </p>
              <p class="control">
                <button class="button is-info">
                  @lang('exams.create')
                </button>
              </p>
            </form>
          @endif
      </div>
    </section>
  </div>
</div>


@endsection
