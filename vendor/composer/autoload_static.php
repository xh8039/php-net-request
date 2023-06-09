<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8d085f1b842775d9b746f229fdfd4a34
{
    public static $files = array (
        '3f25217b295bb6ca58df2f221ad22d51' => __DIR__ . '/../..' . '/src/helper.php',
    );

    public static $prefixLengthsPsr4 = array (
        'n' => 
        array (
            'network\\http\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'network\\http\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8d085f1b842775d9b746f229fdfd4a34::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8d085f1b842775d9b746f229fdfd4a34::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8d085f1b842775d9b746f229fdfd4a34::$classMap;

        }, null, ClassLoader::class);
    }
}
