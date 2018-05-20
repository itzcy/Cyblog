<?php
/**
 * Created by PhpStorm.
 * User: Itzcy
 * Date: 2017/7/30
 * Time: 22:53
 */
namespace app\dashboard\controller;

class Index extends Base
{
    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
    }

    /**
     * 登陆后的框架页
     * @return mixed
     */
    public function index()
    {
        $count['artNum'] = model('article') -> where([]) -> count();
        $count['clsNum'] = model('category') -> where([]) -> count();
        $count['userNum'] = model('sys_manage') -> where([]) -> count();
        $count['likNum'] = model('links') -> where([]) -> count();
        
        $this -> assign('count', $count);
        return $this -> fetch();
    }

    /**
     * 欢迎页
     */
    public function welcome()
    {
        return $this -> fetch();
    }
}
