<h1>Users</h1>
<p>Below is a list of the users.</p>

<div id="infoMessage"><?php echo $message;?></div>
<div><?php echo anchor("admin/logout/", 'Выход') ;?></div>
<table cellpadding=0 cellspacing=10>
	<tr>
		<th>Имя</th>
		<th>Фамилия</th>
		<th>Email</th>
		<th>Группа</th>
		<th>Статус</th>
		<th>Действие</th>
	</tr>
	<?php foreach ($users as $user):?>
		<tr>
			<td><?php echo $user->first_name;?></td>
			<td><?php echo $user->last_name;?></td>
			<td><?php echo $user->email;?></td>
			<td>
				<?php foreach ($user->groups as $group):?>
					<?php echo anchor("auth/edit_group/".$group->id, $group->name) ;?><br />
                <?php endforeach?>
			</td>
			<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, 'Active') : anchor("auth/activate/". $user->id, 'Inactive');?></td>
			<td><?php echo anchor("auth/edit_user/".$user->id, 'Edit') ;?></td>
		</tr>
	<?php endforeach;?>
</table>

<p><a href="<?php echo site_url('auth/create_user');?>">Create a new user</a> | <a href="<?php echo site_url('auth/create_group');?>">Create a new group</a></p>