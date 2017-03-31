@extends('mail.layout')

@section('content')

<strong>تم تحديث جدول مواعيد {{ $schedule['title'] }}</strong>

<table>
<thead>
  <tr> <th> اليوم </th> <th> من </th> <th> الى </th> </tr>
</thead>
<tbody>
  @foreach($schedule['times'] as $time)
    <tr>
      <td> {{ days($time['day']) }} </td>
      <td class="time"> {{ $time['from'] }} </td>
      <td class="time"> {{ $time['to'] }} </td>
    </tr>
  @endforeach
</tbody>
</table>

@stop
