<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LahanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_lahan'          => 'required|string|max:255',
            'luas_ha'             => 'required|numeric|min:0.01',
            'jenis_tanah'         => 'required|in:Alluvial,Latosol,Regosol,Grumosol,Andosol',
            'status_kepemilikan'  => 'required|in:Milik Sendiri,Sewa,Gadai,Bagi Hasil',
            'titik_batas'         => 'required|json',
            'latitude'            => 'nullable|numeric|between:-90,90',
            'longitude'           => 'nullable|numeric|between:-180,180',
            'catatan'             => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_lahan.required'         => 'Nama lahan wajib diisi.',
            'luas_ha.required'            => 'Luas lahan wajib diisi.',
            'luas_ha.min'                 => 'Luas harus lebih dari 0.',
            'jenis_tanah.required'        => 'Jenis tanah wajib dipilih.',
            'jenis_tanah.in'              => 'Jenis tanah tidak valid.',
            'status_kepemilikan.required' => 'Status kepemilikan wajib dipilih.',
            'status_kepemilikan.in'       => 'Status kepemilikan tidak valid.',
            'titik_batas.required'        => 'Titik batas lahan wajib digambar di peta.',
            'titik_batas.json'            => 'Format titik batas tidak valid.',
            'latitude.between'            => 'Latitude harus antara -90 dan 90.',
            'longitude.between'           => 'Longitude harus antara -180 dan 180.',
        ];
    }

    protected function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $titikBatas = $this->input('titik_batas');
            if (!$titikBatas) return;

            $geo = json_decode($titikBatas, true);

            // Cek struktur GeoJSON
            if (!isset($geo['type']) || !isset($geo['coordinates'])) {
                $validator->errors()->add('titik_batas', 'Format GeoJSON tidak valid (harus ada type & coordinates).');
                return;
            }

            // Harus bertipe Polygon
            if ($geo['type'] !== 'Polygon') {
                $validator->errors()->add('titik_batas', 'Titik batas harus berupa Polygon, bukan ' . $geo['type'] . '.');
                return;
            }

            // Polygon minimal 4 titik (3 titik + 1 penutup)
            $coords = $geo['coordinates'][0] ?? [];
            if (count($coords) < 4) {
                $validator->errors()->add('titik_batas', 'Polygon minimal harus memiliki 3 titik batas.');
            }
        });
    }
}