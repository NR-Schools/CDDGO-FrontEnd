<?php

interface ValidationRule
{
    public function validate($var): array;
}

class MinLengthRule implements ValidationRule
{
    private $minLength;

    public function __construct(int $minLength)
    {
        $this->minLength = $minLength;
    }

    public function validate($var): array
    {
        if (strlen($var) < $this->minLength)
            return [false, "Field is too short"];
        return [true, ""];
    }
}

class MaxLengthRule implements ValidationRule
{
    private $maxLength;

    public function __construct(int $maxLength)
    {
        $this->maxLength = $maxLength;
    }

    public function validate($var): array
    {
        if (strlen($var) > $this->maxLength)
            return [false, "Field is too long"];
        return [true, ""];
        
    }
}

class ExistingFileRule implements ValidationRule
{
    public function validate($var): array
    {
        $status = true;
        $error = "";
        if (boolval($var['error'] === 0))
            return [true, "File exists!"];
        return [false, "File does not exists!"];

    }
}


function validate_input(string $label, $var, array $validationRules = []): array
{
    $status = true;
    $error = "";
    foreach ($validationRules as $rule) {
        [$ruleStatus, $ruleError] = $rule->validate($var);
        if (!$ruleStatus) {
            $status = false;
            $error = $ruleError;
            break;
        }
    }
    return [$status, "{$error} on {$label}"];
}

function validate_many_inputs(array $validationMaps): array
{
    foreach ($validationMaps as $validationMap) {
        [$label, $var, $validationRules] = $validationMap;
        [$status, $error] = validate_input($label, $var, $validationRules);
        if (!$status) {
            return [$status, $error];
        }
    }
    return [true, "No Errors"];
}


?>