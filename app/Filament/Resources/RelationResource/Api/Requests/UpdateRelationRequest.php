<?php

namespace App\Filament\Resources\RelationResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRelationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
			'name' => 'required|string',
			'zipcode' => 'required|string',
			'place' => 'required|string',
			'slug' => 'required|string',
			'address' => 'required|string',
			'emailaddress' => 'required|string',
			'phonenumber' => 'required|string',
			'type_id' => 'required|integer',
			'company_id' => 'required|integer',
			'deleted_at' => 'required',
			'post_address' => 'required|string',
			'post_zipcode' => 'required|string',
			'post_place' => 'required|string'
		];
    }
}
