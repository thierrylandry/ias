<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 27/07/2017
 * Time: 10:58
 */

namespace App\Metier\Behavior;


use Illuminate\Support\MessageBag;

class Notifications extends MessageBag
{
    const NOTIFICATION_KEYS_SESSION = 'notifications';
    const NOTIFICATION_KEYS_ERROR = 'errors';

    const WARNING = 'bg-orange';
    const ERROR = 'bg-red';
    const SUCCESS = 'bg-teal';
    const INFO = 'bg-light-blue';

    const ERROR_ICON = 'error';
    const WARNING_ICON = 'warning';
    const SUCCESS_ICON = 'done';
    const INFO_ICON = 'info';


    private $html = '<div class="alert alert-dismissible %s" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <i class="material-icons">%s</i> %s</div>';

    public function makeAlertView()
    {
        $this->checkErrors();

        $notification = $this->getMessageNotification();

        if($notification)
        {
            $this->alerteProcessing(self::INFO_ICON,self::INFO, $notification);

            $this->alerteProcessing(self::SUCCESS_ICON ,self::SUCCESS, $notification);

            $this->alerteProcessing(self::WARNING_ICON, self::WARNING, $notification);
        }
    }

    protected function checkErrors()
    {
        $notification = $this->getErrorMessage();

        if($notification)
        {
            foreach ($notification->all() as $message)
            {
                echo sprintf($this->html, self::ERROR,self::ERROR_ICON,  $message);
            }
        }
    }

    private function alerteProcessing($icon, $key, Notifications $notification)
    {
        foreach ($notification->get($key) as $message)
        {
            echo sprintf($this->html, $key, $icon, $message);
        }
    }

    /**
     * return ViewErrorBag | null
     */
    private function getErrorMessage()
    {
        return session()->has(self::NOTIFICATION_KEYS_ERROR) ? session(self::NOTIFICATION_KEYS_ERROR) : null;
    }

    private function getMessageNotification()
    {
        return session()->has(self::NOTIFICATION_KEYS_SESSION) ? session(self::NOTIFICATION_KEYS_SESSION) : null;
    }
}