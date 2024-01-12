<?php

namespace LesPhp\PSR4Converter;

use Symfony\Component\Finder\Finder;

class Config
{
    /**
     * @var callable|null
     */
    private /*callable|null*/ $classNameFilter = null;

    /**
     * @var callable|null
     */
    private /*callable|null*/ $namespaceFilter = null;

    private ?Finder $finder = null;

    private bool $followSymlink = false;

    private ?string $srcPath = null;

    private ?bool $ignoreDotFiles = null;

    private ?bool $ignoreVCSIgnored = null;

    private array $ignorePaths = [];

    /**
     * @return callable|null
     */
    public function getClassNameFilter(): ?callable
    {
        return $this->classNameFilter;
    }

    /**
     * @param callable|null $classNameFilter
     * @return Config
     */
    public function setClassNameFilter(?callable $classNameFilter): static
    {
        $this->classNameFilter = $classNameFilter;

        return $this;
    }

    /**
     * @return callable|null
     */
    public function getNamespaceFilter(): ?callable
    {
        return $this->namespaceFilter;
    }

    /**
     * @param callable|null $namespaceFilter
     * @return Config
     */
    public function setNamespaceFilter(?callable $namespaceFilter): static
    {
        $this->namespaceFilter = $namespaceFilter;

        return $this;
    }

    /**
     * @return Finder|null
     */
    public function getFinder(): ?Finder
    {
        return $this->finder;
    }

    /**
     * @param Finder|null $finder
     */
    public function setFinder(?Finder $finder): static
    {
        $this->finder = $finder;

        return $this;
    }

    /**
     * @return bool
     */
    public function getFollowSymlink(): bool
    {
        return $this->followSymlink;
    }

    /**
     * @param bool $followSymlink
     */
    public function setFollowSymlink(bool $followSymlink): static
    {
        $this->followSymlink = $followSymlink;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSrcPath(): ?string
    {
        return $this->srcPath;
    }

    /**
     * @param string|null $srcPath
     */
    public function setSrcPath(?string $srcPath): static
    {
        $this->srcPath = $srcPath;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIgnoreDotFiles(): ?bool
    {
        return $this->ignoreDotFiles;
    }

    /**
     * @param bool|null $ignoreDotFiles
     */
    public function setIgnoreDotFiles(?bool $ignoreDotFiles): static
    {
        $this->ignoreDotFiles = $ignoreDotFiles;

        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIgnoreVCSIgnored(): ?bool
    {
        return $this->ignoreVCSIgnored;
    }

    /**
     * @param bool|null $ignoreVCSIgnored
     */
    public function setIgnoreVCSIgnored(?bool $ignoreVCSIgnored): static
    {
        $this->ignoreVCSIgnored = $ignoreVCSIgnored;

        return $this;
    }

    /**
     * @return array
     */
    public function getIgnorePaths(): array
    {
        return $this->ignorePaths;
    }

    /**
     * @param array $ignorePaths
     */
    public function setIgnorePaths(array $ignorePaths): static
    {
        $this->ignorePaths = $ignorePaths;

        return $this;
    }

    /**
     * @param string $ignorePath
     */
    public function addIgnorePath(string $ignorePath): static
    {
        $this->ignorePaths[] = $ignorePath;

        return $this;
    }
}