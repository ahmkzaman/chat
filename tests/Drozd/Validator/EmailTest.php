<?php

class Drozd_Validator_EmailTest extends PHPUnit_Framework_TestCase
{
    public function testGetEmailCorrectFormat()
    {
        $email = new Drozd_Validator_Email();
        $emailValue = "a2drozdenkogmailcom";
        $actual = $email->isValid($emailValue);
        $expected = true;
        $this->assertEquals($expected, $actual);
    }
}