<?php

namespace LesPhp\PSR4Converter\Console;

use LesPhp\PSR4Converter\Config;
use Symfony\Component\Finder\Finder;

class ConfigurationResolver
{
    private Finder $finder;

    private ?Config $config = null;

    private ?bool $followSymlink = null;
    private ?bool $ignoreDotFiles = null;
    private ?bool $ignoreVCSIgnored = null;

    private ?array $ignorePaths;

    private ?string $srcPath = null;

    public function __construct(
        private readonly Config $defaultConfig,
        private array $options = []
    )
    {
    }

    public function getConfig(): Config
    {
        if (($config = $this->config) !== null) {
            return $config;
        }

        if (($configFilePath = $this->options['config']) !== null) {
            if (!is_file($configFilePath)) {
                throw new \InvalidArgumentException(sprintf('Config file not exists: "%s"', $configFilePath));
            }

            $config = require_once $configFilePath;

            if (!is_object($config)) {
                throw new \InvalidArgumentException(sprintf('Config type is wrong ("%s"). Expected type: "%s"', gettype($config), Config::class));
            }

            if (!$config instanceof Config) {
                throw new \InvalidArgumentException(sprintf('Config type is wrong ("%s"). Expected type: "%s"', $config::class, Config::class));
            }

            return $this->config = $config;
        }

        return $this->defaultConfig;
    }

    public function getFollowSymlink(): bool
    {
        if ($this->followSymlink === null) {
            if (null === $this->options['followSymlink']) {
                $this->followSymlink = $this->getConfig()->getFollowSymlink();
            } else {
                $this->followSymlink = (bool) $this->options['followSymlink'];
            }
        }

        return $this->followSymlink;
    }

    public function getIgnoreDotFiles(): bool
    {
        if ($this->ignoreDotFiles === null) {
            if (null === $this->options['ignoreDotFiles']) {
                $this->ignoreDotFiles = $this->getConfig()->getIgnoreDotFiles();
            } else {
                $this->ignoreDotFiles = (bool) $this->options['ignoreDotFiles'];
            }
        }

        return $this->ignoreDotFiles;
    }

    public function getIgnoreVCSIgnored(): bool
    {
        if ($this->ignoreVCSIgnored === null) {
            if (null === $this->options['ignoreVCSIgnored']) {
                $this->ignoreVCSIgnored = $this->getConfig()->getIgnoreVCSIgnored();
            } else {
                $this->ignoreVCSIgnored = (bool) $this->options['ignoreVCSIgnored'];
            }
        }

        return $this->ignoreVCSIgnored;
    }

    public function getSrcPath(): string
    {
        if ($this->srcPath === null) {
            if (null === $this->options['srcPath']) {
                $srcPath = $this->getConfig()->getSrcPath();
            } else {
                $srcPath = $this->options['srcPath'];
            }

            if ($srcPath === null) {
                throw new \InvalidArgumentException('src path argument is required');
            }

            $srcRealPath = realpath($srcPath);

            if ($srcRealPath === false || !is_dir($srcRealPath)) {
                throw new \InvalidArgumentException('The source directory doesn\'t exists or isn\'t readable.');
            }

            $this->srcPath = $srcRealPath;
        }

        return $this->srcPath;
    }

    public function getIgnorePaths(): array
    {
        if (!isset($this->ignorePaths)) {
            if ([] === $this->options['ignorePaths']) {
                $this->ignorePaths = $this->getConfig()->getIgnorePaths();
            } else {
                $this->ignorePaths = $this->options['ignorePaths'];
            }
        }

        return $this->ignorePaths;
    }

    private function resolveFinder(): Finder
    {
        $finder = $this->getConfig()->getFinder() ?? (new Finder())->in($this->getSrcPath());

        if ($this->getFollowSymlink()) {
            $finder->followLinks();
        }

        $finder
            ->ignoreDotFiles($this->getIgnoreDotFiles())
            ->ignoreVCSIgnored($this->getIgnoreVCSIgnored())
            ->files()
            ->name('*.php');

        foreach ($this->getIgnorePaths() as $ignorePath) {
            $finder->notPath($ignorePath);
        }

        return $finder;
    }

    public function getFinder(): Finder
    {
        if (!isset($this->finder)) {
            $this->finder = $this->resolveFinder();
        }

        return $this->finder;
    }
}