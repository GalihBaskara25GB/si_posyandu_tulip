<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KriteriaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'pendidikan' => 'required',
            'penyakit_berat' => 'required', //alias tes kesehatan
            'pengetahuan_kesehatan' => 'required',
            'keaktifan_sosial' => 'required',
            'keahlian_komputer' => 'required',
            'kepribadian' => 'required',
            'mempunyai_hp' => 'required',
            'kader_id' => 'required',
        ];
    }
}
