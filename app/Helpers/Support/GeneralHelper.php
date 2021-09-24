<?php

namespace App\Helpers\Support;

use App\Models\BaseModel;
use Illuminate\Support\Facades\Schema;

class GeneralHelper
{
    public static function getModelColumns(BaseModel $model): array
    {
        return array_diff(
            Schema::getColumnListing($model->getTable()),
            [
                'id',
                'deleted_at',
                'created_at',
                'updated_at',
            ],
        );
    }

    public static function getClassShortName(object $class): string
    {
        return (new \ReflectionClass($class))->getShortName();
    }

    public static function getModelClassShortName(BaseModel $model): string
    {
        return static::getClassShortName($model);
    }

    public static function formatPrice(float $price): string
    {
        return number_format($price, 2, '.', '\'');
    }

    public static function modelHasColumn(BaseModel $model, string $column): bool
    {
        return $model
            ->getConnection()
                ->getSchemaBuilder()
                    ->hasColumn($model->getTable(), $column);
    }

    public static function camelToSnakeCase($string): string
    {
        $parts = [];

        for ($i = 0, $n = strlen($string), $j = 0; $i < $n; $i++) {
            if ($i !== 0 && ctype_upper($string[$i])) {
                $j++;
            }

            isset($parts[$j]) ? $parts[$j] .= $string[$i] : $parts[$j] = $string[$i];
        }

        return implode('_', array_map('strtolower', $parts));
    }

    public static function pascalToSnakeCase($string): string
    {
        return static::camelToSnakeCase($string);
    }

    public static function snakeToCamelCase($string): string
    {
        return lcfirst(static::snakeToPascalCase($string));
    }

    public static function snakeToPascalCase($string): string
    {
        return implode('', array_map('ucfirst', explode('_', $string)));
    }
}