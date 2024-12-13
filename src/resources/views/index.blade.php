@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')

<div class="product-page__header">
    <h2 class="product-page__header-title">商品一覧</h2>
    <div class="product-page__header-button">
        <form class="product-page__add-button" action="/products/register" method="get">
            @csrf
            <button>+ 商品を追加</button>
        </form>
</div>
<div class="product-page">
    <div class="product-page__search">
        <form action="" method="get">
            @csrf
            <input type="text" name="text" placeholder="商品名で検索" />
        <button>検索</button>
        </form>

        <h3>価格順で表示</h3>
        <select>
            <option value="hight">高い順に表示</option>
            <option value="low">低い順に表示</option>
        </select>
        <div class="sort-tags">
        <!--ifをいれる-->
            <div class="sort-tags__hight">
                高い順に表示 <span class="close" onclick="resetSort()">×</span>
            </div>
        <!--elseifをいれる-->
            <div class="sort-tags__low">
                低い順に表示 <span class="close" onclick="resetSort()">×</span>
            </div>
        <!--endifをいれる-->
        </div>
    <div class="product-page__list">
        <ul>
            <!--foreachをつかう？？-->
            <li></li>
        </ul>
    </div>
</div>
@endsection