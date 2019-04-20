<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=freemark.mysql.tools;dbname=freemark_sdeldn',
            'username' => 'freemark_sdeldn',
            'password' => '4eTe3S~8v^',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'mail.adm.tools',
                'username' => 'info@sdelivery.dn.ua',
                'password' => 'MexD8X5l6Xh2',
                'port' => '465',
                'encryption' => 'ssl',
            ],
        ],
        'log' =>[
            'targets' => [
                [
                    'class' => 'sergeymakinen\yii\slacklog\Target',
                    'levels' => ['error'],
                    'except' => [
                        'yii\web\HttpException:*',
                    ],
                    'webhookUrl' => 'https://hooks.slack.com/services/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',
                    'username' => 'Error - Prod',
                    'iconEmoji' => ':poop:',
                ]
            ]
        ],
    ],
];
