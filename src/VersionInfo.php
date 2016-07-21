<?php
namespace Jiuyan\VersionRoute;

/**
 * Created by PhpStorm.
 * User: XingHuo
 * Date: 16/7/19
 * Time: 下午12:17
 */
class VersionInfo
{

    protected static $instance;
    protected $main;
    protected $middle;
    protected $third;

    /**
     * @return mixed
     */
    public function getThird()
    {
        return $this->third;
    }

    /**
     * @param mixed $third
     */
    public function setThird($third)
    {
        $this->third = $third;
    }

    public static function getInstance($version){
        if (!$version) {
            $version = '1.0.0';
        }
        if (!self::$instance) {
            self::$instance = new self($version);
        }
        return self::$instance;
    }
    public function __construct($version)
    {
            $this->init($version);
    }
    public function init($version){
        $versionInfo = explode('.', $version);
        list($this->main, $this->middle, $this->third) = $versionInfo;
    }




    /**
     * @return mixed
     */
    public function getMiddle()
    {
        return $this->middle;
    }

    /**
     * @param mixed $middle
     */
    public function setMiddle($middle)
    {
        $this->middle = $middle;
    }

    /**
     * @return mixed
     */
    public function getMain()
    {
        return $this->main;
    }

    /**
     * @param mixed $main
     */
    public function setMain($main)
    {
        $this->main = $main;
    }
}