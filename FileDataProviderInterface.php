<?php
declare(strict_types=1);

namespace Vendor\Module\Api\File;

/**
 * Interface for the file data provider
 *
 * @author Martijn Swinkels <m.swinkels@youwe.nl>
 */
interface FileDataProviderInterface
{

    /**
     * Get the data from a file as an array.
     *
     * @return mixed[][]
     */
    public function getData(): array;
}