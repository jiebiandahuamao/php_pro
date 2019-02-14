<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use think\Db;

class User extends Controller
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $request)
    {
        $users = model('User')->all();
        return view('user/allUsers',compact('users'));
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function usercreate(Request $request)
    {
    
        return view('user/addUser');
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function saveuser(Request $request)
    {
        //
        $name = $this->request->param('username');
        $password = $this->request->param('password');
        $email = $this->request->param('email');
        $note = $this->request->param('note');

        $pwd = md5($password);
        //1.do insert with function;
        // $sql = sprintf('insert into user(username,email,password,note) values ("%s","%s","%s","%s")',$name,$email,$pwd,$note);
        // $status = Db::execute($sql);
        // echo $status;
        // if ($status)
        // {
        //     echo 'insert user table successful!!!!';
        // }

        //2.do insert with model;
        $userModel = model('User');
        $userModel -> username = $name;
        $userModel -> email = $email;
        $userModel -> password = $pwd;
        $userModel -> note = $note;

        $status = $userModel->save();
        if($status){
            echo 'insert table successful!!!';
            $this->success('操作完成','/admin/user/index',3);
        }
        else{
            $this->error('操作失败','/admin/user/usercreate',5);      // 需要添加 try except
        }

    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read(request $request)
    {
        $id = $this->request->param('id');
        $info = model('User')->get($id);
        return view('user/userInfo',compact('info'));
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit(request $request)
    {
        $id = $this->request->param('id');

        $name = $this->request->param('username');
        $password = $this->request->param('password');
        $email = $this->request->param('email');
        $note = $this->request->param('note');
        $pwd = md5($password);
        echo $name;
        $userModel = model('User')->get($id);

        // $userModel = model('User');
        $userModel -> username = $name;
        $userModel -> email = $email;
        $userModel -> password = $pwd;
        $userModel -> note = $note;

        $status = $userModel->save();

        if($status){
            echo 'edit successful';
            return redirect(url('/admin/user/index','',false));
        }
        else{
            echo 'edit error';
            return redirect(url('/admin/user/read','',false));
        }
       


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
