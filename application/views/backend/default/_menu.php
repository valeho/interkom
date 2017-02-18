<div class="default-skin" id="vertical-scrollbar-demo">    
    <?php if ($menu_site)
    { ?>
        <ul class="ul-menu-site">
    <?php foreach ($menu_site as $menu_site_val): ?>
                <li id="id-item-menu-<?= $menu_site_val->id ?>" <?php if ($menu_site_val->activity == 0)
        {
            echo "class='active_menu_off'";
        } ?>>
                    <div style="position: relative;">
                        <a href="#" class="left-eye-ico" title="Скрыть/Показать" onclick="hide_menu(<?= $menu_site_val->id ?>);
                                return false;">
                            <img src="/img_adm/Buzz-Invisible-icon.png" width="16">
                        </a>

                        <div class="menu-item-block">
                            <table cellpadding="0" cellspacing="0">
                                <tr valign="top">
                                    <td style="font-size: 11px;">
                                        <?php if ($menu_site_val->level > 0)
                                        { ?>
                                            <?php echo str_repeat("&laquo;&laquo;", $menu_site_val->level) . "&nbsp;"; ?>
                                        <?php } ?>
                                    </td>
                                    <td>
                                            <?php
                                            if ($menu_site_val->ref_type_navigation != 'catalog')
                                            {
                                                $link = base_url() . "adm" . $menu_site_val->ref_type_navigation . "/index/" . $menu_site_val->id;
                                            }
                                            else
                                            {
                                                $link = "#";
                                            }
                                            ?>
                                        <a href="<?= $link ?>" class="menu-items-a">
        <?= nl2br($menu_site_val->name_ru) ?>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <a href="#" class="left-edit-ico" title="Редактировать" onclick="edit_menu('<?= $url_cfg_edit ?>', <?= $menu_site_val->id ?>);
                                return false;">
                            <div class="edit-ico"></div>
                        </a>
                        <a href="#" class="left-del-ico" title="Удалить" onclick="del_menu(<?= $menu_site_val->id ?>);
                                return false;">
                            <div class="delet-ico"></div>
                        </a>
                    </div>
                </li>
    <?php endforeach; ?>
        </ul>
<?php } ?>
</div>