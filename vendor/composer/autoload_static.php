<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitac0b46d40ccb0db35b342fb9e0a2a211
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitac0b46d40ccb0db35b342fb9e0a2a211::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitac0b46d40ccb0db35b342fb9e0a2a211::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitac0b46d40ccb0db35b342fb9e0a2a211::$classMap;

        }, null, ClassLoader::class);
    }
}
