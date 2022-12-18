<?php

namespace Modules\Products\Services\ProductService;

use Illuminate\Http\Request;

interface IProductService
{
    public function getProductsDatatable(Request $request);
    public function storeProduct($request);
    public function getProductDetail(int $productId);
    public function updateProduct($request, int $productId);
    public function destroyProduct(int $productId);
}