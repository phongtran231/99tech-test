<?php

namespace Modules\Products\Services\ProductService;

use App\Cores\Service\AbstractService;
use Illuminate\Http\Request;
use Modules\Products\Facades\UploadProductImage;
use Modules\Products\Repositories\ProductImageRepository\IProductImageRepository;
use Modules\Products\Repositories\ProductRepository\IProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ProductService extends AbstractService implements IProductService
{

    public function __construct(
        private IProductRepository      $productRepository,
        private IProductImageRepository $productImageRepository
    )
    {
    }

    public function getProductsDatatable(Request $request)
    {
        $data = $this->productRepository->makeModel()->select(['id', 'name', 'description',
            'stock_quantity', 'price'])
            ->orderBy('id', 'DESC');

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = '<a href="' . route('product.edit', ['product' => $row->id]) . '" class="edit btn btn-success btn-sm">Edit</a>
                             <a href="javascript:void(0)" onclick="destroyProduct(\'' . $row->id . '\')" class="delete btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function storeProduct($request)
    {
        try {
            $product = $this->productRepository->create(
                $request->only('name', 'description', 'stock_quantity', 'price')
            );

            if ($request->hasFile('images')) {
                $dataList = [];
                foreach ($request->file('images') as $file) {
                    $uploadImage = UploadProductImage::handleUpload($file);
                    $dataList[] = [
                        'name' => $file->getClientOriginalName(),
                        'file' => $uploadImage,
                        'product_id' => $product->id
                    ];

                }
                $this->productImageRepository->createMany($dataList);
            }
            return $this->responseData([
                'error' => false,
                'data' => $product,
            ]);
        } catch (\Exception $e) {
            logger()->error('store product error', [$e->getMessage()]);
            return $this->responseData([
                'error' => true,
                'message' => 'Store product error',
            ]);
        }
    }

    public function getProductDetail(int $productId)
    {
        $product = $this->productRepository
            ->with([
                'images' => function ($query) {
                    $query->select(['id', 'product_id', 'file', 'name']);
                }
            ])
            ->firstWhere([
                'id' => $productId,
            ]);
        return $this->responseData([
            'error' => false,
            'data' => $product,
        ]);
    }

    public function updateProduct($request, int $productId)
    {
        $product = $this->productRepository
            ->firstWhere(['id' => $productId], ['id']);
        if (!$product) {
            return $this->responseData([
                'error' => true,
            ], Response::HTTP_NOT_FOUND);
        }
        $product = $this->productRepository->update(
            $request->only(['name', 'description', 'stock_quantity', 'price']),
            $productId
        );

        if ($request->hasFile('images')) {
            $dataList = [];
            foreach ($request->file('images') as $file) {
                $uploadImage = UploadProductImage::handleUpload($file);
                $dataList[] = [
                    'name' => $file->getClientOriginalName(),
                    'file' => $uploadImage,
                    'product_id' => $product->id
                ];

            }
            $this->productImageRepository->createMany($dataList);
        }
        return $this->responseData([
            'error' => false,
            'data' => $product,
        ]);
    }

    public function destroyProduct(int $productId)
    {
        return $this->productRepository->delete($productId);
    }
}