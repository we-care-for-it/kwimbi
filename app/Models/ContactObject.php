<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactObject extends Model
{
    public $table = 'contacts_for_objects';
    
    protected $fillable = ['model_id'];

    public function contact()
    {
        return $this->hasOne(Contact::class, 'id', 'contact_id');
    }

    public function models()
    {
        return $this->hasOne(Relation::class, 'id', 'model_id');
    }
}
