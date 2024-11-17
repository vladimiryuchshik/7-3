<?php
include('include/config.php');
include('include/func.php');

if(!empty($_GET['dnid'])){
$sql = "DELETE FROM req WHERE (id='".$_GET['dnid']."')";
mysql_query($sql) or die(mysql_error());
                        header("Location: req.php?");  
}

if(!empty($_POST['name']) and empty($_POST['eid'])){

$expDT1 = explode(" ",$_POST['dstart']);

$expDT1_date = explode(".",$expDT1[0]);
$expDT1_time = explode(":",$expDT1[1]);

$date1 = mktime($expDT1_time[0],$expDT1_time[1],date("s"),$expDT1_date[1],$expDT1_date[0],$expDT1_date[2]);


$expDT2 = explode(" ",$_POST['dend']);

$expDT2_date = explode(".",$expDT2[0]);
$expDT2_time = explode(":",$expDT2[1]);

$date2 = mktime($expDT2_time[0],$expDT2_time[1],date("s"),$expDT2_date[1],$expDT2_date[0],$expDT2_date[2]);

                        $sql = "INSERT INTO req VALUES ('', '".addslashes($_POST['name'])."', '".addslashes($date1)."', '".addslashes($date2)."', '".addslashes($_POST['status'])."', '".addslashes($_POST['uid'])."', '".addslashes($_POST['p'])."');";
                        mysql_query($sql) or die(mysql_error());
                        header("Location: req.php");
        }


if(!empty($_POST['eid'])){

$expDT1 = explode(" ",$_POST['dstart']);

$expDT1_date = explode(".",$expDT1[0]);
$expDT1_time = explode(":",$expDT1[1]);

$date1 = mktime($expDT1_time[0],$expDT1_time[1],date("s"),$expDT1_date[1],$expDT1_date[0],$expDT1_date[2]);


$expDT2 = explode(" ",$_POST['dend']);

$expDT2_date = explode(".",$expDT2[0]);
$expDT2_time = explode(":",$expDT2[1]);

$date2 = mktime($expDT2_time[0],$expDT2_time[1],date("s"),$expDT2_date[1],$expDT2_date[0],$expDT2_date[2]);

$sql = "UPDATE req SET name='".addslashes($_POST['name'])."',
dstart='".addslashes($date1)."',
dend='".addslashes($date2)."',
status='".addslashes($_POST['status'])."',
uid='".addslashes($_POST['uid'])."',
p='".addslashes($_POST['p'])."' WHERE (id='".$_POST['eid']."')";
mysql_query($sql) or die(mysql_error());

        header("Location: req.php");
}


if(eregi("page=", $_SERVER['REQUEST_URI'])){
        $pos=strrpos($_SERVER['REQUEST_URI'],"=");
        $lastext=substr($_SERVER['REQUEST_URI'],$pos+1);
        $_GET['page'] = $lastext;
}
if(!empty($_GET['page'])) {$page = $_GET['page'];}else { $page = 1;}


