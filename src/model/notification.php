<?php
namespace Carkii\Notifier\model;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DateTime;
use Carbon\Carbon;
class notification extends Model
{   
    protected $fillable = ['name','user_id'];
}
