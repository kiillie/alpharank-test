<?php
class Alpharankmodel extends CI_Model{
	
	public function register(){
		$first_name = $this->input->post('fname');
		$last_name = $this->input->post('lname');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$table = "alpharan_zkaneri_users";
		$details = array(	'password'=>hash('sha256', $password),
							'first_name'=>$first_name,
							'last_name'=>$last_name,
							'email'=>$email,
							'date_added'=>date("Y-m-d H:i:s"),
							'date_updated'=>date("Y-m-d H:i:s")
							);
		if($this->db->insert($table, $details)){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function verify(){
		$email = $this->input->post('email');
		$password = hash("sha256", $this->input->post('password'));
		$table = "alpharan_zkaneri_users";
		$this->db->where('email', $email);
		$this->db->where('password', $password);
		$query = $this->db->get($table);
		if($query->num_rows()){
			return $query->row_array();
		}
		else {
			return false;
		}		
	}
	
	public function getuser(){
		$this->db->where('email', $this->input->post('email'));
		$this->db->where('password', hash("sha256", $this->input->post('password')));
		$query = $this->db->get('alpharan_zkaneri_users');
		$result = $query->row();
		return $result;
	}
}

?>