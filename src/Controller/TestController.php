<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Cache\Cache;

/**
 * Test Controller
 *
 * @property \App\Model\Table\TestTable $Test
 */
class TestController extends AppController
{

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $value = $this->Test;
        $value = ['fsad'=>'dsf'];

        switch(true){
            case is_numeric($value):
                echo 'numeric';
//                break;
            case is_array($value):
                echo 'array';
//                break;
            case is_object($value):
                echo 'object';
//                break;
            case isset($value):
                echo 'isset';
//                break;
        }


       echo '<pre>';
       print_r('das');
       echo '</pre>';
       die;
    }
    public function method1($id = null){

    }
    public function method2($id = null){

    }
    public function method3($id = null){

    }
    public function method4($id = null){

    }
    public function cacheClear(){
        Cache::clear(false,'mcake');
    }

}
