<?php
/**
 * This file is part of the Shieldon package.
 *
 * (c) Terry L. <contact@terryl.in>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * php version 7.1.0
 *
 * @category  Web-security
 * @package   Shieldon
 * @author    Terry Lin <contact@terryl.in>
 * @copyright 2019 terrylinooo
 * @license   https://github.com/terrylinooo/shieldon/blob/2.x/LICENSE MIT
 * @link      https://github.com/terrylinooo/shieldon
 * @see       https://shieldon.io
 */

declare(strict_types=1);

namespace Shieldon\Firewall;

use function count;
use function explode;

/*
 * FirewallTrait
 */
trait FirewallTrait
{
    /**
     * Shieldon instance.
     *
     * @var object
     */
    protected $kernel;

    /**
     * Configuration data of Shieldon.
     *
     * @var array
     */
    protected $configuration;

    /**
     * If status is false and then Sheldon will stop working.
     *
     * @var bool
     */
    protected $status = true;
    
    /**
     * The configuation file's path.
     *
     * @var string
     */
    protected $directory = '/tmp';

    /**
     * The filename of the configuration file.
     *
     * @var string
     */
    protected $filename = 'config.firewall.json';
    
    /**
     * Get the Shieldon instance.
     *
     * @return object
     */
    public function getKernel()
    {
        return $this->kernel;
    }

    /**
     * Get the configuation settings.
     *
     * @return array
     */
    public function getConfiguration(): array
    {
        return $this->configuration;
    }

    /**
     * Get the directory where the data stores.
     *
     * @return string
     */
    public function getDirectory(): string
    {
        return $this->directory;
    }

    /**
     * Get the filename where the configuration saves.
     *
     * @return string
     */
    public function getFileName(): string
    {
        return $this->filename;
    }

    /**
     * Get a variable from configuration.
     *
     * @param string $field The field of the configuration.
     *
     * @return mixed
     */
    public function getConfig(string $field)
    {
        $v = explode('.', $field);
        $c = count($v);

        switch ($c) {
            case 1:
                return $this->configuration[$v[0]] ?? '';
                break;

            case 2:
                return $this->configuration[$v[0]][$v[1]] ?? '';
                break;

            case 3:
                return $this->configuration[$v[0]][$v[1]][$v[2]] ?? '';
                break;

            case 4:
                return $this->configuration[$v[0]][$v[1]][$v[2]][$v[3]] ?? '';
                break;

            case 5:
                return $this->configuration[$v[0]][$v[1]][$v[2]][$v[3]][$v[4]] ?? '';
                break;
        }
        return '';
    }

    /**
     * Set a variable to the configuration.
     *
     * @param string $field The field of the configuration.
     * @param mixed  $value The vale of a field in the configuration.
     *
     * @return void
     */
    public function setConfig(string $field, $value)
    {
        $v = explode('.', $field);
        $c = count($v);

        switch ($c) {
            case 1:
                $this->configuration[$v[0]] = $value;
                break;

            case 2:
                $this->configuration[$v[0]][$v[1]] = $value;
                break;

            case 3:
                $this->configuration[$v[0]][$v[1]][$v[2]] = $value;
                break;

            case 4:
                $this->configuration[$v[0]][$v[1]][$v[2]][$v[3]] = $value;
                break;

            case 5:
                $this->configuration[$v[0]][$v[1]][$v[2]][$v[3]][$v[4]] = $value;
                break;
        }
    }

    /**
     * Get options from the configuration file.
     * This method is same as `$this->getConfig()` but returning value from array directly.
     *
     * @param string $option  The option of the section in the the configuration.
     * @param string $section The section in the configuration.
     *
     * @return mixed
     */
    protected function getOption(string $option, string $section = '')
    {
        if (!empty($this->configuration[$section][$option])) {
            return $this->configuration[$section][$option];
        }

        if (!empty($this->configuration[$option]) && $section === '') {
            return $this->configuration[$option];
        }

        return false;
    }

    /**
     * Update configuration file.
     *
     * @return void
     */
    protected function updateConfig()
    {
        $configFilePath = $this->directory . '/' . $this->filename;

        if (!file_exists($configFilePath)) {
            if (!is_dir($this->directory)) {

                // @codeCoverageIgnoreStart
        
                $originalUmask = umask(0);
                @mkdir($this->directory, 0777, true);
                umask($originalUmask);

                // @codeCoverageIgnoreEnd
            }
        }

        file_put_contents($configFilePath, json_encode($this->configuration));
    }
}
