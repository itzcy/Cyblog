<?php

return [

    // 前台部分
    '/' => 'index/index/index', // 首页

    'article/:id' => 'index/article/show', // 文章详情
    'article' => 'index/article/index', // 文章列表

    'category/:sign' => 'index/category/articles', // 分类下的文章列表
    'category' => 'index/category/index', // 分类

    'tags/:sign' => 'index/tags/show', // tag 下的文章

    'about' => 'index/info/about', // 关于
    'copyright' => 'index/info/copyright', // 关于

];
