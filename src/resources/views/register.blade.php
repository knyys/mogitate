@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}" />
@endsection

@section('content')

<div class="register-page">
    <h2 class="register-page__header">
        商品登録
    </h2>
    <div class="register-page__content">
        <label>商品名</label>
        <input type="text" name="name" placeholder="商品名を入力" />
        <label>値段</label>
        <input type="text" name="price" placeholder="値段を入力" />
        <label>商品画像</label>
        <!--画像を選択できるようにする-->
        <label>季節</label>
        <input type="radio" name="spring"/>春
        <input type="radio" name="summer"/>夏
        <input type="radio" name="autum"/>秋
        <input type="radio" name="winter"/>冬
        <label>商品説明</label>
        <textarea name="text" rows="4" cols="40"></textarea>
    </div>
    <div class="register-page__button">
        <a href="/products">戻る</a>
        <form action="" method="post">
            @csrf
            <button>登録</button>
        </form>
    </div>
</div>
@endsection