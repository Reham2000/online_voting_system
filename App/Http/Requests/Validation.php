<?php

namespace App\Http\Requests;

use App\Database\Models\Model;

class Validation
{
    private string $input;
    private $value;
    private array $errors = [];
    private array $oldValues = [];
    private $changed;


    /**
     * Get the value of value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the value of value
     *
     * @return  self
     */
    public function setValue($value)
    {
        $this->value = $value;
        $this->oldValues[$this->input] = $value;

        return $this;
    }

    /**
     * Get the value of input
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * Set the value of input
     *
     * @return  self
     */
    public function setInput($input)
    {
        $this->input = $input;

        return $this;
    }
    /**
     * Get the value of oldValue
     */
    public function getOldValue(string $input)
    {
        return $this->oldValues[$input] ?? "";
    }

    /**
     * Get the value of errors
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Set the value of errors
     *
     * @return  self
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;

        return $this;
    }
    /**
     * Get the value of changed
     */ 
    public function getChanged()
    {
        return $this->changed;
    }

    public function getError(string $input): ?string
    {
        if (isset($this->errors[$input])) {
            foreach ($this->errors[$input] as $error) {
                return $error;
            }
        }
        return null;
    }
    public function getMessage(string $input)
    {
        return "<p class='text-danger fw-bold'>" . ucwords(str_replace('_', ' ', $this->getError($input))) . "</p>";
    }

    public function required()
    {
        if (empty($this->value)) {
            $this->errors[$this->input][__FUNCTION__] = "{$this->input} is Required.";
        }
        return $this;
    }
    public function max(int $max)
    {
        if (strlen($this->value) > $max) {
            $this->errors[$this->input][__FUNCTION__] = "{$this->input} must be less than {$max} characters.";
        }
        return $this;
    }
    public function min(int $min)
    {
        if (strlen($this->value) < $min) {
            $this->errors[$this->input][__FUNCTION__] = "{$this->input} must be greater than {$min} characters.";
        }
        return $this;
    }
    public function regex(string $pattern, string $message = '')
    {
        if (!preg_match($pattern, $this->value)) {
            $this->errors[$this->input][__FUNCTION__] =  $message ? $message : "{$this->input} Invalid.";
        }
        return $this;
    }
    public function confirmed(string $confirmedValue)
    {
        if ($this->value != $confirmedValue) {
            $this->errors[$this->input][__FUNCTION__] = "{$this->input} Not Confirmed.";
        }
        return $this;
    }

    // unique
    public function unique(string $table, string $column)
    {
        $query = "SELECT * FROM {$table} WHERE {$column} = ?";
        $model = new Model;
        $stmt = $model->conn->prepare($query);
        $stmt->bind_param('s', $this->value);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows >= 1) {
            $this->errors[$this->input][__FUNCTION__] = "{$this->input}  Already Exists";
        }
        return $this;
    }
    // exists
    public function exists(string $table, string $column)
    {
        $query = "SELECT * FROM {$table} WHERE {$column} = ?";
        $model = new Model;
        $stmt = $model->conn->prepare($query);
        $stmt->bind_param('s', $this->value);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {
            $this->errors[$this->input][__FUNCTION__] = "{$this->input}  Not Exists In Our System";
        }
        return $this;
    }
    public function isChanged($oldValue)
    {
        echo $oldValue;
        echo $this->value;
        if($this->value == $oldValue)
        {
            $this->changed = 0;
        }else
        {
            $this->changed = 1;
        }
        return $this;
    }

    
}



// $validation = new Validation;
// $validation->setInput('firstname')->setValue('')->required()->min(2)->max(8);
// print_r($validation->getErrors());