$titleP = 'Задачи';
?><!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title><?php  echo $titleP; ?> | Admin </title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
<link href="assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css">
<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN PAGE STYLES -->
<link rel="stylesheet" type="text/css" href="assets/global/plugins/clockface/css/clockface.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
<link rel="stylesheet" type="text/css" href="assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>
<!-- END PAGE STYLES -->
<!-- BEGIN THEME STYLES -->
<!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
<link href="assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="assets/admin/layout4/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="assets/admin/layout4/css/themes/light.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="assets/admin/layout4/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed page-sidebar-closed-hide-logo page-sidebar-closed-hide-logo">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="index.html">
			<img src="assets/admin/layout4/img/logo-light.png" alt="logo" class="logo-default"/>
			</a>
			<div class="menu-toggler sidebar-toggler">
				<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
			</div>
		</div>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<!-- BEGIN PAGE ACTIONS -->
		<!-- DOC: Remove "hide" class to enable the page header actions -->

		<!-- END PAGE ACTIONS -->
		<!-- BEGIN PAGE TOP -->
		<div class="page-top">
			<!-- BEGIN TOP NAVIGATION MENU -->
			<div class="top-menu">
				<ul class="nav navbar-nav pull-right">

					<!-- BEGIN USER LOGIN DROPDOWN -->
					<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
					<li class="dropdown dropdown-user dropdown-dark">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<span class="username username-hide-on-mobile">
						Администратор </span>
						<!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
						<img alt="" class="img-circle" src="assets/admin/layout4/img/avatar9.jpg"/>
						</a>
						<ul class="dropdown-menu dropdown-menu-default">
							<li>
								<a href="login.php">
								<i class="icon-key"></i> Выйти </a>
							</li>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
			</div>
			<!-- END TOP NAVIGATION MENU -->
		</div>
		<!-- END PAGE TOP -->
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
<?php $pageid=3; include('menu.php'); ?>

	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN PAGE HEADER-->
			<!-- BEGIN PAGE HEAD -->
			<div class="page-head">
				<!-- BEGIN PAGE TITLE -->
				<div class="page-title">
					<h1><?php  echo $titleP; ?> <small><a href="?add" class="btn btn-xs green">Добавить задачу <i class="fa fa-plus"></i></a></small></h1>
				</div>
				<!-- END PAGE TITLE -->
				<!-- BEGIN PAGE TOOLBAR -->
				<div class="page-toolbar">

				</div>
				<!-- END PAGE TOOLBAR -->
			</div>
			<!-- END PAGE HEAD -->
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="portlet light">
				<div class="portlet-body">
					<div class="row">
						<div class="col-md-12">
							<p>
<?php

if(!isset($_GET['add']) and empty($_GET['eid'])){
?>
<?php if(!isset($_GET['status'])){ echo 'Все'; }else {echo '<a href="req.php">Все</a>';} ?> |
<?php if(isset($_GET['status']) and @$_GET['status']==0){ echo 'Новая'; }else {echo '<a href="?status=0">Новая</a>';} ?> |
<?php if(@$_GET['status']==1){ echo 'Подтвердил'; }else {echo '<a href="?status=1">Подтвердил</a>';} ?> |
<?php if(@$_GET['status']==2){ echo 'Отклонена'; }else {echo '<a href="?status=2">Отклонена</a>';} ?>

<?php
$whr = '';

if(isset($_GET['status'])){
$whr = " WHERE(req.status='".$_GET['status']."')";
}
     $sql = "SELECT req.* FROM req".$whr." ORDER BY req.id DESC";
     $s=mysql_query("$sql") or die(mysql_error());
     $rows = mysql_num_rows($s);
echo '<div id="uptable">
  <table class="table table-bordered">
<thead>
<tr>
<th>#</th>
<th>Название</th>
<th>Начало</th>
<th>Конец</th>
<th>Статус</th>
<th>Приоритет</th>
<th>Действия</th>
</tr>
</thead>
<tbody>
';


$n_count = 5;
$arofmetik = $rows / $n_count;
//===============================
$sum_1 = $page * $n_count; //20 //10 //30
$oni = $sum_1 - 1;         //19 //9  //29
$sum_2 = $sum_1 - $n_count;//10 //0  //20
$ofi = $sum_2 - 1;         //9  //-1 //19
//===============================
$per_1 = $sum_2;
$per_2 = $oni;

$showCount = 1;

     for($i=0;$i<$rows;$i++)
     {

            $f=mysql_fetch_array($s);
if($i>=$per_1 and $showCount<=$n_count){
if($f['status']==0){$st = '<span class="label label-info">Новая</span>'; }
if($f['status']==1){$st = '<span class="label label-success">В работе</span>'; }
if($f['status']==2){$st = '<span class="label label-danger">Отклонена</span>'; }
if($f['status']==3){$st = '<span class="label label-warning">Выполнена</span>'; }


          echo '<tbody>
<tr>
<td>'.$f['id'].' </td>

<td>'.$f['name'].'</td>
<td>'.date("d.m.Y H:i",$f['dstart']).'</td>
<td>'.date("d.m.Y H:i",$f['dend']).'</td>
<td>'.$st.'</td>
<td>'.$f['p'].'</td>
<td>';

          echo ' <a href="?eid='.$f['id'].'">Редактировать</a>  | <a href="?dnid='.$f['id'].'">Удалить</a></td>
</tr>
<tbody>
 ';
 $showCount++;
 }

     }  if($rows == 0){echo '<tr><td colspan="6">Нет даных</td></tr>';}
echo '</table>'.perpage_view($arofmetik,$page).'</div>
<br /><br />
<h2>Календарь</h2>
<div id="calendar"></div>
';
}

