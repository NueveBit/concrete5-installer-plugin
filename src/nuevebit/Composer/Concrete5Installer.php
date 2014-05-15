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
 * Description of Concrete5Installer
 *
 * @author emerino
 */
class Concrete5Installer extends LibraryInstaller {

    /**
     * {@inheritDoc}
     */
    public function getInstallPath(PackageInterface $package) {
        return 'src/www/concrete';
    }

    protected function installCode(PackageInterface $package) {
        $tmpPath = tempnam(sys_get_temp_dir(), 'concrete5');
        mkdir($tmpPath);
        $this->downloadManager->download($package, $tmpPath);
        
        $targetPath = $this->getInstallPath($package);
        $fs = new FileSystem();       
        $fs->rename($tmpPath . DIRECTORY_SEPARATOR . "concrete", $targetPath);
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType) {
        return 'concrete5-installer' === $packageType;
    }

}
