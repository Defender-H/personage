<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/22
 * Time: 14:04
 */

namespace App\Common\Admin;


use Illuminate\View\View;

class Base
{
    public $movieList = [];
    public function __construct()
    {
        $this->movieList = [
            'Shawshank redemption',
            'Forrest Gump',
        ];
    }
    public function compose(View $view)
    {
        view()
        dd($movieList);
        $view->with('latestMovie');
    }
}