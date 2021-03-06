<?php
/**
 * Created by PhpStorm.
 * User: Itzcy
 * Date: 2018/2/19
 * Time: 19:05
 */

namespace app\index\controller;


use app\common\controller\Init;
use app\index\model\SysConfig;
use app\index\model\Tags as TagsModel;
use think\exception\DbException;
use think\facade\App;
use think\facade\Config;
use think\facade\Request;
use think\facade\Cache;
use think\facade\View;
use think\response\Redirect;

/**
 * 基础处理器 其他需集成
 * Class Base
 * @package app\index\controller
 */
abstract class Base extends Init
{
    /**
     * 系统配置
     * @var array
     */
    protected $sysConfig;

    /**
     * @var int 分页每页显示数量
     */
    protected $pageRows = 15;


    public function __construct()
    {
        parent::__construct(); // TODO: Change the autogenerated stub

        View::assign('module', Request::module());
        View::assign('controller', Request::controller());
        View::assign('action', Request::action());

        $this->loadSysConfig();

        View::assign('sysConfig', $this->sysConfig);

        $this -> pageRows = Config::get('paginate.list_rows') ?? $this -> pageRows;
    }

    /**
     * 从数据库加载配置文件
     */
    private function loadSysConfig()
    {
        try {
            $sysConfig = SysConfig::cache('sys_config', 7200 )->field(['k', 'v'])->select();
            foreach ($sysConfig as $itme) {
                $this->sysConfig[$itme -> k] = $itme -> v;
            }
        } catch (DbException $e) {
            trace($e->getTraceAsString(), 'EXCEPTION');
        }
    }

    /**
     * 获取要查询的页码
     * @param $field
     * @return int|mixed
     */
    public function getPageNum($field = 'page')
    {
        return input($field, '1') < 0 ? 0 : input($field, '1', 'intval');
    }

    /**
     * 查询所有的tags 并分配到页面
     */
    public function assignAllTags()
    {
        $tags = TagsModel::getAll();
        TagsModel::randColor($tags);
        View::assign('tags', $tags);
    }
    public function _empty()
    {
        return Redirect::create('/', 'redirect');
    }

}