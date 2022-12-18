<?php

namespace Modules\Products\Repositories\ProductImageRepository;

use App\Cores\Repository\AbstractRepository;
use Modules\Products\Models\ProductImage;

class ProductImageRepository extends AbstractRepository implements IProductImageRepository
{
    public function model()
    {
        return ProductImage::class;
    }
}