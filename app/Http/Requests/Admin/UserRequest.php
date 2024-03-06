<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email|max:255', // unique maskudnya jika ada yang cantumin email yg sama tidak bisa
            'roles' => 'nullable|string|in:ADMIN,USER',
            /*
            'nullable': Ini berarti field 'roles' boleh kosong (null) atau memiliki nilai. Jika field 'roles' kosong, validasi akan lolos.
            'string': Ini menunjukkan bahwa nilai field 'roles' harus bertipe string.'in:ADMIN,USER': Ini menunjukkan bahwa nilai field 'roles' harus ada dalam daftar yang telah ditentukan, dalam hal ini 'ADMIN' atau 'USER'. Jadi, jika nilai 'roles' tidak ada dalam daftar ini, validasi akan gagal.
            */
        ];
    }
}
