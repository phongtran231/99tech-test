<?php

namespace Modules\Products\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Products\Http\Requests\ProductStoreRequest;
use Modules\Products\Http\Requests\ProductUpdateRequest;
use Modules\Products\Services\ProductService\IProductService;

class ProductsController extends Controller
{

    public function __construct(
        private IProductService $productService
    )
    {
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->productService->getProductsDatatable($request);
        }
        return view('products::index');
    }

    public function create()
    {
        return view('products::create');
    }

    public function store(ProductStoreRequest $request)
    {
        $result = $this->productService->storeProduct($request);
        if ($result['error']) {
            return redirect()->back()->withErrors(['error' => $result['message']]);
        }

        return redirect()->route('product.edit', ['product' => $result['data']->id]);
    }

    public function edit(int $id)
    {
        $result = $this->productService->getProductDetail($id);
        if ($result['error']) {
            abort(404);
        }

        return view('products::edit', ['product' => $result['data']]);
    }

    public function update(ProductUpdateRequest $request, $id)
    {
        $result = $this->productService->updateProduct($request, $id);
        if ($result['error']) {
            abort($result['code']);
        }
        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->productService->destroyProduct($id);

        return response('', 204);
    }
}
