@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}" />
@endsection

@section('content')

<div class="register-page">
    <h2 class="register-page__header">
        商品登録
    </h2>
    <form class="register-page" action="{{ route('register') }}" method="post" enctype="multipart/form-data">
        @csrf
    <div class="register-page__content">
        <label>商品名</label>
        <span class="register-page__label--required">必須</span></br>
        <input type="text" name="product_name" placeholder="商品名を入力" value="{{ old('product_name') }}" />
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
        <input type="text" name="price" placeholder="値段を入力" value="{{ old('price') }}" />
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
        <input type="file" name='image' />
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
            <input type="checkbox" name="season_name[]" value="春" {{ in_array('春', old('season_name', [])) ? 'checked' : '' }} />春
            <input type="checkbox" name="season_name[]" value="夏" {{ in_array('夏', old('season_name', [])) ? 'checked' : '' }} />夏
            <input type="checkbox" name="season_name[]" value="秋" {{ in_array('秋', old('season_name', [])) ? 'checked' : '' }} />秋
            <input type="checkbox" name="season_name[]" value="冬" {{ in_array('冬', old('season_name', [])) ? 'checked' : '' }} />冬
        </div>
        <div class="alert">
            @foreach ($errors->get('season_name') as $error)
                <li>{{ $error }}</li>
            @endforeach

            @foreach ($errors->get('season_name.*') as $fieldErrors)
                @foreach ($fieldErrors as $error)
                    <li>{{ $error }}</li>
                @endforeach
            @endforeach
        </div></br>

        <label>商品説明</label>
        <span class="register-page__label--required">必須</span></br>
        <textarea name="description" rows="6" cols="40" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
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
        <button class="register-button" type="submit">登録</button>
    </div>
    </form>
</div>
@endsection