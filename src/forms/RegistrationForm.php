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
            'password' => array(
                'Drozd_Validator_Required' => array(
                    Drozd_Validator_Required::IS_REQUIRED => 'Password is required',
                ),
                'PasswordValid' => array(
                    PasswordValid::NOT_VALID => 'Invalid password',
                )
            ),
            
            'email' => array(
              'Drozd_Validator_Required' => array(
              Drozd_Validator_Email::INVALID_EMAIL => '',
              )
            ),
        );
    }
}
