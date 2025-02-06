<!-- Button trigger modal -->
<button type="button"  id="empform" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    New Product
  </button>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form  id="productform" name="productform" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="hid" name="hid">
            <div class="row">
            <div class="col-md-6">
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name"/>
                <span class="text-danger error-name"></span>
              </div>
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Category</label>
                <select id="category" class="form-control" name="category">
                    @foreach($category as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
                <span class="text-danger error-category"></span>
              </div>
            </div>
            <div class="col-md-6">
               

                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">Price</label>
                  <input type="number" class="form-control" name="price" id="price"/>
                  <span class="text-danger error-price"></span>
                </div>

                <div class="mb-3">
                  <label for="status" class="col-form-label">Status</label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="one" value="1">
                    <label class="form-check-label" for="flexRadioDefault1">
                      Active
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="zero" value="0">
                    <label class="form-check-label" for="flexRadioDefault2">
                      Inactive
                    </label>
                  </div>
                    
                  <span class="text-danger error-status"></span>
                </div>

              </div>
            </div>
            
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Image</label>
              <input type="file" class="form-control" name="image" id="image" accept="image/*"/>
              <img id="imagePreview" src="" alt="Image Preview" style="max-width: 150px; display: none; margin-top: 10px;">
              <span class="text-danger error-image"></span>
            </div>
                
                <div class="mb-3">
                  <label for="recipient-name" class="col-form-label">Description</label>
                  <textarea id="description" name="description" class="form-control">
                  </textarea>
                   <span class="text-danger error-description"></span>
                </div>

               

          </form>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" name="productsave" id="productsave" value="Save"/>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!--show modal-->
  