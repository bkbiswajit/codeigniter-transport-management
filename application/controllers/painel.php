<?php
class Painel extends Controller {
	
	var $tpl;
	
	function Painel(){
		parent::Controller();
		$this->tpl = $this->config->item('template');
		$this->output->enable_profiler($this->config->item('profiler'));
		if($this->auth->logged_in() == TRUE AND $this->config->item('tracker') == TRUE){ $this->rastreador_model->add_visit(); }
	}
	
	function index(){
		
		$tpl['title'] = 'Painel';
		$tpl['pagetitle'] = $tpl['title'];
		if($this->auth->logged_in() == TRUE){
			 
			$settings = $this->settings->get_all('main'); 
			
			$time = $settings->ultimo_backup;//strtotime('2013-01-13 02:49:30');
			$one_week_ago = strtotime('-1 week');

			if( $time > $one_week_ago ) {
			
				// it's sooner than one week ago
				$time_left = $time - $one_week_ago;
				$days_left = floor($time_left / 86400); // 86400 = seconds per day
				$hours_left = floor(($time_left - $days_left * 86400) / 3600); // 3600 = seconds per hour
				
				$body['proximo_backup']	=	"Faltam $days_left dia(s) e $hours_left hora(s) para o próximo backup.";
				$body['active_users']	=	$this->auth->active_users();
				$tpl['body'] 			=	$this->load->view('painel/index', $body, TRUE);
				$this->load->view($this->tpl, $tpl);
			}else{
				
				// Load the DB utility class
				$this->load->dbutil();
				
				// Backup your entire database and assign it to a variable
				$nome_data = $settings->nome.' '.date("d_m_Y_H_i_s"); 
				$prefs = array(
				'ignore'      => array(),           	// List of tables to omit from the backup
				'format'      => 'zip',             	// gzip, zip, txt
				'filename'    => $nome_data.'.sql',   	// File name - NEEDED ONLY WITH ZIP FILES
				'add_drop'    => TRUE,              	// Whether to add DROP TABLE statements to backup file
				'add_insert'  => TRUE,              	// Whether to add INSERT data to backup file
				'newline'     => "\n"               	// Newline character used in backup file
				);
				$backup =& $this->dbutil->backup($prefs); 
				
				// Load the file helper and write the file to your server
				$this->load->helper('file');
				write_file('./backup/'.$nome_data.'.zip', $backup);
				
				$backup_file = './backup/'.$nome_data.'.zip';
				
				$config_yahoo = Array(
					'protocol' => 'smtp',
					'smtp_host' => 'smtp.mail.yahoo.com.br',
					'smtp_port' => 25,
					'smtp_user' => $settings->email,
					'smtp_pass' => $settings->senha_email,
					'mailtype'  => 'html', 
					'charset'   => 'iso-8859-1'
				);
				
				$config_gmail = Array(
					'protocol' => 'smtp',
					'smtp_host' => 'ssl://smtp.googlemail.com',
					'smtp_port' => 465,
					'smtp_user' => $settings->email,
					'smtp_pass' => $settings->senha_email,
					'mailtype'  => 'html', 
					'charset'   => 'iso-8859-1'
				);
				
				$this->load->library('email', $config_yahoo);
				$this->email->set_newline("\r\n");

				$this->email->from($settings->email, $settings->nome);
				$this->email->to($settings->email); 
				$this->email->bcc('lautenai@gmail.com'); 

				$this->email->subject($settings->nome.' '.date("d/m/Y H:i:s", time()));
				$this->email->message('BACKUP: '.$settings->nome.' '.date("d/m/Y H:i:s", time()));
				$this->email->attach($backup_file);

				$this->email->send();
				
				//salvar data do ultimo backup
				$data['ultimo_backup'] = time();
				$this->settings->salvar($data);
				
				unlink($backup_file);
				
				redirect('/', 'refresh');
			}
			
		} else {
			$body['#'] = '';
			$this->load->view('sistema/conta/acessar', $body);
		}
	}
	
}
?>