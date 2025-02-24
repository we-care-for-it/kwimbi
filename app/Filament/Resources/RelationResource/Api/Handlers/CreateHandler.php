<?php
namespace App\Filament\Resources\RelationResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\RelationResource;
use App\Filament\Resources\RelationResource\Api\Requests\CreateRelationRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = RelationResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Relation
     *
     * @param CreateRelationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateRelationRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}