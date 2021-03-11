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

class UsersController extends Controller
{
	public $privetekey='';
	public $new_username='';
    protected static $systemConfig;

    function __construct()
    {
        self::$systemConfig = Helpers::systemConfig();
    }



	public function test(Request $request){
	    // return '111';
        return Auth::id();
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

       
    	$response['error_code'] = 0;
    	$response['message']    = '获取配置和线路成功';
    	$response['message_level']    = 'alert';
    	$response['data']       = [
    		
    
    		'server_list'     => $servers
    		
    		];
    	
	    return response()->json($response);
    }


	public function userStatus(){

		$user = User::where('id', Auth::id())->first();
		if ($user) {
			
		
			$row                       = [];
			$row["user_enable"]        = $user->enable;
			$row["user_type"]          = $user->user_type;
		

			$row["Traffic"]         = flowAutoShow($user->transfer_enable);
			$row["usedTraffic"]     = flowAutoShow($user->u + $user->d);
			$row["expire_date"]        = $user->expire_time;
			$row["allow_devices_num"]  = $user->usage;
			$row["vmess_id"]           = $user->vmess_id;
			$row["resetday"]           = $user->traffic_reset_day;
		    $row["speed_limit_per_con"] = flowAutoShow($user->speed_limit_per_con);
		
		
		}


		if ($user) {
        	$response['error_code'] = 0;
        	$response['message']    = '获取用户状态成功';
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



	


    
    
     private function getServerList($userId){
     	    
     	    $SsGroups  = SsGroup::all();
     	    
     	    $server_groups = [];
     
		    foreach ($SsGroups as $ssgroup) {
			$row                  = [];
			$row['server_group_id']     = $ssgroup->id;
			$row['server_group_name']   = $ssgroup->name;
			$row['server_group_sort']   = $ssgroup->sort;
		  
		 
			//$row['v2_vmess_id']   = $ssnode->v2_vmess_id;
		//	$row['v2_alter_id']   = $ssnode->v2_alter_id;
		//	$row['v2_net']        = $ssnode->v2_net;
		//	$row['v2_type']       = $ssnode->v2_type;
		//	$row['v2_host']       = $ssnode->v2_host;
	    //	$row['v2_path']       = $ssnode->v2_path;
		//	$row['v2_tls']        = $ssnode->v2_tls;
		
			array_push($server_groups, $row);
	    	}
     	    
			
	   
	   
	        $outbounds  =  [];
	  
	        $outbound['protocol_type']   = 2;
	        $outbound['protocol']   = 'vmess';
	        $outbound['alterId']    = 0;
	        $outbound['security']   = 'chacha20-poly1305';
	        $outbound['mux']        = 'false';
	        $outbound['nework']     = 'ws';
	        $outbound['path']       = '/fb';
	        $outbound['security']   = 'tls';
	        $outbound['allowInsecure']   = 'true';
	        array_push($outbounds , $outbound);
	
	    	$label_ids 	= UserLabel::where('user_id',  $userId )->pluck('label_id')->toArray();
	    	$node_ids 	= SsNodeLabel::whereIn('label_id', $label_ids)->pluck('node_id')->toArray();
	    	$SsNodes    = SsNode::whereIn('id', $node_ids)->get();
		
	    	$server_list = [];
		    foreach ($SsNodes as $ssnode) {
			$row                  = [];
			$row['server_name']   = $ssnode->name;
			$row['protocol_type'] = $ssnode->type;
			$row['server_group_id'] = $ssnode->group_id;
			$row['server_sort']    = $ssnode->sort;
			$row['server_domain']   = $ssnode->server;
			$row['server_ip']     = $ssnode->ip;
			$row['server_port']   = $ssnode->v2_port;
			$row['server_rate']   = $ssnode->traffic_rate;
		    $row['server_desc']   = $ssnode->desc;
		    $row['country_code']   = $ssnode->country_code;
		    $row['server_load']   = 0.3; //负载状态
		    $row['default_server']   = 1; //是否为默认服务器，客户端根据所有的默认服务器，选择一个负载最小的
			//$row['v2_vmess_id']   = $ssnode->v2_vmess_id;
		//	$row['v2_alter_id']   = $ssnode->v2_alter_id;
		//	$row['v2_net']        = $ssnode->v2_net;
		//	$row['v2_type']       = $ssnode->v2_type;
		//	$row['v2_host']       = $ssnode->v2_host;
	    //	$row['v2_path']       = $ssnode->v2_path;
		//	$row['v2_tls']        = $ssnode->v2_tls;
		
			array_push($server_list, $row);
	    	}
     	
     	 return [
            'server_groups' => $server_groups,
            'outbounds'     => $outbounds,
            'server_list'   => $server_list
        ];
     }
     
    
}

