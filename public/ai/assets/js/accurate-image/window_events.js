$(window).bind('resize', function(e){
  var docH = $(window).height();
  // var midColH = docH-142;
  var sideColH = docH-114;
  // $('#full-wall').css({ height: midColH });
  $('#full-wall').parent().css({ height: sideColH});
});