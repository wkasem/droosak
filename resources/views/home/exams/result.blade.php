<ol>
  @foreach($answers as $answer)
  <li>
    {{ $exam->questions[$answer->qIndx]['title'] }} <br />
    <p>

      {{ $exam->questions[$answer->qIndx]['answers'][$answer->aIndx]['title'] }}
    </p>
  </li>
  @endforeach
</ol>
