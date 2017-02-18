<p></p>
<div class="row" style="width: 100%;margin: 0 auto;">
    <div class="col-sm-12">
        <form id="formAddToCart">
            <input type="hidden" name="object_id" value="<?php echo $post['idTovar']; ?>">
            <input type="hidden" name="price" value="<?php echo $post['priceTovar']; ?>">
            <table class="table table-bordered table-striped">
                <tr>
                    <th width="65">Код</th>
                    <th width="158">Артикул</th>
                    <th>Наименование</th>                                    
                    <th width="100" class="text-center">Ед. изм.</th>
                    <th width="80" class="text-center">Норм. уп.</th>
                    <th width="15" class="text-center">Ост.</th>
                    <th width="65" class="text-center">Цена</th>
                    <th width="100">Кол-во</th>
                </tr>
                <tr>
                    <td><?php echo $post['code']; ?></td>
                    <td><?php echo $post['article']; ?></td>
                    <td><?php echo $post['tovarName']; ?></td>
                    <td class="text-center"><?php echo $post['mkei']; ?></td>
                    <td class="text-center"><?php echo $post['norm']; ?></td>
                    <td class="text-center"><?php
                        $pic = "plus.png";

                        if ($post['is'] == ' ') {
                            $pic = "car.png";
                        }
                        if ($post['is'] == '-') {
                            $pic = "-.png";
                        }
                        echo "<img src=\"/a2dsrc/media/images/" . $pic . "\">"; ?></td>
                    <td class="text-center"><?php echo $post['priceTovar']; ?></td>
                    <td><input type="text" class="form-control input-sm" name="count" value="" id="inp_cart" placeholder="0" data-modalfocus onkeydown="zz(event);"></td>
                </tr>
            </table>
        </form>
    </div>
</div>
<script>
    function zz(event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            addToCart();
            return false;
        }
    }
</script>