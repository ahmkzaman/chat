<?php
 
class RegistrationForm extends Drozd_Form {
    protected function defineValidators() {
        return array(
            'nickname' => array(
                'Drozd_Validator_Required' => array(
                    Drozd_Validator_Required::IS_REQUIRED => 'Nickname is required',
                ),
                'NicknameCorrect' => array(
                    NicknameCorrect::NOT_CORRECT => 'Invalid nickname. Nickname should contain no spaces.<br />',
                ),
                'NicknameUnique' => array(
                    NicknameUnique::NOT_UNIQUE => 'Nickname has been already taken'
                ),
                
            ),
            
            'email' => array(
                 'Drozd_Validator_Required' => array(
                    Drozd_Validator_Required::IS_REQUIRED => 'Email is required',
                ),
                
                'Drozd_Validator_Email' => array(
                    Drozd_Validator_Email::INVALID_EMAIL => 'Email invalid',
                ),
                'EmailUnique' => array(
                    EmailUnique::NOT_UNIQUE => 'This e-mail is already taken',
                ),
            ),
            
            'password' => array(
                'Drozd_Validator_Required' => array(
                    Drozd_Validator_Required::IS_REQUIRED => 'Password is required',
                ),
                'RegPasswordValid' => array(
                    RegPasswordValid::NOT_LONG => 'Password must contain 8 or more symbols',
                )
            ),
            
            'confirm-password' => array(
                'Drozd_Validator_Required' => array(
                    Drozd_Validator_Required::IS_REQUIRED => 'Retype your password',
                ),
                'ConfPassword' => array(
                    ConfPassword::NOT_SAME => 'Passwords don\'t match',
                )
            ),
        );
    }
}
