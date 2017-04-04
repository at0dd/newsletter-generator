@extends('layouts.master')
@section('title', 'Profile')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-md-6 col-md-offset-3">
      @include('layouts/message')
      <h2>{{ Auth::user()->first }} {{ Auth::user()->last }}</h2>
      <form method="POST" action="{{ url('/profile') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
          <label for="first">First Name</label>
          <input type="text" class="form-control" name="first" value="{{ Auth::user()->first }}" required>
        </div>
        <div class="form-group">
          <label for="last">Last Name</label>
          <input type="text" class="form-control" name="last" value="{{ Auth::user()->last }}" required>
        </div>
        <div class="form-group">
          <label for="email">Email Address</label>
          <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required>
        </div>
        <button type="submit" class="btn btn-primary btn-xl">Update Profile</button>
      </form>
    </div>
  </div>
</div>
@endsection
