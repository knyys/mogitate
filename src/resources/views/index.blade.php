@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
<div class="product-page__header">
    <h2 class="product-page__header-title">商品一覧</h2>
    <div class="product-page__header-button">
        <a href="/products/register">
            + 商品を追加
        </a>
    </div>
</div>

<div class="product-page">
    <div class="product-page__search-form">
        <form class="search-form" action="/products/search" method="get">
            <input type="text" name="text" placeholder="商品名で検索" />
            <button>検索</button>
        
            <div class="sort-form">
                <h3 class="sort-form__header">価格順で表示</h3>
                <select class="sort-form__select" name="sort" onchange="this.form.submit()">
                    <option value="default">価格で並べ替え</option>
                    <option value="hight">高い順に表示</option>
                    <option value="low">低い順に表示</option>
                </select>
                @if ($sortOption === 'hight' || $sortOption === 'low')
                <div class="sort-tags">
                    @if ($sortOption === 'hight')
                        <div class="sort-tags__hight">高い順に表示</div>
                    @elseif ($sortOption === 'low')
                        <div class="sort-tags__low">低い順に表示</div>
                    @endif
                    <button class="close" onclick="resetSort()">×</button>
                </div>
                @endif
            </div>
        </form>
    </div>

    <div class="product-page__list">
        @foreach ($products as $product)
        <ul class="product-card">
            <li>
                <a href="{{ route('product', ['productId' => $product->id]) }}" class="product-link">
                    <img class="product-img" src="{{ asset($product->image) }}" alt="{{ $product->name }}" /><br>
                    <div class="product-tag">
                        <span class="product-tag__name">{{ $product->name }}</span>
                        <span class="product-tag__price">{{ $product->price }}</span>
                    </div>
                </a>
            </li>
        </ul>
        @endforeach
    </div>
</div>
 {{ $products->links() }}
@endsection