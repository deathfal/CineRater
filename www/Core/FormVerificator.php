<?php

namespace App\Core;

class FormVerificator
{
    /**
     * Validate form data against form configuration
     */
    public function checkForm(array $formConfig, array $data): bool
    {
        foreach ($formConfig['inputs'] as $name => $input) {
            if (isset($input['required']) && $input['required'] && empty($data[$name])) {
                return false;
            }

            if ($input['type'] === 'email' && !filter_var($data[$name], FILTER_VALIDATE_EMAIL)) {
                return false; 
            }

            if (isset($input['confirm']) && $data[$name] !== $data[$input['confirm']]) {
                return false; 
            }

            // TODO: Add more validations
        }

        return true; // All validations passed
    }
}
