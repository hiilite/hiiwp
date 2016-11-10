<?php

    
    /**
    * Return the user level
    * 
    * This is deprecated, will be removed in the next versions
    * 
    * @param mixed $return_as_numeric
    */
    function userdata_get_user_level($return_as_numeric = FALSE)
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
        
    
    function cpt_get_options()
        {
            //make sure the vars are set as default
            $options = get_option('cpto_options');
            
            $defaults   = array (
                                    'show_reorder_interfaces'   =>  array(),
                                    'autosort'                  =>  1,
                                    'adminsort'                 =>  1,
                                    'capability'                =>  'install_plugins',
                                    'navigation_sort_apply'     =>  1,
                                    
                                );
            $options          = wp_parse_args( $options, $defaults );
            
            return $options;            
        }
        
    function cpt_info_box()
        {
           
        }

?>