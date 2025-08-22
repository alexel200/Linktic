<?php

namespace Src\inventory\infrastructure\http\clients;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use SebastianBergmann\Invoker\TimeoutException;

use Src\inventory\application\Dtos\ProductDto;
use Src\inventory\domain\exceptions\RequestException as DomainRequestException;
use \Src\inventory\domain\exceptions\TimeoutException as DomainTimeoutException;
use \Src\inventory\domain\exceptions\ConnectionException as DomainConnectionException;

class ProductsClient
{
    protected string $baseUrl;
    protected string $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.products.base_url');
        $this->apiKey = config('services.products.api_key');
    }

    public function getProducts(): array
    {
        try {
            $response = Http::withHeaders([
                'X-API-KEY' => $this->apiKey
            ])
                ->timeout(15)
                ->retry(3, 2000)
                ->get("{$this->baseUrl}/api/products");

            if ($response->successful()) {
                $result = $response->json()['data'] ?? [];

                return array_map(function ($product) {
                    return new ProductDto($product);
                }, $result);

            }
        }catch(ConnectionException $e){
            throw new DomainConnectionException($e->getMessage(), $e->getCode());
        }catch (TimeoutException $e){
            throw new DomainTimeoutException($e->getMessage(), $e->getCode());
        }catch (RequestException $e) {
            throw new DomainRequestException("Error al obtener el producto del servicio.", $e->getCode());
        }


        return [];
    }
}






