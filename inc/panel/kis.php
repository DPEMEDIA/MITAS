<div class="row">
<div class="col-md-4 mt-4">
<div class="card">
<div class="card-header bg-main">
<i class="fas fa-list"></i> Kategorien
<span class="float-right"><i class="fas fa-question-circle" data-toggle="tooltip" data-html="true" title="Hier werden die Kategorien angezeigt."></i></span>
</div>
<div class="card-body">
<div id="treeview"></div>
<div class="mt-3">
<div class="btn-group d-flex" role="group">
<button type="button" class="btn btn-success w-50" data-toggle="modal" data-target="#categoryAddModal">Kategorie hinzufügen</button>
<button type="button" class="btn btn-danger w-50" id="removeCategory">Kategorie löschen</button>
</div>
</div>
</div>
</div>
</div>
<div class="col-md-8 mt-4">
<div class="card">
<div class="card-header bg-main">
<i class="fas fa-box"></i> Produkte
<span class="float-right"><i class="fas fa-question-circle" data-toggle="tooltip" data-html="true" title="Hier werden die Produkte angezeigt."></i></span>
</div>
<div class="card-body">

<div class="table-responsive table-list" id="treeviewProducts">
Bitte eine Kategorie wählen...
</div>

<div id="treeviewProductsToolbar"></div>

</div>
</div>
</div>
</div>
<!-- Add Category - Modal -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="categoryAddModal" aria-hidden="true" id="categoryAddModal">
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="categoryAddModalTitle"><i class="fas fa-plus-square"></i> Kategorie hinzufügen</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<form method="POST" name="return" id="returnForm">
<div class="modal-body">
<div id="checkReturnError"></div>
<!-- Info -->
<p><b>Info</b></p>
<div class="form-group mb-0">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text">Name</span>
</div>
<input type="text" placeholder="..." maxlength="64" class="form-control" id="name" name="name">
</div>
</div>
</div>
<div class="modal-footer" style="display:block !important;">
<div class="btn-group d-flex" role="group" aria-label="Kategorie hinzufügen">
<button type="submit" class="btn btn-success w-100" id="addCategory">Kategorie hinzufügen</button>
<button type="reset" class="btn btn-danger w-100" onclick="resetReturn();">Zurücksetzen</button>
</div>
</div>
</form>
</div>
</div>
</div>
<!-- Add Product - Modal -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="productAddModal" aria-hidden="true" id="productAddModal">
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="productAddModalTitle"><i class="fas fa-plus-square"></i> Produkt hinzufügen</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<form method="POST" name="return" id="returnForm">
<div class="modal-body">
<div id="checkReturnError"></div>
<!-- Info -->
<p><b>Info</b></p>
<div class="form-group mb-0">
<div class="input-group">
<div class="input-group-prepend">
<span class="input-group-text">Name</span>
</div>
<input type="text" placeholder="..." maxlength="64" class="form-control" id="productName" name="productName">
</div>
</div>
</div>
<div class="modal-footer" style="display:block !important;">
<div class="btn-group d-flex" role="group" aria-label="Kategorie hinzufügen">
<button type="submit" class="btn btn-success w-100" id="addProduct">Produkt hinzufügen</button>
<button type="reset" class="btn btn-danger w-100" onclick="resetReturn();">Zurücksetzen</button>
</div>
</div>
</form>
</div>
</div>
</div>
