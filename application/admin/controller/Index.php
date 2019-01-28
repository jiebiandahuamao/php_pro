<?php
namespace app\admin\controller;

class Index
{

    public function index()
    {
    	return view('/index');
    }
    public function main()
    {
    	return view('/main');
    }
    public function lst($id=0)
    {
    	return 'this is lst content'.$id;
    }


}
