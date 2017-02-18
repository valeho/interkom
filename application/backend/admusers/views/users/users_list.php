<div class="clr"></div>
<div class="menu_1">
    <? echo anchor("/adminusers/add_user", 'Добавить пользователя', array('class'=>'link_add'));?>
</div>
<div>
    <?php if(isset($user_list)){ ?>
    <table border="0" cellpadding="4" cellspacing="4" class="tb" align="center" width="90%">
        <tr>
            <td class="name">Логин</td>
            <td class="name">ФИО</td>
            <td class="name" width="150">Дата регистрации</td>
            <td class="name" width="150">Последний вход</td>
            <td class="name" width="150">Роль</td>
            <td class="name" align="center" width="150">Разрешения</td>
            <td class="name" width="200" align="center">Действие</td>
        </tr>
        <?php foreach($user_list as $v): ?>
        <tr onmouseover="this.bgColor='#f2f2f2'" onmouseout="this.bgColor='white'">
            <td class="td"><?php echo $v->email;?></td>
            <td class="td"><?php echo $v->last_name . ' ' . $v->first_name;?></td>
            <td class="td"><?php echo date('d-m-Y H:i:s',$v->created_on);?></td>
            <td class="td"><?php echo date('d-m-Y H:i:s',$v->last_login);?></td>
            <td class="td" width="150">
                <?php
                    foreach($this->ion_auth->get_users_groups($v->id)->result() as $v1)
                    {
                        echo $v1->description . "<br />";
                    }
                ?>
            </td>
            <td class="td" align="center" width="150">
                <?php
                    $tt = $this->ion_auth->get_users_groups($v->id)->result();
                    if(strcmp($tt[0]->name, "moderators") == 0){ ?>
                <? echo anchor("/adminusers/look_user/".$v->id, 'Просмотреть', array('class'=>'link_add'));?>
                <?php } ?>
            </td>
            <td class="td" width="200" align="center">
                <? echo anchor("/adminusers/edit_user/".$v->id, 'Редактировать', array('class'=>'link_add'));?> /
                <? echo anchor("/adminusers/del_user/".$v->id, 'Удалить', array('class'=>'link_add'));?>
            </td>
        </tr>
        <?php endforeach;?>
    </table>
    <?php } ?>
</div>
<div class="menu_1">
    <? echo anchor("/adminusers/add_user", 'Добавить пользователя', array('class'=>'link_add'));?>
</div>
