@extends('layouts.master')
@section('title', 'Contribute')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-md-6 col-md-offset-3">
      @include('layouts/message')
      <h2>Contribute</h2>
      <form method="POST" action="{{ url('/contribute') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
          <label for="title">Title<span class="required">*</span></label>
          <input type="text" class="form-control" name="title" value="{{ old('title') }}" maxlength="255" autofocus required>
        </div>
        <div class="form-group">
          <label for="category">Category<span class="required">*</span></label>
          <br />
          <select name="category" required>
            @foreach($categories as $category)
            <option value="{{ $category->slug }}" {{ old('category') == $category->slug ? 'selected' : '' }}>{{ $category->category }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="publish">Publish Date<span class="required">*</span></label>
          <input type="string" class="form-control" id="publish" name="publish" value="{{ old('publish') }}" maxlength="255">
        </div>
        <div class="form-group">
          <label for="link">Link</label>
          <input type="text" class="form-control" name="link" value="{{ old('link') }}" maxlength="255">
        </div>
        <div class="form-group">
          <label for="date">Date</label>
          <input type="string" class="form-control" id="date" name="date" value="{{ old('date') }}" maxlength="255">
        </div>
        <div class="form-group">
          <label for="location">Location</label>
          <input type="text" class="form-control" name="location" value="{{ old('location') }}" maxlength="255">
        </div>
        <div class="form-group">
          <label for="text">Text<span class="required">*</span></label>
          <input type="text" class="form-control" name="text" value="{{ old('text') }}" maxlength="255" required>
        </div>
        <button type="submit" class="btn btn-primary btn-xl">Submit Article</button>
      </form>
    </div>
  </div>
</div>
@endsection

@section('footer')
<script src="{{ URL::asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ URL::asset('js/moment-with-locales.min.js') }}"></script>
<script src="{{ URL::asset('js/datetimepicker.min.js') }}"></script>
<script>
$(function(){$('#date').datetimepicker();});
$('#publish').datetimepicker({
  minDate: moment().valueOf(),
  daysOfWeekDisabled: [0, 2, 3, 4, 5, 6],
  format: 'MM/DD/YYYY',
});
</script>
@endsection
