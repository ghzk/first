<?php
/**
 * 微信oAuth认证示例
 */
namespace Weixin;

class Auth
{
    private $options;
    public $open_id;

    public function __construct($options)
    {
        session_start();
        $this->options = $options;
        $this->wxoauth();
    }

    public function wxoauth()
    {
        $scope = 'snsapi_base';
        $code = isset($_GET['code']) ? $_GET['code'] : '';

        if (!$code && isset($_SESSION['open_id'])) {
            $this->open_id = $_SESSION['open_id'];

            return $this->open_id;
        } else {
            $options = array(
                'token'     => $this->options['token'], //填写你设定的key
                'appid'     => $this->options['appid'], //填写高级调用功能的app id
                'appsecret' => $this->options['appsecret'] //填写高级调用功能的密钥
            );
            $we_obj = new Wechat($options);
            if ($code) {
                $json = $we_obj->getOauthAccessToken();
                if (!$json) {
                    unset($_SESSION['wx_redirect']);

                    // hack
                    unset($_GET['code']);
                    return $this->wxoauth();

                    die('获取用户授权失败，请重新确认');
                }
                $_SESSION['open_id'] = $this->open_id = $json["openid"];
                if ($this->open_id) {
                    return $this->open_id;
                }
                $scope = 'snsapi_userinfo';
            }
            if ($scope == 'snsapi_base') {
                $url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                $_SESSION['wx_redirect'] = $url;
            } else {
                $url = $_SESSION['wx_redirect'];
            }
            if (!$url) {
                unset($_SESSION['wx_redirect']);
                die('获取用户授权失败');
            }
            $oauth_url = $we_obj->getOauthRedirect($url, "wxbase", $scope);
            header('Location: ' . $oauth_url);
            exit();
        }
    }
}

//$options = array(
//    'token'     => 'tokenaccesskey', //填写你设定的key
//    'appid'     => 'wxdk1234567890', //填写高级调用功能的app id, 请在微信开发模式后台查询
//    'appsecret' => 'xxxxxxxxxxxxxxxxxxx', //填写高级调用功能的密钥
//);
//$auth = new wxauth($options);
//var_dump($auth->wxuser);
