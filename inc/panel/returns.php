<!-- Returns -->
<div class="row">
	<div class="col-md-12 mt-4">
		<div class="card">
			<div class="card-header bg-main">
				<i class="fas fa-list"></i> Übersicht der Retouren - <?php echo getStoreData("name"); ?>
				<span class="float-right"><i class="fas fa-question-circle" data-toggle="tooltip" data-html="true" title="Eine Übersicht der Retouren deiner Filiale."></i></span>
			</div>
			<div class="card-body">
				<div class="table-list tableWithID" id="tableResponsive">
					<table class="table table-returns table-hover table-bordered mb-0" id="returnTable">
						<thead>
							<tr>
								<th scope="col">ID</th>
								<th scope="col">Datum</th>
								<th scope="col">Vorname</th>
								<th scope="col">Nachname</th>
								<th scope="col">Telefon</th>
								<th scope="col">Artikel</th>
								<th scope="col">Status</th>
								<th scope="col">Drucken</th>
								<th scope="col">Bearbeiten</th>
								<th scope="col">
									<div class="form-check text-center">
										<input class="form-check-input position-static" type="checkbox" onclick="toggle(this);">
									</div>
								</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Add Return -->
<div class="row">
	<div class="col-md-6 mt-4">
		<button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#returnAddModal">
			<i class="fas fa-share"></i> Retour anlegen
		</button>
	</div>
	<div class="col-md-6 mt-4">
		<button type="submit" class="btn btn-block btn-danger">
			<i class="fas fa-trash"></i> Markierung löschen?
		</button>
	</div>
</div>
<!-- Add Return - Modal -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="returnAddModal" aria-hidden="true" id="returnAddModal">
	<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="returnAddModalTitle"><i class="fas fa-plus-square"></i> Retour anlegen</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" name="return" id="returnForm">
				<div class="modal-body">
					<p><b>Infos</b></p>
					<div class="row">
					<div class="form-group state-change col-md-3">
						<div class="input-group">
							<div class="input-group-prepend">
								<label class="input-group-text" for="state"><i class="fas fa-info-circle"></i></label>
							</div>
							<select class="custom-select" id="state" name="state">
								<option value="" disabled selected>Status</option>
								<option value="" disabled>==================</option>
								<option value="Offen">Offen</option>
								<option value="Ausgetauscht">Ausgetauscht</option>
								<option value="" disabled>==================</option>
							</select>
						</div>
					</div>
					<div class="form-group state-change col-md-3">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-calendar"></i></span>
							</div>
							<span class="form-control"><?php echo date("d.m.Y"); ?></span>
						</div>
					</div>
					<div class="form-group col-md-6">
					<div class="input-group">
					<div class="input-group-prepend">
					<span class="input-group-text"><i class="fas fa-user-circle"></i></span>
					</div>
					<span class="form-control"><?php if(getUserData("username") != "Admin") { echo getUserData("firstname")." ".getUserData("lastname"); } else { echo "Administrator"; } ?></span>
					</div>
					</div>
					</div>
					<div class="row">
						<div class="col-md-12" id="checkAddReturnState"></div>
					</div>

					<!-- Customer -->
                    <div class="row">
                    <div class="col-md-6"><p><b>Kunde</b></p></div>
                    <div class="col-md-3">
						<div class="custom-control custom-checkbox">
					    	<input type="checkbox" class="custom-control-input" id="noemail" name="noemail" onClick="checkboxToggle('noemail', 'email')">
					    	<label class="custom-control-label" for="noemail"> Kein E-Mail</label>
					  	</div>
                    </div>
					<div class="col-md-3">
						<div class="custom-control custom-checkbox">
					    	<input type="checkbox" class="custom-control-input" id="nophone" name="nophone" onClick="checkboxToggle('nophone', 'telefon')">
					    	<label class="custom-control-label" for="nophone"> Kein Telefon</label>
					  	</div>
                    </div>
                    </div>

					<div class="row">
						<div class="form-group col-md-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-user"></i></span>
								</div>
								<input type="text" placeholder="Vorname" maxlength="32" class="form-control" id="firstname" name="firstname">
							</div>
						</div>
						<div class="form-group col-md-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="far fa-user"></i></span>
								</div>
								<input type="text" placeholder="Nachname" maxlength="32" class="form-control" id="surname" name="surname">
							</div>
						</div>

						<div class="form-group emtel-change col-md-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-at"></i></span>
								</div>
								<input type="text" placeholder="E-Mail" maxlength="32" class="form-control" id="email" name="email">
							</div>
						</div>
						<div class="form-group emtel-change col-md-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-phone"></i></span>
								</div>
								<input type="tel" placeholder="+43" maxlength="16" class="form-control" id="telefon" name="telefon">
							</div>
						</div>

					</div>

					<div class="row">
						<div class="col-md-3" id="checkAddReturnFirstname"></div>
						<div class="col-md-3" id="checkAddReturnSurname"></div>
						<div class="col-md-6" id="checkAddReturnEmTel"></div>
						<div class="col-md-3" id="checkAddReturnEmail"></div>
						<div class="col-md-3" id="checkAddReturnTelefon"></div>
					</div>

					<!-- Product -->
					<p><b>Artikel</b></p>
					<div class="row">
						<div class="form-group col-md-6">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-list-ol"></i></span>
									<span class="input-group-text bon-text"><?php echo getStoreData("short")."-"; ?></span>
								</div>
								<input type="text" placeholder="BON-Nr." maxlength="8" class="form-control" id="bonnr" name="bonnr">
							</div>
						</div>
						<div class="form-group col-md-6">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
								</div>
								<input type="text" placeholder="TT.MM.JJJJ" maxlength="10" data-provide="datepicker" data-date-language="de" class="form-control" id="bondate" name="bondate">
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6" id="checkAddReturnBonnr"></div>
						<div class="col-md-6" id="checkAddReturnBondate"></div>
					</div>

					<div class="row">
					<div class="form-group col-md-6">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-box"></i></span>
							</div>
							<input type="text" placeholder="Artikel" maxlength="32" class="form-control" id="product" name="product">
						</div>
					</div>
					<div class="form-group col-md-6">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-comment"></i></span>
							</div>
							<input type="text" placeholder="Kommentar" maxlength="255" class="form-control" id="comment" name="comment">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6" id="checkAddReturnProduct"></div>
					<div class="col-md-6" id="checkAddReturnComment"></div>
				</div>

				<div class="modal-footer" style="display:block !important;">
					<div class="btn-group d-flex" role="group" aria-label="Retour anlegen">
						<button type="submit" class="btn btn-success w-100"><i class="fas fa-share"></i> Retour anlegen</button>
						<button type="reset" class="btn btn-danger w-100" onclick="resetReturn();"><i class="fas fa-undo"></i> Zurücksetzen</button>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
