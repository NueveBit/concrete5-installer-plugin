<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace nuevebit\Composer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

/**
 * Description of Concrete5InstallerPlugin
 *
 * @author emerino
 */
class Concrete5InstallerPlugin extends PluginInterface {

    public function activate(Composer $composer, IOInterface $io) {
        $installer = new Concrete5Installer($io, $composer);
        $composer->getInstallationManager()->addInstaller($installer);
    }

}
