<?php

abstract class Drozd_Form 
{
    private $validators;
    
    private $data;
    
    private $fieldErrors = array();
    
    public function __construct($data) {
        $this->validators = $this->defineValidators();
        $this->data = $data;
    }

    abstract protected function defineValidators();
        
    public function isValid()
    {
        $formValid = true;
        $this->fieldErrors = array();
        
        foreach ( $this->validators as $fieldName => $validators ) {
            foreach ( $validators as $validatorClassName => $errorMessages ) {
                $validator = new $validatorClassName;
                /* @var $validator Drozd_Validator_Interface */
                
                $value = null;
                if ( isset($this->data[$fieldName]) ) {
                    $value = $this->data[$fieldName];
                }
                
                $isValid = $validator->isValid($value, $this->data);
                if ( $isValid !== true ) {
                    $this->fieldErrors[$fieldName] = $errorMessages[$isValid];
                    $formValid = false;
                    break;
                }
            }
        }
        
        return $formValid;
    }
    
    public function getFieldValue($fieldName) 
    {
        if ( isset($this->data[$fieldName]) ) {
            return $this->data[$fieldName];
        }
        
        return '';
    }
    
    public function getFieldError($fieldName)
    {
        if ( isset($this->fieldErrors[$fieldName]) ) {
            return $this->fieldErrors[$fieldName];
        }
        
        return '';
    }
    
    public function isFieldValid($fieldName) 
    {
        if ( isset($this->fieldErrors[$fieldName]) ) {
            return false;
        }
        
        return true;
    }
}