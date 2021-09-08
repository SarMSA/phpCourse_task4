<?php 


function validate($input,$flag){
$status = true;

 switch ($flag) {
     case 'emptyVal':
         # code...
         if(empty($input)){
           $status = false;
         }
         break;

    case 'nameVal': 
        if(!preg_match('/^[a-zA-Z\s]*$/',$input)){
            $status = false;
        }
       break;

    case 'emailVal': 
        # code 
        if(!filter_var($input,FILTER_VALIDATE_EMAIL)){
            $status = false;
        } 
        break; 

    case 'passVal': 
        if (strlen($input) <= '6')
        {
            $status = false;
        }

        break;

    case 'addressVal':
        if (strlen($input) <= '10')
        {
            $status = false;
        }
        break;

    case 'genderVal':
        if ($input == NULL)
        {
            $status = false;
        }
        break;

    case 'urlVal':
        $urlval = "/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
        if (!preg_match($urlval, $input)) {
            $status = false;
        }
        break;
    case 'fileVal':
        $allowedExt = ['jpg', 'png', 'jpeg', 'svg'];

        $extArray = explode('/',$input);
    
        if(!in_array($extArray[1],$allowedExt)){
            $status = false;
        }
        break;
   }
  
    return $status;

}





function CleanInputs($input){
  
    $input = trim($input);
    $input = stripcslashes($input);
    $input = htmlspecialchars($input);

     return $input;
}





?>