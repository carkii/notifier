<?php
namespace Carkii\Notifier\model;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DateTime;
use Carbon\Carbon;
class notification extends Model
{   
	protected $connection = "";
    protected $fillable = ['name','user_id'];

    public function __construct() {
    	// set the DB connection based on required value
        $this->connection = config('notifier.DB_connection');        
    }
}