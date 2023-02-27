<div class="modal modal-lg fade" id="addannounce" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content h-25">
        <div class="modal-body container p-5">
          <form action="insert.php" method="POST" id="myFormadd" enctype="multipart/form-data">
            <h2 class="text-center">Ajouter un annonce</h2>
            <div class=" d-flex flex-column gap-3">
              <div class="formvalid">
              <div class="d-flex gap-2 flex-wrap m-3 ">
                <div class="d-flex flex-wrap gap-3" id="images">
                </div>
                <div class="rectangle">
                  <label for="image-input" class="icon">
                    <i class="fa fa-plus"></i>
                  </label>
                  <input id="image-input" name="images[]" type="file" multiple>
                </div>
              </div>
              <small></small>
              </div>
              <div class="d-flex gap-3">
                <div class="w-50 formvalid">
                  <label for="titleAdd" class="form-label">Titre</label>
                  <input type="text" name="titleAdd" class="form-control" id="titleAdd" placeholder="Titre" />
                  <small></small>
                </div>
                <div class="w-50 formvalid">
                  <label for="priceAdd" class="form-label">Montant</label>
                  <input type="number" min="0" name="priceAdd" class="form-control" id="priceAdd" placeholder="Montant" />
                  <small></small>
                </div>
              </div>
              <div class="d-flex gap-3">
                <div class="w-50 formvalid">
                  <label for="villeadd" class="form-label">Ville</label>
                  <input type="text" name="villeadd" class="form-control" id="villeadd" placeholder="Adresse" />
                  <small></small>
                </div>
                <div class="w-50 formvalid">
                  <label for="typeAdd" class="form-label">Type</label>
                  <select class="form-select" name="typeAdd" id="typeAdd">
                    <option selected disabled>Choisir</option>
                    <option value="Location">Location</option>
                    <option value="Vente">Vente</option>
                  </select>
                  <small></small>
                </div>
              </div>
              <div class="d-flex gap-3">
                <div class="w-50 formvalid">
                  <label for="codpostal" class="form-label">Code postal</label>
                  <input type="number" name="codpostal" class="form-control" id="codpostal" placeholder="Code postal" />
                  <small></small>
                </div>
                <div class="w-50 formvalid">
                  <label for="categorieadd" class="form-label">Categorie</label>
                  <select class="form-select" name="categorieaadd" id="categorieaadd">
                    <option selected disabled>Choisir</option>
                    <option value="appartement">appartement</option>
                    <option value="maison">maison</option>
                    <option value="villa">villa</option>
                  </select>
                  <small></small>
                </div>
              </div>
              <div class="formvalid">
                <label for="descriptionadd" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="descriptionadd" rows="3"></textarea>
                <small></small>
              </div>
              <div class="justify-content-end d-flex">
                <button name="addBtn" value="addBtn" type="submit" class="btn bg-dark text-white" id="addBtn">Ajouter</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>