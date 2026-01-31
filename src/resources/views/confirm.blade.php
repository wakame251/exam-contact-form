@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<main class="confirm">
  <h1 class="confirm__title">FashionablyLate</h1>
  <p class="confirm__subtitle">Confirm</p>

  <div class="confirm-container">
    <table class="confirm-table">
      <tr>
        <th>お名前</th>
        <td>{{ $contact['last_name'] }} {{ $contact['first_name'] }}</td>
      </tr>
      <tr>
        <th>性別</th>
        <td>
          @if($contact['gender'] == 1) 男性
          @elseif($contact['gender'] == 2) 女性
          @else その他
          @endif
        </td>
      </tr>
      <tr>
        <th>メールアドレス</th>
        <td>{{ $contact['email'] }}</td>
      </tr>
      <tr>
        <th>電話番号</th>
        <td>{{ $contact['tel'] }}</td> {{-- ハイフンなし --}}
      </tr>
      <tr>
        <th>住所</th>
        <td>{{ $contact['address'] }}</td>
      </tr>
      <tr>
        <th>建物名</th>
        <td>{{ $contact['building'] ?? '' }}</td>
      </tr>
      <tr>
        <th>お問い合わせの種類</th>
        <td>{{ $category->content }}</td>
      </tr>
      <tr>
        <th>お問い合わせ内容</th>
        <td>{{ $contact['detail'] }}</td>
      </tr>
    </table>

    <div class="confirm-btn-area">
      <form action="/store" method="post">
        @csrf
        @foreach($contact as $key => $value)
          <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
        <button class="confirm-btn">送信</button>
      </form>

      <form action="/confirm" method="post">
      @csrf
      @foreach($contact as $key => $value)
          <input type="hidden" name="{{ $key }}" value="{{ $value }}">
      @endforeach
      <button type="submit" name="back" value="1" class="confirm-btn-outline">修正</button>
      </form>

    </div>
  </div>
</main>
@endsection
