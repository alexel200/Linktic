<?php

namespace Src\products\infrastructure\repositories;

use App\Models\Product as EloquentProduct;
use Illuminate\Pagination\LengthAwarePaginator;
use Src\products\domain\contracts\ProductRepositoryInterface;
use Src\products\domain\entity\Product;
use Src\products\infrastructure\mappers\ProductMapper;

class EloquentProductRepository implements ProductRepositoryInterface
{

    public function createProduct(Product $product): void
    {
        EloquentProduct::create(["name" => $product->getName()->value(), "description" => $product->getDescription(), "price" => $product->getPrice()->value(), "stock" => $product->getStock()->value()]);
    }

    public function getProducts(): array
    {
        return EloquentProduct::all()
            ->map(function (EloquentProduct $eloquentProduct) {
               return ProductMapper::fromEloquent($eloquentProduct);
            })->toArray();
    }

    public function getPaginatedProducts(int $page, int $perPage): LengthAwarePaginator
    {
        $paginator = EloquentProduct::query()->paginate($perPage, ['*'], 'page', $page);

        $mappedItems = $paginator->getCollection()->map(function (EloquentProduct $eloquentProduct) {
            return ProductMapper::fromEloquent($eloquentProduct)->jsonSerialize();
        });

        return new LengthAwarePaginator(
            $mappedItems,
            $paginator->total(),
            $paginator->perPage(),
            $paginator->currentPage(),
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }


    public function getProductById(int $id): ?Product
    {
        $eloquentProduct = EloquentProduct::find($id);
        if (!$eloquentProduct) {
            return null;
        }
        return ProductMapper::fromEloquent($eloquentProduct);
    }

    public function updateProduct(Product $product): void
    {
        $eloquent_product = EloquentProduct::find($product->getId());
        $eloquent_product->update((["name" => $product->getName()->value(), "description" => $product->getDescription(), "price" => $product->getPrice()->value(), "stock" => $product->getStock()->value()]));
    }

    public function deleteProduct(int $id): void
    {
        $deleted = EloquentProduct::destroy($id);
        if ($deleted === 0) {
            throw new \Exception("Ocurrio un error al eliminar el producto.", 500);
        }
    }
}
