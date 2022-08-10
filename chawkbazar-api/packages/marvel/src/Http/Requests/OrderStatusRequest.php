<?php

namespace Marvel\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;


class OrderStatusRequest extends FormRequest
{
    protected $rules = [];

    /**
     * General validation rules
     *
     * @return array
     */
    protected function getRules()
    {
        return [
            'name'   => 'required|unique:order_status,name,' . $this->id,
            'serial' => 'required|integer|unique:order_status,serial,' . $this->id,
            'color' => ['nullable', 'string']
        ];
    }

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
        $this->rules = $this->getRules();

        $queryParam = $this->route()->parameters();

        if (isset($queryParam['name']) && $queryParam['name']) {
            return array_intersect_key($this->rules,  $this->post());
        }

        return $this->rules;
    }

    /**
     * Get the error messages that apply to the request parameters.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Order status name required',
        ];
    }


    public function failedValidation(Validator $validator)
    {
        // TODO: Need to check from the request if it's coming from GraphQL API or not.
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
