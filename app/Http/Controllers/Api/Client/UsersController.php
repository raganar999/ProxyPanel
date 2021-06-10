<?php

namespace App\Http\Controllers\Api\Client;

use App\Components\Helpers;
use App\Components\IP;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client as GuzzleClient;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SysConfig;
use App\Models\SsNode;
use App\Models\SsNodeIp;
use App\Models\User;
use App\Models\Article;
use App\Models\Goods;
use App\Models\OrderGoods;
use App\Models\Payment;
use App\Models\Version;
use App\Models\GoodsLabel;
use App\Models\Order;
use App\Models\Contract;
use App\Models\UserLabel;
use App\Models\SsNodeLabel;
use App\Models\Label;
use App\Models\ReferralLog;
use App\Models\ApiDomain;
use App\Models\SsGroup;
use App\Models\Allowapps;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Events\GetNewToken;
use Response;
use Auth;
use DB;
use Carbon\Carbon;
use Cache;
use Session;
use Log;
use Hash;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use App\Notifications\AccountExpire;

class UsersController extends Controller
{
	public $privetekey='';
	public $new_username='';
    protected static $systemConfig;

    function __construct()
    {
        //self::$systemConfig = Helpers::cacheSystemConfig();
    }



	public function test(Request $request){
	    
	    $user = auth()->user();
	    $user->notify(new AccountExpire($user->expired_at));
	    
	     \Log::debug($user);
	    // return '111';
        return Auth::id();
        
         
        
	}
	
	public function allowApps(){
	    
	    $allowlist = AllowApps::query()->pluck('app_domain');
	    
	    
	    
	    	$response['error_code'] = 1;
        	$response['message']    = 'Get allowlist successfully';
        	$response['allow_list'] =   $allowlist;
               
                 
		   return response()->json($response);
	    
	    
	}
	
	public function term(){
		
	
			$term = Article::whereType(3)->orderBy('sort', 'desc')->first();
	
        if ($term) {

        	$response['error_code'] = 1;
        	$response['message']    = 'Get term successfully';
        	$response['data']        =   [
               
                   'term' =>  $term->content,
                
            ]; 
            
		   return response()->json($response);
	    
        }else{

        	$response['error_code'] = null;
        	$response['message']    = '';

		    return response()->json([
		    	'error' => $response
		    ]);
        }
	}
    
	
	
	
	
	public function logUpload(Request $request){
	   
	  if ($request->isMethod('post')) {

            $file = $request->file('log');

            // 文件是否上传成功
            if ($file->isValid()) {

                // 获取文件相关信息
                $originalName = $file->getClientOriginalName(); // 文件原名
                $ext = $file->getClientOriginalExtension();     // 扩展名
                $realPath = $file->getRealPath();   //临时文件的绝对路径
                $type = $file->getClientMimeType();     // image/jpeg

                // 上传文件
                $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
                // 使用我们新建的uploads本地存储空间（目录）
                //这里的uploads是配置文件的名称
                $bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));
                var_dump($bool);

            }
            
