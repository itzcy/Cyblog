<?php


namespace app\index\controller;



use app\index\model\Tags;
use think\exception\DbException;
use think\facade\Config;
use think\facade\View;
use think\Log;
use think\paginator\driver\Bootstrap;

/**
 * 文章处理
 * Class Article
 * @package app\index\controller
 */
class Article extends Base
{
    /**
     * 全部文章列表
     * @url /articles
     * @return String
     */
    public function index()
    {

        $where = [
            ['art_status' ,'=', \app\index\model\Article::SHOW],
            ['art_release_time' ,'<=' , strtotime(date('Y-m-d H:i'))],
        ];

        $articles = \app\index\model\Article::paging($this -> getPageNum(), $where, 'art_id', 'desc','articles_');
        View::assign('articles', $articles);

        $this -> assignAllTags();

        View::assign('title', 'Article');

        return View::fetch();
    }

    /**
     * 查看文章
     * @param $id
     * @return string
     */
    public function show($id)
    {
        $article = \app\index\model\Article::cache('article_'.$id)->getByArtId($id);

        if (empty($article)) {
            return '';
        }
        
        View::assign('article', $article);

        View::assign('title', $article->art_title);

        return View::fetch();
    }

}