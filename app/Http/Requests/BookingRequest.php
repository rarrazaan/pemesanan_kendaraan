<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        if($this->isMethod('POST')) {
            return [
                'peminjam_id' => ['required', 'integer'],
                'approver_id' => ['required', 'integer'],
                'start_book' => ['required', 'string'],
                'end_book' => ['required', 'string'],
                'driver_id' => ['required', 'integer'],
                'vehicle_id' => ['required', 'integer'],
            ];
        }else {
            return [
                'is_approved' => ['boolean'],
                'need_approval' => ['boolean']
            ];
        }
    }
}