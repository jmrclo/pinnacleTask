<?php
namespace App\Helpers;

class Helper
{

    public static function IDGenerator($helperParams){
        $model = isset($helperParams['className']) ? $helperParams['className'] : '';
        $trow = isset($helperParams['column']) ? $helperParams['column'] : '';
        $prefix = isset($helperParams['prefix']) ? $helperParams['prefix'] : '';
        $length = isset($helperParams['length']) ? $helperParams['length'] : '';
        $data = $model::orderBy('id','desc')->first();
        if(!$data){
            $og_length = $length;
            $last_number = '';
        }else{
            $code = (int) substr($data->$trow, strlen($prefix)+1);
            $actial_last_number = ($code/1)*1;
            $increment_last_number = ((int)$actial_last_number)+1;
            $last_number_length = strlen($increment_last_number);
            $og_length = $length - $last_number_length;
            $last_number = $increment_last_number;
        }
        $zeros = "";
        for($i=0;$i<$og_length;$i++){
            $zeros.="0";
        }
        return $prefix.$zeros.$last_number;
    }
  
    
}
?>