         	$response['error_code'] = 0;
        	$response['message']    = '上传日志文件成功';

        	
		    return response()->json($response);
        }


	}
	
	
	




	public function getAffRecord(Request $request){
    		
	    $raff = ReferralLog::where('ref_user_id', Auth::id())->first();
	    
	     if ($raff) {
	  
        	$response['error_code'] = 1;
        	$response['message']    = 'get the raff successful';
        	$response['data']       = $raff;
        	
		    return response()->json([
		    	'success' => $response
		    ]);
	  
	    }
	}
	
	

	
	
	
	public function checkIn(Request $request){
	    
	    
         // 系统开启登录加积分功能才可以签到
       if (!self::$systemConfig['is_checkin']) {
           return Response::json(['status' => 'fail', 'message' => '系统未开启签到功能']);
       }

      /*// 已签到过，验证是否有效
       if (Cache::has('userCheckIn_' . Auth::user()->id)) {
            $response['error_code'] = 0;
        	$response['message']    = '签到失败，今天已经签到过了！';
        	$response['data']       =  [
                'traffic' => 0,
                'time'    => 0
            ]; 
        	return response()->json([
		    	'error' => $response
		    ]);
       }
      */
      //如果到期用户没有到期，签到赠送流量.  如果到期了，则赠送流量和时间
      
        $score_traffic = mt_rand(self::$systemConfig['min_rand_traffic'], self::$systemConfig['max_rand_traffic']);
        
      if (Auth::user()->expired_at < date("Y-m-d H:i:s")) {
      	//获取随机时间
      	$score_time    = mt_rand(self::$systemConfig['min_rand_time'], self::$systemConfig['max_rand_time']);
      	//计算赠送后的到期时间
        $ret_time      = Carbon::now()->addMinutes($score_time)->settimezone(Config::get('app.timezone'))->format('Y-m-d H:i:s');
      	
      	$ret_traffic_ok   = User::query()->where('id', Auth::user()->id)->increment('transfer_enable', $score_traffic * 1048576);
       
        $ret_time_ok   = User::query()->where('id', Auth::user()->id)->update(['expired_at' => $ret_time, 'enable' => 1]);
      	
      }else{
      	
      	$ret_traffic_ok   = User::query()->where('id', Auth::user()->id)->increment('transfer_enable', $score_traffic * 1048576);
      	
      	$score_time = 0;
      }
        
      
      //执行无错误则返回相应数据，有错误跳出
        
        if ($ret_traffic_ok ) {
        	 // 写入用户流量变动记录
           // Helpers::addUserTrafficModifyLog(Auth::user()->id, 0, Auth::user()->transfer_enable, Auth::user()->transfer_enable + $score_traffic * 1048576, '[签到]');
         
        
        // 多久后可以再签到
             $ttl = self::$systemConfig['traffic_limit_time'] ? self::$systemConfig['traffic_limit_time'] : 1440;
             Cache::put('userCheckIn_' . Auth::user()->id, '1', $ttl);
            
            $response['error_code'] = 0;
        	$response['message']    = '签到成功！';
        	$response['data']       =  [
                'traffic' =>  $score_traffic,
                'time'    => $score_time 
            ]; 
        	return response()->json($response);
		    
            
        } else {
                 return Response::json(['status' => 'fail', 'message' => '签到失败，系统异常']);
               }

       
	}
	
	




	

	public function serverList(Request $request){

	   //$user_id= Auth::id();
	   
	   $server_data = $this->getServerList(Auth::id());
	   
	  
    	$response['error_code'] = 0;
    	$response['message']    = '获取配置和线路成功';
    	$response['data']       = [
    		
    
    		'server_list'     => $server_data
    		
    		];
    	
	    return response()->json($response);
	    
	}	
	
	
	 public function nodeList(int $id = null)
    {
       
       
       
        $user = auth()->user();
        $nodes = $user->nodes()->get();
        if (isset($id)) {
            $node = $nodes->find($id);

            if (empty($node)) {
                return response()->json([], 204);
            }

            return response()->json($node->config($user));
        }
        $servers = [];
        foreach ($nodes as $node) {
            $servers[] = $node->config($user);
        }
        
            
          //  $notice = [];
            //$notice["title"]  = Article::whereType(2)->pluck('title');
           // $notice["content"] =  Article::whereType(2)->pluck('content');
           
            $notice = [];
            $notice["title"]    ="AccountExpire";
            $notice["content"]    ="Your account will expire soon, please renew in time";
            $notice["type"]    = "Notification";  //分为三个等级，小铃铛+通知栏， 小铃铛+dialog
            $notice["time"]    = date('Y-m-d H:i:s');
            
            
	        $row  = [];
			$row["user_enable"]        = $user->enable;
		//	$row["user_type"]          = $user->user_type;
		

			$row["vip_traffic"]         =$user->transfer_enable;
			$row["vip_usedTraffic"]     = $user->u + $user->d;
			$row["expire_ime"]          = $user->expired_at;
			$row["user_status"]         = $user->status;
			$row["user_email"]         = $user->email;
			$row["latest_api_domain"]  = "https://zaozao.ml:7777";
		//	$row["latest_buy_domain"]  = "zaozao2.ml";
			$row["latest_ver"]         = "1.0.0";
	        $row["notice"]             = [$notice];
		//	$row["allow_devices_num"]  = $user->usage;
		//	$row["vmess_id"]           = $user->vmess_id;
		//	$row["resetday"]           = $user->traffic_reset_day;
		//    $row["speed_level"] = flowAutoShow($user->speed_limit_per_con);
		   


       
    	$response['error_code'] = 0;
    	$response['message']    = 'Get the server list successfully';
    	$response['message_level']    = 'alert';
    	$response['data']       = [
    		
            'user_status'     => $row ,
    		'server_list'     => $servers
    		
    		];
    	
	    return response()->json($response);
    }



	public function refreshStatus(){

		$user = auth()->user();
	
			
			$balancer =  $user->nodes()->whereRecommend(1)->select(['tag','weights'])->get();
			
			//select('tag','weights' );
		
		    $row  = [];
			$row["user_enable"]        = $user->enable;
		//	$row["user_type"]          = $user->user_type;
			$row["vip_traffic"]         =$user->transfer_enable;
			$row["vip_used_traffic"]     = $user->u + $user->d;
			$row["expire_time"]          = $user->expired_at;
			$row["user_status"]        = $user->status;
			$row["user_email"]         = $user->email;
			$row["latest_api_domain"]  = "zaozao.ml";
			$row["latest_buy_domain"]  = "zaozao2.ml";
			$row["latest_ver"]         = "1.0.0";
			$row["notice"]             = "";
		
        	$response['error_code'] = 0;
        	$response['message']    = 'Get user status successfully ';
        	$response['level']    = "alert";
        	$response['data']       = $row ;
        	$response['balancer ']  = $balancer;
        	
        	
        	return response()->json($response);
      
	}


	public function userStatus(){

		$user = auth()->user();
		if ($user) {
			
		
			$row                       = [];
			$row["user_enable"]        = $user->enable;
		//	$row["user_type"]          = $user->user_type;
		    $row["high_speed_traffic"] = "unlimited";

			$row["vipTraffic"]         = $user->transfer_enable;
			$row["vipUsedTraffic"]     = $user->u + $user->d;
			$row["expireDate"]         = $user->expired_at;
			$row["allow_devices_num"]  = $user->usage;
		//	$row["vmess_id"]           = $user->vmess_id;
			$row["reset_day"]           = $user->reset_day;
			$row["balance"]             = $user->credit;
			$row["email"]               = $user->email;
			$row["email"]               = $user->id;
		    $row["speed_level"]         = "high";
		    $row["user_type"]           = $user->type;
		
		}


      


		if ($user) {
        	$response['error_code'] = 0;
        	$response['message']    = 'Get user status successfully ';
        	$response['level']    = "alert";
        	$response['data']       = $row ;
        	
		    return response()->json($response);
		}else{
        	$response['error_code'] = 7010;
        	$response['message']    = '数据查询错误';

		    return response()->json($response);
		}
	}

	public function goodslist(){

        
        
      /*  if ($type == 100) {
            $orders    = Order::where('user_id', Auth::id())->get();
            
            $goods        = Goods::where('type', $type)->get();
            foreach ($orders as $order) {

                $good = Goods::where('id', $order->goods_id)->first();
                if ($good) {
                    $row                    = [];
                    $row['product_name']    = $good->name;
                    $row['product_price']   = $good->price;
                    $row['created_at']      = $order->created_at;
                    $row['expire_at']       = $order->expire_at;
                    $row['is_expire']       = $order->is_expire;
                    array_push($data, $row);
                }

            }
            $response['error_code'] = 1;
            $response['message']    = '获取以购买商品成功';
            $response['data']       = $data;
        }else{
        */  
            $goods_groups = [];
            $goods_group['good_group_type']  = 2;
            $goods_group['good_group_name'] = '普通套餐';
            $goods_group['good_group_desc'] = '满足普通上网需求，网页和普通视频流畅,每30天重置流量';
            array_push($goods_groups, $goods_group);
            
            
            
            $data = [];
            $goods        = Goods::where('status', 1)->get();
            foreach ($goods as $good) {
                $row                    = [];
                $row['goods_name']    = $good->name;
                $row['goods_traffic'] = $good->traffic;
                $row['goods_usage']   = $good->usage; // not clear
                $row['goods_type']    = $good->type;
                $row['goods_price']   = $good->price;
                
                $row['goods_days']    = $good->days;
                $row['goods_sort']    = $good->sort;
                array_push($data, $row);
            }
            $response['error_code'] = 0;
            $response['message']    = '获取商品列表成功';
            $response['data']       = [
            	
            	'good_groups'    => $goods_groups,
            	'goods'          => $data
            	
            	];
        

    	
	    return response()->json($response);
	    
	}


     
   
     public function orderList(){
     	
     	 $user = User::where('id', Auth::id())->first();
     	 $puerchased_services = Order::query()->where('user_id', $user->id)->get();
     	 $data = [];
     	 foreach ($puerchased_services as $service) {
     	    $row                    = [];
            $row['service_name']     = '';
     	   	$row['service_price']    = $service->amount;
     	   	$row['created_ate']      = $service->created_at;
     	   	$row['expire_at']        = $service->expire_at;
     	   	$row['is_expire']        = $service->is_expire;
     	    array_push($data , $row);
     	   
     	   
     	   }
     	   
     	  	$response['error_code'] = 0;
        	$response['message']    = '获取已购买的服务成功';
        	$response['data']       = $data;
        	
		    return response()->json($response) ;
     	   
     	
     	
     }



	


    
    
   
     
    
}

