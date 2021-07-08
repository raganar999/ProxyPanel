<?php

namespace App\Http\Controllers\Api\Client;

use App\Components\IP;
use App\Components\Helpers;
use App\Components\IPIP;
use App\Components\QQWry;
use App\Models\Invite;
use App\Models\User;
use App\Models\UserLoginLog;
use App\Models\UserLabel;
use App\Models\UserSubscribe;
use App\Models\Verify;
use App\Models\VerifyCode;
use App\Mail\activeUser;
use App\Mail\resetPassword;
use App\Mail\sendVerifyCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\Verification;
use App\Notifications\RegisterReward;
use Illuminate\Support\Str;
use Response;
use Redirect;
use Captcha;
use Session;
use Cache;
use Auth;
use Mail;
use Hash;
use Log;
use Illuminate\Support\Facades\Validator;
/**
 * 认证控制器
 *
 * Class AuthController
 *
 * @package App\Http\Controllers
 */
class AuthsController extends Controller
{
    protected static $systemConfig;
    public $new_username='';

   
    function __construct()
    {
        //self::$systemConfig = Helpers::systemConfig();
    }
   
    
    public function reopen(Request $request){

	     	$user = auth()->user();
	        $appkey = $request->header('appkey');
            $device = $request->header('device');
            $device_model = $request->device_model;
            $device_brand = $request->device_brand;
            $system_language = $request->system_language;
            $system_version =  $request->system_version;
			$is_register = 2;
			
			 $this->addUserLoginLog($user->id, IP::getClientIp(), $is_register, $device, $device_brand, $device_model, $system_language , $system_version );
			
			
        	$response['error_code'] = 0;
        	$response['message']    = 'reopen status report successfully ';
        	$response['error_level']    = "log";
        //	$response['data']       = $row ;
        
        	
        	
        	return response()->json($response);
      
	}
    
    // 自动注册
    
   
	
