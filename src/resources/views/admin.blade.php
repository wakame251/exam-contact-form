@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="admin-wrapper">

  <header class="admin-header">
    <h1 class="admin-logo">FashionablyLate</h1>

    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="admin-logout">logout</button>
    </form>
  </header>

  <main class="admin-main">
    <h2 class="admin-title">Admin</h2>

    <form class="admin-search" action="{{ route('admin.search') }}" method="GET">

      <input
        type="text"
        name="keyword"
        class="search-input"
        placeholder="名前やメールアドレスを入力してください"
        value="{{ request('keyword') }}"
      >

      <select name="gender" class="search-select">
        <option value="">性別</option>
        <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
        <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
        <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
      </select>

      <select name="category_id" class="search-select wide">
        <option value="">お問い合わせの種類</option>
        @foreach ($categories as $category)
          <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
            {{ $category->content }}
          </option>
        @endforeach
      </select>

      <input
        type="date"
        name="date"
        class="search-date"
        value="{{ request('date') }}"
      >

      <button type="submit" class="btn btn-search">検索</button>
      <a href="{{ route('admin.search') }}" class="btn btn-reset">リセット</a>
    </form>

    <div class="admin-tools">
      <a href="{{ route('admin.export', request()->query()) }}"
    class="btn btn-export">
    エクスポート
      </a>

      <div class="admin-pagination">
        {{-- 検索条件を保持したままページ送り --}}
        {{ $contacts->appends(request()->query())->links('vendor.pagination.admin') }}

      </div>
    </div>

    <div class="admin-table-wrap">
      <table class="admin-table">
        <thead>
          <tr>
            <th>お名前</th>
            <th>性別</th>
            <th>メールアドレス</th>
            <th>お問い合わせの種類</th>
            <th class="th-action"></th>
          </tr>
        </thead>

        <tbody>
          @forelse ($contacts as $contact)
            <tr>
              <td>{{ $contact->last_name }} {{ $contact->first_name }}</td>

              <td>
                @if ($contact->gender == 1)
                  男性
                @elseif ($contact->gender == 2)
                  女性
                @else
                  その他
                @endif
              </td>

              <td>{{ $contact->email }}</td>

              <td>{{ optional($contact->category)->content }}</td>

              <td class="td-action">
                <button
                  type="button"
                  class="btn btn-detail js-open-modal"
                  data-id="{{ $contact->id }}"
                  data-name="{{ $contact->last_name }} {{ $contact->first_name }}"
                  data-gender="@if($contact->gender==1)男性@elseif($contact->gender==2)女性@elseその他@endif"
                  data-email="{{ $contact->email }}"
                  data-tel="{{ $contact->tel }}"
                  data-address="{{ $contact->address }}"
                  data-building="{{ $contact->building }}"
                  data-category="{{ optional($contact->category)->content }}"
                  data-detail="{{ $contact->detail }}">
                    詳細
                </button>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="empty">該当するデータがありません</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </main>
</div>

{{-- モーダル（最初は非表示） --}}
<div class="modal-overlay js-modal-overlay" aria-hidden="true">
  <div class="modal-card" role="dialog" aria-modal="true">
    <button type="button" class="modal-close js-close-modal">×</button>

    <div class="modal-body">
      <div class="modal-row">
        <div class="modal-label">お名前</div>
        <div class="modal-value js-m-name"></div>
      </div>

      <div class="modal-row">
        <div class="modal-label">性別</div>
        <div class="modal-value js-m-gender"></div>
      </div>

      <div class="modal-row">
        <div class="modal-label">メールアドレス</div>
        <div class="modal-value js-m-email"></div>
      </div>

      <div class="modal-row">
        <div class="modal-label">電話番号</div>
        <div class="modal-value js-m-tel"></div>
      </div>

      <div class="modal-row">
        <div class="modal-label">住所</div>
        <div class="modal-value js-m-address"></div>
      </div>

      <div class="modal-row">
        <div class="modal-label">建物名</div>
        <div class="modal-value js-m-building"></div>
      </div>

      <div class="modal-row">
        <div class="modal-label">お問い合わせの種類</div>
        <div class="modal-value js-m-category"></div>
      </div>

      <div class="modal-row modal-row--top">
        <div class="modal-label">お問い合わせ内容</div>
        <div class="modal-value js-m-detail"></div>
      </div>

      {{-- 削除フォーム（ここにID差し込み） --}}
      <form method="POST" class="modal-actions js-delete-form">
        @csrf
        @method('DELETE')
        <button type="submit" class="modal-delete">削除</button>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const overlay = document.querySelector('.js-modal-overlay');
  const closeBtn = document.querySelector('.js-close-modal');

  const setText = (selector, text) => {
    const el = document.querySelector(selector);
    if (el) el.textContent = text ?? '';
  };

  const deleteForm = document.querySelector('.js-delete-form');

  const openModal = (btn) => {
    setText('.js-m-name', btn.dataset.name);
    setText('.js-m-gender', btn.dataset.gender);
    setText('.js-m-email', btn.dataset.email);
    setText('.js-m-tel', btn.dataset.tel);
    setText('.js-m-address', btn.dataset.address);
    setText('.js-m-building', btn.dataset.building);
    setText('.js-m-category', btn.dataset.category);
    setText('.js-m-detail', btn.dataset.detail);

    // 削除URLを差し込み（/delete/{id}）
    deleteForm.setAttribute('action', `/delete/${btn.dataset.id}`);

    overlay.classList.add('is-open');
    overlay.setAttribute('aria-hidden', 'false');
  };

  const closeModal = () => {
    overlay.classList.remove('is-open');
    overlay.setAttribute('aria-hidden', 'true');
  };

  document.querySelectorAll('.js-open-modal').forEach(btn => {
    btn.addEventListener('click', () => openModal(btn));
  });

  closeBtn.addEventListener('click', closeModal);

  // 背景クリックで閉じる
  overlay.addEventListener('click', (e) => {
    if (e.target === overlay) closeModal();
  });

  // ESCで閉じる
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeModal();
  });
});
</script>

@endsection
