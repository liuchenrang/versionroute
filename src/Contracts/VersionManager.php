<?php
namespace Jiuyan\VersionRoute\Contracts;
use Jiuyan\VersionRoute\VersionInfo;

/**
 * Created by PhpStorm.
 * User: XingHuo
 * Date: 16/7/19
 * Time: 下午4:18
 */
interface VersionManager
{
    function setRequestVersionInfo(VersionInfo $versionInfo);
    function getRequestUses($path);
    function getApiVersion();

}