    public function autoRegister(Request $request)
    {
         //   $test99=$request->all();
         //  \Log::debug($test99);
            
            $cacheKey = 'register_times_'.md5(IP::getClientIp()); // 注册限制缓存key

           	$password_str = Str::random(10);
          

           //更新用户名
            $is_not_new = true;
            while ($is_not_new) {
                $is_not_new = $this->get_qnique_email();
            }


            $username = $this->new_username;
            $email = $username;
            $password = Hash::make($password_str);
            $appkey = $request->header('appkey');
            $device = $request->header('device');
            //$aff = (int) $request->input('aff');
            $inviterId =  $request->inviter_id;
            $agent = $request->agent;
            $chanel = $request->chanel;
            
            $device_model = $request->device_model;
            $device_brand = $request->device_brand;
            $system_language = $request->system_language;
            $system_version =  $request->system_version;
           //\Log::debug($appkey);
           \Log::debug($request);
            // 是否开启注册
            if (! sysConfig('is_register')) {
                //Session::flash('errorRegMsg', '系统维护，暂停注册');
                return Response::json(['error_code' => 1001,  'message' => '暂停注册新用户', 'error_level' => 'alert']);
            }

           /* // 校验域名邮箱黑白名单
            if (sysConfig('is_email_filtering')) {
                $result = $this->emailChecker($email, 1);
                if ($result !== false) {
                    return $result;
                }
            }

            */
           

           $is_app_key_exists = User::query()->where('app_key', $appkey)->first();
        if ($is_app_key_exists) {
            
            $is_register = 0;
            $tokenResult       = $is_app_key_exists->createToken('Personal Access Token');
            $token             = $tokenResult->token;
        //    $token->expires_at = Carbon::now()->addHours(1);
            $token->save();
            
            $this->addUserLoginLog($is_app_key_exists->id, IP::getClientIp(), $is_register, $appkey , $device, $device_brand, $device_model, $system_language , $system_version );
            

            $response['error_code'] = 0;
            $response['message']    = 'This device has already been registered and will log in directly';
            $response['error_level']    = "toast";
            $response['token_data']       = [
                'access_token' => $tokenResult->accessToken,
                'expire_in'    => date("Y-m-d H:i:s" , strtotime($tokenResult->token->expires_at) ),
                //'uuid'        => $is_app_key_exists->vmess_id
                'uuid'        => '821a1002-f07e-95bd-1f3e-efc69946f7a2'
            ]; 
            $response['client_config'] = json_decode($this->getClientConfig()) ;
            
            return  $response;
            

        }else{

            // 获取可用端口
            $port = Helpers::getPort();
            if ($port > sysConfig('max_port')) {
                 return Response::json(['error_code' => 1002,  'message' => '暂停注册新用户', 'error_level' => 'alert']);
            }

            // 获取aff
          //  $affArr = $this->getAff(10, $aff);
          //  $inviter_id = $affArr['inviter_id'];

          //  $transfer_enable = MB * ((int) sysConfig('default_traffic') + ( $inviterId ? (int) sysConfig('referral_traffic') : 0));

           $transfer_enable = MB * ((int) sysConfig('default_traffic'));
          
            // 创建新用户
            $user_type = 0;
            $user = Helpers::addUser($email, $password, $transfer_enable, sysConfig('default_days'),  $user_type , $appkey);
           //  \Log::debug($user);
            // 注册失败，抛出异常
            if (! $user) {
                return Response::json(['error_code' => 1001,  'message' => '自动注册失败', 'error_level' => 'alert']);
            }
            
            
          //  User::find($uid)->update(['username' => $username]);
            
            // 注册次数+1
            if (Cache::has($cacheKey)) {
                Cache::increment($cacheKey);
            } else {
                Cache::put($cacheKey, 1, Day); // 24小时
            }

            // 更新邀请码
            
            /*
            if ($affArr['code_id'] && sysConfig('is_invite_register')) {
                Invite::find($affArr['code_id'])->update(['invitee_id' => $uid, 'status' => 1]);
            }
            */
            //添加邀请记录
             Helpers::addInviteLog($inviterId, $user->id, $agent, $chanel );
            
             $is_register = 1;
             
             //\Log::debug($user);
             $this->addUserLoginLog($user->id, IP::getClientIp(), $is_register, $appkey , $device, $device_brand, $device_model, $system_language , $system_version );
           // $user= User::find($uid);
           // \Log::debug($user);
           //通知奖励
            $user->notify(new RegisterReward(10,1));
           
            $tokenResult = $user->createToken('Personal Access Token');
           //   \Log::debug($tokenResult);
            $token = $tokenResult->token;
            
            
                $response['error_code'] = 0;
                $response['message']    = 'Auto register  success';
                $response['error_level']    = "log";
                $response['token_data'] = [
            		'token_type'   =>  'Bearer',
                	'access_token' => $tokenResult->accessToken,
                	'expire_in'    => date("Y-m-d H:i:s" , strtotime($tokenResult->token->expires_at) ),
                	'refresh_token' =>  '',
                	 'uuid'  => "821a1002-f07e-95bd-1f3e-efc69946f7a2"
                	// 'uuid'        => $user->vmess_id
                ]; 
               $response['client_config'] = json_decode($this->getClientConfig()) ;
               
           return $response;
           
        }
        
    }
    
    
    public function login(Request $request){ 
  	
      if(Auth::attempt(['email' => $request->email, 'password' =>$request->password])){ 
           
            $appkey = $request->header('appkey');
            $device = $request->header('device');
            $device_model = $request->device_model;
            $device_brand = $request->device_brand;
            $system_language = $request->system_language;
            $system_version =  $request->system_version;
            $is_register = 0;
           // \Log::debug($request);
            
            $user = Auth::user(); 
            $tokenResult       = $user->createToken('Personal Access Token');
            $token             = $tokenResult->token;
         //  $token->expires_at = Carbon::now()->addHours(1);
            $token->save();
            
           
            $this->addUserLoginLog($user->id, IP::getClientIp(), $is_register, $device, $device_brand, $device_model, $system_language , $system_version );
           

            $response['error_code'] = 0;
            $response['message']    = 'login success';
            $response['error_level']    = "log";
            $response['token_data']       = [
                'token_type'   =>  'Bearer',
                'access_token' => $tokenResult->accessToken,
                'expire_in'    => $tokenResult->token->expires_at,
                'refresh_token' =>  '',
               // 'uuid'        => $user->vmess_id
               'uuid'        => '821a1002-f07e-95bd-1f3e-efc69946f7a2'
            ]; 
            
            
            
           $response['client_config'] = json_decode($this->getClientConfig()) ;
           
    		//生成新的token事件
           // event(new GetNewToken($user));
           
            return $response;
            
               
            
         
            } else {
                return Response::json(['error_code' => 2001,  'message' => 'Username or password is incorrect', 'error_level' => 'alert']);
            }
    }



