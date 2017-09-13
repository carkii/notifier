<?php
namespace Carkii\Notifier;

use Carkii\Notifier\contracts\NotifierInterface;
use Carkii\Notifier\model\notification;
use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use Auth;
use View;
/**
* Notify the user about what is new in the website
*/
class Notifier implements NotifierInterface
{    
    public $isBreakTime = false;     
    protected $notificationsPath;    
    protected $allNotifications=[];
    protected $missingNotifications=[];    
    
    /**
     * init data     
     * @return void
     */
    public function __construct()
    {                
        $this->setNotificationsPath();                    
        $this->setAllNotifications();
        $this->setMissingNotifications();        
    }

    /**    
     * Get only what is not acknowledged     
     * @return array notifications
     */
    public function get()
    {                 
        return $this->missingNotifications;
    }
    
    /**
     * Get all notifications         
     * @return array notifications
     */
    public function getAll()
    {                
        return $notifier->allNotifications;
    }

    /**
     * Number of not acknowledged notifications      
     * @return init|null number of notifications
     */
    public function count()
    {                   
        return $this->missingNotifications->count();
    }

    /**
     * Number of all notifications   
     * @return init|null number of notifications
     */
    public function countAll()
    {
        return $notifier->allNotifications->count();        
    }

    /**
     * check if any notification is missed by this user         
     * @return boolean
     */
    public function any()
    {   
        return $this->count() ? true : false;
    }

    /**
     * show AcknowledgedButton (containing Javascript)
     * @param  string $fileName name of the file
     * @return void
     */
    public function getAcknowledgedButton($fileName)
    {          
        // button class
        $class = config('notifier.acknowledgedButton.class');                     
        // button text
        $text = config('notifier.acknowledgedButton.text');
        // container id
        $containerId = $this->getConteinerId($fileName);        
        // return button
        return '<button type="button" onclick="acknowledged('."'$fileName'".','."'$containerId'".')" class="'.$class.'">'.$text.'</button>';
    }

    /**
     * show messages only after the break 
     * (time interval between the last notification acknowledged and the new one)
     * @param  string $fileName name of the file
     * @return void
     */
    public function break($day = null, $hour = null, $minute = null){        
        // if guest, do nothing
        if(Auth::guest())
            return $this;

        // check if the break time was exceeded
        $dueDate = Carbon::now()
                    ->subDays($day)
                    ->subHours($hour)
                    ->subMinutes($minute);
        
        $this->isBreakTime = notification::whereUserId(Auth::User()->id)
                            ->Where('created_at','>',$dueDate)->exists();

        // if still in the break time, erase the the missing notifications
        if($this->isBreakTime)
            $this->missingNotifications = collect();

        return $this;
    } 

    /**
     * fetch content of the file     
     * @param  string $fileName name of the file
     * @return void
     */
    protected function fetch($fileName)
    {                
        return View::make(
            'notifications/'.$fileName,
            ['acknowledgedButton'=>$this->getAcknowledgedButton($fileName)]
            )->render();
    }

    /**
     * get all files names      
     * @return array list of files available
     */
    protected function getFiles()
    {        
        return array_diff(
            scandir($this->notificationsPath),array('.','..')
            );
    }

    /**
     * set all notification contents     
     */
    protected function setAllNotifications()
    {        
        //empty collection
        $notifications = collect();      
        //search for valid notifications
        foreach($this->getFiles() AS $file){
            $viewName = $this->getNotificationViewName($file);            
            // if starts with underscore, ignore it
            if(! starts_with($file,'_'))
                $notifications[$viewName] = 
                        $this->addDivContainer($this->fetch($viewName),$viewName);
        }
        //return result
        $this->allNotifications = $notifications;
    }

    /**
     * set notification path     
     */
    protected function setNotificationsPath()
    {
        $this->notificationsPath = config('view.paths')[0].'/notifications/';
    }

    /**
     * Convert fileName name to view name to be readable by \View::class
     * @param  string $fileName name of the file
     * @return string           ViewName
     */
    protected function getNotificationViewName($fileName)
    {        
        return str_ireplace(['.blade','.php'],'',$fileName);            
    }

    /**
     * set missing notifications    
     */
    protected function setMissingNotifications()
    {    
        // if guest, missing notification is null
        if(Auth::guest())
            return $this->missingNotifications = collect();
        // search for missed notifications
        $collect = notification::whereUserId(Auth::User()->id)
            ->whereIn('name',$this->allNotifications->keys())
            ->pluck('name')
            ->flip(); 
        //set missing notifications
        return $this->missingNotifications = $this->allNotifications->diffKeys($collect);        
    }

    /**
     * add notification content in div container to hide after the acknowledgment
     * @param  string $content notification content
     * @param  string $id for identify the notification for Js actions
     * @return string $container notification bounded by new div with id 
     */
    protected  function addDivContainer($content,$id){
        $id = $this->getConteinerId($id);
        $class = config('notifier.container.class');
        return "<div id='$id' class='$class'>$content</div>";
    }

    protected function getConteinerId($id){
        $format = config('notifier.container.id');
        return str_ireplace('{notification_name}',$id,$format);        
    }

    public function addStylesAndScriptes(){        
        // css & Js
        echo '<link rel="stylesheet" href="'.asset('css/notifications.css').'">
              <script id="notificationsJS" acknowledgedURL="'.route('notifier::acknowledged').'" notificationsCounter="'.$this->count().'" src="'.asset('js/notifications.js?'.rand(1,1000)).'"></script>';
    }

}