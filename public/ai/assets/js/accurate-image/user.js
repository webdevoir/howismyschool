
var User = {
  loggedIn: false,
  print: false,

  saveImage: function(data){
    var thisUser = this;
    $.ajax({
      url: jsURL+'design/SaveImage',
      data: data,
      type: "POST",
      dataType: 'JSON',
      success: function(result){
        if(result.design_created){
          var myWindow = window.open(result.design_image_link, "_blank");
          if(thisUser.print){
            setTimeout(function(){
              myWindow.print();
              thisUser.print = false;
            }, 3000);
          }
        }else{
          alert(result.message);
        }
      },
      error: function(error){
        alert("Error: could no get design at the moment, please try after sometime.");
      }
    });
  },

  printWall: function(){
    this.print = true;
    this.saveDesignImage();
  },

  saveDesignImage: function(){
    $("div#full-wall-copy").html($("div#full-wall").html());
    $("div#full-wall-copy").show();

    AccurateImage.zoomWallBy(AccurateImage.defaultZoomSize, "div#full-wall-copy", false);

    var data = {
      ajax: 1,
      html: $("#full-wall-copy").html().replace(/url\("/g, 'url(').replace(/"\)/g, ')').replace(/'/g, '"')
    };

    this.saveImage(data);

    $("div#full-wall-copy").hide();
  },

  saveSeamlessDesign: function(){
    var data = {
      ajax: 1,
      html: $("#seamless-wall-container").html().replace(/url\("/g, 'url(').replace(/"\)/g, ')').replace(/'/g, '"')
    };

    this.saveImage(data);
  },

  getDesign: function(designId){
    $.ajax({
      url: jsURL+'design/GetDesign',
      data: { designId: designId, ajax: 1},
      dataType: 'JSON',
      success: function(result){
        if(typeof(result.user_design) !== "undefined" && result.user_design.HTML != null && result.user_design.HTML.length > 0){
          AccurateImage.openDesign(designId, result.user_design.HTML);
        }else{
          alert(result.message);
        }
      },
      error: function(error){
        alert("Error: could no get design at the moment, please try after sometime.")
      }
    });
  },

  openDesignForEdit: function(designId){
    var thisUser = this;
    this.checkUserLoggedIn().complete(function(){
      if(thisUser.loggedIn){
        thisUser.getDesign(designId);
      }else{
        thisUser.openLoginPopup();
      }
    });
  },



  showDesignListHTML: function(userDesigns){
       var HTML = '\
 <div class="custom-overlay"></div>\
       <div style="width:600px; " class="sign-up">\
     <h1 class="sign-up-title">Design(s)</h1><div class="title-table">\
             <table class="table smilar-table  table-bordered ">\
                <tr  id="desings_list_table_header" style="background:#ccc;">\
                  <th>Name</th>\
                  <th colspan="2"></th>\
                  </tr></table></div>\
                  <div id="user_designs_list_container">\
                  <table class="table table-striped smilar-table">\
                   ';
    for(var i=0; i < userDesigns.length; i ++){
      HTML += '\
                <tr>\
                  <td>' + userDesigns[i].name + '</td>\
                  <td><a href="javascript:void(0);" class="open-design-for-edit" data-design_id="' + userDesigns[i].id + '">Edit</a></td>\
                  <td><a href="javascript:void(0);" class="remove-design-for-user" data-design_id="' + userDesigns[i].id + '">Delete</a></td>\
                </tr>\
              ';
    }

    HTML += '</table></div>';
    return HTML;
  },

  showDesignListPopUp: function(userDesigns){
    if(userDesigns.length > 0){
      $("#lightbox-content").html(this.showDesignListHTML(userDesigns));
      $('.show-popup').trigger("click");
      $('.overlay-content').css({});
      $('#lightbox-content').css({});
    }else{
      alert("No design saved yet.");
    }
  },

  showDesignList: function(){
    var thisUser = this;
    $.ajax({
      url: jsURL+'design/ListDesigns',
      dataType: 'JSON',
      data: { ajax: 1 },
      success: function(result){
        if(typeof(result.user_designs) !== "undefined"){
          thisUser.showDesignListPopUp(result.user_designs);
        }else{
          alert(result.message);
        }
      },
      error: function(error){
        alert("Error: could not get data at the moment, please try after some time.")
      }
    });
  },

  openList: function(){
    var thisUser = this;
    this.checkUserLoggedIn().complete(function(){
      if(thisUser.loggedIn){
        thisUser.showDesignList();
      }else{
        thisUser.openLoginPopup();
      }
    });
  },

  loginLinksHTML: function(){
    return  '\
              <li class="user-sign-in-links"><a href="javascript:void(0);" id="open_list">Open</a></li>\
              <li class="user-sign-in-links"><a href="javascript:void(0);" id="logout">Logout</a></li>\
            ';
  },

  showLoginLinks: function(){
    if($(".user-sign-in-links").length == 0){
      $("#user_sign_in_links").after(this.loginLinksHTML());
    }
  },

  removeLoginLinks: function(){
    var el = $(".user-sign-in-links");
    if(el.length >  0){
      $(".user-sign-in-links").remove();
    }
  },

  checkUserLoggedIn: function(){
    return $.ajax({
      url: jsURL+'user-management/FLoginCheck',
      data: { ajax: 1 },
      dataType: 'JSON',
      success: function(result){
        if(result.loggedIn){
          User.loggedIn = true;
          User.showLoginLinks();
        }else{
          User.loggedIn = false;
          User.removeLoginLinks();
        }
      }
    });
  },

  validateLogin: function() {
    if( !validateUserName('username') ) return false;
    if( !validatePassword('password') ) return false;
    return true;
  },

  createRegisterHTML: function() {
    return  '\
              <div class="registration-field">\
              <div class="row">\
              <div class="col-md-12">\
              <input type="text" title="Allowed Characters are a-z, A-Z, 0-9, _" pattern="[a-zA-Z0-9_]+" name="username" class="sign-up-input" required id="username" required placeholder="Enter username*" maxlength="100" />\
               </div>\
                </div>\
                 <div class="row">\
              <div class="col-md-12">\
              <input type="password" name="password" class="sign-up-input" pattern=".{6,20}" required title="6 to 20 characters" required id="password" required placeholder="Enter password*" minlength="6" maxlength="20" />\
               </div>\
                </div>\
              <div class="row">\
              <div class="col-md-12"><input class="sign-up-input" type="password" pattern=".{6,20}" required title="6 to 20 characters" name="confirm_password" required placeholder="Re type password*" id="confirm_password" minlength="6" maxlength="20" /></div>\
              </div>\
               <div class="row">\
              <div class="col-md-12"><input class="sign-up-input" type="email" name="email_id" required placeholder="Enter email id*" id="email_id" maxlength="200" /> </div>\
               </div>\
              <div class="row">\
              <div class="col-md-6"> <input class="sign-up-input" type="text" title="Allowed Characters are a-z, A-Z, 0-9, _, White Space" pattern="[a-zA-Z0-9_\\s]+" name="first_name" required placeholder="Enter first name*" id="first_name" maxlength="50" /> </div>\
               <div class="col-md-6"><input class="sign-up-input" type="text" title="Allowed Characters are a-z, A-Z, 0-9, _, White Space" pattern="[a-zA-Z0-9_\\s]+" name="last_name" required placeholder="Enter last name*" id="last_name" maxlength="50" /> </div>\
               </div>\
                <div class="row">\
              <div class="col-md-12"><input class="sign-up-input" type="text" title="Allowed Characters are a-z, A-Z, 0-9, _, White Space" pattern="[a-zA-Z0-9_\\s]+" name="company_name" placeholder="Enter company name" id="company_name" maxlength="100" /></div>\
               </div>\
                <div class="row">\
              <div class="col-md-12"><input class="sign-up-input" type="text" title="Allowed Characters are a-z, A-Z, 0-9, _ - ., White Space" pattern="[a-zA-Z0-9_,\-\.\\s]+" name="address" placeholder="Enter address" id="address" maxlength="255" /> </div>\
               </div>\
                <div class="row">\
              <div class="col-md-6"> <input class="sign-up-input" type="text" title="Allowed Characters are a-z, A-Z, White Space" pattern="[a-zA-Z\\s]+" name="country" placeholder="Enter country" id="country" maxlength="20" /></div>\
               <div class="col-md-6"> <input class="sign-up-input" type="text" title="Allowed Characters are a-z, A-Z, + - (), White Space" pattern="[a-zA-Z0-9\+\-\(\)\\s]+" name="city" placeholder="Enter city" id="city" maxlength="50" /></div>\
               </div>\
                <div class="row">\
              <div class="col-md-6"> <input class="sign-up-input" type="text" title="Allowed Characters are a-z, A-Z, 0-9, White Space" pattern="[a-zA-Z0-9\\s]+" name="zipcode" placeholder="Enter zipcode" id="zipcode" maxlength="10" /> </div>\
               <div class="col-md-6"> <input class="sign-up-input" type="tel" name="contact_no" placeholder="Enter contact number" id="contact_no" maxlength="15" /></div>\
               </div>\
                 <div class="row">\
              <div class="col-md-3"><label> I am a:</label></div>\
              <div class="col-md-9 checkbox-margin"> <label class="checkbox-inline"><input class="registration-field" type="checkbox" name="user_type[]" value="architect/designer" id="architect/designer"/> Architect/Designer</label>\
               <label class="checkbox-inline"><input class="registration-field" type="checkbox" name="user_type[]" value="home_owner" id="home_owner"/>Home Owner</label>\
                <label class="checkbox-inline"><input class="registration-field" type="checkbox" name="user_type[]" value="builder" id="builder" /> Builder</label>\
                 <label class="checkbox-inline"><input class="registration-field" type="checkbox" name="user_type[]" value="contractor" id="contractor" /> Contractor</label>\
                  <label class="checkbox-inline"><input class="registration-field" type="checkbox" name="user_type[]" value="distributor" id="distributor" /> Distributor</label>\
                   <label class="checkbox-inline"> <input class="registration-field" type="checkbox" name="user_type[]" value="other" id="other" />Other</label>\
               </div>\
              </div>\
              </div>\
             \
            ';
  },

  loginFieldsHTML: function() {
    return '\
            <div class="login-field">\
            <div class="row">\
            <div class="col-md-12">\
            <input type="text" name="username" class="sign-up-input" required id="username" required placeholder="Enter username*" maxlength="100" />\
             </div>\
              </div>\
               <div class="row">\
            <div class="col-md-12">\
            <input type="password" name="password" class="sign-up-input" required id="password" required placeholder="Enter password*" minlength="8" maxlength="20" />\
             </div>\
              </div>\
              </div>\
            ';
  },

  createLogInHTML: function() {
    return  '\
              <div id="login_container popup-height">\
              <div class="custom-overlay"></div>\
              <form name="login_form" id="login_form" method="post" class="sign-up">\
               <h1 class="sign-up-title">Login</h1>\
              <div id="login_form_input_container">\
              </div>'+User.loginFieldsHTML()+'\
              <input type="hidden" name="ajax" value="1" />\
              <input type="submit" value="Login" class="sign-up-button" id="login_btn" />\
              <a href="javascript:void(0);" id="user_register" class="sign-up-button" >Register</a>\
              <a href="javascript:void(0);" id="user_login" class="hide sign-up-button">Login</a>\
              </form>\
              </div>\
             ';
  },

  openLoginPopup: function() {
    $("#lightbox-content").html(this.createLogInHTML());
    $('.show-popup').trigger("click");
    $('.overlay-content').css({ });
    $('#lightbox-content').css({ });
  },

  getDesignName: function(name) {
    if(typeof($("div#full-wall").data("design_id")) === "undefined" || $("div#full-wall").data("design_id").length == 0){
      name = prompt("Give this design a name. Allowed characters a-z, A-z, 0-9, _, - And maximum length is 50", name);
      if(name == null) {
        return false;
      }else{
        var regexToTestFileName = /[a-zA-z0-9_-]{1,50}/;
        if(regexToTestFileName.test(name)){
          return name;
        }else{
          this.getDesignName(name);
        }
      }
    }
    else {
      return true;
    }
  },

  saveDesign: function(name) {
    this.saveDesignAfterLogin = true;

    if(this.loggedIn){
      if(name == undefined){
        var name = "Untitled";
      }

      name = this.getDesignName(name);
      if(name == undefined || name == null || name == false){
        return false;
      }

      var data = {
        html_info: AccurateImage.wallHTML(),
        json_info: JSON.stringify(AccurateImage.wallJSON()),
        user_design_id: AccurateImage.wallDesignId(),
        ajax: '1',
        name: name
      };

      $.ajax({
        type: 'POST',
        url: jsURL+'design/SaveDesign',
        dataType: 'JSON',
        data: data,
        success: function(result) {
          if(result.loggedIn) {
            alert(result.message);
            $("div#full-wall").data("design_id", result.design_id);
          }
          else if(result.notLoggedIn) {
            alert(result.message);
            User.openLoginPopup();
          }
          else{
            alert("Invalid Operation!");
          }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
              var error = "XMLHttpRequest = " + XMLHttpRequest + ", \n\n textStatus = " + textStatus + ", \n\n errorThrown = " + errorThrown;
              alert(error);
        }
      });
    }
    else{
      User.openLoginPopup();
    }
  },

  getSubmitURL: function(){
    var url = "",
        btnVal = $.trim($("#login_btn").val());

    if(btnVal == "Register"){
      url = jsURL+'user-management/FRegistration';
    }else if(btnVal == "Login"){
      url = jsURL+'user-management/FLogin';
    }else {
      alert("Illegal Operation");
      return false;
    }

    return url;
  },

  login: function() {
    $.ajax({
      type: 'POST',
      url: this.getSubmitURL(),
      dataType: 'JSON',
      data: $("#login_form").serialize(),
      success: function(result) {
        if( result.message.toUpperCase() == 'SUCCESS' ) {
          User.showLoginLinks();
          User.loggedIn = true;
          if(User.saveDesignAfterLogin) {
            User.saveDesign();
          }
        }
        else {
          alert(result.message);
          User.loggedIn = false;
        }
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        var error = "XMLHttpRequest = " + XMLHttpRequest + ", \n\n textStatus = " + textStatus + ", \n\n errorThrown = " + errorThrown;
        alert(error);
        User.loggedIn = false;
      }
    });
    return false;
  },

  logout: function() {
    $.ajax({
      url: jsURL+'user-management/FLogout',
      data: { ajax: 1 },
      success: function() {
        User.loggedIn = false;
        alert('You have been logged out');
        User.removeLoginLinks();
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        var error = "XMLHttpRequest = " + XMLHttpRequest + ", \n\n textStatus = " + textStatus + ", \n\n errorThrown = " + errorThrown;
        alert(error);
        User.loggedIn = false;
      }
    });
  },

  getManufacturers: function() {
    $.ajax({
      type: 'POST',
      url: jsURL+'product-management/GetManufacturers',
      data: { ajax: 1 },
      dataType: 'JSON',
      success:function(result) {
        console.log(result);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        var error = "XMLHttpRequest = " + XMLHttpRequest + ", \n\n textStatus = " + textStatus + ", \n\n errorThrown = " + errorThrown;
        alert(error);
      }
    });
  },

  getSizes: function(manufacturerId) {
    $.ajax({
      type: 'POST',
      url: jsURL+'product-management/GetSizes',
      data: { ajax: 1, manufacturer_id: manufacturerId },
      dataType: 'JSON',
      success: function(result) {
        console.log(result);
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {
        var error = "XMLHttpRequest = " + XMLHttpRequest + ", \n\n textStatus = " + textStatus + ", \n\n errorThrown = " + errorThrown;
        alert(error);
      }
    });
  }

};


