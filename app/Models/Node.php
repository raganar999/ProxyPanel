<?php

namespace App\Models;

use App\Components\IP;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * 节点配置信息.
 */
class Node extends Model
{
    protected $table = 'node';
    protected $guarded = [];

   
   public function nodeGroup(): BelongsTo
    {
        return $this->belongsTo(NodeGroup::class);
    }
   
    public function labels()
    {
        return $this->belongsToMany(Label::class);
    }

    public function heartbeats(): HasMany
    {
        return $this->hasMany(NodeHeartbeat::class);
    }

    public function onlineIps(): HasMany
    {
        return $this->hasMany(NodeOnlineIp::class);
    }

    public function onlineLogs(): HasMany
    {
        return $this->hasMany(NodeOnlineLog::class);
    }

    public function userDataFlowLogs(): HasMany
    {
        return $this->hasMany(UserDataFlowLog::class);
    }

    public function ruleLogs(): HasMany
    {
        return $this->hasMany(RuleLog::class);
    }

    public function dailyDataFlows(): HasMany
    {
        return $this->hasMany(NodeDailyDataFlow::class);
    }

    public function hourlyDataFlows(): HasMany
    {
        return $this->hasMany(NodeHourlyDataFlow::class);
    }

    public function ruleGroup(): BelongsTo
    {
        return $this->belongsTo(RuleGroup::class);
    }
    
   

    public function userGroups(): BelongsToMany
    {
        return $this->belongsToMany(UserGroup::class);
    }

    public function auth(): HasOne
    {
        return $this->hasOne(NodeAuth::class);
    }

    public function level_table(): HasOne
    {
        return $this->hasOne(Level::class, 'level', 'level');
    }

    public function users()
    {
        return User::activeUser()
            ->where('level', '>=', $this->attributes['level'])
            ->where(function ($query) {
                $query->whereIn('user_group_id', $this->userGroups->pluck('id'))->orWhereNull('user_group_id');
            })
            ->get();
    }

    public function refresh_geo()
    {
        $data = IP::IPSB($this->is_ddns ? gethostbyname($this->server) : $this->ip);

        if ($data) {
            self::withoutEvents(function () use ($data) {
                $this->update(['geo' => $data['latitude'].','.$data['longitude']]);
            });

            return 1;
        }

        return 0;
    }

    public function config(User $user)
    {
        $config = [
            'id'    => $this->id,
            'name'  => $this->name,
            'host'  => $this->host,
            'network'  => $this->network  / 100,
            'load'  => $this->load / 100,
            'group_id' => $this->group_id,
            'group_name' => NodeGroup::whereGroupId($this->group_id)->value('group_name'),
            'recommend' => $this->recommend,
            'tag'   => $this->tag ,
            'Weights' =>  $this-> Weights,
            
        ];
        switch ($this->type) {
            case 2:
                $config = array_merge($config, [
                    'type'        => 'v2ray',
                    'port'        => $this->is_relay ? $this->relay_port : $this->v2_port,
                  //  'uuid'        => $user->vmess_id,
                    'method'      => $this->v2_method,
                    'v2_alter_id' => $this->v2_alter_id,
                    'v2_net'      => $this->v2_net,
                    'v2_type'     => $this->v2_type,
                    'v2_host'     => $this->v2_host,
                    'v2_path'     => $this->v2_path,
                    'v2_tls'      => $this->v2_tls ? 'tls' : '',
                    'udp'         => $this->is_udp,
                ]);
                break;
            case 3:
                $config = array_merge($config, [
                    'type'   => 'trojan',
                    'port'   => $this->is_relay ? $this->relay_port : $this->v2_port,
                    'passwd' => $user->passwd,
                    'sni'    => $this->is_relay ? $this->server : '',
                    'udp'    => $this->is_udp,
                ]);
                break;
            case 1:
            case 4:
                $config = array_merge($config, [
                    'type'       => $this->compatible ? 'shadowsocks' : 'shadowsocksr',
                    'method'     => $this->method,
                    'protocol'   => $this->protocol,
                    'obfs'       => $this->obfs,
                    'obfs_param' => $this->obfs_param,
                    'udp'        => $this->is_udp,
                ]);
                if ($this->single) {
                    //单端口使用中转的端口
                    $config['port'] = $this->is_relay ? $this->relay_port : $this->port;
                    $config['passwd'] = $this->passwd;
                    $config['protocol_param'] = $user->port.':'.$user->passwd;
                } else {
                    $config['port'] = $user->port;
                    $config['passwd'] = $user->passwd;
                    $config['protocol_param'] = $this->protocol_param;
                    if ($this->type === 1) {
                        $config['method'] = $user->method;
                        $config['protocol'] = $user->protocol;
                        $config['obfs'] = $user->obfs;
                    }
                }

                break;
        }

        return $config;
    }

    public function getSpeedLimitAttribute($value)
    {
        return $value / Mbps;
    }

    public function setSpeedLimitAttribute($value)
    {
        return $this->attributes['speed_limit'] = $value * Mbps;
    }

    public function getTypeLabelAttribute(): string
    {
        return [
            1 => 'ShadowsocksR',
            2 => 'V2Ray',
            3 => 'Trojan',
            4 => 'VNet',
        ][$this->attributes['type']] ?? 'UnKnown';
    }

    public function getHostAttribute(): string
    {
        return $this->is_relay ? $this->relay_server : ($this->server ?: $this->ip);
    }
}
