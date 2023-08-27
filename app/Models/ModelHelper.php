<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ModelHelper extends Model
{
    /**
     * @param Builder $query
     * @return string
     */
    public static function getSqlWithBindings(Builder $query): string
    {
        return vsprintf(
            str_replace('?', '%s', $query->toSql()),
            collect($query->getBindings())
                ->map(function ($binding) {
                    return is_numeric($binding) ? $binding : "'{$binding}'";
                })
                ->toArray());
    }
}
