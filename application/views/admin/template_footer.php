<script>
    function search(e) {
        var dataSend = $('#searchForm').serialize();
        // var e = $(this).prev().attr("id");
        //alert(dump($(this), $(this).id));
        var f = $('input:radio:checked');
        $('input:radio').each(function (i, e) {
                //   alert($(this).attr("id"));
                $(this).next().css("border-top", "0px #ccc");
                $(e).next().css("height", "42px;");
                $(this).next().css("background-color", "#fcfcfc");
                $(this).next().css("padding-top", "12px");
                $(this).next().css("top", "-1px");
            }
        )
        var loadurl = $(f).attr('url');
        console.log($(f).attr('url'));
        var newHtml;
        $.ajax({
            type: 'GET',
            url: '<?php echo dir; ?>/admin/get_' + loadurl,
            datatype: "json",
            success: function (data) {


                $('#content2').html(data);

            }
        });
        // /  alert($(e).next().attr("id"));
        $(f).next().css("top", "0px");
        $(f).next().css("border-top", "3px solid #0072bb");
        $(f).next().css("background", "#ffffff");
        $(f).next().css("padding-top", "10px");
        $(e).next().css("height", "42px;");
        //e.style.background  = '#000';
    }
</script>