@extends('layouts.app')

@section('title', 'Main page')
@section('meta-description', 'Main page. BSA Task 7')

@section('content')
  <article>
    @component('components.page-header')
      @slot('header') Best Car Hire Deals @endslot
      @slot('icon') fa-home @endslot
    @endcomponent

    <p class="text-center">
      <img src="{{ url('images/main.jpg') }}" alt="Main image">
    </p>
  </article>
@endsection
