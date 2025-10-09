<?php

class Validation {
    public $validations;

    public static function validate($rules, $data) {
        $validation = new Validation();

        foreach ($rules as $field => $fieldRules) {
            foreach ($fieldRules as $rule) {
                $fieldValue = $data[$field];

                if($rule == 'confirmed') {
                    $validation->$rule($field, $fieldValue, $data["confirmation_{$field}"]);
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

    public function failed()
    {
        return sizeof($this->validations) > 0;
    }
}