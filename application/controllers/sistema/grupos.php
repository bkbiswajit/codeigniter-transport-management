<?php
class Grupos extends Controller {


	var $tpl;
	

	function Grupos(){
		parent::Controller();
		$this->load->model('sistema_model');
		$this->load->helper('text');
		$this->tpl = $this->config->item('template');
		$this->output->enable_profiler($this->config->item('profiler'));
		if($this->auth->logged_in() == TRUE AND $this->config->item('tracker') == TRUE){ $this->rastreador_model->add_visit(); }
	}
	
	
	
	
	function index(){
		//$this->auth->check('grupos');
		
		$tpl['subnav'] = $this->sistema_model->subnav();
		
		$links[] = array('sistema/grupos/adicionar', 'Adicionar novo grupo');
		$tpl['links'] = $this->load->view('parts/linkbar', $links, TRUE);
		
		// Get list of usuarios
		$body['grupos'] = $this->sistema_model->get_group();
		if ($body['grupos'] == FALSE) {
			$tpl['body'] = $this->msg->err($this->sistema_model->lasterr);
		} else {
			$tpl['body'] = $this->load->view('sistema/grupos/grupos.index.php', $body, TRUE);
		}
		
		$tpl['title'] = 'grupos';
		$tpl['pagetitle'] = 'Gerenciar Grupos';
		
		$this->load->view($this->tpl, $tpl);
	}
	
	
	
	
	function adicionar(){
		//$this->auth->check('grupos.adicionar');
		$body['group'] = NULL;
		$body['grupo_id'] = NULL;
		$tpl['subnav'] = $this->sistema_model->subnav();
		$tpl['title'] = 'Adicionar group';
		$tpl['pagetitle'] = 'Adicionar a new group';
		$tpl['body'] = $this->load->view('sistema/grupos/grupos.addedit.php', $body, TRUE);
		$this->load->view($this->tpl, $tpl);
	}
	
	
	
	
	function editar($grupo_id){
		//$this->auth->check('grupos.editar');
		$body['group'] = $this->sistema_model->get_group($grupo_id);
		$body['grupo_id'] = $grupo_id;
		
		$tpl['subnav'] = $this->sistema_model->subnav();
		$tpl['title'] = 'Editar group';
		
		if($body['group'] != FALSE){
			$tpl['pagetitle'] = 'Editar ' . $body['group']->nome . ' group';
			$tpl['body'] = $this->load->view('sistema/grupos/grupos.addedit.php', $body, TRUE);
		} else {
			$tpl['pagetitle'] = 'Error getting group';
			$tpl['body'] = $this->msg->err('Could not load the specified group. Please check the ID and try again.');
		}
		
		$this->load->view($this->tpl, $tpl);
	}
	
	
	
	
	function salvar(){
		
		
		$grupo_id = $this->input->post('grupo_id');
		
		$this->form_validation->set_rules('grupo_id', 'Group ID');
		$this->form_validation->set_rules('nome', 'Nome', 'required|max_length[20]|trim');
		$this->form_validation->set_rules('description', 'Description', 'max_length[255]|trim');
		$this->form_validation->set_error_delimiters('<li>', '</li>');

		if($this->form_validation->run() == FALSE){
			
			// Validation failed - load required action depending on the state of usuario_id
			($grupo_id == NULL) ? $this->adicionar() : $this->editar($grupo_id);
			
		} else {
		
			// Validation OK
			$data['nome'] = $this->input->post('nome');
			$data['ativo'] = ($this->input->post('ativo') == '1') ? 1 : 0;
			if($grupo_id == NULL){
			
				$adicionar = $this->sistema_model->add_group($data);
				
				if($adicionar == TRUE){
					$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_GROUP_ADD_OK'), $data['nome']));
					$this->msg->adicionar('note', 'You can now configure the permissoes for this group by '.anchor('sistema/permissoes/paraogrupo/'.$adicionar, 'clicking here.'));
				} else {
					$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_GROUP_ADD_FAIL', $this->sistema_model->lasterr)));
				}
			
			} else {
			
				// Updating existing group
				$editar = $this->sistema_model->edit_group($grupo_id, $data);
				if($editar == TRUE){
					$this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_GROUP_EDIT_OK'), $data['nome']));
				} else {
					$this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_GROUP_EDIT_FAIL', $this->sistema_model->lasterr)));
				}
				
			}
			
			// All done, redirect!
			redirect('sistema/grupos');
			
		}
		
	}
	
	
	
	
	function excluir($grupo_id = NULL){
		//$this->auth->check('grupos.excluir');
		// Check if a form has been submitted; if not - show it to ask user confirmation
		if($this->input->post('id')){
		
			// Form has been submitted (so the POST value exists)
			// Call model function to excluir user
			$excluir = $this->sistema_model->delete_group($this->input->post('id'));
			if($excluir == FALSE){
				$this->msg->adicionar('err', $this->sistema_model->lasterr, 'Ocorreu um erro');
			} else {
				$this->msg->adicionar('info', 'The group has been deleted.');
			}
			// Redirect
			redirect('sistema/grupos');
			
		} else {
		
			if( ($this->session->userdata('grupo_id')) && ($grupo_id == $this->session->userdata('grupo_id')) ){
				$this->msg->adicionar(
					'warn',
					base64_decode('WW91IGNhbm5vdCBkZWxldGUgdGhlIGdyb3VwIHRoYXQgeW91IGFyZSBhIG1lbWJlciBvZiwgdGhlIHVuaXZlcnNlIGlzIGxpa2VseSB0byBpbXBsb2RlLg=='),
					base64_decode('RXJyb3IgSUQjMTBU')
				);
				redirect('sistema/grupos');
			}
			
			if($grupo_id == NULL){
				
				$tpl['title'] = 'Excluir group';
				$tpl['pagetitle'] = $tpl['title'];
				$tpl['body'] = $this->msg->err('Cannot find the group or no group ID given.');
				
			}else {
				
				// Get user info so we can present the confirmation page with a dsplaynome/usernome
				$group = $this->sistema_model->get_group($grupo_id);
				
				if($group == FALSE){
				
					$tpl['title'] = 'Excluir group';
					$tpl['pagetitle'] = $tpl['title'];
					$tpl['body'] = $this->msg->err('Could not find that group or no group ID given.');
					
				} else {
					
					// Initialise page
					$body['action'] = 'sistema/grupos/excluir';
					$body['id'] = $grupo_id;
					$body['cancel'] = 'sistema/grupos';
					$body['text'] = 'If you excluir this group, all of its usuarios (if any) will be re-assigned to the Guests group.';
					$tpl['title'] = 'Excluir group';
					$tpl['pagetitle'] = 'Excluir ' . $group->nome;
					$tpl['body'] = $this->load->view('parts/deleteconfirm', $body, TRUE);
					
				}
			}
			$tpl['subnav'] = $this->sistema_model->subnav();
			$this->load->view($this->tpl, $tpl);
		}
		
	}
	
}
/* End of file controllers/sistema/grupos.php */