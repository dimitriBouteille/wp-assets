<?php

namespace Dbout\WpAssetss;

use Dbout\WpAssets\Type\AssetInterface;

/**
 * Class AssetRegister
 * @package Dbout\WpAssets
 *
 * @author      Dimitri BOUTEILLE <bonjour@dimitri-bouteille.fr>
 * @link        https://github.com/dimitriBouteille Github
 * @copyright   (c) 2020 Dimitri BOUTEILLE
 */
class AssetRegister
{

    /**
     * @var AssetInterface[]
     */
    private $assets;

    /**
     * AssetRegister constructor.
     * @param array $assets
     */
    public function __construct(array $assets = [])
    {
        $this->assets = $assets;
    }

    /**
     * @param AssetInterface $asset
     * @return $this
     */
    public function add(AssetInterface $asset): self
    {
        $this->assets[] = $asset;
        return $this;
    }

    /**
     * @return void
     */
    public function register(): void
    {
        foreach ($this->assets as $asset) {
            $asset->register();
        }
    }

}