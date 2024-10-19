@extends('layouts.app')

@section('title', 'Создать пост')

@section('content')
    <div class="container py-4">
        <h1 class="mb-4">Редактировать товар</h1>

        <form action="{{ route('products.update', $product->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Имя товара</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $product['name'] }}" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Описание</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required>{{ $product['description'] }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="catalog_id" class="form-label">Каталог</label>
                <select class="form-select @error('catalog_id') is-invalid @enderror" id="catalog_id" name="catalog_id" required>
                    @foreach($catalogs as $catalog)
                        <option value="{{ $catalog->id }}">{{ $catalog->name }}</option>
                    @endforeach
                </select>
                @error('catalog_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="flavor">Аромат</label>
                <select class="form-control mb-3" id="flavor" name="flavor_id">
                    <option value="" selected disabled>Выберите аромат</option>
                    @foreach($flavors as $flavor)
                        <option
                            {{ old('flavor_id') == $flavor->id ? 'selected' : '' }}
                            value="{{ $flavor->id }}" >{{ $flavor->name }}</option>
                    @endforeach

                </select>
            </div>

            <div class="mb-3">
                <label for="grade">Сорт</label>
                <select class="form-control mb-3" id="grade" name="grade_id">
                    <option value="" selected disabled>Выберите Сорт</option>
                    @foreach($grades as $grade)
                        <option
                            {{ old('grade_id') == $grade->id ? 'selected' : '' }}
                            value="{{ $grade->id }}" >{{ $grade->name }}</option>
                    @endforeach

                </select>
            </div>

            <div class="mb-3">
                <label for="brand">Марка</label>
                <select class="form-control mb-3" id="brand" name="brand_id">
                    <option value="" selected disabled>Выберите марку</option>
                    @foreach($brands as $brand)
                        <option
                            {{ old('brand_id') == $brand->id ? 'selected' : '' }}
                            value="{{ $brand->id }}" >{{ $brand->name }}</option>
                    @endforeach

                </select>
            </div>


            <div class="mb-3">
                <label for="image" class="form-label">Изображение</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Цена</label>
                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ $product['price'] }}" step="0.01" required>
                @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="tags">Tags</label>
                <select
                    multiple class="form-select" id="tags" name="tags[]">
                    @foreach($tags as $tag)
                   <option
                        @foreach($product->tags as $productTag)
                            {{ $tag->id === $productTag->id ? 'selected' : '' }}
                        @endforeach
                        value="{{ $tag->id }}"> {{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
@endsection
