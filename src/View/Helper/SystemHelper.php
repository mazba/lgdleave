<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * System helper
 */
class SystemHelper extends Helper
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    public function display_date($date)
    {
        if(strlen($date)<1)
        {
            return '';
        }
        $display_string=date('d-M-Y',$date);
        if($display_string===false)
        {
            return '';
        }
        else
        {
            return $display_string;
        }
    }
    public function display_date_time($date)
    {
        if(strlen($date)<1)
        {
            return '';
        }
        $display_string=date('d-M-Y H:m:s',$date);
        if($display_string===false)
        {
            return '';
        }
        else
        {
            return $display_string;
        }
    }

    public function eng_to_bangla_code($number)
    {
        $eng_number = ['1','2','3','4','5','6','7','8','9','0'];
        $bn_number = ['১','২','৩','৪','৫','৬','৭','৮','৯','০'];
        return str_replace($eng_number,$bn_number,$number);
        return $number;
//        echo '<pre>';
//        print_r($number);
//        echo '</pre>';
//        die;
    }

}
