<?php

namespace Dbout\WpAssets\Asset;

/**
 * Class Style
 * @package Dbout\WpAssets\Asset
 *
 * @author      Dimitri BOUTEILLE <bonjour@dimitri-bouteille.fr>
 * @link        https://github.com/dimitriBouteille Github
 * @copyright   (c) 2020 Dimitri BOUTEILLE
 */
class Style extends AbstractAsset
{

    /**
     * @var null|string
     */
    protected $media = null;

    /**
     * @return string|null
     */
    public function getMedia(): ?string
    {
        return $this->media;
    }

    /**
     * @param string|null $media
     * @return $this
     */
    public function setMedia(?string $media): self
    {
        $this->media = $media;
        return $this;
    }

    /**
     * Register asset
     * https://developer.wordpress.org/reference/functions/wp_enqueue_style/
     */
    protected function enqueueCallback(): callable
    {
        return function () {
            wp_enqueue_style(
                $this->getHandle(),
                $this->getUrl(),
                $this->getDependencies(),
                $this->getVersion(),
                $this->getMedia());
        };
    }

    /**
     * https://developer.wordpress.org/reference/hooks/style_loader_tag/
     * @return string
     */
    protected function getFilterLoaderTag(): string
    {
        return 'style_loader_tag';
    }

}
