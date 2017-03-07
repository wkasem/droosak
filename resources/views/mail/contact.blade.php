@extends('mail.layout')


@section('content')

<div
style="color:#B8B8C0;line-height:150%;font-family:Arial, 'Helvetica Neue', Helvetica,sans-serif;">
  <table>
    <tr>  <td> {{ $user['contact_username'] }} </td> </tr>
    <tr>  <td> {{ $user['contact_email'] }} </td> </tr>
    <tr>  <td> {{ $user['contact_msg'] }} </td> </tr>
  </table>

</div>


@endsection
