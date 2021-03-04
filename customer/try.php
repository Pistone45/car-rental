<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css"/>
  <script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</head>
<body>
<br><br><br><br><br><br><br><br><br><br><br><br>
<form action="insert.php" method="post">
<div class="btn-group" style="margin:10px;">

                <a class="btn btn-primary dropdown-toggle" name="driver_name" data-toggle="dropdown" href="#"><img width="100" height="100" src="../Images/steering.jpg"> Select Driver <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li>
                    	<input type="text" class="form-control" hidden="hidden" value="<?php echo "John Phiri"; ?>" name="driver_name" id="driver_name">
                    	<a href="javascript:void(0);">
                        <img height="100" width="100" src="../Images/face.png"/>John Phiri</a>
                    </li>
                    <li><a href="javascript:void(0);">
                    	<input type="text" class="form-control" hidden="hidden" value="<?php echo "Joy Banda"; ?>" name="driver_name" id="driver_name">
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
<button class="btn btn-primary">Submit</button>
</form>
</body>
</html>