@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/product.css') }}" />
@endsection

@section('content')

<div class="detail-page">
    <div class="product-content">
        <form class="product-content__image" action="/products" method="post" enctype="multipart/form-data">
            @csrf
            <img src="{{ asset($product->image) }}" alt="商品画像"></br>
            <label class="product-content__image-label" for="image">ファイルを選択</label>
            <input type="file" name='image'>
            <span> {{ basename($product->image) }}</span>

            <div class="alert">
                @if($errors->has('image'))
                <ul>
                    @foreach($errors->get('image') as $error)
                     <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
            </div>
        </form>

        <div class="product-content__detail">
            <label>商品名</label>
            <input type="text" name="name" value="{{ $product->name }}" />
                <div class="alert">
                    @if($errors->has('product_name'))
                    <ul>
                        @foreach($errors->get('product_name') as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            <label>値段</label>
            <input type="text" name="price" value="{{ $product->price }}" />
                <div class="alert">
                    @if($errors->has('price'))
                    <ul>
                        @foreach($errors->get('price') as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>

            <label>季節</label>
            <div class="checkbox-group">
                @foreach($seasons as $seasonId => $seasonName)
                    <input type="checkbox" name="season_name[]" value="{{ $seasonId }}" 
                        @if(in_array($seasonId, old('season_name', $seasonIds))) checked @endif />
                    {{ $seasonName }}
                @endforeach
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
        <label>商品説明</label>
        <textarea name="description" rows="6" cols="40">{{ $product->description }}</textarea>
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


    <div class="detail-page__button">
        <a class="return-button" href="/products">戻る</a>
        <form action="/products/{{ $product->id }}/update" method="post">
            @method('PATCH')
            @csrf
            <input type="hidden" name="id" value="{{ $product['id'] }}">
            <button class="update-button" type="submit">変更を保存</button>
        </form>
        <form action ="/products/{{ $product->id }}/delete" method="post">
            @method('DELETE')
            @csrf
            <input type="hidden" name="id" value="{{ $product['id'] }}">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
            <button class="delete-button" type="submit" onclick="return confirm('本当に削除しますか？');">
                <i class="fas fa-trash custom-icon" aria-hidden="true"></i>
            </button>
        </form>

    </div>
</div>
@endsection