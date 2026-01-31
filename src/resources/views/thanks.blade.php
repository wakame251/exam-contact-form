@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<main class="thanks-page">
  <div class="thanks__inner">
    <p class="thanks__message">お問い合わせありがとうございました</p>
    <a href="/" class="thanks__btn">HOME</a>
  </div>
</main>
@endsection
