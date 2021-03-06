<?php

class users {

	private $db_connection = NULL;
    private $table_user = '';
    private $table_user_details = '';
    private $table_user_roles = '';

    public function __construct($db_obj) {
		$this->db_connection = $db_obj;
        $this->table_user = $this->db_connection->get_table_mapping('users');
        $this->table_user_details = $this->db_connection->get_table_mapping('user_details');
        $this->table_user_roles = $this->db_connection->get_table_mapping('roles');
    }

    public function get_total_users($search = '') {
        $query = 'SELECT
                        COUNT(*) AS cnt
                  FROM
                       ' . $this->table_user . ' AS user_table,
                       ' . $this->table_user_details . ' AS user_details,
                       ' . $this->table_user_roles . ' AS user_role
                  WHERE
                       user_table.id = user_details.user_id
                       AND user_table.role_id = user_role.id
                       AND (user_table.is_deleted = 0 OR user_table.is_deleted
                       IS NULL) AND
                       (user_details.is_deleted = 0 OR user_details.is_deleted
                       IS NULL)
                ';
        if ($search != '') {
            $query .= ' AND
                            (
                              user_table.user_name LIKE "%' . $search . '%"
                              OR
                              user_role.role_code LIKE "%' . $search . '%"
                              OR
                              user_details.full_name LIKE "%' . $search . '%"
                              OR
                              IF(user_details.is_active=1,"'.t('Yes').'",
                              "'.t('No').'")
                              LIKE "%'.$search.'%"
                            )
                    ';
        }
        $result = $this->db_connection->sql_single_query($query);
        return $result['cnt'];
    }

    public function get_user_list($orderByClause = ' UserLoginId ASC',
    	$limit = '', $search = '') {
        $query = 'SELECT
                         user_table.id,user_table.user_name,
                         IFNULL(user_table.last_login_date,0)
                         AS last_login_date,
                         user_details.full_name,user_details.email_id,
                         user_role.role_code,
                         IF(user_table.is_active = 1,"' . t("Yes") . '",
                         "' . t("No") . '") as IsActive
                  FROM
                       ' . $this->table_user . ' AS user_table,
                       ' . $this->table_user_details . ' AS user_details,
                       ' . $this->table_user_roles . ' AS user_role
                  WHERE
                       user_table.id = user_details.user_id
                       AND user_table.role_id = user_role.id
                       AND (user_table.is_deleted = 0 OR user_table.is_deleted
                       IS NULL) AND
                       (user_details.is_deleted = 0 OR user_details.is_deleted
                       IS NULL)
                ';
        if ($search != '') {
            $query .= ' AND
                            (
                              user_table.user_name LIKE "%' . $search . '%"
                              OR
                              user_role.role_code LIKE "%' . $search . '%"
                              OR
                              user_details.full_name LIKE "%' . $search . '%"
                              OR
                              IF(user_details.is_active=1,"'.t('Yes').'",
                              "'.t('No').'")
                              LIKE "%'.$search.'%"
                            )
                    ';
        }
        $query .= " ORDER BY $orderByClause $limit";
        return $this->db_connection->select($query);
    }

    public function load_role_list($id = '',$mode=1) {
        $query = 'SELECT DISTINCT id,role_name,role_code,is_active
        FROM ' . $this->table_user_roles . ' WHERE is_active = 1';
        $query .= ' AND (is_deleted = 0 OR is_deleted IS NULL)';
        if ($id != '' && $mode=='1') {
            $query .= ' AND id = ' . $this->db_connection->mysql_data_encode($id);
        }
        if ($id != '' && $mode=='2') {
          $query .= ' UNION
                    SELECT d,role_name,is_active
                    FROM ' . $this->table_user_roles ;
                    $query .= ' WHERE id = ' . $this->db_connection->mysql_data_encode($id);
        }
       if ($id != '' && $mode=='3') {
            $query .= ' AND id NOT IN (' . $this->db_connection->mysql_data_encode($id).')';
        }
		$query .= ' ORDER BY role_code';
        return $this->db_connection->select($query);
    }

