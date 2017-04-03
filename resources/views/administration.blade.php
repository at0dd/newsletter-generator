@extends('layouts.master')
@section('title', 'Administration')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-md-6 col-md-offset-3">
      @include('layouts/message')
    </div>
  </div>
</div>
<div class="container-fluid">
  <h2>Administration</h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Title</th>
        <th>Category</th>
        <th>Link</th>
        <th>Date</th>
        <th>Location</th>
        <th>Text</th>
        <th>Submitted By</th>
        <th class="approve">Approved</th>
      </tr>
    </thead>
    <tbody>
      @foreach($articles as $article)
      <tr>
        <td>{{ $article->title }}</td>
        <td>{{ $article->categories()->first()->category }}</td>
        <td><a href="{{ $article->link }}" target="_blank">{{ $article->link }}</a></td>
        <td>{{ $article->date }}</td>
        <td>{{ $article->location }}</td>
        <td>{{ $article->text }}</td>
        <td>{{ $article->submitter->first }} {{ $article->submitter->last }}</td>
        @if($article->approved == 1)
          <td class="checked"><a class="clink approved" id="{{ $article->id }}"><i class="fa fa-check" aria-hidden="true"></i></a></td>
        @else
          <td class="checked"><a class="clink denied" id="{{ $article->id }}"><i class="fa fa-times" aria-hidden="true"></i></a></td>
        @endif
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection

@section('footer')
<script>
$('.clink').click(function(e){
  e.preventDefault();
  var settings;
  if($(this).hasClass('approved')){
    settings = {
      "async": true,
      "url": "{{ url('/api/administration/deny/') }}/"+this.id,
      "method": "POST",
    }
  } else {
    settings = {
      "async": true,
      "url": "{{ url('/api/administration/approve/') }}/"+this.id,
      "method": "POST",
    }
  }
  $.ajax(settings).done(function (response) {
    console.log(response);
  });
  $(this).toggleClass('approved denied');
  $(this).find('i').toggleClass('fa-check fa-times');
  return false;
});
</script>
@endsection
