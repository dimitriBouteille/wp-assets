<?php

namespace Dbout\WpAssets\Asset;

/**
 * Class Script
 * @package Dbout\WpAssets\Asset
 *
 * @author      Dimitri BOUTEILLE <bonjour@dimitri-bouteille.fr>
 * @link        https://github.com/dimitriBouteille Github
 * @copyright   (c) 2020 Dimitri BOUTEILLE
 */
class Script extends AbstractAsset
{

    /**
     * @var bool
     */
    protected $inFooter = true;

    /**
     * @return bool
     */
    public function getInFooter(): bool
    {
        return $this->inFooter;
    }

    /**
     * @param bool $inFooter
     * @return $this
     */
    public function setInFooter(bool $inFooter): self
    {
        $this->inFooter = $inFooter;
        return $this;
    }

    /**
     * Register asset
     * https://developer.wordpress.org/reference/functions/wp_enqueue_script/
     */
    protected function enqueueCallback(): callable
    {
        return function() {
            wp_enqueue_script(
                $this->getHandle(),
                $this->getUrl(),
                $this->getDependencies(),
                $this->getVersion(),
                $this->getInFooter());
        };
    }

    /**
     * https://developer.wordpress.org/reference/hooks/script_loader_tag/
     * @return string
     */
    protected function getFilterLoaderTag(): string
    {
        return 'script_loader_tag';
    }

}