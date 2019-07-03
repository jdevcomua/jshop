<?php
return [
    'components' => [
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport'=>false,
            'transport'=>[
                'class'=>'Swift_SmtpTransport',
                'host'=>'mail.adm.tools',
                'username'=>'info@sdelivery.dn.ua',
                'password'=>'MexD8X5l6Xh2',
                'port'=>'465',
                'encryption'=>'ssl',
                'streamOptions' => [
                    'ssl' => [
                        'allow_self_signed' => true,
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                    ],
                ]
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
    ],
];
