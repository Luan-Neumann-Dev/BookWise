<?php

class Validation {
    public $validations = [];

    public static function validate($rules, $data) {
        $validation = new Validation();

        foreach ($rules as $field => $fieldRules) {
            foreach ($fieldRules as $rule) {
                $fieldValue = $data[$field];

                if($rule == 'confirmed') {
                    $validation->$rule($field, $fieldValue, $data["confirmation_{$field}"]);
                } else if (str_contains($rule, ':')) {
                    $temp = explode(':', $rule);
                    $rule = $temp[0];
                    $ruleArg = $temp[1];
                    $validation->$rule($ruleArg, $field, $fieldValue);
                } else {
                    $validation->$rule($field, $fieldValue);
                }
            }
        }

        return $validation;
    }

    private function required($field, $value): void {
        if (strlen($value) == 0) {
            $this->validations[] = "O $field é obrigatório";
        }
    }

    private function email($field, $value): void {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->validations[] = "O {$field} é inválido";
        }
    }

    private function confirmed($field, $value, $confirmationValue): void {
        if ($value != $confirmationValue) {
            $this->validations[] = "O {$field} de confirmação está diferente";
        }
    }

    private function min($min, $field, $value): void {
        if (strlen($value) <= $min) {
            $this->validations[] = "O {$field} precisa ter um mínimo de {$min} caracteres";
        }
    }

    private function max($max, $field, $value): void {
        if (strlen($value) > $max) {
            $this->validations[] = "O {$field} precisa ter um mínimo de {$max} caracteres";
        }
    }

    private function strong($field, $value)
    {
        if (! strpbrk($value, "!#$%&'()*+,-./:;<=>?@[\]^_`{|}~")) {

            $this->validations[] = "A $field precisa um caractere especial nela.";

        }
    }

    public function failed($customName = null)
    {
        $key = 'validations';

        if ($customName) {
            $key .= '_' . $customName;
        }

        flash()->push($key, $this->validations);

        return sizeof($this->validations) > 0;
    }
}