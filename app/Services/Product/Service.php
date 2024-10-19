<?php

namespace App\Services\Product;


use App\Models\Brand;
use App\Models\Catalog;
use App\Models\Flavor;
use App\Models\Grade;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;


class Service
{
    public function index(string $catalog_slug)
    {
        $catalog = Catalog::where('slug', $catalog_slug)->firstOrFail();
        $products = Product::where('catalog_id', $catalog->id)->paginate(12);

        $flavors = Flavor::withCount(['products' => function ($query) use ($catalog) {
            $query->where('catalog_id', $catalog->id);
        }])->get();
        $brands = Brand::withCount(['products' => function ($query) use ($catalog) {
            $query->where('catalog_id', $catalog->id);
        }])->get();

        $grades = Grade::withCount(['products' => function ($query) use ($catalog) {
            $query->where('catalog_id', $catalog->id);
        }])->get();

        return compact('products', 'catalog', 'flavors', 'brands', 'grades');
    }

    public function create()
    {
        $catalogs = Catalog::all();
        $tags = Tag::all();
        $flavors = Flavor::all();
        $grades = Grade::all();
        $brands = Brand::all();

        return compact('catalogs', 'tags', 'flavors', 'grades', 'brands');
    }

    public function store($data)
    {
        return DB::transaction(function () use ($data) {
            $tags = $data['tags'];
            unset($data['tags']);

            $product = Product::create($data);
            $product->tags()->sync($tags);

            return $product;
        });

    }

    public function show($catalog_slug, $product_slug)
    {
        $catalog = Catalog::where('slug', $catalog_slug)->firstOrFail();
        $product = Product::where('slug', $product_slug)->firstOrFail();

        return compact('product', 'catalog');
    }

    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $catalogs = Catalog::all();
        $tags = Tag::all();

        return compact('product', 'catalogs', 'tags');
    }

    public function update($data, $product)
    {
        DB::transaction(function () use ($data, $product) {
            $tags = $data['tags'];
            unset($data['tags']);

            $product->update($data);
            $product->tags()->sync($tags);

            return $product;
        });

    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $catalog = Catalog::findOrFail($product->catalog_id);

        $product->delete();

        return $catalog->slug;
    }


}