    public function load_user_details($id = '') {
        $query = 'SELECT
                     user_table.id,user_table.user_name,user_table.is_active,
                     user_details.id AS detailsId,user_details.full_name,
                     user_details.address,user_details.contact_no,
                     user_details.email_id,
                     user_role.id AS role_id,
                     user_role.role_name AS UTypeNameLabel
               FROM
                       ' . $this->table_user . ' AS user_table,
                       ' . $this->table_user_details . ' AS user_details,
                       ' . $this->table_user_roles . ' AS user_role
                  WHERE
                       user_table.id = user_details.user_id
                       AND user_table.role_id = user_role.id
              ';
        if ($id != '') {
            $query .= ' AND user_table.id = ' . $this->db_connection->mysql_data_encode($id);
        }
        return $this->db_connection->sql_single_query($query);
    }

    public function check_duplicate_username($columnName, $data, $id = '') {
        $query = 'SELECT COUNT(*) AS cnt FROM ' . $this->table_user . '
        WHERE ' . $columnName . '="' . $this->db_connection->mysql_data_encode($data) . '"';
        if ($id != '') {
            $query .= ' AND id != ' . $this->db_connection->mysql_data_encode($id);
        }
        $result = $this->db_connection->sql_single_query($query);
        return $result['cnt'];
    }

    public function check_duplicate_usercode($columnName, $data, $id = '') {
        $query = 'SELECT COUNT(*) AS cnt FROM ' . $this->table_user_details . '
        WHERE ' . $columnName . '="' . $this->db_connection->mysql_data_encode($data) . '"';
        if ($id != '') {
            $query .= ' AND user_id != ' . $this->db_connection->mysql_data_encode($id);
        }
        $result = $this->db_connection->sql_single_query($query);
        return $result['cnt'];
    }

    public function check_duplicate_useremail($columnName, $data, $id = '') {
        $query = 'SELECT COUNT(*) AS cnt FROM ' . $this->table_user_details . '
        WHERE ' . $columnName . '="' . $this->db_connection->mysql_data_encode($data) . '"';
        if ($id != '') {
            $query .= ' AND user_id != ' . $this->db_connection->mysql_data_encode($id);
        }
        $result = $this->db_connection->sql_single_query($query);
        return $result['cnt'];
    }
    /*
     * THIS FUNCTION IS USED TO SAVE USER'S INFORMATION
     * */
    public function save_user_data($dataArray) {
        if (isset($dataArray['pk'])) {
            //update login table
            $query = 'UPDATE ' . $this->table_user . '
                SET
               user_name="' . $this->db_connection->mysql_data_encode($dataArray['user_name']).'",
               role_id="' . $this->db_connection->mysql_data_encode($dataArray['role_id']) . '",
               is_active="' . $this->db_connection->mysql_data_encode($dataArray['is_active']).'",
               modified_by = ' . $_SESSION['USER_ID'] . ',
               modified_at ="' . time() . '"';

            if ($dataArray['user_password'] != '*****') {
                $query .=',user_password="' .
                md5($this->db_connection->mysql_data_encode($dataArray['user_password'])) . '"';
            }
            $query .= ' WHERE id = ' . $this->db_connection->mysql_data_encode($dataArray['pk']);
            $this->db_connection->edit($query);

            //update details table
            $query = 'UPDATE ' . $this->table_user_details . '
            SET
            full_name="' . $this->db_connection->mysql_data_encode($dataArray['full_name']) . '",
            email_id="' . $this->db_connection->mysql_data_encode($dataArray['email_id']) . '",
            is_active="' . $this->db_connection->mysql_data_encode($dataArray['is_active']) . '",
            modified_by = ' . $_SESSION['USER_ID'] . ',
            modified_at ="' . time() . '"';

            $query .= ' WHERE user_id='.$this->db_connection->mysql_data_encode($dataArray['pk']);
            return $this->db_connection->edit($query);
        } else {
            //insert into login table
            $query = 'INSERT INTO ' . $this->table_user . '
                (user_name,user_password,role_id,is_active,created_by,
                created_at,registered_user_ip)
			          VALUES(
                  "' . $this->db_connection->mysql_data_encode($dataArray['user_name']).'",
                  "'.md5($this->db_connection->mysql_data_encode($dataArray['user_password'])).'",
                  "' . $this->db_connection->mysql_data_encode($dataArray['role_id']) . '",
                  "' . $this->db_connection->mysql_data_encode($dataArray['is_active']) . '",
                  ' . $_SESSION['USER_ID'] . ',
                  "' . time() . '",
                  "' . $_SERVER['REMOTE_ADDR'] . '"
                  )
			         ';
            $userId = $this->db_connection->insert($query);
            //insert into details table
            $query = 'INSERT INTO ' . $this->table_user_details . '
              (user_id,full_name,email_id,company_name,address,country,city,zipcode,contact_no,user_type,is_active,
              created_by,created_at)
              VALUES(
                "' . $this->db_connection->mysql_data_encode($userId) . '",
                "' . $this->db_connection->mysql_data_encode($dataArray['full_name']) . '",
                "' . $this->db_connection->mysql_data_encode($dataArray['email_id']) . '",
                "' . $this->db_connection->mysql_data_encode($dataArray['company_name']) . '",
                "' . $this->db_connection->mysql_data_encode($dataArray['address']) . '",
                "' . $this->db_connection->mysql_data_encode($dataArray['country']) . '",
                "' . $this->db_connection->mysql_data_encode($dataArray['city']) . '",
                "' . $this->db_connection->mysql_data_encode($dataArray['zipcode']) . '",
                "' . $this->db_connection->mysql_data_encode($dataArray['contact_no']) . '",
                "' . $this->db_connection->mysql_data_encode($dataArray['user_type']) . '",
                "' . $this->db_connection->mysql_data_encode($dataArray['is_active']) . '",
                ' . $_SESSION['USER_ID'] . ',
                "' . time() . '"
              )';

            $this->db_connection->insert($query);
            return $userId;
        }
    }