    public function updatePasswordWithAuth(Request $request){

        $validator = Validator::make($request->all(), [
            'new_password'      => 'required'
        ]);
        $user = User::where('id', Auth::id())->first();
        $user->password = Hash::make($request->new_password);
        $user->save();
        if ($user) {
            $response['error_code'] = 1;
            $response['message']    = '密码修改成功';
            
            return response()->json([
                'success' => $response
            ]);

        }else{
            $response['error_code'] = null;
            $response['message']    = '';
            return response()->json([
                'error' => $response
            ]);
        }
    }
    public function updatePasswordWithCode(Request $request){
        $validator = Validator::make($request->all(), [
            'email'     => 'required|email',
            'new_password' => 'required',
            'code'        => 'required'

        ]);
        if ($validator->fails()) {
            // return response()->json($validator->messages(), 422);
            $response['error_code'] = 4001;
            $response['message']    = '缺少参数';
            $response['error_level']    = "toast";
            return response()->json([
                'error' => $response
            ]);

        }


        $verifyCode = VerifyCode::query()->where('email', $request->email)->where('code', $request->code)->where('status', 0)->first();
        if ($verifyCode) {
            $user = User::where('email', $request->email)->first();
            $user->password = $request->new_password;
            $user->save();
            if ($user) {
                $verifyCode = VerifyCode::query()->where('email', $request->email)->where('code', $request->code)->where('status', 0)->first();
                $verifyCode->status = 1; 
                $verifyCode->save(); 

                $response['error_code'] = 0;
                $response['message']    = '密码修改成功';
                $response['error_level']    = "alert";
                return response()->json( $response);

            }
        }else{
            $response['error_code'] = 4002;
            $response['message']    = '验证码无效，请重新获取';
            $response['error_level']    = "alert";
            return response()->json($response);
              
        }
    }


    public function updateUser(Request $request){
        $validator = Validator::make($request->all(), [
            'new_username'      => 'required|email|unique:user,username,'.Auth::id(),
            'new_password'      => 'required', 
            'code'              => 'required'


        ]);
        if ($validator->fails()) {
            // return response()->json($validator->messages(), 422);
            $response['error_code'] = 5001;
            $response['message']    = '用户名已经被使用';

            return response()->json($response);
             
        }
    
           $user = User::where('id', Auth::id())->first();
           $verifyCode = VerifyCode::query()->where('email', $user->email)->where('code', $request->code)->where('status', 0)->first();
        
        if ($user->type == 0 && $verifyCode) {
            $user->email  = $request->new_username;
            $user->type = 1;
            $user->password  = $request->new_password;
            $user->save();
           
            if ($user) {
                
               
            	// 失效已使用的验证码，这里会有bug ，如果在这个过程当中用户再来获取验证码，会有执行错误出现。
                $verifyCode = VerifyCode::query()->where('code', $request->code)->where('status', 0)->first();
                $verifyCode->status = 1; 
                $verifyCode->save(); 
            	
            	
                $response['error_code'] = 0;
                $response['message']    = '升级为注册用户成功';
                $response['data']       = ['user_type' => $user->type]; //not clear
                return response()->json($response);
                    
            }else{
                $response['error_code'] = null;
                $response['message']    = '';

                return response()->json([
                    'error' => $response
                ]);
            }
        }else{
            $response['error_code'] = 5005;
            $response['message']    = '已经为注册用户不能再次修改或者为验证码已经失效';

            return response()->json($response);
                
            

    }


   }