if(!empty($_GET['eid'])){

$sql = "SELECT * FROM req WHERE(id='".$_GET['eid']."')";
     $s=mysql_query("$sql") or die(mysql_error());
     $rows = mysql_num_rows($s);
            $f=mysql_fetch_array($s);
echo '   <div class="post-comment col-md-5">
<form method="post" role="form"><input type="hidden" name="eid" value="'.$_GET['eid'].'">

<div class="form-group">
<label class="control-label">Название <span class="required">
* </span>
</label>
<input type="text" class="form-control" name="name" value="'.$f['name'].'">
</div>


<div class="form-group"><label class="control-label">Начало (дд.мм.гггг чч:мм)</label>
											<div class="input-group date form_datetime" data-date="'.date("d.m.Y H:i",$f['dstart']).'">
												<input type="text" name="dstart" size="16" class="form-control" value="'.date("d.m.Y H:i",$f['dstart']).'">
												<span class="input-group-btn">
												<button class="btn default date-reset" type="button"><i class="fa fa-times"></i></button>
												<button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
												</span>
											</div>
</div>
<div class="form-group"><label class="control-label">Конец (дд.мм.гггг чч:мм)</label>
											<div class="input-group date form_datetime" data-date="'.date("d.m.Y H:i",$f['dstart']).'">
												<input type="text" name="dend" size="16" class="form-control" value="'.date("d.m.Y H:i",$f['dend']).'">
												<span class="input-group-btn">
												<button class="btn default date-reset" type="button"><i class="fa fa-times"></i></button>
												<button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
												</span>
											</div>

</div>


<div class="form-group">
<label class="control-label">Статус заявки <span class="required">
* </span>
</label>
<select size="1" name="status">
  <option value="0"'; if($f['status']==0){echo ' selected';} echo '>Новая</option>
  <option value="1"'; if($f['status']==1){echo ' selected';} echo '>Подтвердил</option>
  <option value="2"'; if($f['status']==2){echo ' selected';} echo '>Отклонена</option>
</select>
</div>


<div class="form-group">
<label class="control-label">Исполнитель <span class="required">
* </span>
</label>
<select size="1" name="uid"><option value="0">-</option>';


     $sql = "SELECT * FROM users";
     $s_u=mysql_query($sql) or die(mysql_error());
     $rows_u = mysql_num_rows($s_u);
     for($i_u=0;$i_u<$rows_u;$i_u++)
     {
            $f_u=mysql_fetch_array($s_u);
echo '<option value="'.$f_u['id'].'"'; if($f_u['id']==$f['uid']){echo ' selected';} echo '>'.$f_u['name'].'</option>';
     }

echo '
</select>
</div>

<div class="form-group">
<label class="control-label">Приоритет <span class="required">
* </span>
</label>
<input type="text" class="form-control" name="p" value="'.$f['p'].'">
</div>

        <input type="submit" name="save" class="btn blue btn-block" value="Сохранить" />
</form> </div>
';
}

