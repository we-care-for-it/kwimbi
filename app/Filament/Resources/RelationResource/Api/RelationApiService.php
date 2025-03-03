<?php
namespace App\Filament\Resources\RelationResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Resources\RelationResource;
use Illuminate\Routing\Router;


class RelationApiService extends ApiService
{
    protected static string | null $resource = RelationResource::class;

    public static function handlers() : array
    {
        return [
            Handlers\CreateHandler::class,
            Handlers\UpdateHandler::class,
            Handlers\DeleteHandler::class,
            Handlers\PaginationHandler::class,
            Handlers\DetailHandler::class
        ];

    }
}
