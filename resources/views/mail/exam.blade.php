@extends('mail.layout')

@section('content')

<img src="{{ asset('imgs/exams.jpg')}}" />
<strong>تم نشر أمتحان @lang('exams.'.$exam['title'])</strong>
<p>
  يمكنك الامتحان الان والحصول على درجاتك فوريا
</p>
<a href="{{ route('home.exams') }}"class="button">أمتحن ألان</a>

@stop
