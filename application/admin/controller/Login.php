<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Session;
class Login extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        return view('login/login');
    }

    /**
     * 显示创建资源表单页.登陆
     *
     * @return \think\Response
     */
    public function create()
    {
        $name = $this->request->param('username');
        $password = $this->request->param('password');
        echo $name;
        echo $password;

        $userModel = model('User')->get(['username' => $name]);;
        if($userModel){
            if(md5($password) == $userModel->password ){
                Session::set('username',$name);
                return redirect(url('/admin/index/index','',false));
            }
            else{
                // return redirect(url('/admin/login/index','',false));
                $perror = 'check you password';
                return view('login/login',compact('perror'));
            }
        }
        else{
            // return redirect(url('/admin/login/index','',false));
            $nerror = 'the account do exist';
            return view('login/login',compact('nerror'));
        }   
    }

    // 退出
    public function logout()
    {
        session('username',null);
        $this->success('退出成功','/admin/login/index');
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
