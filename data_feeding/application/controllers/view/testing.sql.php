      $sql = "SELECT child_id, geo_loc, create_datetime, update_datetime, value, req_id, field_id, status, family_id, member_id, location, rating, approve_datetime, rating_datetime
        FROM form_data
        WHERE form_id = ?
          AND $wherestr
          AND location LIKE ?";
$query = $this->db->query($sql, array($form_id, $location . "%"));

// echo "<pre>";
// print_r($query->result_array());
// die();

//sql
SELECT child_id, geo_loc, create_datetime, update_datetime, value, req_id, field_id, status, family_id, member_id, location, rating, approve_datetime, rating_datetime
        FROM form_data
        WHERE form_id = ?
          AND family_id IN (SELECT DISTINCT family_id FROM form_data WHERE field_id = '1690365766_1' AND ( approve_id='RAILWAY' OR (approve_id IS NULL AND value IN (12017)) ))
          AND rating IS NOT NULL 
          AND location LIKE ? ;