   public function sendCode(Request $request)
    {
        $email = $request->email;

        if (!$email) {
            $response['error_code'] = 3001;
            $response['message']    = '邮箱缺失，或者错误';

            return response()->json([
                'error' => $response
            ]);
        }

       
      /*
        // 校验域名邮箱是否在敏感词中
        $sensitiveWords = $this->sensitiveWords();
        $usernameSuffix = explode('@', $username); // 提取邮箱后缀
        if (in_array(strtolower($usernameSuffix[1]), $sensitiveWords)) {
            $response['error_code'] = null;
            $response['message']    = '3';

            return response()->json([
                'error' => $response
            ]);
        }
      */
        $user = User::query()->where('email', $email)->first();
        if (!$user) {
            $response['error_code'] = 3003;
            $response['message']    = "username does not exist";;

            return response()->json([
                'error' => $response
            ]);
        }
        
         // 防刷机制
        if (Cache::has('send_verify_code_' . md5(IP::getClientIp()))) {
            $response['error_code'] = null;
            $response['message']    = '6';

            return response()->json([
                'error' => $response
            ]);
        }

        // 发送邮件
        $code = Str::random(4);
        $title = '发送注册验证码';
        $content = '验证码：' . $code;

        $logId = Helpers::addNotificationLog($title  ,$code,   1, $email,  $content);
        //$user->notifyNow(new Verification($code));

        $this->addVerifyCode($email, $code);

        Cache::put('send_verify_code_' . md5(IP::getClientIp()), IP::getClientIp(), 1);

        $response['error_code'] = 0;
        $response['message']    = 'verification code was successfully sent to the mail';   
         $response['error_level']    = "alert";
        return response()->json($response);


    }
    // 写入生成激活账号验证记录
    private function addVerify($userId, $token)
    {
        $verify = new Verify();
        $verify->type = 1;
        $verify->user_id = $userId;
        $verify->token = $token;
        $verify->status = 0;
        $verify->save();
    }

    // 生成注册验证码
    private function addVerifyCode($email, $code)
    {
        $verify = new VerifyCode();
        $verify->email = $email;
        $verify->code = $code;
        $verify->status = 0;
        $verify->save();
    }
    
     //获取自动注册唯一的用户名
	private function get_qnique_email(){
		$this->new_username = Str::random(15).'@77cloud.com';
		if (User::where('username', $this->new_username)->count() == 0) {
			return false;	
		}
		return true;
	}
	
	
	
	 /**
     * 添加用户登录日志.
     *
     * @param  int  $userId  用户ID
     * @param  string  $ip  IP地址
     */
    private function addUserLoginLog(int $userId, string $ip,  int $is_register , string $appkey = null ,string $device = null, string $device_brand = null , string $device_model = null,  string $system_language = null , string $system_version = null ): void
    {
        $ipLocation = IP::getIPInfo($ip);

        if (empty($ipLocation) || empty($ipLocation['country'])) {
            Log::warning('获取IP信息异常：'.$ip);
        }

        $log = new UserLoginLog();
        
        $log->user_id = $userId;
        $log->is_register = $is_register;
        $log->app_key = $appkey;
        $log->device = $device;
        $log->device_brand = $device_brand;
        $log->device_model = $device_model;
        $log->system_language = $system_language;
        $log->system_version = $system_version;
        $log->ip = $ip;
        $log->country = $ipLocation['country'] ?? '';
        $log->province = $ipLocation['province'] ?? '';
        $log->city = $ipLocation['city'] ?? '';
        $log->county = $ipLocation['county'] ?? '';
        $log->isp = $ipLocation['isp'] ?? ($ipLocation['organization'] ?? '');
        $log->area = $ipLocation['area'] ?? '';
        $log->save();
    }


