$(document).on('page:load', function() {
  loadCarousel();
  showAjaxCompleteNotification();
  ajaxLoaderDisplay();
  fadeOutFlashMessages();
  initializeSelectOptions();
  initializeSelectOptionsForAjax();
  initializeSubmitNavBarSearchForm();
  highlightText();
  Student.initializeStudentScoreCharts();
  initializeDateTimePicker();

});

$(document).ready(function() {
  loadCarousel();
  showAjaxCompleteNotification();
  ajaxLoaderDisplay();
  fadeOutFlashMessages();
  initializeSelectOptions();
  initializeSelectOptionsForAjax();
  initializeSubmitNavBarSearchForm();
  highlightText();
  Student.initializeStudentScoreCharts();
  initializeDateTimePicker();

  $(document).on("change", "select.answer-type", function(){
    var val = $(this).val();
    $("#answer_type_modal_" + val).modal('show');
    $("#last_selected_answer_type").val($(this).data("count"));
  });

  $(document).on("click", "#add_more_multiple_choices", function(){
    $('<div><input type="text" class="multiple-choices-input"><a href="javascript:void(0);" class="remove_multiple_choice">Remove</a><br></div>').insertBefore($(this));
  });

  $(document).on("click", ".remove-multiple-choice", function(){
    $(this).parent().remove();
  });

  $(document).on("click", "#add_multiple_choice", function(){
    var count = $("#last_selected_answer_type").val();
    var el = $(".answer-choices-" + count);

    el.html("<br />");

    $(".multiple-choices-input").each(function(index){
      var choice = $.trim($(this).val());
      if(choice.length > 0){
        el.append('<input type="checkbox" name="qa[]['+ $("#last_selected_answer_type").val() +']choices['+ index +']">&nbsp;&nbsp;&nbsp;' + choice + '<br />');
      }
    });

    $(".modal").modal('hide');
  });

});

var loadCarousel = function(){
  $("#myCarousel").carousel({
    interval: 2000
  });
};

var showAjaxCompleteNotification = function(){
  $(document).ajaxComplete(function(event, request) {
    var msg = request.getResponseHeader('X-Message');
    var type = request.getResponseHeader('X-Message-Type');

    if(msg){
      $("#flash_messages").html(flashMessageHTML(type, msg));
      fadeOutFlashMessages();
    }
  });
};

var flashMessageHTML = function(type, msg){
  if(type == "notice" || type == "success"){
    type = "success";
  }else if(type == "alert" || type == "error"){
    type = "error";
  }

  var html = '<div class="alert fade in alert-' + type + '"><button class="close" data-dismiss="alert">×</button>' + msg + '</div>';

  return html
};


var ajaxLoaderDisplay = function(){
  $(document).bind("ajaxSend", function(){
    $("#ajax-loader").show();
  }).bind("ajaxComplete", function(){
    $("#ajax-loader").hide();
  });
};


var fadeOutFlashMessages = function(){
  setTimeout(function() {
    $("div.alert").removeClass("in");
    $("div.alert button.close").trigger("click");
  }, 2000);
};

var initializeSelectOptions = function(){
  if($(".select2").length > 0){
    $(".select2").select2("destroy")
    $(".select2").select2();
  }
};

var initializeSelectOptionsForAjax = function(){
  $(document).ajaxComplete(function(event, request) {
    initializeSelectOptions();
  });
};

var initializeSubmitNavBarSearchForm = function(){
  $(".searchbar-custom").click(function(){
    $("form#navigation_searchbar").trigger("submit");
  });

  $("form#navigation_searchbar").submit(function(e){
    e.preventDefault();
  });

}

var highlightText = function(){
  $(document).ajaxComplete(function(event, request) {
    var searhQuery = request.getResponseHeader('x-search-term');
    if(searhQuery){
      searchHighlightText(searhQuery);
    }
  });
};

var searchHighlightText = function(text){
  var html  = $("search-container list-group-item-text").html();
  var matchedText = "";
  var regex = "";

  text      = text.split(/\s+/);

  $("p.list-group-item-text").each(function(){
    var html = $(this).html();
    for(var i=0; i < text.length; i++){
      regex = new RegExp(text[i], "ig");
      matchedText = html.match(regex);

      if(matchedText){
        for(var j=0; j < matchedText.length; j++){
          regex = new RegExp(matchedText[j], "g");
          html = html.replace(regex, '<span class="search-highlight">' + matchedText[j] + '</span>');
        }
      }
    }

    $(this).html(html);
  });

};

var initializeDateTimePicker = function(){
  if($(".datetimepicker-initialize").length > 0){
    $(".datetimepicker-initialize").datetimepicker({
      language: 'en',
      pick12HourFormat: true
    });
  }
};