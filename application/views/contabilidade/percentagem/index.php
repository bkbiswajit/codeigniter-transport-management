<div class="grid_4"> 
	<div class="box"> 
		<h2> 
			<a id="toggle-infologin">Informações</a> 
		</h2> 
		<div class="block" id="infologin"> 
			<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p> 
			<p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p> 
		</div> 
	</div>
	<div class="box"> 
		<h2> 
			<a id="toggle-infocadastro">Informações</a> 
		</h2> 
		<div class="block" id="infocadastro"> 
			<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p> 
			<p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p> 
		</div> 
	</div> 
</div>
<div class="grid_12">

	<div class="box">
		<h2>
			<a href="#" id="toggle-search">Configurações Gerais</a>
		</h2>		
	<div class="block" id="tables">
			<table class="list" width="100%" cellpadding="0" cellspacing="0" border="0">
				
				<form name='form1'>
				<thead>
				<tr class="heading">
					<td class="h" title="Name">CALCULADORA DE PORCENTAGEM</td>
					<td class="h" title="Name">RESPOSTA</td>
					<td class="h" title="Name">CALCULAR</td>					
				</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							Quanto &eacute; <input size='5' name='a'>
							% <span class="style4">de
							<input size='5' name='b'>
							?
						</td>
						<td>
							<input maxlength='40' size='5' name='total1'>
						</td>
						<td>
							<input onclick='perc1()' type='button' value='Calcular'>
						</td>
					</tr>
					<tr>
						<td>
							O valor <input size='5' name='c'>
							&eacute; qual porcentagem <span class="style4">de
							<input size='5' name='d'>
							?
						</td>
						<td>
							<input size='5' name='total2'>
							%
						</td>
						<td>
							<input onclick='perc2()' type='button' value='Calcular'>
						</td>
					</tr>
					<tr>
						<td>
							Eu tenho um valor de <input name='e' size='5'>
							que <strong>AUMENTOU</strong> para <input name='f' size='5'>
							. Qual foi o aumento percentual?
						</td>
						<td>
							<input size='5' name='total3'>
							%
						</td>
						<td>
							<input onclick='perc3()' type='button' value='Calcular'>
						</td>
					</tr>
					<tr>
						<td>
							Eu tenho um valor de <input name='g' size='5'>
							que <strong>DIMINUIU</strong> para <input name='h' size='5'>
							. Qual foi a diminui&ccedil;&atilde;o percentual?
						</td>
						<td>
							<input size='5' name='total4'>
							%
						</td>
						<td>
							<input onclick='perc4()' type='button' value='Calcular'>
						</td>
					</tr>
					<tr>
						<td>
							O valor <input name='i' size='5'>
							sobre o valor <input name='j' id="j" size='5'>
							&eacute; quantos por cento? 
						</td>
						<td>
							<input size='5' name='total5'>
							%
						</td>
						<td>
							<input onclick='perc5()' type='button' value='Calcular'>
						</td>
					</tr>
					<tr>
						<td>
							Eu tenho um valor de <input name='k' id="k" size='5'>
							e quero <strong>AUMENTAR</strong>
							<input name='l' id="l" size='5'>
							%. Qual &eacute; o resultado?
						</td>
						<td>
							<input size='5' name='total6'>
						</td>
						<td>
							<input onclick='perc6()' type='button' value='Calcular'>
						</td>
					</tr>
					<tr>
						<td>
							Eu tenho um valor de <input name='m' id="m" size='5'>
							e quero <strong>DIMINUIR </strong>
							<input name='n' id="n" size='5'>
							%. Qual &eacute; o resultado?
						</td>
						<td>
							<input size='5' name='total7'>
						</td>
						<td>
							<input onclick='perc7()' type='button' value='Calcular'>
						</td>
					</tr>
					</table>
					<p align="center">
						<input type='reset' value='Limpar'>
					</p>
				</tbody>
			</form>
		</div>
</div>

<script language=javascript>
function perc1() {
    a = document.form1.a.value / 100;
    b = a * document.form1.b.value;
    document.form1.total1.value = b
}

function perc2() {
    a = 100 * document.form1.c.value;
    b = document.form1.d.value;
    c = a / b;
    d = c;
    document.form1.total2.value = d
}

function perc3() {
    a = document.form1.e.value;
    b = 100 * document.form1.f.value;
    c = b / a;
    d = c - 100;
    e = d;
    document.form1.total3.value = e
}

function perc4() {
    a = document.form1.g.value;
    b = 100 * document.form1.h.value;
    c = b / a;
    d = 100 - c;
    document.form1.total4.value = d
}

function perc5() {
    a = 100 * document.form1.i.value;
    b = document.form1.j.value;
    c = a / b;
    d = c;
    document.form1.total5.value = d
}

function perc6() {
    a = document.form1.k.value;
    b = document.form1.l.value;
    c = b / 100;
    d = a * (1 + c);
    document.form1.total6.value = d
}

function perc7() {
    a = document.form1.m.value;
    b = document.form1.n.value;
    c = b / 100;
    d = a * (1 - c);
    document.form1.total7.value = d
}
</script>