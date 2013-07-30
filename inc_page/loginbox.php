        <div>
          <?php if ($_GET['login'] == "failed"){ ?>
		  <h1><span class="redheading">Login gagal, </span>silahkan ulangi kembali.</h1>
		  <?php } else { ?>
		  <h1><span class="redheading">Log</span>in</h1>
		  <?php } ?>
        </div>
		<div class="loginbox">
			Username :
			<div class="clear"></div>
			<form action="logincheck.php" method="post">
			<input type="text" name="username" class="login_input"  />
			<div class="clear"></div>
			Password : 
			<div class="clear"></div>
			<input type="password" name="password" class="login_input" />
			<div class="clear"></div>
			<input type="submit" value="login" name="login" class="navbutton" />
		</div>