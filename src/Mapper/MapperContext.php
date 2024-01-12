<?php

namespace LesPhp\PSR4Converter\Mapper;

class MapperContext
{

    /**
     * @param string[] $ignoreNamespaces
     */
    public function __construct(
        private readonly string $filePath,
        private readonly string $rootSourcePath,
        private readonly string $includesDirPath,
        private readonly ?string $prefixNamespace,
        private readonly bool $appendNamespace,
        private readonly bool $underscoreConversion,
        private readonly bool $ignoreNamespacedUnderscoreConversion,
        private readonly array $ignoreNamespaces,
        private readonly bool $pathBasedConversion,
        private readonly bool $forceNamesCamelCase,
        private $classNameFilter,
        private $namespaceFilter,
    ) {
    }

    public function getFilePath(): string
    {
        return $this->filePath;
    }

    public function getRootSourcePath(): string
    {
        return $this->rootSourcePath;
    }

    public function getPrefixNamespace(): ?string
    {
        return $this->prefixNamespace;
    }

    public function getIncludesDirPath(): string
    {
        return $this->includesDirPath;
    }

    public function isAppendNamespace(): bool
    {
        return $this->appendNamespace;
    }

    public function isUnderscoreConversion(): bool
    {
        return $this->underscoreConversion;
    }

    public function isIgnoreNamespacedUnderscoreConversion(): bool
    {
        return $this->ignoreNamespacedUnderscoreConversion;
    }

    /**
     * @return string[]
     */
    public function getIgnoreNamespaces(): array
    {
        return $this->ignoreNamespaces;
    }

    /**
     * @return bool
     */
    public function isPathBasedConversion(): bool
    {
        return $this->pathBasedConversion;
    }

    /**
     * @return bool
     */
    public function isForceNamesCamelCase(): bool
    {
        return $this->forceNamesCamelCase;
    }

    /**
     * @return callable|null
     */
    public function getClassNameFilter(): ?callable
    {
        return $this->classNameFilter;
    }

    public function getNamespaceFilter(): ?callable
    {
        return $this->namespaceFilter;
    }

    public function getRelativeFilePath(): string
    {
        return ltrim(substr($this->filePath, strlen($this->rootSourcePath)), DIRECTORY_SEPARATOR);
    }
}
