<?php

namespace Dbout\WpAssets\Asset;

/**
 * Interface AssetInterface
 * @package Dbout\WpAssets\Asset
 */
interface AssetInterface
{

    /**
     * Register the asset
     *
     * @return $this
     */
    public function register(): self;

    /**
     * Function getHandle
     * Get asset handle name
     * ie : app_styles
     *
     * @return string
     */
    public function getHandle(): string;

    /**
     * @param string $handle
     * @return $this
     */
    public function setHandle(string $handle): self;

    /**
     * @return mixed
     */
    public function getVersion();

    /**
     * @param $version
     * @return $this
     */
    public function setVersion($version): self;

    /**
     * @return mixed
     */
    public function getDependencies();

    /**
     * @param array $dependencies
     * @return $this
     */
    public function setDependencies(array $dependencies): self;

    /**
     * @param array $attributes
     * @return $this
     */
    public function setAttributes(array $attributes): self;

}