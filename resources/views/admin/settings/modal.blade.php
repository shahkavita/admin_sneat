 <!-- Hidden Forms -->
 <div id="general" class="d-none">
  <form id="generalsetting" name="generalsetting" method="POST" enctype="multipart/form-data">
    @csrf  
    <div class="mb-3">
          <label class="form-label">Logo</label>
          <input type="file" class="form-control" placeholder="Enter logo" name="logo" id="logo">
            <img src="" name="previewlogo" id="previewlogo" 
            height="70px" width="50px"
            style="display: none;"/>
        </div>
        <span class="text-danger error-logo"></span>
         
      <div class="mb-3">
        <label class="form-label">Favicon</label>
        <input type="file" class="form-control" placeholder="Enter favicon" name="favicon" id="favicon">
        <img src="" name="previewfavicon" id="previewfavicon"
        height="70px" width="50px"
        style="display: none;"/>
        <span class="text-danger error-favicon"></span>
         
    </div>
    <div class="mb-3">
        <label class="form-label">Company Name</label>
        <input type="text" class="form-control" placeholder="Enter company name" name="settings[companyname]" id="companyname">
        <span class="text-danger error-companyname"></span>
         
    </div>
    <div class="mb-3">
        <label class="form-label">City</label>
        <input type="text" class="form-control" placeholder="Enter city" name="settings[city]" id="city">
        <span class="text-danger error-city"></span>
    </div>
    <div class="mb-3">
        <label class="form-label">State</label>
        <input type="text" class="form-control" placeholder="Enter state" name="settings[state]" id="state">
        <span class="text-danger error-state"></span>
 </div>
    <div class="mb-3">
        <label class="form-label">Country</label>
        <input type="text" class="form-control" placeholder="Enter country" name="settings[country]" id="country">
        <span class="text-danger error-country"></span>
    </div>
    <div class="mb-3">
        <label class="form-label">Zip Code</label>
        <input type="number" class="form-control" placeholder="Enter zip code" name="settings[zipcode]" id="zipcode">
        <span class="text-danger error-zipcode"></span>
    </div>
    <div class="mb-3">
        <label class="form-label">Phone Number</label>
        <input type="number" class="form-control" placeholder="Enter phone number" name="settings[phonenumber]" id="phonenumber">
        <span class="text-danger error-phonenumber"></span>
        <p>Use(,) to add multiple phone number</p>
    </div>
    <div class="mb-3">
        <label class="form-label">Email Address</label>
        <input type="email" class="form-control" placeholder="Enter email address" name="settings[email]" id="email">
        <span class="text-danger error-email"></span>
        <p>Use(,) to add multiple email address</p>
    </div>
    <div class="w-100 mb-4 pb-3">
    <center><h5>Home Page Counter Setting</h5></center>
   
    <div class="mb-3">
        <label class="form-label">Project Completed</label>
        <input type="number" class="form-control" placeholder="Enter Project Completed" name="settings[project]" id="project">
        <span class="text-danger error-project"></span>
    </div>
    <div class="mb-3">
        <label class="form-label">Global Customers</label>
        <input type="number" class="form-control" placeholder="Enter name" name="settings[globalcustomer]" id="globalcustomer">
        <span class="text-danger error-customer"></span>
    </div>
    <div class="mb-3">
        <label class="form-label">Years of experience</label>
        <input type="number" class="form-control" placeholder="Enter years of experience" name="settings[experience]" id="experience">
        <span class="text-danger error-experience"></span>
    </div>
    <div class="mb-3">
        <label class="form-label">Countries Clients Served</label>
        <input type="number" class="form-control" placeholder="Enter countries clients served" name="settings[client]" id='client'>
        <span class="text-danger error-client"></span>
    </div>
      <button type="submit" class="btn btn-primary" name="general" id="general">Submit</button>
      <button type="reset" class="btn btn-secondary" name="reset" id="reset">Reset</button>
  </form>
</div>
</div>
<!---theme form-->
<div id="theme" class="d-none">
  <form>
      <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" placeholder="Enter email">
      </div>
      <button type="submit" class="btn btn-success">Submit</button>
  </form>
</div>

<div id="smtp" class="d-none">
  <form>
      <div class="mb-3">
          <label class="form-label">Phone</label>
          <input type="text" class="form-control" placeholder="Enter phone">
      </div>
      <button type="submit" class="btn btn-warning">Submit</button>
  </form>
</div>
<div id="socialmedia" class="d-none">
  <form>
      <div class="mb-3">
          <label class="form-label">Phone</label>
          <input type="text" class="form-control" placeholder="Enter phone">
      </div>
      <button type="submit" class="btn btn-warning">Submit</button>
  </form>
</div>
<div id="additional" class="d-none">
  <form>
      <div class="mb-3">
          <label class="form-label">Phone</label>
          <input type="text" class="form-control" placeholder="Enter phone">
      </div>
      <button type="submit" class="btn btn-warning">Submit</button>
  </form>
</div>

