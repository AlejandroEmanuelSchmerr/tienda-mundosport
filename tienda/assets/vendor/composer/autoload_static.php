<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitba419e9a8f480da9413f242ee86bbba6
{
    public static $prefixLengthsPsr4 = array (
        't' => 
        array (
            'tododeporte\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'tododeporte\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitba419e9a8f480da9413f242ee86bbba6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitba419e9a8f480da9413f242ee86bbba6::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitba419e9a8f480da9413f242ee86bbba6::$classMap;

        }, null, ClassLoader::class);
    }
}
