<?php
namespace App\Filament\Resources\RelationResource\Api\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Relation;

/**
 * @property Relation $resource
 */
class RelationTransformer extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->resource->toArray();
    }
}
