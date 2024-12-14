@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/product.css') }}" />
@endsection

@section('content')

<div class="detail-page">
    <div class="product-content">
        <div class="product-content__image">
            <img src="" alt="商品画像"></br>
            <button>ファイルを選択</button>
        </div>

        <div class="product-content__detail">
            <label>商品名</label></br>
            <input type="text" name="name" value="変数で代入" /></br>
            <label>値段</label></br>
            <input type="text" name="price" value="変数で代入" /></br>
            <label>季節</label></br>
            <div class="radio-group">
            <input type="radio" name="spring"/>春
            <input type="radio" name="summer"/>夏
            <input type="radio" name="autum"/>秋
            <input type="radio" name="winter"/>冬
            </div>
        </div>
    </div>
    <div class="product-detail">
        <label>商品説明</label></br>
        <textarea name="name"  rows="4" cols="40" value="変数で代入"></textarea>
    </div>
</div>

<div class="detail-page__button">
    <a class="return-button" href="/products">戻る</a>
    <form action="" method="">
        @csrf
        <button class="save-button">変更を保存</button>
    </form>
    <form action="" method="post">
        <!--@method('DELETE')-->
        @csrf
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <button class="delete-button" type="submit" onclick="return confirm('本当に削除しますか？');">
        <i class="fas fa-trash custom-icon" aria-hidden="true"></i>
        </button>
    </form>
</div>
</div>

@endsection