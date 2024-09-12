<?php

namespace App\Core;

class Form
{
    protected array $config = [];
    protected array $inputs = [];

    public function __construct()
    {

    }

    /**
     * Get the form configuration and inputs.
     */
    public function getConfig(): array
    {
        return [
            'config' => $this->config,
            'inputs' => $this->inputs
        ];
    }

    /**
     * Validate the form data.
     */
    public function isValid(array $data): bool
    {
        foreach ($this->inputs as $name => $input) {
            if (!isset($data[$name]) || empty($data[$name])) {
                return false;
            }
        }

        return true;
    }
}
