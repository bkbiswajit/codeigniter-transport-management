<?php
//painel
$permissoes['painel'][] = array('painel', 'Acessar Painél');
//clientes
$permissoes['clientes'][] = array('clientes', 'Clientes', 'Acessar Linguas');
$permissoes['clientes'][] = array('clientes.adicionar', 'Adicionar cliente');
$permissoes['clientes'][] = array('clientes.editar', 'Editar cliente');
$permissoes['clientes'][] = array('clientes.excluir', 'Excluir cliente');
//despesas
$permissoes['despesas'][] = array('despesas', 'Despesas', 'Acessar despesas');
$permissoes['despesas'][] = array('despesas.adicionar', 'Adicionar despesa');
$permissoes['despesas'][] = array('despesas.editar', 'Editar despesa');
$permissoes['despesas'][] = array('despesas.excluir', 'Excluir despesa');
//producao
$permissoes['producao'][] = array('producao', 'producao', 'Acessar produção');
$permissoes['producao'][] = array('producao.adicionar', 'Adicionar produção');
$permissoes['producao'][] = array('producao.editar', 'Editar produção');
$permissoes['producao'][] = array('producao.excluir', 'Excluir produção');
//relatorios
$permissoes['relatorios'][] = array('relatorios', 'relatorios', 'Acessar relatórios');



//PERMISSOES DO SISTEMA
//conta
$permissoes['conta'][] = array('conta', 'Acessar Conta');
//usuarios
$permissoes['usuarios'][] = array('usuarios', 'Acessar Usuários');
$permissoes['usuarios'][] = array('usuarios.adicionar', 'Adicionar usuário');
$permissoes['usuarios'][] = array('usuarios.editar', 'Editar usuário');
$permissoes['usuarios'][] = array('usuarios.excluir', 'Excluir usuário');
$permissoes['usuarios'][] = array('usuarios.rastrear', 'Rastrear usuário');
//grupos
$permissoes['grupos'][] = array('grupos', 'Grupos');
$permissoes['grupos'][] = array('grupos.adicionar', 'Adicionar grupo');
$permissoes['grupos'][] = array('grupos.editar', 'Editar grupo');
$permissoes['grupos'][] = array('grupos.excluir', 'Excluir grupo');
//permissoes
$permissoes['sistema'][] = array('sistema', 'Sistema');
$permissoes['sistema'][] = array('sistema.geral', 'Geral');
$permissoes['sistema'][] = array('sistema.permissoes', 'Permissões');
//criar array para permissoes
$config['permissoes'] = $permissoes;
?>