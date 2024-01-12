<?php

namespace LesPhp\PSR4Converter\Mapper;

use LesPhp\PSR4Converter\Console\ConfigurationResolver;
use LesPhp\PSR4Converter\Exception\InvalidNamespaceException;
use PhpParser\Lexer;
use PhpParser\Parser;

interface MapperFactoryInterface
{
    /**
     * @throws InvalidNamespaceException
     */
    public function createMapper(
        Parser $parser,
        Lexer $lexer,
        string $srcPath,
        string $includesDirPath,
        ?string $prefixNamespace,
        bool $appendNamespace,
        bool $underscoreConversion,
        bool $ignoreNamespacedUnderscoreConversion,
        array $ignoreNamespaces,
        bool $pathBasedConversion,
        bool $forceNamesCamelCase,
        ConfigurationResolver $configurationResolver
    ): MapperInterface;
}
