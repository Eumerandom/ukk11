<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PKLRequest extends FormRequest
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
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            return [
                'siswa_id' => 'sometimes|exists:siswas,id',
                'industri_id' => 'sometimes|exists:industris,id',
                'guru_id' => 'sometimes|exists:gurus,id',
                'tanggal_mulai' => 'sometimes|date',
                'tanggal_selesai' => 'sometimes|date|after_or_equal:tanggal_mulai',
            ];
        }
        return [
            'siswa_id' => 'required|exists:siswas,id',
                'industri_id' => 'required|exists:industris,id',
                'guru_id' => 'required|exists:gurus,id',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ];
    }
}
