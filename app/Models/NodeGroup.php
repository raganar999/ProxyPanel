<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 节点授权密钥.
 */
class NodeGroup extends Model
{
    protected $table = 'node_group';
    protected $guarded = [];

    public function node()
    {
        return $this->hasMany(Node::class);
    }
}
