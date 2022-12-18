<?php

namespace Modules\Products\Repositories\ProductRepository;

use App\Cores\Repository\AbstractRepository;
use Modules\Products\Models\Product;

class ProductRepository extends AbstractRepository implements IProductRepository
{
    public function model()
    {
        return Product::class;
    }
}