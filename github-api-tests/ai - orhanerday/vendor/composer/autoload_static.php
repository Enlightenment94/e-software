<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4e6e7f492340e8f3b1bb6dfb239cfccf
{
    public static $prefixLengthsPsr4 = array (
        'O' => 
        array (
            'Orhanerday\\OpenAi\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Orhanerday\\OpenAi\\' => 
        array (
            0 => __DIR__ . '/..' . '/orhanerday/open-ai/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4e6e7f492340e8f3b1bb6dfb239cfccf::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4e6e7f492340e8f3b1bb6dfb239cfccf::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4e6e7f492340e8f3b1bb6dfb239cfccf::$classMap;

        }, null, ClassLoader::class);
    }
}
