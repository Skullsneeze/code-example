<?php
declare(strict_types=1);

namespace Vendor\Module\Model\File;

use Magento\Framework\Setup\SampleData\FixtureManager;

use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\Filesystem\Exception\IOException as FileIOException;

use Vendor\Module\Api\File\FileDataProviderInterface;

/**
 * Abstraction for the file data provider
 *
 * @author Martijn Swinkels <m.swinkels@youwe.nl>
 */
abstract class AbstractFileDataProvider implements FileDataProviderInterface
{

    /**
     * @var string
     */
    protected $sourceFile;

    /**
     * @var FixtureManager
     */
    private $fixtureManager;

    /**
     * FileDataProvider constructor.
     *
     * @param FixtureManager $fixtureManager
     */
    public function __construct(
        FixtureManager $fixtureManager
    ) {
        $this->fixtureManager = $fixtureManager;
    }

    /**
     * Get the data from a file as an array.
     *
     * @return string[]
     */
    abstract public function getData(): array;

    /**
     * Make sure the given file is valid.
     *
     * @return bool
     * @throws FileNotFoundException
     * @throws FileIOException
     */
    public function isValidFile(): bool
    {
        $file = $this->sourceFile;

        if (!file_exists($file)) {
            throw new FileNotFoundException('File "'. $file .'" not found', 0, null, $file);
        }

        if (is_dir($file)) {
            throw new FileIOException('Passed file "'. $file .'" is a directory', 0, null, $file);
        }

        if (!is_readable($file)) {
            throw new FileIOException('File "'. $file .'" not readable', 0, null, $file);
        }

        return true;
    }

    /**
     * Set the source file containing the data
     *
     * @param string $filePath
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function setSourceFile($filePath)
    {
        // Convert dynamic module path (Vendor_Module::path/to/file).
        if (strpos($filePath, '::') !== false) {
            $filePath = $this->fixtureManager->getFixture($filePath);
        }

        $this->sourceFile = $filePath;

        return $this;
    }
}