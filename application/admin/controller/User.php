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

    public function index()
    {
       $data = (new UserModel())->field('*')->where(['status'=>1])->select();
        return $this->fetch('index',['data'=>$data]);
    }

    public function  add(){
        return $this->fetch();
    }

    public function save(){
        if($this->request->isPost()){
            $data = request()->param();
            $validate_result = $this->validate($data,'User.add');
            if($validate_result !== true){
                $this->error('验证失败');
            }else
            {
                try
                {
                    (new UserModel())->allowField(true)->isupdate(false)->save($data);
                }catch(\Exception $e)
                {
                    $this->error('添加失败');
                }
                $this->success('添加成功');
            }
        }
    }
}