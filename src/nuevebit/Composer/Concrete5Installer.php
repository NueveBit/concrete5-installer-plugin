<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace nuevebit\Composer;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;
use Composer\Util\FileSystem;

/**
 * Custom installer for Concrete5. Extracts only the concrete/ folder from
 * a concrete5 zip distribution to a predefined folder.
 *
 * @author emerino
 */
class Concrete5Installer extends LibraryInstaller {

    /**
     * {@inheritDoc}
     * 
     * TODO: Install path should not be static
     */
    public function getInstallPath(PackageInterface $package) {
        return 'src/www/concrete';
    }

    protected function installCode(PackageInterface $package) {
        // download and extract to a temp dir, we only need the concrete/ folder
        $tmpPath = tempnam(sys_get_temp_dir(), 'concrete5');
        if (file_exists($tmpPath)) {
            unlink($tmpPath);
        }
        mkdir($tmpPath);
        $this->downloadManager->download($package, $tmpPath);

        $targetPath = $this->getInstallPath($package);
        $fs = new FileSystem();
        $fs->rename($tmpPath . DIRECTORY_SEPARATOR . "concrete", $targetPath);

        // TOOD: should we remove from tmp?
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType) {
        return 'concrete5-installer' === $packageType 
                || 'concrete5-update' === $packageType;
    }

}
