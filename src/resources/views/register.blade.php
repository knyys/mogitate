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
        <span class="register-page__label--required">必須</span></br>
        <input type="text" name="product_name" placeholder="商品名を入力" /></br>
            <div class="alert">
                @if($errors->has('product_name'))
                <ul>
                    @foreach($errors->get('product_name') as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
            </div></br>

        <label>値段</label>
        <span class="register-page__label--required">必須</span></br>
        <input type="text" name="price" placeholder="値段を入力" /></br>
            <div class="alert">
                @if($errors->has('price'))
                <ul>
                    @foreach($errors->get('price') as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
            </div></br>

        <label>商品画像</label>
        <span class="register-page__label--required">必須</span></br>
        <!--画像を選択できるようにする-->
            <div class="alert">
                @if($errors->has('image'))
                <ul>
                    @foreach($errors->get('image') as $error)
                     <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
            </div>

        <label>季節</label>
        <span class="register-page__label--required">必須</span></br>
            <div class="checkbox-group">
            <input type="checkbox" name="season_name[]"/>春
            <input type="checkbox" name="season_name[]"/>夏
            <input type="checkbox" name="season_name[]"/>秋
            <input type="checkbox" name="season_name[]"/>冬
            </div></br>
            <div class="alert">
                @if($errors->has('season_name'))
                <ul>
                    @foreach($errors->get('season_name') as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
            </div></br>

        <label>商品説明</label>
        <span class="register-page__label--required">必須</span></br>
        <textarea name="description" rows="6" cols="40"></textarea>
            <div class="alert">
                @if($errors->has('description'))
                <ul>
                    @foreach($errors->get('description') as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
            </div></br>

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