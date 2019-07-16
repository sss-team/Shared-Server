<?php
session_start();
$id = $_SESSION['id'];
$user_name = $_SESSION['user_name'];

if(isset($_GET['action']) and isset($_GET['id']) and isset($_GET['user_name'])){
    $action = htmlspecialchars($_GET['action']);
    $id_get = htmlspecialchars($_GET['id']);
    $user_name_get = htmlspecialchars($_GET['user_name']);

    if($action == 'connecter' and $id_get == $id and $user_name == $user_name_get){
        $title = "Shared-Server";
        ob_start();
        require("public/link_bt_acceuil.html");
        $entete = ob_get_clean();
        ob_start();
        require("public/style_acceuil.html");
        $style = ob_get_clean();
        ob_start();
        ?>

<nav class="navbar navbar-default navbar-expand-xl">
	<div class="navbar-header d-flex col">
		<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle navbar-toggler ml-auto">
			<span class="navbar-toggler-icon"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
	</div>
	<!-- Collection of nav links, forms, and other content for toggling -->
	<div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
		<form class="navbar-form form-inline">
			<div class="input-group search-box">								
				<input type="text" id="search" class="form-control" placeholder="Rechercher ici">
				<span class="input-group-addon"><i class="material-icons">&#xE8B6;</i></span>
			</div>
		</form>
		<ul class="nav navbar-nav navbar-right ml-auto">
			<li class="nav-item"><a href="#" class="nav-link notifications"><i class="fa fa-bell-o"></i><span class="badge">10</span></a></li>
			<li class="nav-item"><a href="#" class="nav-link messages"><i class="fa fa-envelope-o"></i><span class="badge">-5</span></a></li>
			<li class="nav-item dropdown">
				<a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle user-action"><img src="Images/off.jpg" class="avatar" alt="Avatar"> <b class="off"> <?php echo $userinfo['user_name']; ?> </b><b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="#" class="dropdown-item"><i class="fa fa-user-o"></i> Profile</a></li>
					<li><a href="#" class="dropdown-item"><i class="fa fa-sliders"></i> Langues</a></li>
					<li class="divider dropdown-divider"></li>
					<li><a href="se_deconnecter.php" class="dropdown-item"><i class="material-icons">&#xE8AC;</i> Déconnexion</a></li>
				</ul>
			</li>
		</ul>
	</div>
</nav>

        <?php
        while($file = $files->fetch()){
            $name_file = $file['file_name'];
            $user_name = $file['user_name'];
            $groupe_file = $file['groupe_name'];
            $date_upload_file = $file['date_upload'];
            $description_file = $file['description_file'];

            echo "$name_file et $user_name et $groupe_file et $date_upload_file et $description_file <br><br>";
        }

        $content = ob_get_clean();
        require("template.php");
        
    }
}