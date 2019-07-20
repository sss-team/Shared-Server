<!-- Modal HTML Ajouter un fichier-->
<div id="myModal_fichier" class="modal fade">
	
	<div class="modal-dialog modal-login">
		<div class="modal-content">
			<div class="modal-header">
							<div class="avatar"><i class="material-icons">&#xE7FD;</i></div>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
				<div class="modal-body">
					<form action="index.php?action=ajouter_fichier" method="POST" enctype="multipart/form-data">
						<span class="titre">Ajouter un fichier</span><br/><br/><br/>
						<span class="fichier">Fichier :</span>
							<input type="file"  name="fichier" required/><br /><br />
						
						<div class="form-group">
						<span class="fichier">Description fichier :</span>
							<textarea name="description_file" rows="7" cols="45" class="form-control" placeholder="Description du fichier" name="description_file" ></textarea>
						</div>
						<div class="form-group" id="t">
							<input type="submit" class="btn btn-primary btn-block btn-lg" name="envoyer_fichier" value="Envoyer le fichier"/>
						</div>
						<?php
						if(isset($erreur))
						{
							echo '<font color="red">'.$erreur."</font>";
						}
						?>
					</form>				

				</div>
			</div>
		</div>
	</div>