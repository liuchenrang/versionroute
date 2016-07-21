<?php
/**
 * Created by PhpStorm.
 * User: XingHuo
 * Date: 16/7/19
 * Time: 下午5:58
 */

namespace Jiuyan\VersionRoute;


class ParseUses
{
    protected $mainVersion = 0;
    protected $middleVersion = 0;
    public function decode($uses){
        preg_match('/(?<main>V\d+)\\\\(?<middle>V\d{2,})/', $uses, $m);
        if ($m) {
            if (isset($m['main'])) {
                $this->mainVersion = trim($m['main'], 'V');
            }
            if (isset($m['middle'])) {
                $this->middleVersion = trim($m['middle'], 'V');
            }
        }
        return $this;
    }
    public function getMainVersion(){
        return $this->mainVersion;
    }
    public function getMiddleVersion(){
        return $this->middleVersion;
    }
    public static function main(){
        $uses = 'Api\V1\V120\NoteController@hello';
        $pas = new ParseUses();
        echo $pas->decode($uses)->getMainVersion();
    }
}
//ParseUses::main();