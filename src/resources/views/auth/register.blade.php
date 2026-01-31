@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth-wrapper">
  <header class="auth-header">
    <h1 class="auth-logo">FashionablyLate</h1>
    <a href="{{ route('login') }}" class="auth-link">login</a>
  </header>

  <main class="auth-main">
    <p class="auth-page-title">Register</p>

    <div class="auth-card">
      <form method="POST" action="{{ route('register') }}" class="auth-form" novalidate>
        @csrf

        <div class="form-group">
          <label>お名前</label>
          <input type="text" name="name" value="{{ old('name') }}">
          @error('name')
            <p class="error-text">{{ $message }}</p>
          @enderror
        </div>

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

        <button type="submit" class="auth-btn">登録</button>
      </form>
    </div>
  </main>
</div>
@endsection