    /**
     * 获取AFF.
     *
     * @param  string|null  $code  邀请码
     * @param  int|null  $aff  URL中的aff参数
     *
     * @return array
     */
    private function getAff($code = null, $aff = null): array
    {
        $data = ['inviter_id' => null, 'code_id' => 0]; // 邀请人ID 与 邀请码ID

        // 有邀请码先用邀请码，用谁的邀请码就给谁返利
        if ($code) {
            $inviteCode = Invite::whereCode($code)->whereStatus(0)->first();
            if ($inviteCode) {
                $data['inviter_id'] = $inviteCode->inviter_id;
                $data['code_id'] = $inviteCode->id;
            }
        }

        // 没有用邀请码或者邀请码是管理员生成的，则检查cookie或者url链接
        if (! $data['inviter_id']) {
            // 检查一下cookie里有没有aff
            $cookieAff = \Request::hasCookie('register_aff');
            if ($cookieAff) {
                $data['inviter_id'] = User::find($cookieAff) ? $cookieAff : null;
            } elseif ($aff) { // 如果cookie里没有aff，就再检查一下请求的url里有没有aff，因为有些人的浏览器会禁用了cookie，比如chrome开了隐私模式
                $data['inviter_id'] = User::find($aff) ? $aff : null;
            }
        }

        return $data;
    }
    
    
    // 生成用户标签
    private function makeUserLabels($userId, $labels)
    {
        // 先删除该用户所有的标签
        UserLabel::query()->where('user_id', $userId)->delete();

        if (!empty($labels) && is_array($labels)) {
            foreach ($labels as $label) {
                $userLabel = new UserLabel();
                $userLabel->user_id = $userId;
                $userLabel->label_id = $label;
                $userLabel->save();
            }
        }
    }
     
      //生成客户端的smart 模式的配置文件
      private function getClientConfig(){
      	 $client_config = '{
  "stats":{},
  "log": {
    "loglevel": "warning"
  },
  "policy":{
      "levels": {
        "8": {
          "handshake": 4,
          "connIdle": 300,
          "uplinkOnly": 1,
          "downlinkOnly": 1
        }
      },
      "system": {
        "statsOutboundUplink": true,
        "statsOutboundDownlink": true
      }
  },
  "inbounds": [{
    "tag": "socks",
    "port": 10808,
    "protocol": "socks",
    "settings": {
      "auth": "noauth",
      "udp": true,
      "userLevel": 8
    },
    "sniffing": {
      "enabled": true,
      "destOverride": [
        "http",
        "tls"
      ]
    }
  },
  {
    "tag": "http",
    "port": 10809,
    "protocol": "http",
    "settings": {
      "userLevel": 8
    }
  }
],
  "outbounds": [
  {
    "tag": "proxy",
    "protocol": "vmess",
    "settings": {
      "vnext": [
        {
          "address": "v2ray.cool",
          "port": 10086,
          "users": [
            {
              "id": "a3482e88-686a-4a58-8126-99c9df64b7bf",
              "alterId": 64,
              "security": "auto",
              "level": 8
            }
          ]
        }
      ],
      "servers": [
        {
        "address": "v2ray.cool",
        "method": "chacha20",
        "ota": false,
        "password": "123456",
        "port": 10086,
        "level": 8
      }
      ]
    },
    "streamSettings": {
      "network": "tcp"
    },
    "mux": {
      "enabled": false
    }
  },
  {
    "protocol": "freedom",
    "settings": {},
    "tag": "direct"
  },
  {
    "protocol": "blackhole",
    "tag": "block",
    "settings": {
      "response": {
        "type": "http"
      }
    }
  }
  ],
  "routing": {
      "domainStrategy": "IPIfNonMatch",
      "rules": [],
       "balancers": [
       {
       "tag": "balancer",
        "selector": [],
        "strategy": "optimal",
        "optimalSettings": {
          "timeout": 200000,
          "interval": 300000,
          "url": "https://douyin.ga",
          "count": 1,
          "weights": []
         
        }
      }
      ]
    
  },
  "dns": {
      "hosts": {},
      "servers": []
  }
  
}';

        return $client_config;
      }
     

}