<?php
  if(empty($admin_aunt)){
  //echo 'Ошибка... <a href="login.php">Попробуйте еще</a>';
  //exit();
  }
?>	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">. 

		<div class="page-sidebar navbar-collapse collapse">

			<ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
				<li class="start <?php if($pageid==1){echo 'active';} ?> ">
					<a href="index.php">
					<i class="icon-home"></i>
					<span class="title">Главная</span>
					</a>
				</li>
				<li class="<?php if($pageid==3){echo 'active';} ?>">
					<a href="req.php">
					<i class="icon-pie-chart"></i>
					<span class="title">Задачи</span>
					</a>
				</li>
				<li class="<?php if($pageid==2){echo 'active';} ?>">
					<a href="users.php">
					<i class="icon-pie-chart"></i>
					<span class="title">Пользователи</span>
					</a>
				</li>

			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->