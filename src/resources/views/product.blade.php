@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/product.css') }}" />
@endsection

@section('content')

<div class="detail-page">
    <div class="product-content">

    @if(session('success'))
        <div class="alert--success">
            {{ session('success') }}
        </div>
    @endif
    <form class="content-form" action="/products/{{ $product->id }}/update" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('products_list') }}">商品一覧</a>
                </li>
                <li class="breadcrumb-item">
                    >
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $product->name }}
                </li>
            </ol>
        </nav>

        <div class="product-content__image">
            <img src="{{ asset($product->image ?? 'images/no_image.png') }}" alt="商品画像"></br>
            <label class="product-content__image-label" for="image">ファイルを選択</label>
            <input type="file" id="image" name="image" style="display:none;" />
            <span id="file-name-display">{{ basename($product->image) }}</span>
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
            <label class="detail-label">商品名</label>
            <input type="text" name="product_name" value="{{ old('product_name', $product->name) }}" />
            <div class="alert">
                @if($errors->has('product_name'))
                <ul>
                    @foreach($errors->get('product_name') as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
            </div>

            <label class="detail-label">値段</label>
            <input type="text" name="price" value="{{ old('price', $product->price) }}" />
            <div class="alert">
                @if($errors->has('price'))
                <ul>
                    @foreach($errors->get('price') as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
            </div>

            <label class="detail-label">季節</label>
            <div class="checkbox-group">
            @foreach($seasons as $seasonId => $seasonName)
                <input type="checkbox" name="season_name[]" value="{{ $seasonName }}"
                {{ in_array($seasonName, old('season_name', $product->seasons->pluck('name')->toArray())) ? 'checked' : '' }} />
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

        <div class="product-description">
            <label class="detail-label">商品説明</label>
            <textarea name="description" rows="6" cols="40">{{ old('description', $product->description) }}</textarea>
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
            <button class="update-button" type="submit">変更を保存</button>
        </div>
    </form>
    <!-- 削除フォーム -->
    <form action="/products/{{ $product->id }}/delete" method="post" style="display:inline;">
        @csrf
        @method('DELETE')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <button class="delete-button" type="submit" onclick="return confirm('本当に削除しますか？');">
            <i class="fas fa-trash custom-icon" aria-hidden="true"></i>
        </button>
    </form>
    </div>
</div>

<script>
document.getElementById('image').addEventListener('change', function() {
    const fileName = this.files[0]?.name || '選択されていません';
    document.getElementById('file-name-display').textContent = fileName;
});
</script>
@endsection