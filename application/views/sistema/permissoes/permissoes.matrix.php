<table class="form a-t" cellpadding="0" cellspacing="0" border="0">

	<tr>
		<td width="250">
			<!-- GENERAL -->
			<?php
			unset($checks);
			$checks['options'] = $permissoes['general'];
			$checks['grupo_id'] = $grupo_id;
			$checks['category'] = 'General';
			$this->load->view('sistema/permissoes/permissoes.checks.php', $checks);
			?>
		</td>
		<td width="50">&nbsp;</td>
		<td width="350">
			<!-- BOOKINGS -->
			<?php
			unset($options);
			unset($checks);
			$options[] = array('bookings', 'View bookings page', 'View the main bookings page', TRUE);
			$options[] = array('bookings/createone', 'Create their own one-time bookings', 'Booking days ahead and quota options still apply', FALSE);
			$options[] = array('bookings/createrecur', 'Create recurring bookings', 'Bookings that occur on every timetabled week', TRUE);
			$options[] = array('bookings/deleteone/own', 'Excluir their own one-time bookings', NULL, FALSE);
			$options[] = array('bookings/deleteone/ifowner', 'Excluir room one-time bookings if room owner', NULL, TRUE);
			$options[] = array('bookings/deleterecur/ifowner', 'Excluir room recurring bookings if room owner', NULL, FALSE);
			$options[] = array('bookings/overwriteone', 'Can overwrite other one-time bookings', NULL, TRUE);
			$options[] = array('bookings/overwriterecur', 'Can overwrite other recurring bookings with one-time booking', NULL, FALSE);
			$options[] = array('bookings/overwriteone/ifowner', 'Can overwrite other one-time bookings if room owner', NULL, FALSE);
			$options[] = array('bookings/overwriterecur/ifowner', 'Can overwrite other recurring bookings if room owner', NULL, FALSE);
			$checks['options'] = $options;
			$checks['grupo_id'] = $grupo_id;
			$checks['category'] = 'Room booking';
			$this->load->view('sistema/permissoes/permissoes.checks.php', array('category' => 'Room booking', 'options' => $options));
			?>
		</td>
	</tr>
	
	<tr>
		<td>
			<!-- ROOMS -->
			<?php
			unset($options);
			$options[] = array('rooms', 'Rooms', 'Has access to the Rooms page', TRUE);
			$options[] = array('rooms/adicionar', 'Adicionar a room', NULL, FALSE);
			$options[] = array('rooms/editar', 'Editar room properties', NULL, TRUE);
			$options[] = array('rooms/excluir', 'Excluir a room', NULL, FALSE);
			$options[] = array('rooms/changephoto', 'Change photo', NULL, TRUE);
			$options[] = array('rooms/changefields', 'Change fields', NULL, TRUE);
			$options[] = array('rooms/changefieldvalues', 'Change field values', NULL, TRUE);
			$this->load->view('sistema/permissoes/permissoes.checks.php', array('category' => 'Rooms', 'options' => $options));
			?>
		</td>
		<td width="50">&nbsp;</td>
		<td>
			<!-- PERIODS -->
			<?php
			unset($options);
			$options[] = array('periods', 'Periods', NULL, TRUE);
			$options[] = array('periods/adicionar', 'Adicionar a period', NULL, FALSE);
			$options[] = array('periods/editar', 'Editar a period/change times', NULL, TRUE);
			$options[] = array('periods/excluir', 'Excluir a period', NULL, FALSE);
			$this->load->view('sistema/permissoes/permissoes.checks.php', array('category' => 'Periods', 'options' => $options));
			?>
		</td>
	</tr>
	
	<tr>
		<td>
			<!-- WEEKS -->
			<?php
			unset($options);
			$options[] = array('weeks', 'Weeks', 'Has access to the Weeks page', TRUE);
			$options[] = array('weeks/adicionar', 'Adicionar a timetable week', NULL, FALSE);
			$options[] = array('weeks/editar', 'Editar a week and set its dates', NULL, TRUE);
			$options[] = array('weeks/excluir', 'Excluir a week', NULL, FALSE);
			$options[] = array('weeks/ayears/manage', 'Manage the academic year dates', NULL, FALSE);
			$options[] = array('weeks/ayears/set', 'Set the current academic year', NULL, TRUE);
			$this->load->view('sistema/permissoes/permissoes.checks.php', array('category' => 'Timetable weeks', 'options' => $options));
			?>
		</td>
		<td width="50">&nbsp;</td>
		<td>
			<!-- HOLIDAYS -->
			<?php
			unset($options);
			$options[] = array('holidays', 'Holidays', NULL, TRUE);
			$options[] = array('holidays/adicionar', 'Adicionar a holiday', NULL, FALSE);
			$options[] = array('holidays/editar', 'Editar school holidays', NULL, TRUE);
			$options[] = array('holidays/excluir', 'Excluir a holiday', NULL, FALSE);
			$this->load->view('sistema/permissoes/permissoes.checks.php', array('category' => 'Holidays', 'options' => $options));
			?>
		</td>
	</tr>
	
	<tr>
		<td>
			<!-- DEPARTMENTS -->
			<?php
			unset($options);
			$options[] = array('departments', 'Departments', 'Has access to the Departments page', TRUE);
			$options[] = array('departments/adicionar', 'Adicionar a department', NULL, FALSE);
			$options[] = array('departments/editar', 'Editar a department', NULL, TRUE);
			$options[] = array('departments/excluir', 'Excluir a department', NULL, FALSE);
			$this->load->view('sistema/permissoes/permissoes.checks.php', array('category' => 'Departments', 'options' => $options));
			?>
		</td>
		<td width="50">&nbsp;</td>
		<td>
			<!-- REPORTS -->
			<?php
			unset($options);
			$options[] = array('reports', 'Reports', NULL, TRUE);
			$options[] = array('reports/owndepartment', 'View reports for their own deparment', NULL, FALSE);
			$options[] = array('reports/alldepartments', 'View reports on all departments', NULL, TRUE);
			$options[] = array('reports/ownroom', 'View reports for their own room', NULL, FALSE);
			$options[] = array('reports/allrooms', 'View reports on all rooms', NULL, FALSE);
			$options[] = array('reports/other', 'View other reports', NULL, TRUE);
			$this->load->view('sistema/permissoes/permissoes.checks.php', array('category' => 'Reports', 'options' => $options));
			?>
		</td>
	</tr>
	
	<tr>
		<td colspan="3">
			<table class="form" cellpadding="6" cellspacing="0" border="0" width="100%">
				
				<tr class="h"><td colspan="2">Other options</td></tr>
				
				<tr>
					<td class="caption"><label for="days-ahead" title="The number of days ahead usuarios can create a booking. Leave blank to allow bookings at any time in the future.">Booking ahead</label></td>
					<td class="field">
						<?php
					  	unset($input);
						$input['name'] = 'days-ahead';
						$input['id'] = "p_{$grupo_id}_days-ahead";
						$input['size'] = '10';
						$input['maxlength'] = '3';
						$input['value'] = set_value('days-ahead', '');
						echo form_input($input);
						?>
					</td>
				</tr>
				
				<tr>
					<td class="caption"><label for="schoolname" title="The number of bookings a user in this group can make in a given period of time.">Booking quota</label></td>
					<td class="field">
						<?php
						#$ = @field($this->validation->cpf);
						echo form_input(array(
							'name' => 'quota',
							'id' => 'quota',
							'size' => '10',
							'maxlenght' => '3',
							'value' => '',
						));
						?>
						<label for="quota-none" class="check">
						<?php
						#$ = @field($this->validation->cpf);
						echo form_radio(array(
							'name' => 'quota',
							'id' => 'quota-none',
							'value' => 'none',
							'checked' => TRUE,
						));
						?>(None)
						</label>
						<label for="quota-per-week" class="check">
						<?php
						#$ = @field($this->validation->cpf);
						echo form_radio(array(
							'name' => 'quota',
							'id' => 'quota-per-week',
							'value' => 'week',
							'checked' => FALSE,
						));
						?>Per week
						</label>
						<label for="quota-per-month" class="check">
						<?php
						#$ = @field($this->validation->cpf);
						echo form_radio(array(
							'name' => 'quota',
							'id' => 'quota-per-month',
							'value' => 'month',
							'checked' => FALSE,
						));
						?>Per month
						</label>
					</td>
				</tr>
				
				<?php
				unset($buttons);
				$buttons[] = array('submit', 'positive', 'Salvar group permissoes', 'disk1.gif', 0);
				$this->load->view('parts/buttons', array('buttons' => $buttons));
				?>
				
			</table>
		</td>
	</tr>
</table>