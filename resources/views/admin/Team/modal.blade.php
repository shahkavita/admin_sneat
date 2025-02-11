<!-- Button trigger modal 
<button type="button"  id="empform" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    New Team
  </button>
  Modal -->
  <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Team</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form  id="teamform" name="teamform" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="hid" name="hid">
            <div class="row">
                <div class="col-md-6">
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name"/>
                <span class="text-danger error-name"></span>
              </div>
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Facebook</label>
                <input type="url" class="form-control" name="facebook" id="facebook"/>
                 <span class="text-danger error-facebook"></span>
              </div> 

            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Role</label>
                    <select id="role" class="form-control" name="role">
                        <option value="Customer Support">Customer Support</option>
                        <option value="Developer">Developer</option>
                        <option value="Quality Assurance">Quality Assurance </option>
                        <option value="Marketing Specialist">Marketing Specialist</option>
                       </select>
                    <span class="text-danger error-role"></span>
                  </div>
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">twitter</label>
                    <input type="url" class="form-control" name="twitter" id="twitter"/>
                     <span class="text-danger error-twitter"></span>
                  </div> 
            </div>
        </div>
        <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Skype</label>
            <input type="url" class="form-control" name="skype" id="skype"/>
             <span class="text-danger error-skype"></span>
          </div> 
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Image</label>
                <input type="file" class="form-control" name="image" id="image" accept="image/*"/>
                <img id="imagePreview" src="" alt="Image Preview" style="max-width: 150px; display: none; margin-top: 10px;">
                <input type="text" name="oldimage" id="oldimage" readonly hidden/>
                
                <button class="btn-danger"
                 type="button" id="cancel-image" style="display: none"><i class="fa fa-times" aria-hidden="true"></i>
                </button>
                <span class="text-danger error-image"></span>
              </div>
          </form>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" name="productsave" id="teamsave" value="Save"/>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <!--show modal-->
  