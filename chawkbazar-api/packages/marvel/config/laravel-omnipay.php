<?php

return [

    // The default gateway to use
    'default'  => 'STRIPE',

    // Add in each gateway here
    'gateways' => [
        'PAYPAL' => [
            'driver'  => 'PayPal_Express',
            'options' => [
                'solutionType'   => '',
                'landingPage'    => '',
                'headerImageUrl' => '',
                'testMode'       => env('OMNIPAY_TEST_MODE', true)

            ]
        ],
        'STRIPE' => [
            'driver'  => 'Stripe',
            'options' => [
                'apiKey'   => env('STRIPE_API_KEY', config('shop.stripe_api_key')),
                'testMode' => env('OMNIPAY_TEST_MODE', true)
            ]
        ]
    ]

];
