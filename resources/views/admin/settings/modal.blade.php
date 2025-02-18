 <!-- Hidden Forms -->
 <div id="general" class="d-none" style="display: block;">
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
        <input type="text" class="form-control" placeholder="Enter company name" name="settings[companyname]" id="companyname" 
        value="{{ old('settings.companyname') }}">
        <span class="text-danger error-companyname"></span>
         
    </div>
    <div class="mb-3">
        <label class="form-label">City</label>
        <input type="text" class="form-control" placeholder="Enter city" name="settings[city]" id="city"
        value="{{ old('settings.city') }}">
        <span class="text-danger error-city"></span>
    </div>
    <div class="mb-3">
        <label class="form-label">State</label>
        <input type="text" class="form-control" value="{{ old('settings.state') }}"
        placeholder="Enter state" name="settings[state]" id="state">
        <span class="text-danger error-state"></span>
 </div>
    <div class="mb-3">
        <label class="form-label">Country</label>
        <select name="settings[country]" id="country"class="form-control">
          <option value="">Select Country
        </option>
      </select>
      <span class="text-danger error-country"></span>
    </div>
    <div class="mb-3">
        <label class="form-label">Zip Code</label>
        <input type="number" class="form-control" value="{{ old('settings.zipcode') }}"
         placeholder="Enter zip code" name="settings[zipcode]" id="zipcode">
        <span class="text-danger error-zipcode"></span>
    </div>
    <div class="mb-3">
        <label class="form-label">Phone Number</label>
        <input type="number" class="form-control" value="{{ old('settings.phonenumber') }}"
        placeholder="Enter phone number" name="settings[phonenumber]" id="phonenumber">
        <span class="text-danger error-phonenumber"></span>
        <p>Use(,) to add multiple phone number</p>
    </div>
    <div class="mb-3">
        <label class="form-label">Email Address</label>
        <input type="email" class="form-control" value="{{ old('settings.email') }}"
        placeholder="Enter email address" name="settings[email]" id="email">
        <span class="text-danger error-email"></span>
        <p>Use(,) to add multiple email address</p>
    </div>
    <div class="w-100 mb-4 pb-3">
    <center><h5>Home Page Counter Setting</h5></center>
   
    <div class="mb-3">
        <label class="form-label">Project Completed</label>
        <input type="number" class="form-control" value="{{ old('settings.project') }}"
        placeholder="Enter Project Completed" name="settings[project]" id="project">
        <span class="text-danger error-project"></span>
    </div>
    <div class="mb-3">
        <label class="form-label">Global Customers</label>
        <input type="number" class="form-control" value="{{ old('settings.globalcustomer') }}"
        placeholder="Enter name" name="settings[globalcustomer]" id="globalcustomer">
        <span class="text-danger error-globalcustomer"></span>
    </div>
    <div class="mb-3">
        <label class="form-label">Years of experience</label>
        <input type="number" class="form-control" value="{{ old('settings.experience') }}"
        placeholder="Enter years of experience" name="settings[experience]" id="experience">
        <span class="text-danger error-experience"></span>
    </div>
    <div class="mb-3">
        <label class="form-label">Countries Clients Served</label>
        <input type="number" class="form-control" value="{{ old('settings.client') }}"
        placeholder="Enter countries clients served" name="settings[client]" id='client'>
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
  <form id="smtpform" name="smtpform" method="POST" action="{{route('smtp.update')}}">
    @csrf
      <div class="mb-3">
          <label class="form-label">Mail engine</label>
      </div>
        <div class="mb-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="mailengine" id="PHP" value="PHP Mailer">
                <label class="form-check-label" for="inlineRadio1">PHP Mailer</label>
                <span class="text-danger error-client"></span>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="mailengine" id="Codeigniter" value="Codeigniter">
                <label class="form-check-label" for="inlineRadio2">Codeigniter</label>
                <span class="text-danger error-mailengine"></span>
              </div>
        </div>
      <div class="mb-3">
        <label class="form-label">Email Protocol</label>
        <span class="text-danger error-emailprotocol"></span>
    </div>
    <div class="mb-3">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="emailprotocol" id="Smtp" value="SMTP">
            <label class="form-check-label" for="inlineRadio1">SMTP</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio"  name="emailprotocol" id="SendMail" value="SendMail">
            <label class="form-check-label" for="inlineRadio2">SendMail</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio"  name="emailprotocol" id="Mailprotocol" value="Mail">
            <label class="form-check-label" for="inlineRadio2">Mail</label>
          </div>
    </div>
    <div class="mb-3">
        <label class="form-label">Email Encryption</label>
        <span class="text-danger error-encryption"></span>
       <select id="encryption" name="encryption" class="form-control">
            <option value="None">None</option>
            <option value="TLS">TLS</option>
            <option value="SSL">SSL</option>
       </select>
    </div>
    <div class="mb-3">
        <label class="form-label">SMTP Host</label>
        <input type="text" class="form-control" name="host" id="host"placeholder="Enter SMTP Host">
        <span class="text-danger error-host"></span>
      </div>
    <div class="mb-3">
        <label class="form-label">SMTP Port</label>
        <input type="text" class="form-control" name="port" id="port" placeholder="Enter SMTP Port">
        <span class="text-danger error-port"></span>
    </div>
    <div class="mb-3">
        <label class="form-label">SMTP Email</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Enter SMTP Email">
        <span class="text-danger error-emails"></span>
      </div>
    <div class="mb-3">
        <label class="form-label">SMTP Username</label>
        <input type="text" class="form-control" name="username" id="username"placeholder="Enter SMTP Username">
        <span class="text-danger error-username"></span>
    </div>
    <div class="mb-3">
        <label class="form-label">SMTP Password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Enter SMTP Password">
        <span class="text-danger error-password"></span>
    </div>
    <div class="mb-3">
        <label class="form-label">Email Charset</label>
        <select name="charset" id="charset" class="form-control">
            <option value="UTF-8" selected>UTF-8 (Recommended)</option>
            <option value="ISO-8859-1">ISO-8859-1</option>
            <option value="ISO-8859-15">ISO-8859-15</option>
            <option value="US-ASCII">US-ASCII</option>
        </select>   
        <span class="text-danger error-charset"></span> 
    </div>
      <button type="submit" class="btn btn-primary" name="smtp" id="smtp">Submit</button>
      <div class="mb-3">
        <hr class="border-top"/>
    </div>

      <div class="mb-3">
        <label class="form-label">Send Test Email</label>
        <p>Send test email to make sure that your SMTP setting is set correctly</p>
    </div>
    <div class="input-group">
        <input type="email" class="form-control" placeholder="Email address" id="sendemail" name="sendemail">
        <button class="btn btn-primary" type="button" id="send">Send</button>
    </div>
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

