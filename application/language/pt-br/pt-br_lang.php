<?php

$lang['AUTH_FAIL_USERPASS'] 				= 'USUÁRIO E/OU SENHA INCORRETOS';
$lang['AUTH_OK'] 							= 'PARABÉNS! AGORA VOCÊ ESTÁ CONECTADO';

$lang['AUTH_LOGOUT_OK'] 					= 'You have been successfully logged out';
$lang['AUTH_LOGOUT_FAIL'] 					= 'Your sair request was unsuccessful. Please close all browser windows to ensure your session is closed properly';

$lang['AUTH_CHECK_NO_PID'] 					= 'Could not locate privilege ID for requested action (%s)';
$lang['AUTH_MUST_LOGIN'] 					= 'Para ter acesso às ferramentas do sistema, você precisa estar logado.';
$lang['AUTH_NO_PRIVS'] 						= 'You do not have the correct privileges to access this section';

$lang['CONF_MAIN_SAVE_OK'] 					= 'A configurações foram salvas com sucesso';
$lang['CONF_AUTH_SAVE_OK'] 					= 'Authentication configurações foram salvas com sucesso';
$lang['CONF_AUTH_SAVE_FAIL'] 				= 'An error occured while saving the authentication configurações';

$lang['SECURITY_USER_ADD_OK_ENABLED'] 		= 'O usuário foi criado com sucesso';
$lang['SECURITY_USER_ADD_OK_DISABLED'] 		= 'The user foi criado com sucesso, but they will not be able to log in until their conta is ativo';
$lang['SECURITY_USER_ADD_FAIL'] 			= 'An error occured and the user could not be added (%s)';

$lang['SECURITY_USER_EDIT_OK_ENABLED'] 		= 'Os dados do usuário foram salvos com sucesso';
$lang['SECURITY_USER_EDIT_OK_DISABLED']		= 'The user details foram salvas com sucesso, but they will not be able to log in until you enable their conta';
$lang['SECURITY_USER_ADD_FAIL'] 			= 'An error occured and the user details could not be saved (%s)';

$lang['SECURITY_GROUP_ADD_OK']				= '%s  ADICIONADO COM SUCESSO';
$lang['SECURITY_LINGUA_ADD_OK']				= '%s  ADICIONADO COM SUCESSO';
$lang['SECURITY_CURSO_ADD_OK']				= '%s  ADICIONADO COM SUCESSO';
$lang['SECURITY_HORARIO_ADD_OK']			= '%s  ADICIONADO COM SUCESSO';
$lang['SECURITY_TURMA_ADD_OK'] 				= '%s  ADICIONADO COM SUCESSO';
$lang['SECURITY_GROUP_ADD_FAIL'] 			= 'ERRO! NÃO PODE SER ADICIONADO (%s)';

$lang['SECURITY_GROUP_EDIT_OK'] 			= '%s ALTERADO COM SUCESSO';
$lang['SECURITY_LINGUA_EDIT_OK'] 			= '%s ALTERADA COM SUCESSO';
$lang['SECURITY_CURSO_EDIT_OK'] 			= '%s ALTERADO COM SUCESSO';
$lang['SECURITY_HORARIO_EDIT_OK'] 			= '%s ALTERADO COM SUCESSO';
$lang['SECURITY_TURMA_EDIT_OK'] 			= '%s ALTERADO COM SUCESSO';
$lang['SECURITY_GROUP_EDIT_FAIL']			= 'ERRO! NÃO PODE SER SALVO (%s)';

$lang['DEPARTMENTS_ADD_OK'] 				= 'The %s department foi ADICIONADO com sucesso';
$lang['DEPARTMENTS_ADD_FAIL']				= 'An error occured and the department could not be added (%s)';
$lang['DEPARTMENTS_EDIT_OK']				= 'The %s department details foram salvas com sucesso';
$lang['DEPARTMENTS_EDIT_FAIL']				= 'An error occured and the department details could not be saved (%s)';

