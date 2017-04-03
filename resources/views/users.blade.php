@extends('layouts.master')
@section('title', 'User Administration')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-md-6 col-md-offset-3">
      @include('layouts/message')
    </div>
  </div>
</div>
<div class="container-fluid">
  <h2>User Administration</h2>
  @include('layouts/admin')
  <table class="table table-striped">
    <thead>
      <tr>
        <th>First</th>
        <th>Last</th>
        <th>Email</th>
        <th class="checked">User</th>
        <th class="checked">Administrator</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr>
        <td>{{ $user->first }}</td>
        <td>{{ $user->last }}</td>
        <td>{{ $user->email }}</td>
        <td class="checked"><a class="clink" id="{{ $user->id }}"><i class="fa {{ $user->hasRole('User') ? 'fa-check' : 'fa-times' }}" id="User" aria-hidden="true"></i></a></td>
        <td class="checked"><a class="clink" id="{{ $user->id }}"><i class="fa {{ $user->hasRole('Administrator') ? 'fa-check' : 'fa-times' }}" id="Administrator" aria-hidden="true"></i></a></td>
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
  var settings = {
    "async": true,
    "url": "{{ url('/api/administration/users/') }}/"+this.id+"/"+$(this).find('i').attr('id'),
    "method": "POST",
  }
  $.ajax(settings).done(function (response) {
    console.log(response);
    if(response != 200){
      alert("An error occured. Please sign in and try again.");
    }
  });
  $(this).find('i').toggleClass('fa-check fa-times');
  return false;
});
</script>
@endsection
