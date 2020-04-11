<?php

namespace Dbout\WpAssets\Asset;

use Dbout\WpAssets\File\AssetFileInterface;
use Dbout\WpAssets\Html\AttributeBuilder;

/**
 * Class AbstractAsset
 * @package Dbout\WpAssets\Asset
 *
 * @author      Dimitri BOUTEILLE <bonjour@dimitri-bouteille.fr>
 * @link        https://github.com/dimitriBouteille Github
 * @copyright   (c) 2020 Dimitri BOUTEILLE
 */
abstract class AbstractAsset implements AssetInterface
{

    const LOCATIONS_BY_HOOK = [
        'admin' => 'admin_enqueue_scripts',
        'login' => 'login_enqueue_scripts',
        'front' => 'wp_enqueue_scripts',
    ];

    /**
     * @var string
     */
    protected $handle;

    /**
     * @var string|null
     */
    protected $file;

    /**
     * @var string|bool|array
     */
    protected $dependencies;

    /**
     * @var string|null|bool
     */
    protected $version;

    /**
     * @var string[]
     */
    protected $attributes = [];

    /**
     * @var array
     */
    protected $inline = [];

    /**
     * @var array
     */
    protected $localisations;

    /**
     * Asset constructor.
     * @param string $handle
     * @param $file
     */
    public function __construct(string $handle, $file)
    {
        $this->handle = $handle;
        $this->file = $file;
        $this->localisations[] = 'front';
    }

    /**
     * @return string
     */
    public function getHandle(): string
    {
        return $this->handle;
    }

    /**
     * @param string $handle
     * @return AssetInterface
     */
    public function setHandle(string $handle): AssetInterface
    {
       $this->handle = $handle;
       return $this;
    }

    /**
     * @return array|bool|string
     */
    public function getDependencies()
    {
        return $this->dependencies;
    }

    /**
     * @param array $dependencies
     * @return $this
     */
    public function setDependencies(array $dependencies): AssetInterface
    {
        $this->dependencies = $dependencies;
        return $this;
    }

    /**
     * @return bool|string|null
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param $version
     * @return AssetInterface
     */
    public function setVersion($version): AssetInterface
    {
        $this->version = $version;
        return $this;
    }

    /**
     * Return asset URL
     * @return string
     */
    public function getUrl(): string
    {
        return $this->file;
    }

    /**
     * @param array $attributes
     * @return AssetInterface
     */
    public function setAttributes(array $attributes): AssetInterface
    {
        $this->attributes = $attributes;
        return $this;
    }

    /**
     * @param string|$locations
     * @return $this
     */
    public function to($locations): self
    {
        if(is_string($locations)) {
            $locations = (array)$locations;
        }

        $this->localisations = $locations;
        return $this;
    }

    /**
     * Register the asset
     *
     * @return AssetInterface
     */
    public function register(): AssetInterface
    {
        foreach ($this->localisations as $localisation) {
            $hook = self::LOCATIONS_BY_HOOK[$localisation] ?? null;
            if($hook) {
                add_action($hook, $this->enqueueCallback());
            }
        }

        $this->registerAttributes();
        return $this;
    }

    /**
     * Add asset attributes
     *
     * @return void
     */
    protected function registerAttributes(): void
    {
        add_filter($this->getFilterLoaderTag(), function(string $tag, ?string $handle) {

            if($this->getHandle() !== $handle) {
                return $tag;
            }

            return preg_replace(
                '/(src|href)(.+>)/',
                AttributeBuilder::attributes($this->attributes).' $1$2',
                $tag);
        }, 10, 2);
    }

    /**
     * Register asset with wp_enqueue_script or wp_enqueue_style
     * @return callable
     */
    protected abstract function enqueueCallback(): callable;

    /**
     * Returns the filter name
     *
     * @return string
     */
    protected abstract function getFilterLoaderTag(): string;

}