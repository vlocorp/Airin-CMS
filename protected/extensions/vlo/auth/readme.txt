1. ADD THIS TO CONTROLLER FUNCTION accessRules
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => VAuth::getMethods('post'), //first param is class, second param is user, but it automatically get user which is login
                'users' => VAuth::getUsersByGroup(), //first param is user, but it automatically get user which is login
            ),

COPYRIGHT BY VLO CORPORATION 
AUTHOR: EGA WACHID RADIEGTYA
EMAIL: RADIEGTYA@YAHOO.CO.ID
PHONE: 085641278479