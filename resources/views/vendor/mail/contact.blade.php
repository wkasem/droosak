@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot

<h2>Name</h2>{{ $user['contact_username'] }}
<h2>Email</h2>{{ $user['contact_email'] }}

@component('mail::panel')
    {{ $user['contact_msg'] }}
@endcomponent




    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        @endcomponent
    @endslot
@endcomponent
