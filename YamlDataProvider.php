<?php
declare(strict_types=1);

namespace Vendor\Module\Model\File;

use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

/**
 * Data provider for Yaml files
 *
 * @author Martijn Swinkels <m.swinkels@youwe.nl>
 */
class YamlDataProvider extends AbstractFileDataProvider
{

    /**
     * Get the data from a yaml file as an array.
     *
     * @return string[]
     * @throws ParseException
     */
    public function getData(): array
    {
        return $this->isValidFile() ? Yaml::parse(file_get_contents($this->sourceFile)) : [];
    }
}