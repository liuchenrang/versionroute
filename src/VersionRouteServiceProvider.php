<?php
/**
 * Created by PhpStorm.
 * User: XingHuo
 * Date: 16/7/20
 * Time: 上午11:03
 */

namespace Jiuyan\VersionRoute;

use Illuminate\Support\ServiceProvider;
use Jiuyan\VersionRoute\VersionInfo;
use Jiuyan\VersionRoute\VersionManager;
use Jiuyan\VersionRoute\ParseUses;
use Illuminate\Http\Request;
use Exception;

class VersionRouteServiceProvider extends ServiceProvider
{
    public function register()
    {
        // TODO: Implement register() method.
        $configPath = __DIR__ . '/config/uses.php';
        if (function_exists('config_path')) {
            $publishPath = config_path('uses.php');
        } else {
            $publishPath = base_path('config/uses.php');
        }
        $this->publishes([$configPath => $publishPath], 'config');

    }
    public function boot(){

        $publishPath = __DIR__ . '/config/uses.php';

        if (function_exists('config_path')) {
            $publish = config_path('uses.php');
            if (file_exists($publish)) {
                $publishPath = $publish;
            }
        }
        $this->mergeConfigFrom($publishPath,'uses');

        $reqVersion = $this->app->make(Request::class)->input(config('uses.common.request_version_name'));
        $verInfo = VersionInfo::getInstance($reqVersion);
        $versionRoute = new VersionManager();
        $versionRoute->setRouteMap(config('uses'));
        $parseUses = new ParseUses();
        $versionRoute->setDebug(true);
        $versionRoute->setParseUses($parseUses);
        $versionRoute->setRequestVersionInfo($verInfo);
        $paths = config('uses.versions.'.$versionRoute->getApiVersion());
        $namespace = config('uses.namespace.'.$versionRoute->getApiVersion());
        if (!$namespace) {
            throw new Exception("{$versionRoute->getApiVersion()} missing namespace");
        }
        if ($paths) {
            foreach ($paths as $path => $uses) {
            }
            $this->app->group(['prefix' => $versionRoute->getApiVersion(),'namespace'=>$namespace], function () use ($versionRoute, $path) {
                $this->app->get($path, [
                    'as' => 'profile', 'uses' => $versionRoute->getRequestUses($path)
                ]);

            });
        }
    }

}