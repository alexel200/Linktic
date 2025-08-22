<?php

namespace Src\products\infrastructure;


use Illuminate\Http\Request;
use Src\products\domain\exceptions\BadRequestException;


class Validator
{
    private array $validator = [];
    private array $missing_fields = [];

    public function __construct(array $validator)
    {
        $this->validator = $validator;
    }

    public function validate(Request $request): void
    {
        $data = $request->all();
        $this->checkMissingFields($data);

        $this->checkCorrectValue($data);
    }

    private function checkMissingFields(array $data): void
    {
        $tmp_missing_fields = array_diff_key($this->validator, $data);
        foreach ($tmp_missing_fields as $key => $value) {
            if($this->validator[$key]['required']){
                $this->missing_fields[] = $key;
            }
        }

        if(count($this->missing_fields) > 0){
            throw new BadRequestException("Missing fields: " . implode(', ', $this->missing_fields));
        }
    }

    public function checkCorrectValue(array $data): void
    {
        foreach ($data as $key => $value) {
            $validator_row = $this->validator[$key];
            if($validator_row){
                $this->checkFieldType($key, $value, $validator_row);
                $this->checkMinimumLength($key, $value, $validator_row);
                $this->checkMinimumValue($key, $value, $validator_row);
                $this->checkDateFormat($key, $value, $validator_row);
            }
        }
    }

    private function checkFieldType(string $field, mixed $value, array $validator_row):void{
        if(gettype($value) !== $validator_row['type'] && !str_contains(gettype($value), $validator_row['type'])){
            throw new BadRequestException( sprintf("Field \"%s\" contains wrong value, the expected value should be %s", $field, $validator_row['type']));
        }
    }

    private function checkMinimumLength(string $field, mixed $value, array $validator_row):void{
        if($validator_row['type'] === 'string' && isset($validator_row['min_length']) && strlen($value) < $validator_row['min_length']){
            throw new BadRequestException( sprintf("Field \"%s\" must content at least %d characters", $field, $validator_row['min_length']));
        }
    }

    private function checkMinimumValue(string $field, mixed $value, array $validator_row):void{
        if($validator_row['type'] === 'int' && isset($validator_row['min_value']) && $value < $validator_row['min_value']){
            throw new BadRequestException( sprintf("Field \"%s\" must content at least %d characters", $field, $validator_row['min_value']));
        }
    }

    private function checkDateFormat(string $field, mixed $value, array $validator_row):void{
        if($validator_row['type'] === 'string' && isset($validator_row['format']) && $validator_row['format'] == 'date'){
            $pattern = '/\d{4}-\d{2}-\d{2}$/';

            if (!preg_match($pattern, $value)) {
                throw new BadRequestException(sprintf("The field \"%s\" does not contain a valid format yyyy-mm-dd", $field));
            }

            [$year, $month, $day] = explode('-', $value);
            if(!checkdate((int) $month, (int) $day, (int) $year)){
                throw new BadRequestException(sprintf("The field \"%s\" is not a valid date format", $field));
            }
        }
    }
}
