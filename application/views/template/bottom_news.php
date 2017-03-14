<?php
?>
    <div class="modal fade" id="News" tabindex="-1" role="document" aria-labelledby="autorizModalLabel">
        <div class="modal-dialog" role="document" style="width:733px; margin:0px auto;">
            <div class="modal-content" style="width:733px">

                <div class="modal-body news-body">
                    <h4 class="modal-title" id="myModalLabel">Новости</h4>
                </div>
               
            </div>
        </div>
    </div>
<div class="modal fade" id="shownews" tabindex="-1" role="document">
    <div class="modal-dialog modal-lg" role="document" style="width:550px;">
        <div class="modal-content">
            <div class="title_new"></div>
            <div class="text_new"></div>

            <div class="modal-body">

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="oneNews" tabindex="-1" role="document" aria-labelledby="autorizModalLabel">
    <div class="modal-dialog" role="document" style="width:733px; margin:0px auto;">
        <div class="modal-content" style="width:733px">
            <div class="modal-body modal-news">
                <h4 class="modal-title" id="myModalLabel">Новости</h4>
                
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on('click', '.btn_news', function () {
        // $('#shownews').modal({show: true});
        $.getJSON('<?php echo dir; ?>/tovar/getNews',
            function (data) {
                //alert(data);
                $('.modal-body').html(data);
            }
        )
    });

    $(document).on('click', '.button_show_all', function () {
       // $('#shownews').modal({show: true});
        $.getJSON('<?php echo dir; ?>/tovar/getNews',
            function (data) {
                //alert(data);
                $('.modal-body').html(data);
            }
        )
    });
    $(document).on('click', '.button', function () {
        //alert('here');
        //$('#oneNews').modal({show: true});
        var guid = $(this).attr('guid');
        console.log('<?php echo dir; ?>/tovar/getOneNew/' + guid)
        $.getJSON('<?php echo dir; ?>/tovar/getOneNew/' + guid,
            function (data) {
                //alert(data);
                $('.modal-body').html(data);
            }
        )
    });
</script>
<?php
?>