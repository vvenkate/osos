<?php
/*
  * Model class for ACL  
  * Author : ManikandaRaja.S
  * Date created : 20 August 2016
*/
class acl_Model extends CI_Model {
	
	
	public function __construct(){
		die('on the acl model');

		
	}
	
    /**
     * Get the features that the user has an access to if he has a role other than Admin
     * Author : ManikandaRaja.S
     * return @array Associate array of rights
    */
    public function getAccessRights($tenant_id,$user_id,$role_id){
        
          
        // Check if the role assigned is not admin, if not admin retrieve the use cases accessible.
        // If admin all use cases are accessible
        $side_menu = null;
        if ($role_id != 'ADMN')
        {
            $role_features = $this->getRoleFeatures($tenant_id,$role_id);
            $side_menu = $this->getRoleFeaturesAccessRightsMenu($role_features);
            $this->session->set_userdata('main_menu', $side_menu);
        }
       
        return $side_menu;
    }

    /**
     * ********************8 This can be removed to a common class ******************
     * Author : ManikandaRaja.S
     * Get the Role Id
     * @input - tenant_id, user_id
     * @output - role_id
    */    
    public function getRoleId($tenant_id, $user_id) {
        $this->db->select('role_id');
        $this->db->from('internal_user_role');
        $this->db->where('tenant_id', $tenant_id);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->row()->role_id;
        } else {
            return 0;
        }
    }

    /*
     * Returns the use cases accessible by the user
     * Author: Manikandaraja.S
     * @input  - session tenant_id and role_id
     * @outout - Array of Features Id
     */
    public function getRoleFeatures($tenant_id, $role_id) {
        $this->db->select('feature_id,feature_access_scope_id');
        $this->db->from('role_features');
        $this->db->where('tenant_id', $tenant_id);
        $this->db->where('role_id',$role_id );
        $query = $this->db->get();
       
        if ($query->num_rows() > 0) {
            $role_feature_id = array();
            //$role_scope_access_id = array(); // Later
            foreach ($query->result() as $row)
            {
                $role_feature_id[] = $row->feature_id;
                // need it later when need of feature_access_scope_id - TO DO
                // $role_scope_access_id[] = $row->feature_access_scope_id;
            }
            
            // need it later when need of role_scope_access_id - TO DO
            // $role_features = array_combine($role_feature_id, $role_scope_access_id);           
            // return $role_features;

            return $role_feature_id;
        } else {
            return 0;
        }
    }
    
    /*
     * This function returns back the list of sub-menus or sub-features that the user has access to within a feature/ menu
     * Author: Manikandaraja.S
     * @input  - Array of Feature
     * @output - Array of Features + Acess Rights
     */
    public function getRoleFeaturesAccessRightsMenu($role_features) {
        $this->db->select('*');
        $this->db->from('role_features_access_rights');
        $this->db->where('tenant_id', $this->session->userdata('tenant_id'));
        $this->db->where('role_id', $this->session->userdata('role_id'));
        
        $this->db->where_in('feature_id', $role_features);
        
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $role_scope_access_id = array();
            
            $category_list = array();
            $cat_id = NULL;
            
            //Generate a common sturcture with all menu and sub-menu names and their parameter_Id
                $master_menu = $this->getMasterMenu('CAT09');
            // Create a copy of the master menu into another array which will hold the enabled menu and submenu list.
            $master_menu_enabled = $master_menu;
  
                /*1. get a feature id from the master menulist
                2. Look for this featureId in the result dataset
                3. If found get the aceessRightID - sub-menu from the menumaster list, if not found set menu and all sub-menu for this menu to disable
                4. look for the FeatureID + AccessRightID in the result dataset
                5. If found enbale the featureId and Feature_ID+Access RightID
                6.  Loop and repeat - If not found - set access_right_id to disabled                 
                */            
            foreach ($query->result() as $row){
                if ( ($cat_id == NULL ) || ($cat_id != $row->feature_id) ) {
                    $cat_id = $row->feature_id;
                    $res_data_set[$cat_id] = array($row->access_right_id);
                } else {
                    array_push($res_data_set[$row->feature_id], $row->access_right_id);
                }                
            }
            foreach ($master_menu as $main_menu => $menu_detail)// loop through the master menu list
            {
                if (in_array($main_menu, array_keys($res_data_set))) {
                    // Check the sub menu access
                    $sub_menu_arr = array_keys($menu_detail);
                    foreach($sub_menu_arr as $sub_menu) {  
                        if(!in_array($sub_menu, $res_data_set[$main_menu])) {
                            unset($master_menu_enabled[$main_menu][$sub_menu]);
                        }
                    }
                } else {
                    unset($master_menu_enabled[$main_menu]);
                }
            }
        } else {
            return 0;
        }
        return $master_menu_enabled;
    }

    /*
     * This function builds the menu and sub menu master list for the application from the metadata values table.
     */
    private function getMasterMenu($master_category_id) {
        $this->db->select('category_name, child_category_id, parameter_id');
        $this->db->from('metadata_values');
        $this->db->where('category_id', $master_category_id);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $row = $query->row();
            if($row->child_category_id !== NULL) {
                $child_category_id = $row->child_category_id;
                $master_menu = $this->getMenuInfo($child_category_id);
            } 
        } else {
            return 0;
        }
        return $master_menu;
    }
    
    /*
     * This function returns the Main menu information
     */
    public function getMenuInfo($category_id) {
        $root_category_id = $category_id;
        $category_list = array();
        
        $this->db->select('category_name, child_category_id, parameter_id');
        $this->db->from('metadata_values');
        $this->db->where('category_id', $category_id);

        $query = $this->db->get();
        $menu_detail = array();
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row)
            {
                $menu_detail[$row->parameter_id] = $this->getSubMenuInfo($row->parameter_id, $row->child_category_id);
            }
        } else {
            return 0;
        }
        return $menu_detail;
    }
    
    /*  
     * This function builds the sub menu
     */
    public function getSubMenuInfo($category_name, $sub_category_id) {
        $this->db->select('category_name, child_category_id, parameter_id');
        $this->db->from('metadata_values');
        
        $this->db->where('category_id', $sub_category_id);
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row)
            {
                $category_list_menu[$row->parameter_id] = $row->category_name;
            }
        } else {
            return 0;
        }
        return $category_list_menu;
    }
}