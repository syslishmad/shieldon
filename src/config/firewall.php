<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Deamon
    |--------------------------------------------------------------------------
    |
    | Setting true to this value to start Shieldon running on the background.
    | Every HTTP request will be analyzed.
    |
    */

    'daemon' => false,

    /*
    |--------------------------------------------------------------------------
    | Channel Id
    |--------------------------------------------------------------------------
    |
    | If you would like use mutliple Shieldon, specifying a Channel Id here.
    |
    */

    'channel_id' => '',

    /*
    |--------------------------------------------------------------------------
    | Driver Type
    |--------------------------------------------------------------------------
    |
    | The type of the Data driver
    |
    */

    'driver_type' => 'file',

    /*
    |--------------------------------------------------------------------------
    | Drivers
    |--------------------------------------------------------------------------
    |
    | The setting details of the data drivers.
    |
    */

    'drivers' => [

        // Data driver: File system.
        'file' => [
            'enable' => true,
            'config' => [
                'directory_path' => '',
            ],
        ],

        // Data driver: File system.
        'mysql' => [
            'enable' => true,
            'config' => [
                'host'    => '127.0.0.1',
                'dbname'  => 'shieldon_db',
                'user'    => 'shieldon_user',
                'pass'    => '1234',
                'charset' => 'utf8',
            ],
        ],

        // Data driver: SQLite.
        'sqlite' => [
            'enable' => true,
            'config' => [
                'directory_path' => '',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Loggers
    |--------------------------------------------------------------------------
    |
    | Logging data to the logs files then we can parse them to visual charts.
    | Currently, we provide only Action Logger now.
    |
    */

    'loggers' => [
        'action' => [
            'enable' => false,
            'config' => [
                'directory_path' => '',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Filters
    |--------------------------------------------------------------------------
    |
    | Filters are the soft rule-sets to detect bad-behavior requests then we 
    | can "temporarily" ban them. (Unbannend by solving CAPTCHA by themselves.)
    |
    */

    'filters' => [

        // Fequency filter.
        'frequency' => [
            'enable' => false,
            'config' => [
                'quota_s' => 2,
                'quota_m' => 10,
                'quota_h' => 30,
                'quota_d' => 60,
            ],
        ],

        // JavaScript cookie filter.
        'cookie' => [
            'enable' => false,
            'config' => [
                'cookie_name'   => 'ssjd',
				'cookie_domain' => '',
				'cookie_value'  => '1',
				'quota'         => 5,
            ],
        ],

        // Session filter.
        'session' => [
            'enable' => false,
            'config' => [
                'quota'       => 5,
                'time_buffer' => 5,
            ],
        ],

        // Referer filter.
        'referer' => [
            'enable' => false,
            'config' => [
                'quota'       => 5,
                'time_buffer' => 5,
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Components
    |--------------------------------------------------------------------------
    |
    | Components are the hard rule-sets to detect bad-behavior requests then we 
    | can "permanently" ban them. (No CAPTCHA shows.)
    |
    | Each component provides its public APIs for further control.
    |
    */

    'components' => [

        // IP component.
        'ip' => [
            'enable' => true,
        ],

        // Trusted-bot component.
        'trusted_bot' => [
            'enable'      => true,
            'strict_mode' => false,
        ],

        // Header filter.
        'header' => [
            'enable'      => true,
            'strict_mode' => false,
        ],

        // User-agent filter.
        'user_agent' => [
            'enable'      => true,
            'strict_mode' => false,
        ],

        // RDNS filter.
        'rdns' => [
            'enable'      => true,
            'strict_mode' => false,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | CAPTCHA Modules
    |--------------------------------------------------------------------------
    |
    | CAPTCHA modules provide its way to unban users.
    |
    */

	'captcha_modules' => [

        // Google reCAPTCHA.
		'recaptcha' => [
			'enable' => false,
			'config' => [
				'site_key'   => null,
				'secret_key' => null,
				'version'    => 'v2',
				'lang'       => 'en-US'
            ],
        ],

        // A very simple image CAPTCHA.
        'image' => [
			'enable' => false,
			'config' => [
				'type'   =>  'alnum',
				'length' => 4
            ],
        ],
    ],
    
    /*
    |--------------------------------------------------------------------------
    | IP Variable Source
    |--------------------------------------------------------------------------
    |
    | Picking up the real IP source is a must if you use CDN service on frontend.
    |
    */

    'ip_variable_source' => [
        'REMOTE_ADDR'           => true,
		'HTTP_CF_CONNECTING_IP' =>  false,
		'HTTP_X_FORWARDED_FOR'  =>  false,
		'HTTP_X_FORWARDED_HOST' =>  false
    ],

    /*
    |--------------------------------------------------------------------------
    | Online Session Limit
    |--------------------------------------------------------------------------
    |
    | When the online user amount has reached the limit, other users not in the 
    | queue have to line up!
    |
    */

    'online_session_limit' => [
        'enable' => false,
        'config' => [
            'count'  =>  100,
            'period' => 300,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | XSS protection. (Not ready.)
    |--------------------------------------------------------------------------
    |
    | Googling "XSS" to understand who it is and how can we do.
    | This feature is still under development. Give us suggestions.
    |
    */

    'xss_protection' => [

        'request_uri' => [
            'enable' => true,
        ],

        'post' => [
            'enable' => false,
        ],

        'get' => [
            'enable' => false,
        ],

        'cookie' => [
            'enable' => false,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | CSRF protection. (Not ready.)
    |--------------------------------------------------------------------------
    |
    | Googling "CSRF" to understand who it is and how can we do.
    | This feature is still under development. Give us suggestions.
    |
    */

    'csrf_protection' => [
        'enable' => true,
        'config' => [
            'expire'        => 7200,
            'excluded_urls' => [
                [
                    'url' => '/ajax/',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Cronjob
    |--------------------------------------------------------------------------
    |
    | Shieldon's CRON is triggered by HTTP request, not real system CRON.
    |
    */

    'cronjob' => [

        'reset_circle' => [
            'enable' => true,
            'config' => [
                'period'      => 86400,
                'last_update' => '2019-01-01 00:00:00',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Excluded URLs
    |--------------------------------------------------------------------------
    |
    | Shieldon will ignore URLs listed blew.
    |
    */

    'excluded_urls' => [
        [
            'url' => '/tests/',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IP Manager
    |--------------------------------------------------------------------------
    |
    | IP manager is provided by IP component.
    |
    */

    'ip_manager' => [
        [
			'rule' => 'allow',
			'ip'   => '127.0.0.1',
			'url'  => '/',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password-protection URLs
    |--------------------------------------------------------------------------
    |
    | The URLs below are protected by password.
    |
    */

    'ip_manager' => [
        [
            'url'      => '/',
            'username' => 'shieldon_test',
            'password' => 'shieldon_test',
			'captcha'  => true,
        ],
    ],

];