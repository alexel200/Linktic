<?php

namespace Tests\Unit\products\infrastructure;

use PHPUnit\Framework\TestCase;
use Illuminate\Http\Request;
use Src\products\infrastructure\Validator;
use Src\products\domain\exceptions\BadRequestException;

class ValidatorTest extends TestCase
{
    private function getValidatorConfig(): array
    {
        return [
            "id" => ['required' => false, 'type' => 'int'],
            "name" => ["required" => true, "type" => "string", "min_length" => 3],
            "description" => ["required" => false, "type" => "string"],
            "price" => ["required" => true, "type" => "double", "min_value" => 0],
            "stock" => ["required" => true, "type" => "int", "min_value" => 0],
        ];
    }

    private function createRequest(array $data): Request
    {
        return Request::create('/fake-url', 'POST', $data);
    }

    public function test_valid_data_passes_validation()
    {
        $request = $this->createRequest([
            "id" => 1,
            "name" => "Laptop",
            "description" => "High-end device",
            "price" => 999.99,
            "stock" => 10
        ]);

        $validator = new Validator($this->getValidatorConfig());

        $this->expectNotToPerformAssertions();
        $validator->validate($request);
    }

    public function test_missing_required_field_throws_exception()
    {
        $request = $this->createRequest([
            "id" => 1,
            "description" => "Missing name and price",
            "stock" => 5
        ]);

        $validator = new Validator($this->getValidatorConfig());

        $this->expectException(BadRequestException::class);
        $this->expectExceptionMessage("Missing fields: name, price");

        $validator->validate($request);
    }

    public function test_invalid_type_throws_exception()
    {
        $request = $this->createRequest([
            "name" => "Laptop",
            "price" => "not-a-double",
            "stock" => 10
        ]);

        $validator = new Validator($this->getValidatorConfig());

        $this->expectException(BadRequestException::class);
        $this->expectExceptionMessage('Field "price" contains wrong value');

        $validator->validate($request);
    }

    public function test_min_length_violation_throws_exception()
    {
        $request = $this->createRequest([
            "name" => "PC",
            "price" => 100.0,
            "stock" => 5
        ]);

        $validator = new Validator($this->getValidatorConfig());

        $this->expectException(BadRequestException::class);
        $this->expectExceptionMessage('Field "name" must content at least 3 characters');

        $validator->validate($request);
    }

    public function test_stock_min_value_violation_throws_exception()
    {
        $request = $this->createRequest([
            "name" => "Laptop",
            "price" => 100.0,
            "stock" => -5
        ]);

        $validator = new Validator($this->getValidatorConfig());

        $this->expectException(BadRequestException::class);
        $this->expectExceptionMessage('Field "stock" must content at least 0 characters');

        $validator->validate($request);
    }
}
