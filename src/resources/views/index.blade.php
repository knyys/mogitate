@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')

<div class="product-list-page">
<div class="product-page__header">
    <h2 class="product-page__header-title">商品一覧</h2>
    <div class="product-page__header-button">
        <a href="/products/register">+ 商品を追加</a>
    </div>
</div>

<div class="product-page">
    <div class="product-page__search-form">
        <form class="search-form" action="{{ route('products_search') }}" method="get">
            <input type="text" name="text" placeholder="商品名で検索" value="{{ request('text') }}" />
            <button>検索</button>

            <div class="sort-form">
                <h3 class="sort-form__header">価格順で表示</h3>
                <select class="sort-form__select" name="sort" onchange="this.form.submit()">
                    <option value="default">価格で並べ替え</option>
                    <option value="hight" {{ request('sort') === 'hight' ? 'selected' : '' }}>高い順に表示</option>
                    <option value="low" {{ request('sort') === 'low' ? 'selected' : '' }}>低い順に表示</option>
                </select>

                @if (request('sort') === 'hight' || request('sort') === 'low')
                    <div class="sort-tags">
                        @if (request('sort') === 'hight')
                            <div class="sort-tags__hight">高い順に表示</div>
                        @elseif (request('sort') === 'low')
                            <div class="sort-tags__low">低い順に表示</div>
                        @endif
                        <button type="button" class="close" onclick="resetSort()">×</button>
                    </div>
                @endif
            </div>
        </form>
    </div>

    <div class="product-page__list">
        @forelse ($products as $product)
            <ul class="product-card">
                <li>
                    <a href="{{ route('product', ['productId' => $product->id]) }}" class="product-link">
                        <img class="product-img" src="{{ asset($product->image) }}" alt="{{ $product->name }}" />
                        <div class="product-tag">
                            <span class="product-tag__name">{{ $product->name }}</span>
                            <span class="product-tag__price">¥{{ number_format($product->price) }}</span>
                        </div>
                    </a>
                </li>
            </ul>
        @empty
            <p>該当する商品が見つかりませんでした。</p>
        @endforelse
    </div>

    {{-- ページネーション --}}
    <div class="pagination">
    @if ($products->lastPage() > 1)
        <div class="pagination-numbers">
            @if ($products->onFirstPage())
                <span class="page-link disabled">&lt;</span>
            @else
                <a class="page-link" href="{{ $products->previousPageUrl() }}{{ request()->getQueryString() ? '&'.http_build_query(request()->except('page')) : '' }}">&lt;</a>
            @endif

            @for ($i = 1; $i <= $products->lastPage(); $i++)
                @if ($i == $products->currentPage())
                    <span class="page-number active">{{ $i }}</span>
                @else
                    <a class="page-number" href="{{ $products->url($i) }}{{ request()->getQueryString() ? '&'.http_build_query(request()->except('page')) : '' }}">{{ $i }}</a>
                @endif
            @endfor

            @if ($products->hasMorePages())
                <a class="page-link" href="{{ $products->nextPageUrl() }}{{ request()->getQueryString() ? '&'.http_build_query(request()->except('page')) : '' }}">&gt;</a>
            @else
                <span class="page-link disabled">&gt;</span>
            @endif
        </div>
    @endif
    </div>
</div>
</div>
{{-- 並び替えリセットボタン用スクリプト --}}
<script>
    function resetSort() {
        const url = new URL(window.location.href);
        url.searchParams.delete('sort');
        window.location.href = url.toString();
    }
</script>

@endsection
