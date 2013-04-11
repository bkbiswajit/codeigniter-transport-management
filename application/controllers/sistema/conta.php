<?php
class Conta extends Controller
{

    var $tpl;

    function Conta()
    {
        parent::Controller();
        $this->tpl = $this->config->item('template');
        $this->output->enable_profiler($this->config->item('profiler'));
		if($this->auth->logged_in() == TRUE AND $this->config->item('tracker') == TRUE){ $this->rastreador_model->add_visit(); }
    }

    function index()
    {
        $usuario_id = $this->session->userdata('usuario_id');
        $body['usuario_id'] = $usuario_id;
        $body['usuario'] = $this->sistema_model->get_user($usuario_id);

        $tpl['title'] = 'Perfil';
        $body['pagetitle'] = 'editar usuario '.$this->session->userdata('nome_ou_cpf') . '';

        $tpl['body'] = $this->load->view('sistema/conta/perfil.php', $body, true);
        $this->load->view($this->tpl, $tpl);
    }

    function acessar()
    {
        $tpl['title'] = 'Entrar';
        $tpl['pagetitle'] = $tpl['title'];
        if ($this->auth->logged_in())
        {
            $tpl['body'] = 'Você já está conectado.';
			$this->load->view($this->tpl, $tpl);
        } else
        {
            $this->load->view('sistema/conta/acessar');
        }
       
    }
	
    function acessando()
    {
        //$this->form_validation->set_rules('cpf', 'CPF', 'required|exact_length[11]');
        $this->form_validation->set_rules('cpf', 'CPF', 'required');
        $this->form_validation->set_rules('password', 'Senha', 'required|max_length[104]');
        $this->form_validation->set_error_delimiters('<li>', '</li>');
		
        if ($this->form_validation->run() == false)
        {
            return $this->acessar();
        } else
        {
            $cpf = $this->input->post('cpf');
            $password = $this->input->post('password');
            $remember = ($this->input->post('remember') == '1') ? true : false;

            $acessar = $this->auth->acessar($cpf, $password, $remember);

            if ($acessar == true)
            {
                //$this->session->set_flashdata('flash', $this->msg->yes($this->lang->line('AUTH_OK')), 'OK');
                $uri = $this->session->userdata('uri');
                redirect(($uri != null) ? $uri : 'painel');

            } else
            {
				$this->session->set_flashdata('flash', $this->msg->err($this->auth->lasterr, 'falha na autenticação'));
				redirect("sistema/conta/acessar");
            }
        }
    }
	
	function sair()
    {
        $sair = $this->auth->sair();
        if ($sair == true)
        {
            $this->session->set_flashdata('flash', $this->msg->info($this->lang->line('AUTH_LOGOUT_OK')));
            redirect("");
        } else
        {
            $this->session->set_flashdata('flash', $this->msg->err($this->lang->line('AUTH_LOGOUT_FAIL')));
            redirect("sistema/conta/acessar");
        }
    }

    function editar()
    {
        $usuario_id = $this->session->userdata('usuario_id');
        $body['usuario_id'] = $usuario_id;
        $body['usuario'] = $this->sistema_model->get_user($usuario_id);

        $tpl['title'] = 'Perfil';
        $body['pagetitle'] = 'editar usuario '.$this->session->userdata('nome_ou_cpf') . '';

        $tpl['body'] = $this->load->view('sistema/conta/perfil.php', $body, true);
        $this->load->view($this->tpl, $tpl);
    }
	
    function editar_salvar()
    {
        $usuario_id = $this->session->userdata('usuario_id');
        $this->form_validation->set_rules('email', 'Endereço de E-mail', 'required|max_length[256]|valid_email|trim');
        $this->form_validation->set_rules('nomecompleto', 'Nome Completo', 'required|max_length[255]|trim');
        $this->form_validation->set_error_delimiters('', '');

        if ($this->form_validation->run() == false)
        {
            $this->editar();
        } else
        {
            $data['nome'] = $this->input->post('nomecompleto');
            $data['email'] = $this->input->post('email');
            if ($this->input->post('password1'))
            {
                $data['password'] = sha1($this->input->post('password1'));
            }
			$editar = $this->sistema_model->edit_user($usuario_id, $data);
            if ($editar == true)
            {
                $this->msg->adicionar('info', sprintf($this->lang->line('SECURITY_USER_EDIT_OK_ENABLED', $this->sistema_model->lasterr)));
            } else
            {
                $this->msg->adicionar('err', sprintf($this->lang->line('SECURITY_USER_EDIT_FAIL', $this->sistema_model->lasterr)));
            }
			redirect('sistema/conta');
        }
    }

}

/* End of file app/controllers/conta.php */