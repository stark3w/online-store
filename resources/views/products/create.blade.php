@extends('layouts.app')

@section('title', 'Создать пост')

@section('content')
    <div class="container py-4">
        <h1 class="mb-4">Добавить новый товар</h1>

        <form action="{{ route('products.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Имя товара</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Описание</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="catalog">Каталог</label>
                <select class="form-control mb-3" id="catalog" name="catalog_id">
                    <option value="" selected disabled>Выберите категорию</option>
                    @foreach($catalogs as $catalog)
                        <option
                            {{ old('catalog_id') == $catalog->id ? 'selected' : '' }}
                            value="{{ $catalog->id }}" >{{ $catalog->name }}</option>
                    @endforeach

                </select>
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
                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" step="0.01" required>
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
                            {{old('tags') != null && in_array($tag->id, old('tags')) ? 'selected' : ''}}
                            value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>
@endsection
