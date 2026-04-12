<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLocationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $soilTest = $this->route('soilTest');

        return [
            'latitude' => [
                'required',
                'numeric',
                'between:-90,90',

                // 🔥 hanya jalan kalau ada soilTest
                Rule::unique('j1_jadwal_titik_uji')
                    ->when($soilTest, function ($rule) use ($soilTest) {
                        return $rule->where(function ($query) use ($soilTest) {
                            $query->where('pengajuan_id', $soilTest->id)
                                  ->where('longitude', $this->input('longitude'));
                        });
                    }),
            ],

            'longitude' => [
                'required',
                'numeric',
                'between:-180,180',
            ],

            'tanggal_uji' => [
                'required',
                'date',
                'after_or_equal:today',
            ],
        ];
    }
}