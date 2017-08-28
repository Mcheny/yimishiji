<?php

namespace app\admin\controller;
class Goods extends Base
{
    function goodsList()
    {
    return $this->fetch('list');
    }
}