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
            <div class="alert">
                @if($errors->has('image'))
                <ul>
                    @foreach($errors->get('image') as $error)
                     <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>

        <div class="product-content__detail">
            <label>商品名</label></br>
            <input type="text" name="name" value="変数で代入" /></br>
                <div class="alert">
                    @if($errors->has('product_name'))
                    <ul>
                        @foreach($errors->get('product_name') as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div></br>
            <label>値段</label></br>
            <input type="text" name="price" value="変数で代入" /></br>
                <div class="alert">
                    @if($errors->has('price'))
                    <ul>
                        @foreach($errors->get('price') as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>

            <label>季節</label></br>
            <div class="checkbox-group">
            <input type="checkbox" name="season_name[]"/>春
            <input type="checkbox" name="season_name[]"/>夏
            <input type="checkbox" name="season_name[]"/>秋
            <input type="checkbox" name="season_name[]"/>冬
            </div>
                <div class="alert">
                    @if($errors->has('season_name'))
                    <ul>
                        @foreach($errors->get('season_name') as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>

        </div>
    </div>
    <div class="product-description">
        <label>商品説明</label></br>
        <textarea name="description"  rows="4" cols="40" value="変数で代入"></textarea>
            <div class="alert">
                @if($errors->has('description'))
                <ul>
                    @foreach($errors->get('description') as $error)
                     <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
            </div>

    </div>
</div>

<div class="detail-page__button">
    <a class="return-button" href="/products">戻る</a>
    <form action="/products/1" method="post">
        @csrf
        <button class="update-button">変更を保存</button>
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