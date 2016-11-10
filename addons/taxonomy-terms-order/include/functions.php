<?php
    
    /**
    * @desc 
    * 
    * Return UserLevel
    * 
    */
    function tto_userdata_get_user_level($return_as_numeric = FALSE)
        {
            global $userdata;
            
            $user_level = '';
            for ($i=10; $i >= 0;$i--)
                {
                    if (current_user_can('level_' . $i) === TRUE)
                        {
                            $user_level = $i;
                            if ($return_as_numeric === FALSE)
                                $user_level = 'level_'.$i; 
                            break;
                        }    
                }        
            return ($user_level);
        } 
        
    function tto_info_box()
        {
            ?>
               
            
            <?php   
        }

?>