if(isset($_GET['add'])){


?> <div class="post-comment col-md-5">
<form method="post">
<div class="form-group">
<label class="control-label">Название <span class="required">
* </span>
</label>
<input type="text" class="form-control" name="name" value="">
</div>
<div class="form-group"><label class="control-label">Начало (дд.мм.гггг чч:мм)</label>
											<div class="input-group date form_datetime" data-date="<?php echo date("Y-m-d").'T'.date("H:i:s"); ?>Z">
												<input type="text" name="dstart" size="16" class="form-control">
												<span class="input-group-btn">
												<button class="btn default date-reset" type="button"><i class="fa fa-times"></i></button>
												<button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
												</span>
											</div>
</div>
<div class="form-group"><label class="control-label">Конец (дд.мм.гггг чч:мм)</label>
											<div class="input-group date form_datetime" data-date="<?php echo date("Y-m-d").'T'.date("H:i:s"); ?>Z">
												<input type="text" name="dend" size="16" class="form-control">
												<span class="input-group-btn">
												<button class="btn default date-reset" type="button"><i class="fa fa-times"></i></button>
												<button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
												</span>
											</div>

</div>

<div class="form-group">
<label class="control-label">Статус заявки <span class="required">
* </span>
</label>
<select size="1" name="status" class="form-control">
  <option value="0">Новая</option>
  <option value="1">Подтвердил</option>
  <option value="2">Отклонена</option>
</select>
</div>


<div class="form-group">
<label class="control-label">Исполнитель <span class="required">
* </span>
</label>
<select size="1" name="uid" class="form-control"><option value="0">-</option>

<?php

     $sql = "SELECT * FROM users";
     $s_u=mysql_query($sql) or die(mysql_error());
     $rows_u = mysql_num_rows($s_u);
     for($i_u=0;$i_u<$rows_u;$i_u++)
     {
            $f_u=mysql_fetch_array($s_u);
echo '<option value="'.$f_u['id'].'"'; if($f_u['id']==$f['uid']){echo ' selected';} echo '>'.$f_u['name'].'</option>';
     }

?>

</select>
</div>

<div class="form-group">
<label class="control-label">Приоритет <span class="required">
* </span>
</label>
<input type="text" class="form-control" name="p" value="">
</div>

        <input type="submit" name="save" class="btn blue btn-block" value="Сохранить" />
</form></div>
<?php
}
?>
							</p>
						</div>
					</div>
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->


<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="assets/global/plugins/respond.min.js"></script>
<script src="assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<script src="assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
<!-- IMPORTANT! fullcalendar depends on jquery-ui.min.js for drag & drop support -->
<script src="assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/clockface/js/clockface.js"></script>
<script type="text/javascript" src="assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script><script type="text/javascript" src="assets/global/plugins/bootstrap-datepicker/js/components-pickers.js"></script>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="assets/admin/layout4/scripts/layout.js" type="text/javascript"></script>
<script src="assets/admin/layout4/scripts/demo.js" type="text/javascript"></script>
<script src="assets/admin/pages/scripts/index3.js" type="text/javascript"></script>
<script src="assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.3.1/fullcalendar.min.js" rel="stylesheet" type="text/css"/>
<link href="http://fullcalendar.io/js/fullcalendar-2.3.1/fullcalendar.css" rel="stylesheet" type="text/css"/>
<link href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.3.1/fullcalendar.print.css" rel="stylesheet" type="text/css"/>


<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.3.1/fullcalendar.min.js" type="text/javascript"></script>



<script>

	jQuery(document).ready(function() {

        ComponentsPickers.init();
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			defaultDate: '<?php echo date("Y-m-d"); ?>',
			editable: false ,
			eventLimit: true, // allow "more" link when too many events
			events: [
<?php
     $sql = "SELECT req.* FROM req".$whr." ORDER BY req.id DESC";
     $s=mysql_query("$sql") or die(mysql_error());
     $rows = mysql_num_rows($s);
     for($i=0;$i<$rows;$i++)
     {

            $f=mysql_fetch_array($s);

?>
				{
					title: '<?php echo $f['name']; ?>',
					start: '<?php echo date("Y-m-d",$f['dstart']).'T'.date("H:i:s",$f['dstart']); ?>',
					end: '<?php echo date("Y-m-d",$f['dend']).'T'.date("H:i:s",$f['dend']); ?>'
				},
<?php
    }
?>

				{
					title: 'Click for Google',
					url: 'http://google.com/',
					start: '2015-02-28'
				}
			]
		});

	});

</script>
<script>



jQuery(document).ready(function() {

        $('.sendsms').click(function() {
        var thisuid = $(this).attr('val');
$.get("sms.php?uid="+thisuid, function(data){
$(".smsdiv"+thisuid).html(data);
});
        });

});
</script>

<script>
jQuery(document).ready(function() {


   Metronic.init(); // init metronic core componets
   Layout.init(); // init layout
   Demo.init(); // init demo features
    Index.init(); // init index page
 Tasks.initDashboardWidget(); // init tash dashboard widget
});
</script>
<!-- END JAVASCRIPTS -->

</body>

<!-- END BODY -->
</html>
