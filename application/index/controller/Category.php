<?php


namespace app\index\controller;


use think\exception\DbException;
use think\facade\View;

/**
 * 分类相关处理
 * Class Category
 * @package app\index\controller\
 */
class Category extends Base
{

    /**
     * 非法访问直接重定向
     */
    public function index()
    {
        $page = $this -> getPageNum();
        $where = [
            'status' => \app\index\model\Category::STATUS_NORMAL
        ];
        $categoryes = \app\index\model\Category::paging($page, $where);
        View::assign('categoryes', $categoryes);
        return View::fetch();
    }

    /**
     * 某个分类下的文章
     */
    public function articles()
    {
        // 用文章的列表
        return View::fetch('article/index');
    }

}