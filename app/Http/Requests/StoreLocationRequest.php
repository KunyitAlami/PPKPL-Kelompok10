<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreLocationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'latitude' => [
                'required',
                'numeric',
                'between:-90,90',
            ],
            'longitude' => [
                'required',
                'numeric',
                'between:-180,180',
            ],
            'tanggal_uji' => ['required', 'date', 'after_or_equal:today'],
            'latitude' => [
                'required',
                'numeric',
                Rule::unique('j1_jadwal_titik_uji')
                    ->where(function ($query) {
                        return $query
                            ->where('pengajuan_id', $this->route('soilTest')->id)
                            ->where('longitude', $this->input('longitude'));
                    })
            ],
        ];
    }
}
