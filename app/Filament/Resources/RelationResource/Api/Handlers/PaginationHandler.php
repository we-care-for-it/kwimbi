<?php
namespace App\Filament\Resources\RelationResource\Api\Handlers;

use App\Filament\Resources\RelationResource;
use App\Filament\Resources\RelationResource\Api\Transformers\RelationTransformer;
use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use Spatie\QueryBuilder\QueryBuilder;

class PaginationHandler extends Handlers
{
    public static string|null $uri      = '/';
    public static string|null $resource = RelationResource::class;

    /**
     * List of Relation
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function handler()
    {

        $query = static::getEloquentQuery();

        $query = QueryBuilder::for($query)
            ->allowedFields($this->getAllowedFields() ?? [])
            ->allowedSorts($this->getAllowedSorts() ?? [])
            ->allowedFilters($this->getAllowedFilters() ?? [])
            ->allowedIncludes($this->getAllowedIncludes() ?? [])
            ->paginate(request()->query('per_page'))
            ->appends(request()->query());

        return RelationTransformer::collection($query);
    }
}
