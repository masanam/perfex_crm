<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Recruitment Model
 */
class Recruitment_model extends App_Model {
	public function __construct() {
		parent::__construct();
	}

	/**
	 * get job position
	 * @param  boolean $id 
	 * @return object
	 */
	public function get_job_position($id = false) {

		if (is_numeric($id)) {
			$this->db->where('position_id', $id);

			return $this->db->get(db_prefix() . 'rec_job_position')->row();
		}

		if ($id == false) {
			return $this->db->query('select * from tblrec_job_position')->result_array();
		}

	}

	/**
	 * add job position
	 * @param object $data
	 */
	public function add_job_position($data) {
		$this->db->insert(db_prefix() . 'rec_job_position', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	/**
	 * update job position
	 * @param  object $data
	 * @param  int $id  
	 * @return bool
	 */
	public function update_job_position($data, $id) {
		$this->db->where('position_id', $id);
		$this->db->update(db_prefix() . 'rec_job_position', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * delete job position
	 * @param  int $id
	 * @return bool
	 */
	public function delete_job_position($id) {
		$this->db->where('position_id', $id);
		$this->db->delete(db_prefix() . 'rec_job_position');
		if ($this->db->affected_rows() > 0) {
			return true;
		}

		return false;
	}

	/**
	 * add recruitment proposal
	 * @param object $data
	 */
	public function add_recruitment_proposal($data) {
		if (isset($data['file'])) {
			unset($data['file']);
		}
		$data['salary_from'] = reformat_currency_rec($data['salary_from']);
		$data['salary_to'] = reformat_currency_rec($data['salary_to']);
		$data['from_date'] = to_sql_date($data['from_date']);
		$data['to_date'] = to_sql_date($data['to_date']);
		$data['date_add'] = date('Y-m-d');
		$data['status'] = 1;
		$this->db->insert(db_prefix() . 'rec_proposal', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	/**
	 * update recruitment proposal
	 * @param  object $data
	 * @param  int $id  
	 * @return bool
	 */
	public function update_recruitment_proposal($data, $id) {
		if (isset($data['file'])) {
			unset($data['file']);
		}
		$data['salary_from'] = reformat_currency_rec($data['salary_from']);
		$data['salary_to'] = reformat_currency_rec($data['salary_to']);
		$data['from_date'] = to_sql_date($data['from_date']);
		$data['to_date'] = to_sql_date($data['to_date']);
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'rec_proposal', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * delete recruitment proposal
	 * @param  int $id 
	 * @return bool
	 */
	public function delete_recruitment_proposal($id) {
		$this->db->where('rel_id', $id);
		$this->db->where('rel_type', 'rec_proposal');
		$attachments = $this->db->get('tblfiles')->result_array();
		foreach ($attachments as $attachment) {
			$this->delete_proposal_attachment($attachment['id']);
		}
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'rec_proposal');
		if ($this->db->affected_rows() > 0) {
			return true;
		}

		return false;
	}

	/**
	 * get rec proposal 
	 * @param  string $id
	 * @return object    
	 */
	public function get_rec_proposal($id = '') {
		if ($id != '') {
			$this->db->where('id', $id);
			return $this->db->get(db_prefix() . 'rec_proposal')->row();
		} elseif ($id == '') {
			return $this->db->get(db_prefix() . 'rec_proposal')->result_array();
		}
	}

	/**
	 * get rec proposal by status
	 * @param  int $status
	 * @return object
	 */
	public function get_rec_proposal_by_status($status) {
		$this->db->where('status', $status);
		return $this->db->get(db_prefix() . 'rec_proposal')->result_array();
	}

	/**
	 * get proposal file
	 * @param  object $proposal
	 * @return int
	 */
	public function get_proposal_file($proposal) {
		$this->db->where('rel_id', $proposal);
		$this->db->where('rel_type', 'rec_proposal');
		return $this->db->get('tblfiles')->result_array();
	}

	/**
	 * delete proposal attachment
	 * @param  int $id
	 * @return bool
	 */
	public function delete_proposal_attachment($id) {
		$attachment = $this->get_proposal_attachments('', $id);
		$deleted = false;
		if ($attachment) {
			if (empty($attachment->external)) {
				unlink(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/proposal/' . $attachment->rel_id . '/' . $attachment->file_name);
			}
			$this->db->where('id', $attachment->id);
			$this->db->delete('tblfiles');
			if ($this->db->affected_rows() > 0) {
				$deleted = true;
			}

			if (is_dir(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/proposal/' . $attachment->rel_id)) {
				// Check if no attachments left, so we can delete the folder also
				$other_attachments = list_files(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/proposal/' . $attachment->rel_id);
				if (count($other_attachments) == 0) {
					// okey only index.html so we can delete the folder also
					delete_dir(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/proposal/' . $attachment->rel_id);
				}
			}
		}

		return $deleted;
	}

	/**
	 * get proposal attachments
	 * @param  object $proposal
	 * @param  string $id      
	 * @return int          
	 */
	public function get_proposal_attachments($proposal, $id = '') {
		// If is passed id get return only 1 attachment
		if (is_numeric($id)) {
			$this->db->where('id', $id);
		} else {
			$this->db->where('rel_id', $proposal);
		}
		$this->db->where('rel_type', 'rec_proposal');
		$result = $this->db->get('tblfiles');
		if (is_numeric($id)) {
			return $result->row();
		}

		return $result->result_array();
	}

	/**
	 * get file
	 * @param  int  $id
	 * @param  boolean $rel_id
	 * @return object         
	 */
	public function get_file($id, $rel_id = false) {
		$this->db->where('id', $id);
		$file = $this->db->get('tblfiles')->row();

		if ($file && $rel_id) {
			if ($file->rel_id != $rel_id) {
				return false;
			}
		}
		return $file;
	}

	/**
	 * approve reject proposal
	 * @param  int $type
	 * @param  int $id  
	 * @return bool      
	 */
	public function approve_reject_proposal($type, $id) {
		if ($type == 'approved') {
			$this->db->where('id', $id);
			$this->db->update(db_prefix() . 'rec_proposal', ['status' => 2]);
			if ($this->db->affected_rows() > 0) {
				return 'approved';
			}
			return false;
		} elseif ($type == 'reject') {
			$this->db->where('id', $id);
			$this->db->update(db_prefix() . 'rec_proposal', ['status' => 4]);
			if ($this->db->affected_rows() > 0) {
				return 'reject';
			}
			return false;
		}
	}

	/**
	 * add recruitment campaign
	 * @param object $data
	 */
	public function add_recruitment_campaign($data) {
		if (isset($data['file'])) {
			unset($data['file']);
		}
		if (isset($data['cp_proposal'])) {
			$data['cp_proposal'] = implode(',', $data['cp_proposal']);
		}

		if (isset($data['cp_manager'])) {
			$data['cp_manager'] = implode(',', $data['cp_manager']);
		}

		if (isset($data['cp_follower'])) {
			$data['cp_follower'] = implode(',', $data['cp_follower']);
		}

		$data['cp_salary_from'] = reformat_currency_rec($data['cp_salary_from']);
		$data['cp_salary_to'] = reformat_currency_rec($data['cp_salary_to']);
		$data['cp_from_date'] = to_sql_date($data['cp_from_date']);
		$data['cp_to_date'] = to_sql_date($data['cp_to_date']);
		$data['cp_date_add'] = date('Y-m-d');
		$data['cp_status'] = 1;
		$this->db->insert(db_prefix() . 'rec_campaign', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	/**
	 * update recruitment campaign
	 * @param  object $data
	 * @param  int $id  
	 * @return bool
	 */
	public function update_recruitment_campaign($data, $id) {
		if (isset($data['file'])) {
			unset($data['file']);
		}
		if (isset($data['cp_proposal'])) {
			$data['cp_proposal'] = implode(',', $data['cp_proposal']);
		}

		if (isset($data['cp_manager'])) {
			$data['cp_manager'] = implode(',', $data['cp_manager']);
		}

		if (isset($data['cp_follower'])) {
			$data['cp_follower'] = implode(',', $data['cp_follower']);
		}
		$data['cp_salary_from'] = reformat_currency_rec($data['cp_salary_from']);
		$data['cp_salary_to'] = reformat_currency_rec($data['cp_salary_to']);
		$data['cp_from_date'] = to_sql_date($data['cp_from_date']);
		$data['cp_to_date'] = to_sql_date($data['cp_to_date']);
		$this->db->where('cp_id', $id);
		$this->db->update(db_prefix() . 'rec_campaign', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * delete recruitment campaign
	 * @param  [type] $id 
	 * @return [type]     
	 */
	public function delete_recruitment_campaign($id) {
		$this->db->where('rel_id', $id);
		$this->db->where('rel_type', 'rec_campaign');
		$attachments = $this->db->get('tblfiles')->result_array();
		foreach ($attachments as $attachment) {
			$this->delete_campaign_attachment($attachment['id']);
		}
		$this->db->where('cp_id', $id);
		$this->db->delete(db_prefix() . 'rec_campaign');
		if ($this->db->affected_rows() > 0) {
			return true;
		}

		return false;
	}

	/**
	 * get rec campaign
	 * @param  string $id
	 * @return object    
	 */
	public function get_rec_campaign($id = '') {
		if ($id != '') {
			$this->db->where('cp_id', $id);
			return $this->db->get(db_prefix() . 'rec_campaign')->row();
		} elseif ($id == '') {
			return $this->db->get(db_prefix() . 'rec_campaign')->result_array();
		}
	}

	/**
	 * get campaign_file
	 * @param  object $proposal
	 * @return object
	 */
	public function get_campaign_file($proposal) {
		$this->db->where('rel_id', $proposal);
		$this->db->where('rel_type', 'rec_campaign');
		return $this->db->get('tblfiles')->result_array();
	}

	/**
	 * delete campaign attachment
	 * @param  int $id
	 * @return bool    
	 */
	public function delete_campaign_attachment($id) {
		$attachment = $this->get_campaign_attachments('', $id);
		$deleted = false;
		if ($attachment) {
			if (empty($attachment->external)) {
				unlink(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/campaign/' . $attachment->rel_id . '/' . $attachment->file_name);
			}
			$this->db->where('id', $attachment->id);
			$this->db->delete('tblfiles');
			if ($this->db->affected_rows() > 0) {
				$deleted = true;
			}

			if (is_dir(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/campaign/' . $attachment->rel_id)) {
				// Check if no attachments left, so we can delete the folder also
				$other_attachments = list_files(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/campaign/' . $attachment->rel_id);
				if (count($other_attachments) == 0) {
					// okey only index.html so we can delete the folder also
					delete_dir(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/campaign/' . $attachment->rel_id);
				}
			}
		}

		return $deleted;
	}

	/**
	 * get campaign attachments
	 * @param  object $campaign
	 * @param  int $id      
	 * @return object          
	 */
	public function get_campaign_attachments($campaign, $id = '') {
		// If is passed id get return only 1 attachment
		if (is_numeric($id)) {
			$this->db->where('id', $id);
		} else {
			$this->db->where('rel_id', $campaign);
		}
		$this->db->where('rel_type', 'rec_campaign');
		$result = $this->db->get('tblfiles');
		if (is_numeric($id)) {
			return $result->row();
		}

		return $result->result_array();
	}

	/**
	 * add candidate
	 * @param object $data
	 */
	public function add_candidate($data) {
		$data['birthday'] = to_sql_date($data['birthday']);
		$data['days_for_identity'] = to_sql_date($data['days_for_identity']);
		$data['desired_salary'] = reformat_currency_rec($data['desired_salary']);
		$data['status'] = 1;
		$data['date_add'] = date('Y-m-d');

		if (isset($data['from_date'])) {
			$from_date = $data['from_date'];
			unset($data['from_date']);
		}

		if (isset($data['to_date'])) {
			$to_date = $data['to_date'];
			unset($data['to_date']);
		}

		if (isset($data['company'])) {
			$company = $data['company'];
			unset($data['company']);
		}

		if (isset($data['position'])) {
			$position = $data['position'];
			unset($data['position']);
		}

		if (isset($data['contact_person'])) {
			$contact_person = $data['contact_person'];
			unset($data['contact_person']);
		}

		if (isset($data['salary'])) {
			$salary = $data['salary'];
			unset($data['salary']);
		}

		if (isset($data['reason_quitwork'])) {
			$reason_quitwork = $data['reason_quitwork'];
			unset($data['reason_quitwork']);
		}

		if (isset($data['job_description'])) {
			$job_description = $data['job_description'];
			unset($data['job_description']);
		}

		if (isset($data['literacy_from_date'])) {
			$literacy_from_date = $data['literacy_from_date'];
			unset($data['literacy_from_date']);
		}

		if (isset($data['literacy_to_date'])) {
			$literacy_to_date = $data['literacy_to_date'];
			unset($data['literacy_to_date']);
		}

		if (isset($data['diploma'])) {
			$diploma = $data['diploma'];
			unset($data['diploma']);
		}

		if (isset($data['training_places'])) {
			$training_places = $data['training_places'];
			unset($data['training_places']);
		}

		if (isset($data['specialized'])) {
			$specialized = $data['specialized'];
			unset($data['specialized']);
		}

		if (isset($data['training_form'])) {
			$training_form = $data['training_form'];
			unset($data['training_form']);
		}

		if (isset($data['relationship'])) {
			$relationship = $data['relationship'];
			unset($data['relationship']);
		}

		if (isset($data['name'])) {
			$name = $data['name'];
			unset($data['name']);
		}

		if (isset($data['fi_birthday'])) {
			$fi_birthday = $data['fi_birthday'];
			unset($data['fi_birthday']);
		}

		if (isset($data['job'])) {
			$job = $data['job'];
			unset($data['job']);
		}

		if (isset($data['address'])) {
			$address = $data['address'];
			unset($data['address']);
		}

		if (isset($data['phone'])) {
			$phone = $data['phone'];
			unset($data['phone']);
		}

		$this->db->insert(db_prefix() . 'rec_candidate', $data);
		$insert_id = $this->db->insert_id();
		if ($insert_id) {
			foreach ($from_date as $key => $val) {
				if ($from_date[$key] != '') {
					$this->db->insert(db_prefix() . 'cd_work_experience', [
						'candidate' => $insert_id,
						'from_date' => to_sql_date($val),
						'to_date' => to_sql_date($to_date[$key]),
						'company' => $company[$key],
						'position' => $position[$key],
						'contact_person' => $contact_person[$key],
						'salary' => $salary[$key],
						'reason_quitwork' => $reason_quitwork[$key],
						'job_description' => $job_description[$key],
					]);
				}
			}

			foreach ($literacy_from_date as $key => $val) {
				if ($literacy_from_date[$key] != '') {
					$this->db->insert(db_prefix() . 'cd_literacy', [
						'candidate' => $insert_id,
						'literacy_from_date' => to_sql_date($val),
						'literacy_to_date' => to_sql_date($literacy_to_date[$key]),
						'diploma' => $diploma[$key],
						'training_places' => $training_places[$key],
						'specialized' => $specialized[$key],
						'training_form' => $training_form[$key],
					]);
				}
			}

			foreach ($relationship as $key => $val) {
				if ($relationship[$key] != '') {
					$this->db->insert(db_prefix() . 'cd_family_infor', [
						'candidate' => $insert_id,
						'relationship' => $val,
						'name' => $name[$key],
						'fi_birthday' => to_sql_date($fi_birthday[$key]),
						'job' => $job[$key],
						'address' => $address[$key],
						'phone' => $phone[$key],
					]);
				}
			}

			return $insert_id;
		}
	}

	/**
	 * change status campaign
	 * @param  int $status
	 * @param  int $id    
	 * @return bool        
	 */
	public function change_status_campaign($status, $id) {
		$this->db->where('cp_id', $id);
		$this->db->update(db_prefix() . 'rec_campaign', ['cp_status' => $status]);
		if ($this->db->affected_rows() > 0) {
			return true;
		}

		return false;
	}

	/**
	 * get candidates
	 * @param  string $id
	 * @return object
	 */
	public function get_candidates($id = '') {
		if ($id == '') {
			return $this->db->get(db_prefix() . 'rec_candidate')->result_array();
		} else {
			$this->db->where('id', $id);
			$candidate = $this->db->get(db_prefix() . 'rec_candidate')->row();

			$this->db->where('candidate', $id);
			$candidate->literacy = $this->db->get(db_prefix() . 'cd_literacy')->result_array();

			$this->db->where('candidate', $id);
			$candidate->family_infor = $this->db->get(db_prefix() . 'cd_family_infor')->result_array();

			$this->db->where('candidate', $id);
			$candidate->work_experience = $this->db->get(db_prefix() . 'cd_work_experience')->result_array();

			$this->db->where('rel_id', $id);
			$this->db->where('rel_type', 'rec_cadidate_avar');
			$candidate->avar = $this->db->get(db_prefix() . 'files')->row();

			$this->db->where('rel_id', $id);
			$this->db->where('rel_type', 'rec_cadidate_file');
			$candidate->file = $this->db->get(db_prefix() . 'files')->result_array();

			$this->db->where('candidate', $id);
			$candidate->care = $this->db->get(db_prefix() . 'cd_care')->result_array();

			return $candidate;
		}
	}

	/**
	 * update cadidate
	 * @param  object $data
	 * @param  int $id  
	 * @return 
	 */
	public function update_cadidate($data, $id) {

		$data['birthday'] = to_sql_date($data['birthday']);
		$data['days_for_identity'] = to_sql_date($data['days_for_identity']);
		$data['desired_salary'] = reformat_currency_rec($data['desired_salary']);

		if (isset($data['from_date'])) {
			$from_date = $data['from_date'];
			unset($data['from_date']);
		}

		if (isset($data['to_date'])) {
			$to_date = $data['to_date'];
			unset($data['to_date']);
		}

		if (isset($data['company'])) {
			$company = $data['company'];
			unset($data['company']);
		}

		if (isset($data['position'])) {
			$position = $data['position'];
			unset($data['position']);
		}

		if (isset($data['contact_person'])) {
			$contact_person = $data['contact_person'];
			unset($data['contact_person']);
		}

		if (isset($data['salary'])) {
			$salary = $data['salary'];
			unset($data['salary']);
		}

		if (isset($data['reason_quitwork'])) {
			$reason_quitwork = $data['reason_quitwork'];
			unset($data['reason_quitwork']);
		}

		if (isset($data['job_description'])) {
			$job_description = $data['job_description'];
			unset($data['job_description']);
		}

		if (isset($data['literacy_from_date'])) {
			$literacy_from_date = $data['literacy_from_date'];
			unset($data['literacy_from_date']);
		}

		if (isset($data['literacy_to_date'])) {
			$literacy_to_date = $data['literacy_to_date'];
			unset($data['literacy_to_date']);
		}

		if (isset($data['diploma'])) {
			$diploma = $data['diploma'];
			unset($data['diploma']);
		}

		if (isset($data['training_places'])) {
			$training_places = $data['training_places'];
			unset($data['training_places']);
		}

		if (isset($data['specialized'])) {
			$specialized = $data['specialized'];
			unset($data['specialized']);
		}

		if (isset($data['training_form'])) {
			$training_form = $data['training_form'];
			unset($data['training_form']);
		}

		if (isset($data['relationship'])) {
			$relationship = $data['relationship'];
			unset($data['relationship']);
		}

		if (isset($data['name'])) {
			$name = $data['name'];
			unset($data['name']);
		}

		if (isset($data['fi_birthday'])) {
			$fi_birthday = $data['fi_birthday'];
			unset($data['fi_birthday']);
		}

		if (isset($data['job'])) {
			$job = $data['job'];
			unset($data['job']);
		}

		if (isset($data['address'])) {
			$address = $data['address'];
			unset($data['address']);
		}

		if (isset($data['phone'])) {
			$phone = $data['phone'];
			unset($data['phone']);
		}
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'rec_candidate', $data);

		$this->db->where('candidate', $id);
		$this->db->delete('cd_work_experience');
		foreach ($from_date as $key => $val) {
			if ($from_date[$key] != '') {
				$this->db->insert(db_prefix() . 'cd_work_experience', [
					'candidate' => $id,
					'from_date' => to_sql_date($val),
					'to_date' => to_sql_date($to_date[$key]),
					'company' => $company[$key],
					'position' => $position[$key],
					'contact_person' => $contact_person[$key],
					'salary' => $salary[$key],
					'reason_quitwork' => $reason_quitwork[$key],
					'job_description' => $job_description[$key],
				]);
			}
		}

		$this->db->where('candidate', $id);
		$this->db->delete('cd_literacy');
		foreach ($literacy_from_date as $key => $val) {
			if ($literacy_from_date[$key] != '') {
				$this->db->insert(db_prefix() . 'cd_literacy', [
					'candidate' => $id,
					'literacy_from_date' => to_sql_date($val),
					'literacy_to_date' => to_sql_date($literacy_to_date[$key]),
					'diploma' => $diploma[$key],
					'training_places' => $training_places[$key],
					'specialized' => $specialized[$key],
					'training_form' => $training_form[$key],
				]);
			}
		}

		$this->db->where('candidate', $id);
		$this->db->delete('cd_family_infor');
		foreach ($relationship as $key => $val) {
			if ($relationship[$key] != '') {
				$this->db->insert(db_prefix() . 'cd_family_infor', [
					'candidate' => $id,
					'relationship' => $val,
					'name' => $name[$key],
					'fi_birthday' => to_sql_date($fi_birthday[$key]),
					'job' => $job[$key],
					'address' => $address[$key],
					'phone' => $phone[$key],
				]);
			}
		}

		$this->db->where('rel_id', $id);
		$this->db->where('rel_type', 'rec_cadidate_avar');
		$avar = $this->db->get(db_prefix() . 'files')->row();

		if ($avar && (isset($_FILES['cd_avar']['name']) && $_FILES['cd_avar']['name'] != '')) {
			if (empty($avar->external)) {
				unlink(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/avartar/' . $avar->rel_id . '/' . $avar->file_name);
			}
			$this->db->where('id', $avar->id);
			$this->db->delete('tblfiles');

			if (is_dir(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/' . $avar->rel_id)) {
				// Check if no avars left, so we can delete the folder also
				$other_avars = list_files(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/' . $avar->rel_id);
				if (count($other_avars) == 0) {
					// okey only index.html so we can delete the folder also
					delete_dir(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/' . $avar->rel_id);
				}
			}
		}

		return true;
	}

	/**
	 * add interview schedules
	 * @param object $data 
	 */
	public function add_interview_schedules($data) {
		$data['interview_day'] = to_sql_date($data['interview_day']);
		$data['interviewer'] = implode(',', $data['interviewer']);
		$data['added_from'] = get_staff_user_id();
		$data['added_date'] = date('Y-m-d');
		$data['from_hours'] = $data['interview_day'] . ' ' . $data['from_time'] . ':00';
		$data['to_hours'] = $data['interview_day'] . ' ' . $data['to_time'] . ':00';

		if (isset($data['candidate'])) {
			$candidate = $data['candidate'];
			unset($data['candidate']);
		}

		$this->db->insert(db_prefix() . 'rec_interview', $data);
		$insert_id = $this->db->insert_id();
		if ($insert_id) {
			if (count($candidate) > 0) {
				foreach ($candidate as $can) {
					$this->db->insert(db_prefix() . 'cd_interview', [
						'candidate' => $can,
						'interview' => $insert_id,
					]);
				}
			}
			return $insert_id;
		}
	}

	/**
	 * update interview schedules
	 * @param  object $data
	 * @param  int $id
	 * @return bool 
	 */
	public function update_interview_schedules($data, $id) {
		$data['interview_day'] = to_sql_date($data['interview_day']);
		$data['interviewer'] = implode(',', $data['interviewer']);
		$data['added_from'] = get_staff_user_id();
		$data['added_date'] = date('Y-m-d');
		$data['from_hours'] = $data['interview_day'] . ' ' . $data['from_time'] . ':00';
		$data['to_hours'] = $data['interview_day'] . ' ' . $data['to_time'] . ':00';

		if (isset($data['candidate'])) {
			$candidate = $data['candidate'];
			unset($data['candidate']);
		}

		$this->db->where('interview', $id);
		$this->db->delete(db_prefix() . 'cd_interview');

		if (count($candidate) > 0) {
			foreach ($candidate as $can) {
				$this->db->insert(db_prefix() . 'cd_interview', [
					'candidate' => $can,
					'interview' => $id,
				]);
			}
		}

		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'rec_interview', $data);

		return true;

	}

	/**
	 * delete candidate
	 * @param  int $id
	 * @return bool
	 */
	public function delete_candidate($id) {
		$this->db->where('rel_id', $id);
		$this->db->where('rel_type', 'rec_cadidate_file');
		$attachments = $this->db->get('tblfiles')->result_array();
		foreach ($attachments as $attachment) {
			$this->delete_candidate_attachment($attachment['id']);

		}

		$this->db->where('rel_id', $id);
		$this->db->where('rel_type', 'rec_cadidate_avar');
		$avartar = $this->db->get('tblfiles')->result_array();
		foreach ($avartar as $avar) {
			$this->delete_candidate_avar_attachment($avar['id']);

		}

		$this->db->where('candidate', $id);
		$this->db->delete(db_prefix() . 'cd_interview');

		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'rec_candidate');
		if ($this->db->affected_rows() > 0) {
			return true;
		}

		return false;
	}

	/**
	 * delete candidate attachment
	 * @param  int $id
	 * @return bool   
	 */
	public function delete_candidate_attachment($id) {
		$attachment = $this->get_candidate_attachments('', $id);
		$deleted = false;
		if ($attachment) {
			if (empty($attachment->external)) {
				unlink(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/files/' . $attachment->rel_id . '/' . $attachment->file_name);
			}
			$this->db->where('id', $attachment->id);
			$this->db->delete('tblfiles');
			if ($this->db->affected_rows() > 0) {
				$deleted = true;
			}

			if (is_dir(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/files/' . $attachment->rel_id)) {
				// Check if no attachments left, so we can delete the folder also
				$other_attachments = list_files(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/files/' . $attachment->rel_id);
				if (count($other_attachments) == 0) {
					// okey only index.html so we can delete the folder also
					delete_dir(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/files/' . $attachment->rel_id);
				}
			}
		}

		return $deleted;
	}

	/**
	 * delete candidate avar attachment
	 * @param  int $id
	 * @return bool    
	 */
	public function delete_candidate_avar_attachment($id) {
		$attachment = $this->get_candidate_avar_attachments('', $id);
		$deleted = false;
		if ($attachment) {
			if (empty($attachment->external)) {
				unlink(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/avartar/' . $attachment->rel_id . '/' . $attachment->file_name);
			}
			$this->db->where('id', $attachment->id);
			$this->db->delete('tblfiles');
			if ($this->db->affected_rows() > 0) {
				$deleted = true;
			}

			if (is_dir(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/avartar/' . $attachment->rel_id)) {
				// Check if no attachments left, so we can delete the folder also
				$other_attachments = list_files(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/avartar/' . $attachment->rel_id);
				if (count($other_attachments) == 0) {
					// okey only index.html so we can delete the folder also
					delete_dir(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/candidate/avartar/' . $attachment->rel_id);
				}
			}
		}

		return $deleted;
	}

	/**
	 * get candidate avar attachments
	 * @param  object $candidate 
	 * @param  string $id        
	 * @return object            
	 */
	public function get_candidate_avar_attachments($candidate, $id = '') {
		// If is passed id get return only 1 attachment
		if (is_numeric($id)) {
			$this->db->where('id', $id);
		} else {
			$this->db->where('rel_id', $candidate);
		}
		$this->db->where('rel_type', 'rec_cadidate_avar');
		$result = $this->db->get('tblfiles');
		if (is_numeric($id)) {
			return $result->row();
		}

		return $result->result_array();
	}

	/**
	 * get candidate attachments
	 * @param  object $candidate
	 * @param  string $id       
	 * @return object           
	 */
	public function get_candidate_attachments($candidate, $id = '') {
		// If is passed id get return only 1 attachment
		if (is_numeric($id)) {
			$this->db->where('id', $id);
		} else {
			$this->db->where('rel_id', $candidate);
		}
		$this->db->where('rel_type', 'rec_cadidate_file');
		$result = $this->db->get('tblfiles');
		if (is_numeric($id)) {
			return $result->row();
		}

		return $result->result_array();
	}

	/**
	 * add care candidate
	 * @param object $data 
	 */
	public function add_care_candidate($data) {
		$data['care_time'] = to_sql_date($data['care_time'], true);
		$data['add_from'] = get_staff_user_id();
		$data['add_time'] = date('Y-m-d H:i:s');
		$this->db->insert(db_prefix() . 'cd_care', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	/**
	 * rating candidate
	 * @param  object $data
	 * @return bool      
	 */
	public function rating_candidate($data) {
		$rs = 0;
		$assessor = get_staff_user_id();
		$evaluation_date = date('Y-m-d H:i:s');
		$this->db->where('candidate', $data['candidate']);
		$rate = $this->db->get(db_prefix() . 'rec_cd_evaluation')->result_array();
		if (count($rate) > 0) {
			$this->db->where('candidate', $data['candidate']);
			$this->db->delete(db_prefix() . 'rec_cd_evaluation');
		}

		foreach ($data['rating'] as $key => $value) {

			$this->db->insert(db_prefix() . 'rec_cd_evaluation', [
				'criteria' => $key,
				'rate_score' => $value,
				'assessor' => $assessor,
				'evaluation_date' => $evaluation_date,
				'percent' => $data['percent'][$key],
				'candidate' => $data['candidate'],
				'feedback' => $data['feedback'],
				'group_criteria' => $data['group'][$key],
			]);
			if ($this->db->insert_id()) {
				$rs++;
			}

		}
		if ($rs > 0) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * send mail candidate
	 * @param  object $data
	 * @return bool      
	 */
	public function send_mail_candidate($data) {
		$staff_id = get_staff_user_id();

		$inbox = array();

		$inbox['to'] = $data['email'];
		$inbox['sender_name'] = get_staff_full_name($staff_id);
		$inbox['subject'] = _strip_tags($data['subject']);
		$inbox['body'] = _strip_tags($data['content']);
		$inbox['body'] = nl2br_save_html($inbox['body']);
		$inbox['date_received'] = date('Y-m-d H:i:s');
		$inbox['from_email'] = get_staff_email_by_id_rec($staff_id);

		if (strlen(get_option('smtp_host')) > 0 && strlen(get_option('smtp_password')) > 0 && strlen(get_option('smtp_username')) > 0) {

			$ci = &get_instance();
			$ci->email->initialize();
			$ci->load->library('email');
			$ci->email->clear(true);
			$ci->email->from($inbox['from_email'], $inbox['sender_name']);
			$ci->email->to($inbox['to']);

			$ci->email->subject($inbox['subject']);
			$ci->email->message($inbox['body']);

			$ci->email->send(true);
		}

		$care = array();
		$care['care_time'] = $inbox['date_received'];
		$care['add_from'] = $staff_id;
		$care['add_time'] = $inbox['date_received'];
		$care['candidate'] = $data['candidate'];
		$care['care_result'] = 'Sent';
		$care['type'] = 'send_mail';
		$this->db->insert(db_prefix() . 'cd_care', $care);

		return true;
	}

	/**
	 * send mail list candidate
	 * @param  object $data
	 * @return object      
	 */
	public function send_mail_list_candidate($data) {
		$staff_id = get_staff_user_id();

		$inbox = array();

		$inbox['to'] = implode(',', $data['email']);
		$inbox['sender_name'] = get_staff_full_name($staff_id);
		$inbox['subject'] = _strip_tags($data['subject']);
		$inbox['body'] = _strip_tags($data['content']);
		$inbox['body'] = nl2br_save_html($inbox['body']);
		$inbox['date_received'] = date('Y-m-d H:i:s');
		$inbox['from_email'] = get_staff_email_by_id_rec($staff_id);

		if (strlen(get_option('smtp_host')) > 0 && strlen(get_option('smtp_password')) > 0 && strlen(get_option('smtp_username')) > 0) {

			$ci = &get_instance();
			$ci->email->initialize();
			$ci->load->library('email');
			$ci->email->clear(true);
			$ci->email->from($inbox['from_email'], $inbox['sender_name']);
			$ci->email->to($inbox['to']);

			$ci->email->subject($inbox['subject']);
			$ci->email->message($inbox['body']);

			$ci->email->send(true);
		}

		$care = array();
		foreach ($data['candidate'] as $cd) {
			$care['care_time'] = $inbox['date_received'];
			$care['add_from'] = $staff_id;
			$care['add_time'] = $inbox['date_received'];
			$care['candidate'] = $cd;
			$care['care_result'] = 'Sent';
			$care['type'] = 'send_mail';
			$this->db->insert(db_prefix() . 'cd_care', $care);
		}

		return true;
	}

	/**
	 * check candidate interview
	 * @param  object $data
	 * @return object      
	 */
	public function check_candidate_interview($data) {
		$data['interview_day'] = to_sql_date($data['interview_day']);
		$cd = $data['candidate'];
		$from_hours = $data['interview_day'] . ' ' . $data['from_time'] . ':00';
		$to_hours = $data['interview_day'] . ' ' . $data['to_time'] . ':00';

		if (!isset($data['id'])) {
			$list = $this->db->query('SELECT * FROM tblrec_interview ri LEFT JOIN tblcd_interview ON tblcd_interview.interview = ri.id WHERE tblcd_interview.candidate = ' . $cd . ' AND (((ri.from_hours <= "' . $from_hours . '") AND (ri.to_hours >= "' . $from_hours . '")) OR  ((ri.from_hours <= "' . $to_hours . '") AND (ri.to_hours >= "' . $to_hours . '")) OR  ((ri.from_hours >= "' . $from_hours . '") AND (ri.to_hours <= "' . $to_hours . '")) )')->result_array();
			return $list;

		} else {
			$lists = $this->db->query('SELECT * FROM tblrec_interview ri LEFT JOIN tblcd_interview ON tblcd_interview.interview = ri.id WHERE tblcd_interview.candidate = ' . $cd . ' AND ri.id != ' . $data['id'] . ' AND (((ri.from_hours <= "' . $from_hours . '") AND (ri.to_hours >= "' . $from_hours . '")) OR  ((ri.from_hours <= "' . $to_hours . '") AND (ri.to_hours >= "' . $to_hours . '")) OR  ((ri.from_hours >= "' . $from_hours . '") AND (ri.to_hours <= "' . $to_hours . '")) )')->result_array();
			return $lists;

		}

	}

	/**
	 * get list cd
	 * @return object
	 */
	public function get_list_cd() {
		$this->db->select('id, candidate_name as label');
		return $this->db->get(db_prefix() . 'rec_candidate')->result_array();
	}

	/**
	 * get list candidates interview
	 * @param  int $id
	 * @return object
	 */
	public function get_list_candidates_interview($id) {
		return $this->db->query('SELECT * FROM tblcd_interview LEFT JOIN tblrec_candidate on tblrec_candidate.id = tblcd_interview.candidate where tblcd_interview.interview = ' . $id)->result_array();
	}

	/**
	 * delete interview schedule
	 * @param  int $id
	 * @return bool
	 */
	public function delete_interview_schedule($id) {
		$this->db->where('interview', $id);
		$this->db->delete(db_prefix() . 'cd_interview');

		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'rec_interview');
		if ($this->db->affected_rows() > 0) {
			return true;
		}

		return false;
	}

	/**
	 * get interview schedule
	 * @param  string $id
	 * @return object    
	 */
	public function get_interview_schedule($id = '') {
		if ($id == '') {
			return $this->db->get(db_prefix() . 'rec_interview')->result_array();
		} else {
			$this->db->where('id', $id);
			$intv_sch = $this->db->get(db_prefix() . 'rec_interview')->row();
			$intv_sch->list_candidate = $this->get_list_candidates_interview($id);

			return $intv_sch;
		}
	}

	/**
	 * add evaluation criteria
	 * @param object $data 
	 */
	public function add_evaluation_criteria($data) {
		$data['add_from'] = get_staff_user_id();
		$data['add_date'] = date('Y-m-d');
		$this->db->insert(db_prefix() . 'rec_criteria', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	/**
	 * update evaluation criteria
	 * @param  object $data
	 * @param  int $id  
	 * @return bool      
	 */
	public function update_evaluation_criteria($data, $id) {
		$this->db->where('criteria_id', $id);
		$this->db->update(db_prefix() . 'rec_criteria', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * delete evaluation criteria
	 * @param  int $id
	 * @return bool    
	 */
	public function delete_evaluation_criteria($id) {
		$affected_rows = 0;
		$this->db->where('group_criteria', $id);
		$rs = $this->db->get(db_prefix() . 'rec_criteria')->result_array();
		foreach ($rs as $value) {
			$this->db->where('criteria_id', $value['criteria_id']);
			$this->db->delete(db_prefix() . 'rec_criteria');
			if ($this->db->affected_rows() > 0) {
				$affected_rows++;
			}
		}

		$this->db->where('criteria_id', $id);
		$this->db->delete(db_prefix() . 'rec_criteria');
		if ($this->db->affected_rows() > 0) {
			$affected_rows++;
		}

		if ($affected_rows > 0) {
			return true;
		}
		return false;
	}

	/**
	 * get group evaluation criteria
	 * @param  string $id
	 * @return object    
	 */
	public function get_group_evaluation_criteria($id = '') {
		if ($id == '') {
			$this->db->where('group_criteria', 0);
			$group = $this->db->get(db_prefix() . 'rec_criteria')->result_array();
		} else {
			$this->db->where('group_criteria', $id);
			$group = $this->db->get(db_prefix() . 'rec_criteria')->row();
		}
		return $group;
	}

	/**
	 * get list child criteria
	 * @return object
	 */
	public function get_list_child_criteria() {
		$list_group = $this->get_group_evaluation_criteria();
		$rs = array();
		$list = array();
		$parent = array();
		foreach ($list_group as $gr) {
			$parent[] = $gr;
			$this->db->where('group_criteria', $gr['criteria_id']);
			$rs = $this->db->get(db_prefix() . 'rec_criteria')->result_array();
			foreach ($rs as $value) {
				$parent[] = $value;
			}
		}
		return $parent;
	}

	/**
	 * get criteria by group
	 * @param  int $id
	 * @return object    
	 */
	public function get_criteria_by_group($id) {
		$this->db->where('group_criteria', $id);
		$rs = $this->db->get(db_prefix() . 'rec_criteria')->result_array();
		return $rs;
	}

	/**
	 * add evaluation form
	 * @param object $data
	 */
	public function add_evaluation_form($data) {
		$data['add_from'] = get_staff_user_id();
		$data['add_date'] = date('Y-m-d');

		if (isset($data['job_position'])) {
			$data['position'] = $data['job_position'];
			unset($data['job_position']);
		}

		if (isset($data['group_criteria'])) {
			$group_criteria = $data['group_criteria'];
			unset($data['group_criteria']);
		}

		if (isset($data['evaluation_criteria'])) {
			$evaluation_criteria = $data['evaluation_criteria'];
			unset($data['evaluation_criteria']);
		}

		if (isset($data['percent'])) {
			$percent = $data['percent'];
			unset($data['percent']);
		}

		$this->db->insert(db_prefix() . 'rec_evaluation_form', $data);
		$insert_id = $this->db->insert_id();
		if (isset($insert_id)) {
			foreach ($evaluation_criteria as $key => $value) {
				foreach ($value as $per => $val) {
					$this->db->insert(db_prefix() . 'rec_list_criteria', [
						'evaluation_form' => $insert_id,
						'group_criteria' => $group_criteria[$key],
						'evaluation_criteria' => $val,
						'percent' => $percent[$key][$per],
					]);
				}
			}
			return $insert_id;
		}

	}

	/**
	 * update evaluation form
	 * @param  object $data
	 * @param  int $id  
	 * @return bool      
	 */
	public function update_evaluation_form($data, $id) {

		if (isset($data['job_position'])) {
			$data['position'] = $data['job_position'];
			unset($data['job_position']);
		}

		if (isset($data['group_criteria'])) {
			$group_criteria = $data['group_criteria'];
			unset($data['group_criteria']);
		}

		if (isset($data['evaluation_criteria'])) {
			$evaluation_criteria = $data['evaluation_criteria'];
			unset($data['evaluation_criteria']);
		}

		if (isset($data['percent'])) {
			$percent = $data['percent'];
			unset($data['percent']);
		}

		$this->db->where('form_id', $id);
		$this->db->update(db_prefix() . 'rec_evaluation_form', $data);

		$this->db->where('evaluation_form', $id);
		$this->db->delete(db_prefix() . 'rec_list_criteria');

		foreach ($evaluation_criteria as $key => $value) {
			foreach ($value as $per => $val) {
				$this->db->insert(db_prefix() . 'rec_list_criteria', [
					'evaluation_form' => $id,
					'group_criteria' => $group_criteria[$key],
					'evaluation_criteria' => $val,
					'percent' => $percent[$key][$per],
				]);
			}
		}

		return true;
	}

	/**
	 * delete evaluation form
	 * @param  int $id
	 * @return bool    
	 */
	public function delete_evaluation_form($id) {
		$affected_rows = 0;

		$this->db->where('form_id', $id);
		$this->db->delete(db_prefix() . 'rec_evaluation_form');
		if ($this->db->affected_rows() > 0) {
			$affected_rows++;
		}

		$this->db->where('evaluation_form', $id);
		$this->db->delete(db_prefix() . 'rec_list_criteria');
		if ($this->db->affected_rows() > 0) {
			$affected_rows++;
		}

		if ($affected_rows > 0) {
			return true;
		}
		return false;
	}

	/**
	 * get list evaluation form
	 * @param  string $id
	 * @return object    
	 */
	public function get_list_evaluation_form($id = '') {
		if ($id == '') {
			return $this->db->get(db_prefix() . 'rec_evaluation_form')->result_array();
		} else {
			$this->db->where('form_id', $id);
			return $this->db->get(db_prefix() . 'rec_evaluation_form')->row();
		}
	}

	/**
	 * get list criteria edit
	 * @param  int $id
	 * @return object    
	 */
	public function get_list_criteria_edit($id) {
		$groups = $this->get_group_evaluation_criteria();
		$list_group = $this->db->query('SELECT distinct(tblrec_list_criteria.group_criteria) as id, criteria_title FROM tblrec_list_criteria
                      LEFT JOIN tblrec_criteria on tblrec_criteria.criteria_id = tblrec_list_criteria.group_criteria where tblrec_list_criteria.evaluation_form = ' . $id)->result_array();
		$html = '<div class="new-kpi-group-al">';
		$count_group = 0;
		foreach ($list_group as $gr) {
			$list_criter = $this->db->query('select evaluation_criteria, criteria_title, percent from tblrec_list_criteria
                        left join tblrec_criteria on tblrec_criteria.criteria_id = tblrec_list_criteria.evaluation_criteria
                         where tblrec_list_criteria.evaluation_form = ' . $id . ' AND tblrec_list_criteria.group_criteria = ' . $gr['id'])->result_array();
			$criterias = $this->get_criteria_by_group($gr['id']);
			$i = 'fa-plus';
			$class = 'success';
			$click = 'new_kpi_group';
			if ($count_group > 0) {
				$i = 'fa-minus';
				$class = 'danger';
				$click = 'remove_kpi_group';
			}

			$html .= '<div id="new_kpi_group" class="col-md-12">
                              <div class="row margin-top-10">
                                <div class="col-md-12">
                                    <label for="group_criteria[' . $count_group . ']" class="control-label"><span class="text-danger">* </span>' . _l('group_criteria') . '</label>
                                      <select onchange="group_criteria_change(this)" name="group_criteria[' . $count_group . ']" class="selectpicker" id="group_criteria[' . $count_group . ']" data-width="100%" data-none-selected-text="' . _l('dropdown_non_selected_tex') . '" required>
                                        <option value=""></option>';
			foreach ($groups as $kpi_coll) {
				$select = '';
				if ($kpi_coll['criteria_id'] == $gr['id']) {
					$select = 'selected';
				}
				$html .= '<option value="' . $kpi_coll['criteria_id'] . '" ' . $select . '> ' . $kpi_coll['criteria_title'] . '</option>';
			}
			$html .= '</select>
                                </div>

                              </div>
                                <br>
                              <div class="row " >

                                <div class="col-md-11 new-kpi-al pull-right margin-left-right-20-0">';
			$count_criter = 0;
			foreach ($list_criter as $li) {
				$l_i = 'fa-plus';
				$l_class = 'success';
				$l_click = 'new_kpi';
				if ($count_criter > 0) {
					$l_i = 'fa-minus';
					$l_class = 'danger';
					$l_click = 'remove_kpi';
				}

				$html .= '<div id ="new_kpi" class="row padding-bottom-5">';

				$html .= '<div class="col-md-7 padding-right-0">
                                      <label for="evaluation_criteria[' . $count_group . '][' . $count_criter . ']" class="control-label get_id_row " value ="' . $count_criter . '" ><span class="text-danger">* </span>' . _l('evaluation_criteria') . '</label>
                                      <select name="evaluation_criteria[' . $count_group . '][' . $count_criter . ']" class="selectpicker" id="evaluation_criteria[' . $count_group . '][' . $count_criter . ']" data-width="100%" data-none-selected-text="' . _l('dropdown_non_selected_tex') . '" data-sl-id="e_criteria[' . $count_group . ']" required>
                                        <option value=""></option>';
				foreach ($criterias as $cr) {
					$select_cr = '';
					if ($cr['criteria_id'] == $li['evaluation_criteria']) {
						$select_cr = 'selected';
					}
					$html .= '<option value="' . $cr['criteria_id'] . '" ' . $select_cr . '> ' . $cr['criteria_title'] . '</option>';
				}

				$html .= '</select>
                                    </div>

                                    <div class="col-md-3 padding-right-0">
                                      <label for="percent[' . $count_group . '][' . $count_criter . ']" class="control-label"><span class="text-danger">* </span>' . _l('proportion') . '</label>
                                      <input type="number" id="percent[' . $count_group . '][' . $count_criter . ']" name="percent[' . $count_group . '][' . $count_criter . ']" class="form-control" min="1" max="100" step="1" value="' . $li['percent'] . '" aria-invalid="false" required>
                                    </div>
                                    <div class="col-md-1 lightheight-84-nowrap" name="button_add_kpi">
                                      <button name="add" class="btn ' . $l_click . ' btn-' . $l_class . ' border-radius-20" data-ticket="true" type="button"><i class="fa ' . $l_i . '"></i></button>
                                    </div>
                                  </div>';
				$count_criter++;
			}
			$html .= '</div>

                              </div>

                              <div class="row">
                                <div class="col-md-2 lightheight-84-nowrap" name="button_add_kpi_group">
                                        <button name="add_kpi_group" class="btn ' . $click . ' btn-' . $class . ' border-radius-20" data-ticket="true" type="button"><i class="fa ' . $i . '"></i></button>
                                </div>
                              </div>

                            </div>';

			$count_group++;
		}

		return $html;
	}

	/**
	 * get evaluation form by position
	 * @param  string $position
	 * @return object          
	 */
	public function get_evaluation_form_by_position($position = '') {
		$this->db->where('position', $position);
		$e_form = $this->db->get(db_prefix() . 'rec_evaluation_form')->row();

		if (!isset($e_form)) {
			$this->db->where('position', 0);
			$e_form = $this->db->get(db_prefix() . 'rec_evaluation_form')->row();
		}

		if ($e_form) {
			$rs['groups'] = $this->db->query('SELECT distinct(tblrec_list_criteria.group_criteria) as id, criteria_title FROM tblrec_list_criteria
                          LEFT JOIN tblrec_criteria on tblrec_criteria.criteria_id = tblrec_list_criteria.group_criteria where tblrec_list_criteria.evaluation_form = ' . $e_form->form_id)->result_array();

			$rs['criteria'] = $this->db->query('select tblrec_list_criteria.group_criteria as group_cr, evaluation_criteria, criteria_title, percent from tblrec_list_criteria
                            left join tblrec_criteria on tblrec_criteria.criteria_id = tblrec_list_criteria.evaluation_criteria
                             where tblrec_list_criteria.evaluation_form = ' . $e_form->form_id)->result_array();
			return $rs;
		} else {
			return '';
		}

	}

	/**
	 * get cd evaluation
	 * @param  object $candidate
	 * @return object
	 */
	public function get_cd_evaluation($candidate) {
		$this->db->where('candidate', $candidate);
		return $this->db->get(db_prefix() . 'rec_cd_evaluation')->result_array();
	}

	/**
	 * get interview by candidate
	 * @param  object $candidate 
	 * @return object            
	 */
	public function get_interview_by_candidate($candidate) {
		return $this->db->query('SELECT * FROM tblcd_interview LEFT JOIN tblrec_interview on tblrec_interview.id = tblcd_interview.interview where tblcd_interview.candidate = ' . $candidate)->result_array();
	}

	/**
	 * change status candidate
	 * @param  int $status
	 * @param  int $id    
	 * @return bool        
	 */
	public function change_status_candidate($status, $id) {
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'rec_candidate', ['status' => $status]);
		if ($this->db->affected_rows() > 0) {
			return true;
		}

		return false;
	}

	/**
	 * add setting tranfer
	 * @param object $data
	 */
	public function add_setting_tranfer($data) {
		$data['add_from'] = get_staff_user_id();
		$data['add_date'] = date('Y-m-d');		
		if (isset($data['email_to'])) {
			$data['email_to'] = implode(',', $data['email_to']);
		}

		$this->db->insert(db_prefix() . 'rec_set_transfer_record', $data);
		$insert_id = $this->db->insert_id();
		if (isset($insert_id)) {
			return $insert_id;
		}
	}

	/**
	 * update setting tranfer
	 * @param  object $data
	 * @param  int $id  
	 * @return bool
	 */
	public function update_setting_tranfer($data, $id) {
		$rs = 0;		
		if (isset($data['email_to'])) {
			$data['email_to'] = implode(',', $data['email_to']);
		}

		$this->db->where('rel_id', $id);
		$this->db->where('rel_type', 'rec_set_transfer');
		$avar = $this->db->get(db_prefix() . 'files')->row();

		if ($avar && (isset($_FILES['attachment']['name']) && $_FILES['attachment']['name'] != '')) {
			if (empty($avar->external)) {
				unlink(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/set_transfer/' . $avar->rel_id . '/' . $avar->file_name);
			}
			$this->db->where('id', $avar->id);
			$this->db->delete('tblfiles');
			if ($this->db->affected_rows() > 0) {
				$rs++;
			}

			if (is_dir(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/set_transfer/' . $avar->rel_id)) {
				// Check if no avars left, so we can delete the folder also
				$other_avars = list_files(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/set_transfer/' . $avar->rel_id);
				if (count($other_avars) == 0) {
					// okey only index.html so we can delete the folder also
					delete_dir(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/set_transfer/' . $avar->rel_id);
				}
			}
		}

		$this->db->where('set_id', $id);
		$this->db->update(db_prefix() . 'rec_set_transfer_record', $data);
		if ($this->db->affected_rows() > 0) {
			$rs++;
		}

		if ($rs > 0) {
			return true;
		}
		return false;
	}

	/**
	 * delete setting tranfer
	 * @param  int $id
	 * @return object    
	 */
	public function delete_setting_tranfer($id) {
		$rs = 0;
		$this->db->where('set_id', $id);
		$this->db->delete(db_prefix() . 'rec_set_transfer_record');
		if ($this->db->affected_rows() > 0) {
			$rs++;
		}

		$this->db->where('rel_id', $id);
		$this->db->where('rel_type', 'rec_set_transfer');
		$avar = $this->db->get(db_prefix() . 'files')->row();

		if ($avar) {
			if (empty($avar->external)) {
				unlink(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/set_transfer/' . $avar->rel_id . '/' . $avar->file_name);
			}
			$this->db->where('id', $avar->id);
			$this->db->delete('tblfiles');
			if ($this->db->affected_rows() > 0) {
				$rs++;
			}

			if (is_dir(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/set_transfer/' . $avar->rel_id)) {
				// Check if no avars left, so we can delete the folder also
				$other_avars = list_files(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/set_transfer/' . $avar->rel_id);
				if (count($other_avars) == 0) {
					// okey only index.html so we can delete the folder also
					delete_dir(RECRUITMENT_MODULE_UPLOAD_FOLDER . '/set_transfer/' . $avar->rel_id);
				}
			}
		}

		if ($rs > 0) {
			return true;
		}
		return false;
	}

	/**
	 * get list set transfer
	 * @param  boolean $id
	 * @return object     
	 */
	public function get_list_set_transfer($id = false) {
		if (is_numeric($id)) {
			$this->db->where('set_id', $id);
			return $this->db->get(db_prefix() . 'rec_set_transfer_record')->row();
		}

		if ($id == false) {
			return $this->db->get(db_prefix() . 'rec_set_transfer_record')->result_array();
		}
	}

	/**
	 * get step transfer setting
	 * @return object
	 */
	public function get_step_transfer_setting() {
		return $this->db->query('SELECT * FROM tblrec_set_transfer_record order by tblrec_set_transfer_record.order ASC;')->result_array();
	}

	/**
	 * action transfer hr
	 * @param  object $data
	 * @return object      
	 */
	public function action_transfer_hr($data) {

		$this->db->where('rel_id', $data['id']);
		$this->db->where('rel_type', 'rec_set_transfer');
		$file = $this->db->get(db_prefix() . 'files')->row();

		$inbox = array();

		$inbox['to'] = $data['email'];
		$inbox['sender_name'] = get_option('companyname');
		$inbox['subject'] = _strip_tags($data['subject']);
		$inbox['body'] = _strip_tags($data['content']);
		$inbox['body'] = nl2br_save_html($inbox['body']);
		$inbox['date_received'] = date('Y-m-d H:i:s');
		$inbox['from_email'] = get_option('smtp_email');

		if (strlen(get_option('smtp_host')) > 0 && strlen(get_option('smtp_password')) > 0 && strlen(get_option('smtp_username')) > 0) {

			$ci = &get_instance();
			$ci->email->initialize();
			$ci->load->library('email');
			$ci->email->clear(true);
			$ci->email->from($inbox['from_email'], $inbox['sender_name']);
			$ci->email->to($inbox['to']);

			$ci->email->subject($inbox['subject']);
			$ci->email->message($inbox['body']);

			$attachment_url = site_url(RECRUITMENT_PATH . 'set_transfer/' . $data['id'] . '/' . $file->file_name);
			$ci->email->attach($attachment_url);

			$ci->email->send(true);
		}
	}

	/**
	 * get rec dashboard count 
	 * @return object
	 */
	public function get_rec_dashboard_count() {
		$rs = [];

		$total = $this->db->query('Select * from tblrec_campaign')->result_array();
		$inprogress = $this->db->query('Select * from tblrec_campaign where cp_status = 3')->result_array();
		$planning = $this->db->query('Select * from tblrec_campaign where cp_status = 1')->result_array();
		$finish = $this->db->query('Select * from tblrec_campaign where cp_status = 4')->result_array();
		$candidate_need = $this->db->query('Select amount_recruiment from tblrec_proposal')->result_array();
		$recruited = $this->db->query('Select * from tblrec_candidate where status = 6')->result_array();
		$upcomming_intv = $this->get_upcoming_interview();

		$rs['candidate_need'] = 0;
		foreach ($candidate_need as $cd) {
			$rs['candidate_need'] += $cd['amount_recruiment'];
		}

		$rs['recruiting'] = 0;
		foreach ($inprogress as $cd) {
			$rs['recruiting'] += $cd['cp_amount_recruiment'];
		}

		$rs['upcomming_intv'] = count($upcomming_intv);
		$rs['recruited'] = count($recruited);
		$rs['total'] = count($total);
		$rs['inprogress'] = count($inprogress);
		$rs['planning'] = count($planning);
		$rs['finish'] = count($finish);

		return $rs;
	}

	/**
	 * rec plan chart by status
	 * @return object
	 */
	public function rec_plan_chart_by_status() {
		$plans = $this->get_rec_proposal();

		$chart = [];
		$status_1 = ['name' => _l('proposal'), 'color' => '#777', 'y' => 0, 'z' => 100];
		$status_2 = ['name' => _l('approved'), 'color' => '#ff6f00', 'y' => 0, 'z' => 100];
		$status_3 = ['name' => _l('made_finish'), 'color' => '#03a9f4', 'y' => 0, 'z' => 100];
		$status_4 = ['name' => _l('reject'), 'color' => '#fc2d42', 'y' => 0, 'z' => 100];

		foreach ($plans as $pl) {

			if ($pl['status'] == 1) {
				$status_1['y'] += 1;
			} elseif ($pl['status'] == 2) {
				$status_2['y'] += 1;
			} elseif ($pl['status'] == 3) {
				$status_3['y'] += 1;
			} elseif ($pl['status'] == 4) {
				$status_4['y'] += 1;
			}

		}

		if ($status_1['y'] > 0) {
			array_push($chart, $status_1);
		}
		if ($status_2['y'] > 0) {
			array_push($chart, $status_2);
		}
		if ($status_3['y'] > 0) {
			array_push($chart, $status_3);
		}
		if ($status_4['y'] > 0) {
			array_push($chart, $status_4);
		}

		return $chart;
	}

	/**
	 * rec campaign chart by status
	 * @return object
	 */
	public function rec_campaign_chart_by_status() {
		$campaign = $this->get_rec_campaign();

		$chart = [];
		$status_1 = ['name' => _l('planning'), 'color' => '#c53da9', 'y' => 0, 'z' => 100];
		$status_2 = ['name' => _l('in_progress'), 'color' => '#28B8DA', 'y' => 0, 'z' => 100];
		$status_3 = ['name' => _l('finish'), 'color' => '#84C529', 'y' => 0, 'z' => 100];
		$status_4 = ['name' => _l('cancel'), 'color' => '#fb3b3b', 'y' => 0, 'z' => 100];

		foreach ($campaign as $cp) {

			if ($cp['cp_status'] == 1) {
				$status_1['y'] += 1;
			} elseif ($cp['cp_status'] == 3) {
				$status_2['y'] += 1;
			} elseif ($cp['cp_status'] == 4) {
				$status_3['y'] += 1;
			} elseif ($cp['cp_status'] == 5) {
				$status_4['y'] += 1;
			}

		}

		if ($status_1['y'] > 0) {
			array_push($chart, $status_1);
		}
		if ($status_2['y'] > 0) {
			array_push($chart, $status_2);
		}
		if ($status_3['y'] > 0) {
			array_push($chart, $status_3);
		}
		if ($status_4['y'] > 0) {
			array_push($chart, $status_4);
		}

		return $chart;
	}

	/**
	 * get upcoming interview
	 * @return object 
	 */
	public function get_upcoming_interview() {
		return $this->db->query('select * from tblrec_interview where from_hours >= "' . date('Y-m-d H:i:s') . '"')->result_array();
	}

	/**
	 * get form 
	 * @param  string $where
	 * @return object
	 */
	public function get_form($where) {
		$this->db->where($where);
		return $this->db->get(db_prefix() . 'rec_campaign_form_web')->row();
	}

	/**
	 * add recruitment channel
	 * @param [object $data
	 */
	public function add_recruitment_channel($data) {

		if (isset($data['r_form_name'])) {
			$r_form_name = $data['r_form_name'];
		}

		$data['form_data'] = preg_replace('/=\\\\/m', "=''", $data['form_data']);
		if (isset($data['notify_lead_imported'])) {
			$data['notify_lead_imported'] = 1;
		} else {
			$data['notify_lead_imported'] = 0;
		}

		$data = $this->convert_data_campaign($data);
		$data['success_submit_msg'] = nl2br($data['success_submit_msg']);
		$data['form_key'] = app_generate_hash();

		if (isset($data['notify_ids_staff']) && $data['notify_ids_staff'] != null) {
			$data['notify_ids_staff'] = implode(',', $data['notify_ids_staff']);

		}

		if (isset($data['notify_ids_roles']) && $data['notify_ids_roles'] != null) {
			$data['notify_ids_roles'] = implode(',', $data['notify_ids_roles']);

		}

		$data['r_form_name'] = $r_form_name;
		$this->db->insert(db_prefix() . 'rec_campaign_form_web', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;

	}

	/**
	 * convert data campaign
	 * @param  object $data 
	 * @return object       
	 */
	public function convert_data_campaign($data) {

		$data_out['rec_campaign_id'] = isset($data['rec_campaign_id']) ? $data['rec_campaign_id'] : '';
		$data_out['form_type'] = isset($data['form_type']) ? $data['form_type'] : '';

		$data_out['lead_status'] = isset($data['lead_status']) ? $data['lead_status'] : '';
		$data_out['notify_ids_staff'] = isset($data['notify_ids_staff']) ? $data['notify_ids_staff'] : '';
		$data_out['notify_ids_roles'] = isset($data['notify_ids_roles']) ? $data['notify_ids_roles'] : '';
		$data_out['form_key'] = isset($data['form_key']) ? $data['form_key'] : '';
		$data_out['notify_lead_imported'] = isset($data['notify_lead_imported']) ? $data['notify_lead_imported'] : '';
		$data_out['notify_type'] = isset($data['notify_type']) ? $data['notify_type'] : '';
		$data_out['notify_ids'] = isset($data['notify_ids']) ? $data['notify_ids'] : '';
		$data_out['responsible'] = isset($data['responsible']) ? $data['responsible'] : '';
		$data_out['form_data'] = isset($data['form_data']) ? $data['form_data'] : '';
		$data_out['recaptcha'] = isset($data['recaptcha']) ? $data['recaptcha'] : '';
		$data_out['submit_btn_name'] = isset($data['submit_btn_name']) ? $data['submit_btn_name'] : '';
		$data_out['success_submit_msg'] = isset($data['success_submit_msg']) ? $data['success_submit_msg'] : '';
		$data_out['language'] = isset($data['language']) ? $data['language'] : '';
		$data_out['allow_duplicate'] = isset($data['allow_duplicate']) ? $data['allow_duplicate'] : '';
		$data_out['mark_public'] = isset($data['mark_public']) ? $data['mark_public'] : '';
		$data_out['track_duplicate_field'] = isset($data['track_duplicate_field']) ? $data['track_duplicate_field'] : '';
		$data_out['track_duplicate_field_and'] = isset($data['track_duplicate_field_and']) ? $data['track_duplicate_field_and'] : '';
		$data_out['create_task_on_duplicate'] = isset($data['create_task_on_duplicate']) ? $data['create_task_on_duplicate'] : '';

		return $data_out;
	}

	/**
	 * get recruitment channel
	 * @param  boolean $id
	 * @return object    
	 */
	public function get_recruitment_channel($id = false) {
		if (is_numeric($id)) {
			$this->db->where('id', $id);

			return $this->db->get(db_prefix() . 'rec_campaign_form_web')->row();
		}

		if ($id == false) {
			return $this->db->query('select * from tblrec_campaign_form_web')->result_array();
		}

	}

	/**
	 * delete recruitment channel 
	 * @param  int $id 
	 * @return bool    
	 */
	public function delete_recruitment_channel($id) {
		$this->db->where('id', $id);
		$this->db->delete(db_prefix() . 'rec_campaign_form_web');
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

	/**
	 * count cv from recruitment channel
	 * @param  int $id               
	 * @param  object $recruitment_channel
	 * @return object                     
	 */
	public function count_cv_from_recruitment_channel($id, $recruitment_channel) {
		$this->db->where('rec_campaign', $id);
		$this->db->where('recruitment_channel', $recruitment_channel);
		return $this->db->count_all_results(db_prefix() . 'rec_candidate');
	}

	/**
	 * count row all candidate profile
	 * @return object
	 */
	public function count_row_all_candidate_profile() {
		return $this->db->count_all('rec_candidate');
	}

	/**
	 * add candidate forms
	 * @param object $data
	 * @param string $form_key
	 */
	public function add_candidate_forms($data, $form_key = '') {
		$this->db->where('form_key', $form_key);
		$rec_campaign_form_web = $this->db->get(db_prefix() . 'rec_campaign_form_web')->row();
		$count_row = $this->recruitment_model->count_row_all_candidate_profile();

		$data['candidate_code'] = "WEB_000" . (int) $count_row += 1;
		$data['recruitment_channel'] = 1; /*type: forms*/

		$data['rec_campaign'] = $rec_campaign_form_web->rec_campaign_id;

		if (isset($data['desired_salary'])) {
			$data['desired_salary'] = $data['desired_salary'];
			unset($data['days_for_identity']);
		}
		$data['status'] = $rec_campaign_form_web->lead_status;
		$data['date_add'] = date('Y-m-d');

		if (isset($data['from_date'])) {
			$from_date = $data['from_date'];
			unset($data['from_date']);
		} else {
			$from_date = '';
		}

		if (isset($data['to_date'])) {
			$to_date = $data['to_date'];
			unset($data['to_date']);
		} else {
			$to_date = '';
		}

		if (isset($data['company'])) {
			$company = $data['company'];
			unset($data['company']);
		} else {
			$company = '';

		}

		if (isset($data['contact_person'])) {
			$contact_person = $data['contact_person'];
			unset($data['contact_person']);
		} else {
			$contact_person = '';

		}

		if (isset($data['salary'])) {
			$salary = $data['salary'];
			unset($data['salary']);
		} else {
			$salary = '';
		}

		if (isset($data['reason_quitwork'])) {
			$reason_quitwork = $data['reason_quitwork'];
			unset($data['reason_quitwork']);
		} else {

			$reason_quitwork = '';
		}

		if (isset($data['job_description'])) {
			$job_description = $data['job_description'];
			unset($data['job_description']);
		} else {
			$job_description = '';

		}

		if (isset($data['literacy_from_date'])) {
			$literacy_from_date = $data['literacy_from_date'];
			unset($data['literacy_from_date']);
		}

		if (isset($data['literacy_to_date'])) {
			$literacy_to_date = $data['literacy_to_date'];
			unset($data['literacy_to_date']);
		}

		if (isset($data['diploma'])) {
			$diploma = $data['diploma'];
			unset($data['diploma']);
		}

		if (isset($data['training_places'])) {
			$training_places = $data['training_places'];
			unset($data['training_places']);
		}

		if (isset($data['specialized'])) {
			$specialized = $data['specialized'];
			unset($data['specialized']);
		}

		if (isset($data['training_form'])) {
			$training_form = $data['training_form'];
			unset($data['training_form']);
		}

		if (isset($data['relationship'])) {
			$relationship = $data['relationship'];
			unset($data['relationship']);
		}

		if (isset($data['name'])) {
			$name = $data['name'];
			unset($data['name']);
		}

		if (isset($data['fi_birthday'])) {
			$fi_birthday = $data['fi_birthday'];
			unset($data['fi_birthday']);
		}

		if (isset($data['job'])) {
			$job = $data['job'];
			unset($data['job']);
		}

		if (isset($data['address'])) {
			$address = $data['address'];
			unset($data['address']);
		}

		if (isset($data['phone'])) {
			$phone = $data['phone'];
			unset($data['phone']);
		}
		if (isset($data['position'])) {
			$position_id = $data['position'];
			unset($data['position']);
		}
		if (isset($data['year_experience'])) {
			$data['year_experience'] = $data['year_experience'];
			unset($data['year_experience']);
		}

		if (isset($data['recruitment_channel'])) {
			$data['recruitment_channel'] = $data['recruitment_channel'];
			unset($data['recruitment_channel']);
		}

		if (isset($data['key'])) {
			unset($data['key']);
		}

		if (isset($data['key'])) {
			unset($data['key']);
		}
		if (isset($data['zip'])) {
			unset($data['zip']);
		}

		if (isset($data['position_id'])) {
			$data['position_id'] = $data['position_id'];
			unset($data['position_id']);
		}		

		$this->db->insert(db_prefix() . 'rec_candidate', $data);
		$insert_id = $this->db->insert_id();

		if ($insert_id) {

			if (isset($position_id)) {

				$this->db->insert(db_prefix() . 'cd_work_experience', [
					'candidate' => $insert_id,
					'from_date' => to_sql_date($from_date),
					'to_date' => to_sql_date($to_date),
					'company' => $company,
					'position' => $position_id,
					'contact_person' => $contact_person,
					'salary' => $salary,
					'reason_quitwork' => $reason_quitwork,
					'job_description' => $job_description,
				]);

			}

			if (isset($diploma)) {

				$this->db->insert(db_prefix() . 'cd_literacy', [

					'candidate' => $insert_id,
					'literacy_from_date' => isset($literacy_from_date) ? to_sql_date($literacy_from_date) : '',
					'literacy_to_date' => isset($literacy_to_date) == 'true' ? to_sql_date($literacy_to_date) : '',
					'diploma' => isset($diploma) ? $diploma : '',
					'training_places' => isset($training_places) ? $training_places : '',
					'specialized' => isset($specialized) ? $specialized : '',
					'training_form' => isset($training_form) ? $training_form : '',
				]);
			}

			if (isset($relationship)) {

				$this->db->insert(db_prefix() . 'cd_family_infor', [
					'candidate' => $insert_id,
					'relationship' => isset($training_form) ? $cd_family_infor : '',
					'name' => isset($name) ? $name : '',
					'fi_birthday' => isset($fi_birthday) ? to_sql_date($fi_birthday) : '',
					'job' => isset($job) ? $job : '',
					'address' => isset($address) ? $address : '',
					'phone' => isset($phone) ? $phone : '',
				]);
			}

			/*send notifi to personal related*/

			if ($rec_campaign_form_web->notify_lead_imported == 1) {

				$additional_data = '';
				$mes = 'notify_new_candidate';
				$link = 'recruitment/candidate/' . $insert_id;

				if ($rec_campaign_form_web->notify_type == 'assigned') {
					$notified = add_notification([
						'description' => $mes,
						'touserid' => $rec_campaign_form_web->responsible,
						'link' => $link,
						'additional_data' => serialize([
							$additional_data,
						]),
					]);
					if ($notified) {
						pusher_trigger_notification([$rec_campaign_form_web->responsible]);
					}

				} elseif ($rec_campaign_form_web->notify_type == 'roles') {

					$str_roles = $rec_campaign_form_web->notify_ids_roles;
					if (strlen($str_roles) > 0) {

						$sql_role = 'role IN (' . $str_roles . ')';
						$this->db->where($sql_role);
						$arr_staff = $this->db->get(db_prefix() . 'staff')->result_array();

						if (count($arr_staff) > 0) {
							foreach ($arr_staff as $staff_value) {

								$notified = add_notification([
									'description' => $mes,
									'touserid' => $staff_value['staffid'],
									'link' => $link,
									'additional_data' => serialize([
										$additional_data,
									]),
								]);

								if ($notified) {
									pusher_trigger_notification([$staff_value['staffid']]);
								}

							}
						}

					}

				} elseif ($rec_campaign_form_web->notify_type == 'specific_staff') {
					$str_staff = $rec_campaign_form_web->notify_ids_staff;
					if (strlen($str_staff) > 0) {
						$arr_staff = explode(",", $str_staff);
						foreach ($arr_staff as $staff_value) {

							$notified = add_notification([
								'description' => $mes,
								'touserid' => $staff_value,
								'link' => $link,
								'additional_data' => serialize([
									$additional_data,
								]),
							]);

							if ($notified) {
								pusher_trigger_notification([$staff_value]);
							}

						}

					}

				}
			}

			return $insert_id;
		}

	}

	/**
	 * update recruitment channel
	 * @param  object $data
	 * @param  int $id  
	 * @return bool      
	 */
	public function update_recruitment_channel($data, $id) {
		if (isset($data['r_form_name'])) {
			$r_form_name = $data['r_form_name'];
		}

		$data['form_data'] = preg_replace('/=\\\\/m', "=''", $data['form_data']);
		if (isset($data['notify_lead_imported'])) {
			$data['notify_lead_imported'] = 1;
		} else {
			$data['notify_lead_imported'] = 0;
		}

		$data = $this->convert_data_campaign($data);
		$data['success_submit_msg'] = nl2br($data['success_submit_msg']);
		$data['form_key'] = app_generate_hash();

		if (isset($data['notify_ids_staff']) && $data['notify_ids_staff'] != null) {
			$data['notify_ids_staff'] = implode(',', $data['notify_ids_staff']);

		}

		if (isset($data['notify_ids_roles']) && $data['notify_ids_roles'] != null) {
			$data['notify_ids_roles'] = implode(',', $data['notify_ids_roles']);

		}

		$data['r_form_name'] = $r_form_name;
		$this->db->where('id', $id);
		$this->db->update(db_prefix() . 'rec_campaign_form_web', $data);

		if ($this->db->affected_rows() > 0) {
			return true;
		}
		return false;
	}

}