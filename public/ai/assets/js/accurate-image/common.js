
  $(function (){

                  $(document).on("click", ".btnBottom", function(){
                    $('.test').toggleClass('fa-chevron-down');
                    $ ('#bottom-container').slideToggle(200);
                  });
                  // $('.btnBottom').on('click', function(){
                  // $('.test').toggleClass('fa-chevron-down');
                  // $ ('#bottom-container').slideToggle(200);
                  //   });
                  $('#left-boxDiv').click(function() {
                  $('#leftpanelDiv').animate({width: 'toggle'}, "fast")
                    });
                  });

                  $('.dropdown-toggle').on('click', function(){
                  $('.dropdown-menu').animate({height: 'toggle'}, "fast")

        });

 $(document).ready(function () {

                var docH = $(window).height();
                var mainColH = docH-65;
                var midColH = docH-142;
                var sideColH = docH-156;
                var innerContainer = mainColH - 90;

                // $('#leftpanelDiv').css({ height: sideColH });
                // $('#full-wall').css({ height: midColH });
                 $('#user_designs_list_container').css({ height: mainColH });
                $('#full-wall').parent().css({ height: sideColH});
                // $(window).trigger("resize");
                // $('#full-wall').css({ height: "80%" });
                // $('#full-wall').parent().css({ height: "79%" });
                // $('.innerContainer').css({ height: innerContainer });





                 var allAccordions = $('.accordion div.data');
                 var allAccordionItems = $('.accordion .accordion-item');

                  $('.show-popup').click(function(event){
                    // event.preventDefault();
                    var docHeight = $(document).height();
                    var scrollTop = $(window).scrollTop();
                    var selectedPopup = $(this).data('showpopup');

                    $('.overlay-bg').fadeToggle('fast').css({'height' : docHeight});
                    $('.popup'+selectedPopup).show();
                    $('.overlay-content').css({'top': scrollTop+20+'px'});
                  });


                  $('.close-btn').click(function(){
                    $('.overlay-bg, .overlay-content').hide();
                  });
                  // $('.overlay-bg').click(function(){
                  // $('.overlay-bg, .overlay-content').hide();
                  //  })
                  // $('.overlay-content').click(function(){
                  //   return false;
                  // })


              // sub menu toggle

                $('.menu-primary-navigation').on('click','a',function(e) {
                    e.preventDefault();
                    $('.sub-menu:visible').slideToggle('fast');
                    if(($(this).attr("class"))!="active-submenu"){
                       $(this).next('.sub-menu').slideToggle('fast');
                       $('.menu-primary-navigation').find('.active-submenu').removeClass('active-submenu');
                      $('.menu-primary-navigation').children().addClass('plus-icon');
                   $(this).addClass('active-submenu').removeClass('plus-icon');
                     }else{
                      $(this).addClass('plus-icon').removeClass('active-submenu');
                     }




                });


                 $('#cssmenu > ul > li > a').click(function() {
                  var current = $(this);
                  $('.menu-primary-navigation > a').each(function(){



                        $(this).addClass('plus-icon').removeClass('active-submenu');
                       $(".sub-menu").css("display",'none');



                  });
                 $('#cssmenu li').removeClass('active');
                 $(this).closest('li').addClass('active');
                  var checkElement = $(this).next();
                  if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
                 $(this).closest('li').removeClass('active');
                  checkElement.slideUp('normal');
                }
                  if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
                  $('#cssmenu ul ul:visible').slideUp('normal');
                  checkElement.slideDown('normal');
                }
                  if($(this).closest('li').find('ul').children().length == 0) {
                  return true;
                } else {
                  return false;
                }
               });
});


            $(document).ready(function(c) {
                $('.close-btn').on('click', function(c){
                  $(this).parent().fadeOut('slow', function(c){
                  });
                });
              });


              // $(window).bind('resize', function(e)
                     // {
                      //  if (window.RT) clearTimeout(window.RT);
                      //  window.RT = setTimeout(function()
                      // {
                       //   this.location.reload(false); /* false to get page from cache */
                      //  }, 10);
                      //});
