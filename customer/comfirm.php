kutoba
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="RYA5467WT4B3C">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

kutoba

Numaan
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="7JBX3AZYL3RPA">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

Numaan

MTZ 60
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="NDCBGGSMEK9VG">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

MTZ 60

Tsibilisi
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="BDMHFB5AU88P4">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

Tsibilisi


<h5 class="card-title">Select on of the drivers below</h5>
<div class="btn-group" style="margin:10px;">

                <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><img width="100" height="100" src="../Images/steering.jpg"> Select Driver Below<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li>
                      <input type="text" class="form-control" hidden="hidden" value="<?php echo "John Phiri"; ?>" name="driver_name" id="driver_name">
                      <a href="javascript:void(0);">
                        <img height="100" width="100" src="../Images/face.png"/>John Phiri</a>
                    </li>
                    <li>
                      <input type="text" class="form-control" hidden="hidden" value="<?php echo "Joy Banda"; ?>" name="driver_name" id="driver_name">
                      <a href="javascript:void(0);">
                        <img height="100" width="100" src="../Images/face2.jpg" />Joy Banda</a>
                    </li>
                </ul>
            </div>

<script type="text/javascript">
/* BOOTSTRAP DROPDOWN MENU - Update selected item text and image */
$(".dropdown-menu li a").click(function () {
    var selText = $(this).text();
    var imgSource = $(this).find('img').attr('src');
    var img = '<img src="' + imgSource + '"/>';        
    $(this).parents('.btn-group').find('.dropdown-toggle').html(img + ' ' + selText + ' <span class="caret"></span>');
});
</script>