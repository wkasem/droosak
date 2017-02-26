@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot

@component('mail::panel')
@component('mail::table')
| الى    |        من     |            يوم   |
| -------------  |:-------------:| --------:|
@foreach($data['times'] as $time)
| {{ $time['from'] }} | {{ $time['to'] }} | {{ days($time['day']) }} |
@endforeach
@endcomponent

@endcomponent




    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        @endcomponent
    @endslot
@endcomponent
