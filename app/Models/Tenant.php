<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    protected $casts = [
        'data' => 'array',
];
    public static function getCustomColumns(): array
    {
        return [
            'id',
            'name',
            'email',
            'password',
            'data',
        ];
    }

    public function setPassworddAttribute($value)
    {
        return $this->attributes['password'] = bcrypt($value);
    }
    public function getTenancyDbNameAttribute()
    {
        return $this->data['tenancy_db_name'] ?? null;
    }
    
}
