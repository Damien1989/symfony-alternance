<?php

namespace App\Classe;

use Mailjet\Client;
use Mailjet\Resources;

class Mail {

    private $api_key = 'acf108780d0406d8f869618c2c55670d';
    private $api_key_secret = '04f6b43745437d2b5722b93179b633ea';

    public function send($to_email, $to_name, $subject, $content)
    {
        $mj = new Client($this->api_key, $this->api_key_secret, true,['version' => 'v3.1']);
        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "contact.shopdams@gmail.com",
                        'Name' => "Dams"
                    ],
                    'To' => [
                        [
                            'Email' => $to_email,
                            'Name' => $to_name,
                        ]
                    ],
                    'TemplateID' => 5579784,
                    'TemplateLanguage' => true,
                    'Subject' => $subject,
                    'Variables' => [
                        'content' => $content
                    ]
                ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success();
    }
}