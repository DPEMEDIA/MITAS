<!-- Returns -->
<div class="row">
	<div class="col-md-12 mt-4">
		<div class="card">
			<div class="card-header bg-main">
				<i class="fas fa-list"></i> Übersicht der Retouren
				<span class="float-right"><i class="fas fa-question-circle" data-toggle="tooltip" data-html="true" title="Eine Übersicht der Retouren deiner Filiale."></i></span>
			</div>
			<div class="card-body">
				<?php
				$getReturns = MysqlSelect("SELECT * FROM `ms_returns` WHERE `storeid` = '".MysqlEscape(getUserData("storeid"))."' ORDER BY `returnid` ASC LIMIT 25");
				if(MysqlNumRow($getReturns)) {
				?>
				<div class="table-responsive table-list tableWithID">
					<table class="table table-returns table-hover table-bordered mb-0">
						<thead>
							<tr>
								<th scope="col">Nr.</th>
								<th scope="col">Datum</th>
								<th scope="col">Vorname</th>
								<th scope="col">Nachname</th>
								<th scope="col">E-Mail</th>
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
						<tbody>
						<?php
						$getReturns = MysqlSelect("SELECT * FROM `ms_returns` WHERE `storeid` = '".MysqlEscape(getUserData("storeid"))."' ORDER BY `returnid` ASC LIMIT 25");
						while($getReturnsData = MysqlAssoc($getReturns)) {
						?>
							<tr>
								<th scope="row"><?php if(!isset($number)) { $number = 1; } echo $number++; ?></th>
								<td><?php echo date("d.m.Y", strtotime($getReturnsData["dateofreturn"])); ?></td>
								<td><?php if(strlen($getReturnsData["firstname"]) > 8) { echo substr($getReturnsData["firstname"], 0, 5)."..."; } else { echo $getReturnsData["firstname"]; } ?></td>
								<td><?php if(strlen($getReturnsData["lastname"]) > 8) { echo substr($getReturnsData["lastname"], 0, 5)."..."; } else { echo $getReturnsData["lastname"]; } ?></td>
								<td><?php if(strlen($getReturnsData["telefon"]) > 13) {  echo substr($getReturnsData["telefon"], 0, 13)."..."; } else { echo $getReturnsData["telefon"]; } ?></td>
								<td><?php if(strlen($getReturnsData["product"]) > 20) { echo substr($getReturnsData["product"], 0, 20)."..."; } else { echo $getReturnsData["product"]; } ?></td>
								<td><?php echo $getReturnsData["status"]; ?></td>
								<td class="text-center"><i class="fas fa-print" id="drucker"></i></td>
								<td class="text-center"><i class="fas fa-edit" id="edit" onclick="rowReturn(<?php echo $getReturnsData["returnid"]; ?>);"></i></td>
								<td>
									<div class="form-check text-center">
										<input class="form-check-input position-static" type="checkbox" id="returnCheck" name="returnCheck">
									</div>
								</td>
							</tr>
						<?php
						}
						?>
						</tbody>
					</table>
				</div>
				<!-- Pagination -->
				<div class="row mt-4 mb-0">
					<!-- Pagination -->
					<div class="col-6 col-md-6">
						<nav aria-label="Pagination">
							<ul class="pagination mb-0">
								<li class="page-item">
									<a class="page-link" href="#" aria-label="Previous">
										<span aria-hidden="true">&laquo;</span>
										<span class="sr-only">Previous</span>
									</a>
								</li>
								<li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
								<li class="page-item"><a class="page-link" href="#">2</a></li>
								<li class="page-item">
									<a class="page-link" href="#" aria-label="Next">
										<span aria-hidden="true">&raquo;</span>
										<span class="sr-only">Next</span>
									</a>
								</li>
							</ul>
						</nav>
					</div>
					<!-- Sitenation -->
					<div class="col-6 col-md-6">
						<nav aria-label="Sitenation">
							<ul class="pagination mb-0 justify-content-end">
								<li class="page-item">
									<span class="page-link">Seite</span>
								</li>
								<li class="page-item">
									<span class="page-link">1 von 5</span>
								</li>
							</ul>
						</nav>
					</div>
				</div>
				<?php
				} else {
				?>
				<b>Keine Einträge vorhanden.</b>
				<?php
				}
				?>
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
		<button type="button" class="btn btn-block btn-danger">
			<i class="fas fa-trash"></i> Markierte löschen?
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
					<div id="checkReturnError"></div>
					<p><b>Infos</b></p>
					<div class="row">
					<div class="form-group state-change col-md-3">
						<div class="input-group">
							<div class="input-group-prepend">
								<label class="input-group-text" for="state"><i class="fas fa-info-circle"></i></label>
							</div>
							<select class="custom-select" id="state" name="state">
								<option disabled selected>Status</option>
								<option disabled>==================</option>
								<option value="Offen">Offen</option>
								<option value="Ausgetauscht">Ausgetauscht</option>
								<option disabled>==================</option>
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
					<p><b>Kunde</b></p>
					<div class="row">
						<div class="form-group col-md-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-user"></i></span>
								</div>
								<input type="text" placeholder="Vorname" maxlength="24" class="form-control" id="firstname" name="firstname">
							</div>

						</div>
						<div class="form-group col-md-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="far fa-user"></i></span>
								</div>
								<input type="text" placeholder="Nachname" maxlength="24" class="form-control" id="surname" name="surname">
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
								<input type="tel" placeholder="Telefon" maxlength="32" class="form-control" id="telefon" name="telefon">
							</div>

						</div>

					</div>

					<div class="row">
						<div class="col-md-3" id="checkAddReturnFirstname"></div>
						<div class="col-md-3" id="checkAddReturnSurname"></div>
						<div class="col-md-6" id="checkAddReturnEmTel"></div>
					</div>

					<!-- Product -->
					<p><b>Artikel</b></p>
					<div class="row">
						<div class="form-group col-md-6">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-list-ol"></i></span>
								</div>
								<input type="text" placeholder="BON-Nr." maxlength="32" class="form-control" id="bonnr" name="bonnr">
							</div>
							<div id="checkAddReturnBonnr"></div>
						</div>
						<div class="form-group col-md-6">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
								</div>
								<input type="text" placeholder="TT.MM.JJJJ" maxlength="10" data-provide="datepicker" data-date-language="de" class="form-control" id="bondate" name="bondate">
							</div>
							<div id="checkAddReturnBondate"></div>
						</div>

					<div class="form-group col-md-6">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-box"></i></span>
							</div>
							<input type="text" placeholder="Artikel" maxlength="50" class="form-control" id="product" name="product">
						</div>
						<div id="checkAddReturnProduct"></div>
					</div>
					<div class="form-group col-md-6">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-comment"></i></span>
							</div>
							<input type="text" placeholder="Kommentar" maxlength="255" class="form-control" id="comment" name="comment">
						</div>
						<div id="checkAddReturnComment"></div>
					</div>
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
