<?php class Permissoes extends Controller
{
	var $tpl;
	function Permissoes()
	{
		parent::Controller();
		$this->load->model('sistema_model');
		$this->tpl = $this->config->item('template');
		$this->output->enable_profiler($this->config->item('profiler'));
		if ($this->auth->logged_in() == TRUE AND $this->config->item('tracker') == TRUE)
		{
			$this->rastreador_model->add_visit();
		}
	}
	function index($tab = NULL)
	{
		$body['tab'] = ($tab == NULL) ? $this->session->flashdata('tab') : $tab;
		$body['grupos'] = $this->sistema_model->get_groups_dropdown();
		$body['permissoes'] = $this->config->item('permissoes');
		$body['group_permissions'] = $this->sistema_model->get_group_permissions();
		$tpl['title'] = 'Permissoes';
		$tpl['pagetitle'] = 'Gerenciar Permissões';
		$tpl['body'] = $this->load->view('sistema/permissoes/permissoes.index.php', $body, TRUE);
		$this->load->view($this->tpl, $tpl);
	}
	function paraogrupo($grupo_id)
	{
		$this->index($grupo_id);
	}
	function salvar()
	{
		$this->form_validation->set_rules('grupo_id', 'Group ID');
		$this->form_validation->set_rules('permissoes[]', 'Permissoes');
		$this->form_validation->set_rules('daysahead', 'days ahead');
		$this->form_validation->set_error_delimiters('<li>', '</li>');
		if ($this->form_validation->run() == FALSE)
		{
			// Validation failed - load required action depending on the state of usuario_id
			$this->index($this->input->post('grupo_id'));
		}
		else
		{
			// Validation OK
			$grupo_id = $this->input->post('grupo_id');
			$group_permissions = $this->input->post("permissions_{$grupo_id}");
			$salvar = $this->sistema_model->save_group_permissions($grupo_id, $group_permissions);
			if ($salvar == FALSE)
			{
				$this->msg->adicionar('err', $this->sistema_model->lasterr, 'erro ao salvar');
			}
			else
			{
				$this->msg->adicionar('info', 'salvo com sucesso');
			}
			$this->session->set_flashdata('tab', 'g' . $grupo_id);
			// Unset existing group permissoes array in session - it will get re-filled on next page load
			if ($grupo_id == $this->session->userdata('grupo_id'))
			{
				$this->session->set_userdata('group_permissions', NULL);
			}
			redirect('sistema/permissoes');
		}
	}
	/**
	 * Show effective permissoes on a user
	 *
	 * @param	int		usuario_id		ID of user to find info on
	 * @param	bool	ajax		Whether the request is via ajax or a normal page
	 */
	function effective($usuario_id = NULL)
	{
		$ajax = (array_key_exists('HTTP_X_REQUESTED_WITH', $_SERVER));
		$tpl['title'] = 'Effective user permissoes';
		if ($usuario_id == NULL)
		{
			$tpl['pagetitle'] = $tpl['title'];
			$tpl['body'] = $this->msg->err($this->lang->line('PERMISSIONS_EFFECTIVE_USER_FAIL'));
		}
		else
		{
			$user = $this->sistema_model->get_user($usuario_id);
			$body['user_permissions'] = $this->sistema_model->get_user_permissions($usuario_id);
			$tpl['pagetitle'] = 'Effective permissoes for ' . $user->nomecompleto;
			$tpl['body'] = $this->load->view('sistema/permissoes/permissoes.effective.php', $body, TRUE);
		}
		if ($ajax == FALSE)
		{
			$this->load->view($this->tpl, $tpl);
		}
		else
		{
			$this->output->enable_profiler(FALSE);
			$this->load->view('sistema/permissoes/permissoes.effective.php', $body);
		}
	}
}