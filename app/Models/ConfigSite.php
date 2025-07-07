<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfigSite extends Model
{
    use HasFactory;

    protected $table = 'config_sites';

    protected $fillable = [
        'name_site',
        'title',
        'description',
        'keywords ',
        'author ',
        'thumbnail',
        'logo ',
        'favicon',
        'facebook ',
        'nameadmin',
        'avatar_admin',
        'madon',
        'percent',
        'zalo',
        'telegram ',
        'maintenance',
        'collaborator',
        'agency',
        'distributor',
        'start_promotion',
        'end_promotion',
        'percent_promotion',
        'transfer_code',
        'telegram_chat_id',
        'telegram_chat_id_dontay',
        'telegram_chat_id_box',
        'telegram_chat_id_withdraw',
        'telegram_bot_token',
        'telegram_bot_username',
        'telegram_bot_chat_id',
        'telegram_bot_chat_token',
        'telegram_bot_chat_username',
        'notice',
        'script_head',
        'script_body',
        'script_footer',
        'admin_username',
        'site_token',
        'status',
        'created_at',
        'updated_at',
        'domain',
        'partner_key',
        'partner_id',
        'price',
        'price_collaborator',
        'price_agency',
        'price_distributor',
        'tigia',
        'round_price',
        'rule',
        'percentage_commission_affiliate',
        'min_withdraw_ref',
        'max_withdraw_ref',
        'status_massorder',
        'status_services',
        'theme',
        'theme_mode',
        'theme_admin',
        'landing',
        'auth_image',
        'confirm_payment',
        'maintain',
        'maintenance',
    ];

    public function userAdmin()
    {
        return $this->belongsTo(User::class, 'admin_username', 'username');
    }


}
