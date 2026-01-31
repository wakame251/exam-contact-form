@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth-page">

  <header class="auth-header">
    <h1 class="auth-logo">FashionablyLate</h1>

    <a href="{{ route('register') }}" class="auth-link">register</a>
  </header>

  <main class="auth-main">
    <p class="auth-page-title">Login</p>

    <div class="auth-card">
      <form method="POST" action="{{ route('login') }}" class="auth-form" novalidate>
        @csrf

        <div class="form-group">
          <label>メールアドレス</label>
          <input type="email" name="email" value="{{ old('email') }}">
          @error('email')
            <p class="error-text">{{ $message }}</p>
          @enderror
        </div>

        <div class="form-group">
          <label>パスワード</label>
          <input type="password" name="password">
          @error('password')
            <p class="error-text">{{ $message }}</p>
          @enderror
        </div>

        <button type="submit" class="auth-btn">ログイン</button>
      </form>
    </div>
  </main>

</div>
@endsection

