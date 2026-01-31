@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<main class="contact">
  <h1 class="contact__title">FashionablyLate</h1>
  <p class="contact__subtitle">Contact</p>

  <form action="/confirm" method="post" class="contact-form" novalidate>
    @csrf

    <label class="form-row">
      <span class="form-label">お名前 <span class="required">※</span></span>
      <div class="form-input name-group">
        <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="山田">
        <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="太郎">
      </div>
    </label>
    @error('last_name')<p class="error">{{ $message }}</p>@enderror
    @error('first_name')<p class="error">{{ $message }}</p>@enderror

    <fieldset class="form-row">
      <legend class="form-label">性別 <span class="required">※</span></legend>
      <div class="form-input gender-group">
        <label><input type="radio" name="gender" value="1" {{ old('gender') == '1' ? 'checked' : '' }}> 男性</label>
        <label><input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}> 女性</label>
        <label><input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}> その他</label>
      </div>
    </fieldset>
    @error('gender')<p class="error">{{ $message }}</p>@enderror

    <label class="form-row">
      <span class="form-label">メールアドレス <span class="required">※</span></span>
      <input class="form-input" type="email" name="email" value="{{ old('email') }}" placeholder="test@example.com">
    </label>
    @error('email')<p class="error">{{ $message }}</p>@enderror

    <label class="form-row">
      <span class="form-label">電話番号 <span class="required">※</span></span>
      <div class="form-input tel-group">
        <input type="text" name="tel[]" value="{{ old('tel.0') }}" placeholder="080">
        <span class="tel-separator">-</span>
        <input type="text" name="tel[]" value="{{ old('tel.1') }}" placeholder="1234">
        <span class="tel-separator">-</span>
        <input type="text" name="tel[]" value="{{ old('tel.2') }}" placeholder="5678">
      </div>
    </label>

    @error('tel.0')<p class="error">{{ $message }}</p>@enderror
    @error('tel.1')<p class="error">{{ $message }}</p>@enderror
    @error('tel.2')<p class="error">{{ $message }}</p>@enderror


    <label class="form-row">
      <span class="form-label">住所 <span class="required">※</span></span>
      <input class="form-input" type="text" name="address" value="{{ old('address') }}" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3">
    </label>
    @error('address')<p class="error">{{ $message }}</p>@enderror

    <label class="form-row">
      <span class="form-label">建物名</span>
      <input class="form-input" type="text" name="building" value="{{ old('building') }}" placeholder="例: 千駄ヶ谷マンション101">
    </label>

    <label class="form-row">
      <span class="form-label">お問い合わせの種類 <span class="required">※</span></span>
      <select class="form-input" name="category_id">
        <option value="">選択してください</option>
        @foreach($categories as $category)
          <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
            {{ $category->content }}
          </option>
        @endforeach
      </select>
    </label>
    @error('category_id')<p class="error">{{ $message }}</p>@enderror

    <label class="form-row">
      <span class="form-label">お問い合わせ内容 <span class="required">※</span></span>
      <textarea class="form-input textarea" name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
    </label>
    @error('detail')<p class="error">{{ $message }}</p>@enderror

    <button type="submit" class="submit-btn">確認画面</button>
  </form>
</main>
@endsection
