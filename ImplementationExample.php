<?php

/**
 * Setup the basic configuration
 *
 * @param ModuleContextInterface $context
 * @return void
 * @throws ParseException
 */
private function setupConfig($context)
{
    // Get configuration data.
    $configData = $this->yamlDataProvider->setSourceFile('Vendor_Module::fixtures/config_setup.yaml')->getData();

    /** @var ConfigInterface $configSetup */
    $configSetup = $this->configFactory->create(['moduleContext' => $context]);
    $configSetup->setupConfig($configData);
}