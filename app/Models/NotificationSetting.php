<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationSetting extends Model
{
    protected $table = 'notification_settings';

    protected $fillable = [
        'shopName',
        'is_top_bar_enable',
        'notification_content',
        'notification_bg_color',
        'notification_color',
        'is_popup_enable',
        'popup_content',
        'popup_bg_color',
        'popup_color',
    ];
}
