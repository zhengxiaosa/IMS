<?php
namespace app\admin\controller;
use app\admin\controller\Base;
use think\Controller;
use app\admin\model\User as UserModel;
use think\Session;
class User extends Controller {

    public function login(){

        return $this->fetch();
    }
    //登录验证
    public function checkLogin()
    {
        $status = 0; //验证失败标志
        $result = '验证失败'; //失败提示信息
        $data = request() -> param();
        //验证规则
//        $rule = [
//            'name|姓名' => 'require',
//            'password|密码'=>'require',
//            'captcha|验证码' => 'require|captcha'
//        ];
        //验证数据 $this->validate($data, $rule, $msg)
//        $result = $this -> validate($data, $rule);
//        //通过验证后,进行数据表查询
        //此处必须全等===才可以,因为验证不通过,$result保存错误信息字符串,返回非零
        $result = $this->validate($data,'User.login');
        if (true === $result) {

            //查询条件
            $map = [
                'name' => $data['name'],
                'password' => md5($data['password'])
            ];

            //数据表查询,返回模型对象
            $user = UserModel::get($map);
            if (null === $user) {
                $result = '没有该用户,请检查';
            } else {
                $status = 1;
                $result = '验证通过,点击[确定]后进入后台';

                //创建2个session,用来检测用户登陆状态和防止重复登陆
                Session::set('user_id', $user -> id);
                Session::set('user_info', $user -> getData());

                //更新用户登录次数:自增1
                $user -> setInc('login_count');
            }
        }
        return ['status'=>$status, 'message'=>$result, 'data'=>$data];
    }

    public function logout(){
        Session::delete('user_id');
        Session::delete('user_info');
        $this->success('注销成功','admin/user/login');
    }
}