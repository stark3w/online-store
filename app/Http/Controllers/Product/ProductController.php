<?php

namespace App\Http\Controllers\Catalog;



use App\Http\Controllers\Product\BaseController;
use App\Http\Requests\Product\CreateRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index($catalog_slug)
    {
        $data = $this->service->index($catalog_slug);

        return view('products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Product::class);

        $data = $this->service->create();

        return view('products.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request)
    {
        Gate::authorize('create', Product::class);

        $data = $request->validated();
        $product = $this->service->store($data);


        return redirect()->route('products.show', [
            'product_slug' => $product->slug,
            'catalog_slug' => $product->catalog->slug,
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show($catalog_slug, $product_slug)
    {
        $data = $this->service->show($catalog_slug, $product_slug);

        return view('products.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        Gate::authorize('update', Product::class);

        $data = $this->service->edit($id);

        return view('products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Product $product)
    {
        Gate::authorize('update', Product::class);

        $data = $request->validated();
        $product = $this->service->update($data, $product);

        return redirect()->route('products.show',[
            'product_slug' => $product->slug,
            'catalog_slug' => $product->catalog->slug,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('delete', Product::class);

        $catalog_slug = $this->service->destroy($id);

        return redirect()->route('products.index', ['catalog_slug' => $catalog_slug]);
    }
}