    public function update_user_image($userId, $imageFilePath) {
        //select existing image and delete
        $query = 'SELECT Image FROM ' . $this->table_user_details
        . ' WHERE Id =' . $userId;
        $result = $this->db_connection->sql_single_query($query);
        $imagePath = $result['Image'];
        if ($imagePath != '') {
            @unlink(CUSTOMDIR . '/media/profile_images/' . $imagePath);
        }
        $query = 'UPDATE ' . $this->table_user_details
        . ' SET Image ="' . $imageFilePath . '" WHERE UserId =' . $userId;
        $this->db_connection->edit($query);
    }

    public function getUserDetialsByCode($ucode, $fields = array(),
        $utype = '') {
        $columns = '';
        if(empty($fields)) {
            $columns =
                'tbl1.Id, tbl1.UserId, tbl1.UserCode, tbl1.FullName';
        } else if(is_array($fields)) {
            foreach ($fields as $col) {
                if(empty($columns)) {
                    $columns = $col;
                } else {
                    $columns .= ', '.$col;
                }
            }
        } else {
            $columns = $fields;
        }
        $users = $this->db_connection->get_table_mapping('users');
        $query =    'SELECT
                    '.$columns.'
                    FROM '.$this->table_user_details.' tbl1
                    INNER JOIN '.$users.' tbl2
                    ON tbl1.UserId=tbl2.Id
                    WHERE tbl1.UserCode LIKE "'.$ucode.'"';
        if(!empty($utype)) {
            $query .= ' AND tbl2.UTypeId IN ('.$utype.')';
        }
        $result = $this->db_connection->sql_single_query($query);
        if(!empty($result)) {
            return $result;
        } else {
            return FALSE;
        }
    }

	/*
	 * Soft delete user
	 * */
	public function deleteUser($id,$userId,$time){
    $userId = $userId;
    $time = $time;
		$query  = 'DELETE FROM '.$this->table_user;
		$query .= ' WHERE id = "'.$id.'"';
		$this->db_connection->delete($query);

		$query  = 'DELETE FROM '.$this->table_user_details;
		$query .= ' WHERE user_id = "'.$id.'"';
		$this->db_connection->delete($query);

		$query  = 'DELETE FROM '.$this->db_connection->get_table_mapping('users_permissions');
		$query .= ' WHERE user_id = "'.$id.'"';
		$this->db_connection->delete($query);

	}
  /*
  * Update user's password reset token
  */
  public function updatePwdResetToken($userName,$token,$end){
    $query  = 'UPDATE '.$this->table_user.'
    SET reset_password_token = "'.$token.'",';
    $query .= 'reset_password_end_time = "'.$end.'"';
    $query .= ' WHERE user_name = "'.$userName.'"';
    $this->db_connection->edit($query);
  }

  /*
  * This function is used to
  * check validity of pwd reset token
  */
  public function checkPwdResetTokenValidity($userId){
    $query  = 'SELECT  reset_password_token,
    reset_password_end_time FROM '.$this->table_user;
    $query .= ' WHERE id = "'.$userId.'"';
    return $this->db_connection->sql_single_query($query);
  }

}

?>