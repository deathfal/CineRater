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
            $data[$name] = htmlspecialchars($data[$name], ENT_QUOTES, 'UTF-8');

            if (isset($input['required']) && $input['required'] && empty($data[$name])) {
                return false;
            }

            // Email validation
            if ($input['type'] === 'email' && !filter_var($data[$name], FILTER_VALIDATE_EMAIL)) {
                return false;
            }

            // Password length validation
            if ($input['type'] === 'password' && strlen($data[$name]) < 8) {
                return false; // Password must be at least 8 characters
            }

            // Password confirmation validation
            if (isset($input['confirm']) && $data[$name] !== $data[$input['confirm']]) {
                return false;
            }

            // TODO: Add more validations
        }

        return true; // All validations passed
    }
}
