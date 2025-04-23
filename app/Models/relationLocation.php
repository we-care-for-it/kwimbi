<?php
namespace App\Models;

use App\Enums\LocationType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**

 * @package App
 * @mixin Builder
 */
class relationLocation extends Model implements Auditable, HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use \OwenIt\Auditing\Auditable;

    protected function casts(): array
    {
        return [
            'type_id' => LocationType::class,

        ];
    }

    // Validation rules for this model
    static $rules = [];

    // Number of items to be shown per page
    protected $perPage = 20;

    public function contactsObject()
    {
        return $this->hasMany(Contact::class, 'location_id', 'id');
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'item_id', 'id')->where('model', 'RelationLocation');
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'item_id', 'id')->where('model', 'RelationLocation');
    }

}
