@extends('layouts.app')
@section('title','Product - iCATCH')

@section('content')
    @vite('resources/js/filters/catalogFilter.js')
    <div class="container py-4">
        <div class="row justify-content-center">
            @include('products.partials.filters')

            @include('products.partials.products-list')
        </div>
    </div>
@endsection

