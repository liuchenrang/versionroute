<?php
/**
 * Created by PhpStorm.
 * User: XingHuo
 * Date: 16/7/19
 * Time: 下午4:09
 */

namespace Jiuyan\VersionRoute;
use Jiuyan\VersionRoute\Contracts\VersionManager as VersionManagerInterface;
use Exception;

class VersionManager implements VersionManagerInterface
{
    protected $debug = false;
    /**
     * @var array 版本路由配置
     */
    protected $routeMap = [];

    /**
     * @return array
     */
    public function getRouteMap()
    {
        return $this->routeMap;
    }

    /**
     * @param array $routeMap
     */
    public function setRouteMap($routeMap)
    {
        $this->routeMap = $routeMap;
    }

    /**
     * @return boolean
     */
    public function isDebug()
    {
        return $this->debug;
    }

    /**
     * @param boolean $debug
     */
    public function setDebug($debug)
    {
        $this->debug = $debug;
    }
    /**
     * @var VersionInfo $versionInfo;
     */
    protected  $versionInfo;
    /**
     * @var ParseUses $parseUses
     */
    protected  $parseUses;

    /**
     * @return mixed
     */
    public function getParseUses()
    {
        return $this->parseUses;
    }

    /**
     * @param mixed $parseUses
     */
    public function setParseUses($parseUses)
    {
        $this->parseUses = $parseUses;
    }
    function setRequestVersionInfo(VersionInfo $versionInfo)
    {
        $this->versionInfo = $versionInfo;
        // TODO: Implement setRequestVersionInfo() method.
    }

    function getRequestUses($path)
    {
//        $config = include __DIR__ . '/config/uses.php';
        $config = $this->getRouteMap();
        $bigV = $this->getApiVersion();
        $this->info('VersionManager bigV ',[$bigV]);
        if (isset($config['versions'][$bigV])) {
            $pathInfo = $config['versions'][$bigV];
            $this->info('VersionManager path ',[$path]);

            if (isset($pathInfo[$path]['uses'])) {
                $findUses = array_pop($pathInfo[$path]['uses']);
                while ($uses = array_shift($pathInfo[$path]['uses'])) {
                    $this->parseUses->decode($uses);
                    if ($this->parseUses->getMainVersion() <= $this->versionInfo->getMain()) {
                        if ($this->parseUses->getMiddleVersion() <= $this->versionInfo->getMiddle()) {
                            $findUses = $uses;
                            break;
                        }
                    }
                }

                $this->info('VersionManager uses ',[$findUses]);
                return $findUses;
            }else{
                throw new Exception("missing path version config!");
            }
        }else{
            throw new Exception("missing api version!");
        }

        // TODO: Implement getRequestUses() method.
    }

    function getApiVersion()
    {
        // TODO: Implement getApiVersion() method.
        return 'v'.$this->versionInfo->getMain();
    }
    function info($str,$content){
        if ($this->isDebug()) {
            echo $str.var_export($content,1)."<br>\n";
        }
    }


}