<!-- Button trigger modal -->
<button type="button"  id="empform" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    New Product Category
  </button>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Product Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form  id="productform" name="productform" method="POST">
            <input type="hidden" id="hid" name="hid">
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Name:</label>
              <input type="text" class="form-control" name="name" id="name"/>
              <span class="text-danger error-name"></span>
            </div>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Status</label>
              <select name="status" id="status" class="form-control">
                <option value=1>Active</option>
                <option value=0>Inactive</option>
              </select>
              <span class="text-danger error-department"></span>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" name="categorysave" id="categorysave"/>
        </div>
      </div>
    </div>
  </div>
  <!--show modal-->
  