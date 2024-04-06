<?php return array(
    'root' => array(
        'name' => 'vender/app',
        'pretty_version' => '1.0.0+no-version-set',
        'version' => '1.0.0.0',
        'reference' => NULL,
        'type' => 'project',
        'install_path' => __DIR__ . '/../../',
        'aliases' => array(),
        'dev' => true,
    ),
    'versions' => array(
        'phpmailer/phpmailer' => array(
            'pretty_version' => 'dev-master',
            'version' => 'dev-master',
            'reference' => '5372c1694dea54e156443af9c888ccecfa52cb4d',
            'type' => 'library',
            'install_path' => __DIR__ . '/../phpmailer/phpmailer',
            'aliases' => array(
                0 => '9999999-dev',
            ),
            'dev_requirement' => false,
        ),
        'vender/app' => array(
            'pretty_version' => '1.0.0+no-version-set',
            'version' => '1.0.0.0',
            'reference' => NULL,
            'type' => 'project',
            'install_path' => __DIR__ . '/../../',
            'aliases' => array(),
            'dev_requirement' => false,
        ),
    ),
);
