@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot

@component('mail::panel')
    {{ \Lang::get('exams.'.$exam['title']) }} أونﻻين والحصول على درجاتك فوريايمكنك أخذ أمتحان
@endcomponent




    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        @endcomponent
    @endslot
@endcomponent
