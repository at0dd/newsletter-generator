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
  @include('layouts/admin')
  <div class="adminbtn">
    <a href="#" class="btn btn-danger btn-xl archive">Archive</a>
    <a href="#" class="btn btn-success btn-xl newsletter">Send Newsletter</a>
  </div>
  <table class="table table-striped table-condensed">
    <thead>
      <tr>
        <th>Title</th>
        <th>Category</th>
        <th>Link</th>
        <th>Date</th>
        <th>Location</th>
        <th>Text</th>
        <th>Submitted By</th>
        <th class="checked">Approved</th>
        <th class="checked">Archived</th>
      </tr>
    </thead>
    <tbody>
      @foreach($articles as $article)
      <tr>
        <td>{{ $article->title }}</td>
        <td>{{ $article->categories()->first()->category }}</td>
        <td><a href="{{ $article->link }}" target="_blank">{{ $article->link }}</a></td>
        <td>{{ date("M j, Y @ g:i A", strtotime($article->date)) }}</td>
        <td>{{ $article->location }}</td>
        <td>{{ $article->text }}</td>
        <td>{{ $article->submitter->first }} {{ $article->submitter->last }}</td>
        @if($article->approved == 1)
          <td class="checked"><a class="clink approved" id="{{ $article->id }}"><i class="fa fa-check" aria-hidden="true"></i></a></td>
        @else
          <td class="checked"><a class="clink denied" id="{{ $article->id }}"><i class="fa fa-times" aria-hidden="true"></i></a></td>
        @endif
        @if($article->archived == 1)
          <td class="checked"><a class="carch archived" id="{{ $article->id }}"><i class="fa fa-check" aria-hidden="true"></i></a></td>
        @else
          <td class="checked"><a class="carch narchived" id="{{ $article->id }}"><i class="fa fa-times" aria-hidden="true"></i></a></td>
        @endif
      </tr>
      @endforeach
    </tbody>
  </table>
  {{ $articles->links() }}
</div>
@endsection

@section('footer')
<script>
$('.archive').click(function(e){
  e.preventDefault();
  var conf = confirm("Are you sure you want to archive all articles?");
  if(conf){
    window.location.href = "{{ url('/administration/archive') }}";
  }
  return false;
});

$('.newsletter').click(function(e){
  e.preventDefault();
  var conf = confirm("Are you sure you want to send out the weekly newsletter?");
  if(conf){
    var settings = {
      "async": true,
      "url": "{{ url('/api/administration/send/') }}",
      "method": "POST",
      headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}",
      }
    }
    $.ajax(settings).done(function (response) {
      console.log(response);
      if(response == 200){
        alert("The newsletter has been sent out!");
      } else {
        alert("There was an error sending the newsletter. Please sign in and try again.");
      }
    });
  }
  return false;
});

$('.clink').click(function(e){
  e.preventDefault();
  var settings = {
    "async": true,
    "url": "url",
    "method": "POST",
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}",
    }
  }
  if($(this).hasClass('approved')){
    settings['url'] = "{{ url('/api/administration/deny/') }}/"+this.id;
  } else {
    settings['url'] = "{{ url('/api/administration/approve/') }}/"+this.id;
  }
  $.ajax(settings).done(function (response) {
    console.log(response);
    if(response != 200){
      alert("An error occured while approving the article. Please sign in and try again.");
    }
  });
  $(this).toggleClass('approved denied');
  $(this).find('i').toggleClass('fa-check fa-times');
  return false;
});

$('.carch').click(function(e){
  e.preventDefault();
  var settings = {
    "async": true,
    "url": "{{ url('/api/administration/archive/') }}/"+this.id,
    "method": "POST",
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}",
    }
  }
  $.ajax(settings).done(function (response) {
    console.log(response);
    if(response != 200){
      alert("An error occured while archiving the article. Please sign in and try again.");
    }
  });
  $(this).find('i').toggleClass('fa-check fa-times');
  return false;
});
</script>
@endsection
