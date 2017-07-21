@extends('layouts.app')

@section('title', 'Register')
@section('meta-description', 'Register a new user')

@section('content')
<section>
  @component('components.page-header')
    @slot('header') Register a new user @endslot
    @slot('icon') fa-user-plus @endslot
  @endcomponent

  <div class="container">
    <form method="POST" action="{{ route('register') }}">
      {{ csrf_field() }}

      <div class="form-group row{{ $errors->has('name') ? ' has-danger' : '' }}">
        <label for="name" class="form-control-label col-md-4 col-form-label">Name</label>

        <div class="col-md-6">
          <input id="name" type="text" class="form-control{{ $errors->has('name') ?
            ' form-control-danger' : '' }}" name="name"
            value="{{ old('name') }}" autofocus>

          @if ($errors->has('name'))
            <div class="form-control-feedback">{{ $errors->first('name') }}</div>
          @endif
        </div>
      </div>

      <div class="form-group row{{ $errors->has('email') ? ' has-danger' : '' }}">
        <label for="email" class="form-control-label col-md-4 col-form-label">E-Mail</label>

        <div class="col-md-6">
          <input id="email" type="email" class="form-control{{ $errors->has('email') ?
            ' form-control-danger' : '' }}" name="email"
            value="{{ old('email') }}">

          @if ($errors->has('email'))
            <div class="form-control-feedback">{{ $errors->first('email') }}</div>
          @endif
        </div>
      </div>

      <div class="form-group row{{ $errors->has('password') ? ' has-danger' : '' }}">
        <label for="password" class="form-control-label col-md-4 col-form-label">Password</label>

        <div class="col-md-6">
          <input id="password" type="password" class="form-control{{ $errors->has('password') ?
            ' form-control-danger' : '' }}" name="password">

          @if ($errors->has('password'))
            <div class="form-control-feedback">{{ $errors->first('password') }}</div>
          @endif
        </div>
      </div>

      <div class="form-group row{{ $errors->has('password') ? ' has-danger' : '' }}">
        <label for="password-confirm" class="form-control-label col-md-4 col-form-label">
          Confirm Password</label>

        <div class="col-md-6">
          <input id="password-confirm" type="password" name="password_confirmation"
            class="form-control{{ $errors->has('password') ?
              ' form-control-danger' : '' }}">
        </div>
      </div>

      <div class="form-group mt-4">
        <button type="submit" class="btn btn-primary">
          <i class="fa fa-floppy-o fa-lg mr-1" aria-hidden="true"></i> Register</button>
      </div>

    </form>
  </div>
</section>
@endsection
