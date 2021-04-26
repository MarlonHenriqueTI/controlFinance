<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdc8946a42e66f3033913745d9fa78414
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'N' => 
        array (
            'NFePHP\\NFe\\' => 11,
            'NFePHP\\Gtin\\' => 12,
            'NFePHP\\Common\\' => 14,
        ),
        'L' => 
        array (
            'League\\Flysystem\\' => 17,
        ),
        'J' => 
        array (
            'JsonSchema\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'NFePHP\\NFe\\' => 
        array (
            0 => __DIR__ . '/..' . '/nfephp-org/sped-nfe/src',
        ),
        'NFePHP\\Gtin\\' => 
        array (
            0 => __DIR__ . '/..' . '/nfephp-org/sped-gtin/src',
        ),
        'NFePHP\\Common\\' => 
        array (
            0 => __DIR__ . '/..' . '/nfephp-org/sped-common/src',
        ),
        'League\\Flysystem\\' => 
        array (
            0 => __DIR__ . '/..' . '/league/flysystem/src',
        ),
        'JsonSchema\\' => 
        array (
            0 => __DIR__ . '/..' . '/justinrainbow/json-schema/src/JsonSchema',
        ),
    );

    public static $prefixesPsr0 = array (
        'F' => 
        array (
            'ForceUTF8\\' => 
            array (
                0 => __DIR__ . '/..' . '/neitanod/forceutf8/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdc8946a42e66f3033913745d9fa78414::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdc8946a42e66f3033913745d9fa78414::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitdc8946a42e66f3033913745d9fa78414::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
