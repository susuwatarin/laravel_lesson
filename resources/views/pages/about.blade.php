@extends('layout')

@section('title')
about
@endsection

@section('content')
<div class="title">About Page</div>
<!-- <div class="name">For <?= $first_name ?> <?= $last_name ?></div> -->
<div class="name">For {{ $first_name }} {{ $last_name }}</div>
@endsection
