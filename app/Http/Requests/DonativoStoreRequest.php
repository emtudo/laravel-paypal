<?php

namespace app\Http\Requests;

use App\Http\Requests\Request;

class DonativoStoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $input = parent::all();

        $rules = [
            'doacoes' => 'required|array',
        ];

        if (!isset($input['doacoes']) || !is_array($input['doacoes'])) {
            return $rules;
        }

        $doacoesRules = [
            'value' => 'required|numeric|min:1',
        ];

        $doacoes = $input['doacoes'];

        $newRules = [];
        foreach ($doacoes as $row => $address) {
            foreach ($doacoesRules as $key => $value) {
                $newRules['doacoes.'.$row.'.'.$key] = $value;
            }
        }

        return array_merge($rules, $newRules);
    }

    public function messages()
    {
        $input = parent::all();

        $messages = [
            'doacoes.required' => 'Doação precisa ser informada',
            'doacoes.array' => 'Doação precisa ser um conjunto',
        ];

        /*
                                                                                                                     * Verifica se foram passados endereços
                                                                                                                     * Caso contrário devolver as regras
        */
        if (!isset($input['doacoes']) || !is_array($input['doacoes'])) {
            return $messages;
        }

        /*
                                                                                                                     * Messages para validação dos doacoes(endereços)
                                                                                                                     * @var array
        */
        $doacoesMessages = [
            'value.required' => 'Você precisa informar um valor',
            'value.numeric' => 'O valor precisa ser numérico',
            'value.min' => 'Valor mínimo :min',
        ];
        $doacoes = $input['doacoes'];

        $newMessagens = [];
        foreach ($doacoes as $row => $address) {
            foreach ($doacoesMessages as $key => $value) {
                $newMessagens['doacoes.'.$row.'.'.$key] = ($row + 1).': '.$value;
            }
        }

        return array_merge($messages, $newMessagens);
    }
}
