<?php


namespace Marvel\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Marvel\Enums\WithdrawStatus;

class UpdateWithdrawRequest extends FormRequest
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
            'shop_id'     => ['required', 'exists:Marvel\Database\Models\Shop,id'],
            'amount'   => ['required', 'numeric'],
            'payment_method' => ['nullable', 'string'],
            'details' => ['nullable', 'string'],
            'note' => ['nullable', 'string'],
            'status'        => ['required', Rule::in([
                WithdrawStatus::APPROVED,
                WithdrawStatus::PROCESSING,
                WithdrawStatus::REJECTED,
                WithdrawStatus::PENDING,
                WithdrawStatus::ON_HOLD,
            ])],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
