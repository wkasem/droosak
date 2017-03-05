@extends('mail.layout')


@section('content')

<div class="panel">
  <div class="header">

  </div>
</div>
<table>
  <tr> <td> أﻻسم </td> <td> {{ $user['contact_username'] }} </td> </tr>
  <tr> <td> عنوان البريد </td> <td> {{ $user['contact_email'] }} </td> </tr>
  <tr> <td> الرسالة </td> <td> {{ $user['contact_msg'] }} </td> </tr>
</table>

@endsection
