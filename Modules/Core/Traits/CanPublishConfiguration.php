<?php

namespace Modules\Core\Traits;

trait CanPublishConfiguration
{
    /**
     * Publish the given configuration file name (without extension) and the given module
     * @param string $module
     * @param string $filename
     */
    public function publishConfig($module, $filename)
    {
        if (app()->environment() === 'testing') {
            return;
        }

        $this->mergeConfigFrom($this->getModuleConfigFilePath($module, $filename), strtolower("framework.$module.$filename"));
        $this->publishes([
            $this->getModuleConfigFilePath($module, $filename) => config_path(strtolower("framework/$module/$filename") . '.php'),
        ], 'config');
    }

    /**
     * Get path of the give file name in the given module
     * @param string $module
     * @param string $file
     * @return string
     */
    private function getModuleConfigFilePath($module, $file)
    {
        return $this->getModulePath($module) . "/Config/$file.php";
    }

    /**
     * @param $module
     * @return string
     */
    private function getModulePath($module)
    {
        return base_path('Modules' . DIRECTORY_SEPARATOR . ucfirst($module));
    }
}
