<?php
/**
 * Created by PhpStorm.辅助函数
 * User: gaoxuhui
 * Date: 2018/7/23
 * Time: 18:06
 */

function route_class()
{
    return str_replace('.', '_', Route::currentRouteName());
}