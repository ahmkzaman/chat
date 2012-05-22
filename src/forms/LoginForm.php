<?php

class LoginForm extends Drozd_Form
{
    protected function defineValidators() 
    {
        return array(
            'nickname' => array(
                'Drozd_Validator_Required' => array(
                    Drozd_Validator_Required::IS_REQUIRED => 'Nickname is required',
                ),
                'NicknameExists' => array(
                    NicknameExists::NOT_EXISTS => 'Invalid nickname',
                )
            ),
            'password' => array(
                'Drozd_Validator_Required' => array(
                    Drozd_Validator_Required::IS_REQUIRED => 'Password is required',
                ),
                'PasswordValid' => array(
                    PasswordValid::NOT_VALID => 'Invalid password',
                )
            ),
        );
    }
}