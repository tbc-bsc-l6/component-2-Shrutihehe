@extends('layouts.main')


@section ('content')


<div class ="container mt-3">

@foreach($questions as $question)

<fieldset class="mt-3" id="No.1">
<h5>{{ $question->question}}</h5>
<div class="form-check">
  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
  <label class="form-check-label" for="flexRadioDefault1">
{{$question->answer1}}
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
  <label class="form-check-label" for="flexRadioDefault1">
  {{$question->answer2}}
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
  <label class="form-check-label" for="flexRadioDefault1">
  {{$question->answer3}}
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
  <label class="form-check-label" for="flexRadioDefault2">
  {{$question->answer4}}
  </label>
</div>
</div>
</fieldset>
@endforeach
</div>

@endsection