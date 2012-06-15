<?php

class Drozd_Validator_EmailTest extends PHPUnit_Framework_TestCase
{
    public function testGetEmailCorrectFormat()
    {
        $email = new Drozd_Validator_Email();
        $emailValue = "trololo@gmail.com";
        $this->assertTrue($email->isValid($emailValue));
    }
    
    public function testGetEmailIncorrectFormat()
    {
        $email = new Drozd_Validator_Email();
        $emailValue = "trololo#gmail.com";
        $validationResult = $email->isValid($emailValue);
        $this->assertInternalType("int", $validationResult);
        $this->assertEquals(Drozd_Validator_Email::INVALID_EMAIL, $validationResult);
    }
}

