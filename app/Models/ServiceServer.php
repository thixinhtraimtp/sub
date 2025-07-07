<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceServer extends Model
{
    use HasFactory;

    protected $table = 'service_servers';

    protected $fillable = [
        'service_id',
        'name',
        'details',
        'package_id',
        'price',
        'price_update',
        'price_member',
        'price_collaborator',
        'price_agency',
        'price_distributor',
        'min',
        'max',
        'limit_day',
        'status',
        'percents',
        'visibility',
        'get_uid',
        'quantity_status',
        'reaction_status',
        'reaction_data',
        'comments_status',
        'comments_data',
        'minutes_status',
        'minutes_data',
        'providerLink',
        'providerServer',
        'providerName',
        'providerKey',
        'domain',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function actions()
    {
        return $this->hasMany(ServerAction::class, 'server_id', 'id');
    }

    public function action()
    {
        return $this->hasOne(ServerAction::class, 'server_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'server_id', 'id');
    }

    public function getStatus($status)
    {
        return $status == 'active' ? 'Hoạt động' : 'Không hoạt động';
    }

    public function getStatusLabel($status, $html = false)
    {
        $status = $this->getStatus($status);
        if ($html) {
            return '<span class="badge bg-' . ($status == 'Hoạt động' ? 'success' : 'danger') . '">' . $status . '</span>';
        }
        return $status;
    }

    public function getVisibility($visibility)
    {
        return $visibility == 'public' ? 'Công khai' : 'Riêng tư';
    }
    public function getServerByService($service_id)
    {
        return $this->where('domain', getDomain())->where('id', $service_id)->first();
    }
    public function getVisibilityLabel($visibility, $html = false)
    {
        $visibility = $this->getVisibility($visibility);
        if ($html) {
            return '<span class="badge bg-' . ($visibility == 'Công khai' ? 'success' : 'danger') . '">' . $visibility . '</span>';
        }
        return $visibility;
    }

    public function getActionStatusLabel($status, $html = false)
    {
        $status = $status == 'on' ? 'Bật' : 'Tắt';
        if ($html) {
            return '<span class="badge bg-' . ($status == 'Bật' ? 'success' : 'danger') . '">' . $status . '</span>';
        }
        return $status;
    }


    public function levelPrice($level)
    {
        //price_member
        //price_collaborator
        //price_agency
        //price_distributor
        switch ($level) {
            case 'member':
                return $this->price_member;
                break;
            case 'collaborator':
                return $this->price_collaborator;
                break;
            case 'agency':
                return $this->price_agency;
                break;
            case 'distributor':
                return $this->price_distributor;
                break;
            default:
                return $this->price_member;
                break;
        }
    }
}