$lang['PERIODS_ADD_OK'] = 'The period foi adicionado com sucesso';
$lang['PERIODS_ADD_FAIL'] = 'An error occured and the period could not be added';
$lang['PERIODS_EDIT_OK'] = 'The period details foram salvas com sucesso';
$lang['PERIODS_EDIT_FAIL'] = 'An error occured and the period details could not be saved';

$lang['WEEKS_ADD_OK'] = '%s foi adicionado com sucesso';
$lang['WEEKS_ADD_FAIL'] = 'An error occured and the week could not be added (%s)';
$lang['WEEKS_EDIT_OK'] = 'The %s details foram salvas com sucesso';
$lang['WEEKS_EDIT_FAIL'] = 'An error occured and the week details could not be saved (%s)';

$lang['YEARS_ADD_OK'] = 'The academic year %s foi adicionado com sucesso';
$lang['YEARS_ADD_FAIL'] = 'An error occured and the academic year (%s) could not be added';
$lang['YEARS_EDIT_OK'] = 'The %s academic year details foram salvas com sucesso';
$lang['YEARS_EDIT_FAIL'] = 'An error occured and the academic year (%s) details could not be saved';
$lang['YEARS_ACTIVATE_OK'] = 'The academic year has been made active';
$lang['YEARS_ACTIVATE_FAIL'] = 'An error occured and the academic year could not be made active';
$lang['YEARS_ACTIVATE_NOID'] = 'You must supply a year ID to make it active';

$lang['ROOMS_ADD_OK'] = 'The room foi adicionado com sucesso';
$lang['ROOMS_ADD_FAIL'] = 'An error occured and the room could not be added (%s)';
$lang['ROOMS_EDIT_OK'] = 'The room details foram salvas com sucesso';
$lang['ROOMS_EDIT_FAIL'] = 'An error occured and the room details could not be saved (%s)';

$lang['ROOMS_PERMS_ADD_OK'] = 'The room permission entry foi adicionado com sucesso';
$lang['ROOMS_PERMS_ADD_FAIL'] = 'An error occured and the room permission entry could not be added';

$lang['ROOMS_ATTRVALS_SAVE_OK'] = 'The room attributes foram salvas com sucesso';
$lang['ROOMS_ATTRVALS_SAVE_FAIL'] = 'An error occured and the room attributes could not be saves (%s)';

$lang['FIELDS_ADD_OK'] = 'O campo foi adicionado com sucesso';
$lang['FIELDS_ADD_FAIL'] = 'An error occured and the field could not be added (%s)';
$lang['FIELDS_EDIT_OK'] = 'O campo details foram salvas com sucesso';
$lang['FIELDS_EDIT_FAIL'] = 'An error occured and the field details could not be saved (%s)';

// Misc
$lang['PERMISSIONS_EFFECTIVE_USER_FAIL'] = 'Could not find the given user, or no user ID supplied';
$lang['FORM_ERRORS'] = 'Verifique os itens inválidos e tente novamente';
$lang['ADD_ANOTHER'] = 'e adicione outro';

// Words
$lang['W_PERIOD'] = 'Period';
$lang['W_PERIODS'] = 'Periods';
$lang['W_DEPARTMENT'] = 'Department';
$lang['W_DEPARTMENTS'] = 'Departments';
$lang['W_WEEK'] = 'Week';
$lang['W_WEEKS'] = 'Weeks';
$lang['W_YEAR'] = 'Year';
$lang['W_YEARS'] = 'Years';
$lang['W_FIELD'] = 'Field';

// Actions
$lang['ACTION_ADD'] = 'Adicionar';
$lang['ACTION_SAVE'] = 'Salvar';
$lang['ACTION_DELETE'] = 'Excluir';
$lang['ACTION_CANCEL'] = 'Cancelar';

$lang['CONTA_PREENCHER_DADOS'] = 'Você precisa preencher todos os dados da sua conta no sistema';
$lang['ATUALIZAR_LATTES'] = 'Você precisa atualizar seu currículo lattes. Ele está a mais de 30 dias sem ser atualizado';
?>