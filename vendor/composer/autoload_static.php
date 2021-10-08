<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3fe3c6a0015cb267e64d6c338182df1a
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Spatie\\ArrayToXml\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Spatie\\ArrayToXml\\' => 
        array (
            0 => __DIR__ . '/..' . '/spatie/array-to-xml/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3fe3c6a0015cb267e64d6c338182df1a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3fe3c6a0015cb267e64d6c338182df1a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit3fe3c6a0015cb267e64d6c338182df1a::$classMap;

        }, null, ClassLoader::class);
    }
}