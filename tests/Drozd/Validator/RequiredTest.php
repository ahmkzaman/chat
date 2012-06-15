<?php

class Drozd_Validator_RequiredTest extends PHPUnit_Framework_TestCase
{
    public function testIfNotEmpty()
    {
        $required = new Drozd_Validator_Required();
        $someValue = "kaka";
        $this->assertTrue($required->isValid($someValue));
    }
    
    public function testIfEmpty()
    {
        $required = new Drozd_Validator_Email();
        $emptyValue = "";
        $validationResult = $required->isValid($emptyValue);
        $this->assertInternalType("int", $validationResult);
        $this->assertEquals(Drozd_Validator_Required::IS_REQUIRED, $validationResult);
    }
}
