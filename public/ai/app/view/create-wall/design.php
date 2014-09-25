 <script type="text/javascript">

$(window).ready(

  function() {

    $("#user_designs_list_container, #wall").niceScroll();

    $("#leftpanelDiv").niceScroll({
      cursorwidth: "5px",
      hidecursordelay: 0
    });

    $(".wall-seam").niceScroll();

    }

);

</script>
<!-- Fixed header -->
<div id="ajax-loader"></div>

<div class="stickheader" id="top-tool-bar">
  <div class="container-fluid">
    <div class="row">
      <div  class="col-xs-2 text-center">
        <table>
          <tr>
            <td>
              <a href="#" class="btn-leftbar" id="left-boxDiv" data-toggle="#manufacturers_list">
                <i class="fa fa-ellipsis-v"></i>
              </a>
            </td>
            <td> <img class="logo-img" src="../assets/images/accurate-image/logo.png"/> </td>
          </tr>
        </table>
      </div>
      <div  class="col-xs-9">
        <div id="wrapper">
          <div id="scroller">
            <ul id="thelist" class="main-nav">
              <li class="active">
                <i class="stack-icon select-stagger" data-stagger="0"></i>
                Stack
              </li>
              <li>
                <i class="runing-icon select-stagger" data-stagger="2"></i>
                Running
              </li>
              <li>
                <i class="third-icon select-stagger" data-stagger="3"></i>
                Third
              </li>
              <li class="active">
                <i class="coursing-icon coursing" data-coursing="standard"></i>
                Standard
              </li>
              <li>
                <i class="soilder-icon coursing" data-coursing="running"></i>
                Soldier
              </li>
              <li>
                <i class="header-icon coursing" data-coursing="headers"></i>
                Headers
              </li>
              <li>
                <i class="reset-icon reset-mortor"></i>
                Reset Mortor
              </li>
              <li>
                <i class="undo-icon" id="undo"></i>
                Undo
              </li>
              <li>
                <i class="redo-icon" id="redo" ></i>
                Redo
              </li>
              <li>
                <i class="zoomin-icon zoom zoom-in"></i>
                Zoom In
              </li>
              <li>
                <i class="zoomout-icon zoom zoom-out"></i>
                Zoom Out
              </li>
              <li>
                <i class="sizetool-icon" id="size-tool"></i>
                Size Tool
              </li>
              <li>
                <i class="advSearch-icon"></i>
                Search
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div  class="col-xs-1 text-right">
        <a href="#"  class="dropdown-toggle right-menu">
          <i class="fa fa-bars"></i>
        </a>
        <div class="dropdown-menu" role="menu">
          <div id='cssmenu'>
            <ul>
              <li class='has-sub '>
                <a href='#'>
                  <span> <i class="fa fa-pencil-square-o"></i> File</span>
                </a>
                <ul>
                  <!-- <li>
                    <a href='javascript:void(0);' id='file-new-design'>
                      <span>New</span>
                    </a>
                  </li> -->
                  <li>
                    <a href='javascript:void(0);' id='file-save-design'>
                      <span>Save Design</span>
                    </a>
                  </li>
                  <li class='has-sub'>
                      <div class="menu-primary-navigation">
                    <a href='javascript:void(0);' id='file-save-image' class="plus-icon">
                      <span>Save Image</span>
                    </a>
                    <ul class="sub-menu" style="display: none; ">
                      <li>
                        <a href='javascript:void(0);' id='file-save-image-seamless'>
                          <span>- Seamless Tile</span>
                        </a>
                      </li>
                      <li>
                        <a href='javascript:void(0);' id='file-save-image-wall'>
                          <span>- Wall Image</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                  </li>
                  <li id="user_sign_in_links"></li>
                  <li>
                    <a href='javascript:void(0);' id='print-design'>
                      <span>Print</span>
                    </a>
                  </li>
                  <!-- <li>
                    <a href='javascript:void(0);' id='exit-system'>
                      <span>Exit</span>
                    </a>
                  </li> -->
                </ul>
              </li>
              <li class='has-sub'>
                <a href='#'>
                  <span><i class="fa fa-eye"></i> View</span>
                </a>
                <ul>
                  <li>
                    <a href='javascript:void(0);' id="tool-bar-hide" class="">
                      <span>Tool Bar</span>
                    </a>
                  </li>
                  <li>
                    <a href='javascript:void(0);' class="zoom zoom-in">
                      <span>Zoom In</span>
                    </a>
                  </li>
                  <li>
                    <a href='javascript:void(0);' class="zoom zoom-out">
                      <span>Zoom Out</span>
                    </a>
                  </li>
                </ul>
              </li>
              <li class='has-sub'>
                <a href='#'>
                  <span><i class="fa fa-picture-o"></i>Image</span>
                </a>
                <ul >
                  <li>
                    <div class="menu-primary-navigation">
                    <a href='javascript:void(0);' id='build-new-image' class="plus-icon">
                      <span>Build New Image</span>
                    </a>
                    <ul class="sub-menu" style="display: none; ">
                      <li>
                        <a href='javascript:void(0);' class="select-wall-type" data-wall_type="5x5" >
                          <span>- 5 by 5 units</span>
                        </a>
                      <li>
                        <a href='javascript:void(0);' class="select-wall-type" data-wall_type="10x10" >
                          <span>- 10 by 10 units</span>
                        </a>
                      <li>
                        <a href='javascript:void(0);' class="select-wall-type" data-wall_type="25x25" >
                        <span>- 25 by 25 units</span>
                      </a>
                      <li>
                        <a href='javascript:void(0);' id='file-new-design'>
                          <span>- Custom Size</span>
                        </a>
                    </ul>
                     </div>
                  </li>
                  <li>
                   <div class="menu-primary-navigation">
                    <a href='javascript:void(0);' id='fill-stagger' class="plus-icon">
                      <span>Fill</span>
                    </a>
                    <ul class="sub-menu" style="display: none; ">
                      <li>
                        <a href='javascript:void(0);' class="select-stagger" data-stagger="0" >
                          <span>- No Stagger</span>
                        </a>
                      <li>
                        <a href='javascript:void(0);' class="select-stagger" data-stagger="2" >
                          <span>- Stagger 1/2 Unit</span>
                        </a>
                      <li>
                        <a href='javascript:void(0);' class="select-stagger" data-stagger="3" >
                          <span>- Stagger 1/3 Unit</span>
                        </a>
                    </ul>
                    </div>
                  </li>
                  <li>
                    <div class="menu-primary-navigation">
                    <a href='javascript:void(0);' id='fill-random' class="plus-icon">
                      <span>Fill Random</span>
                    </a>
                    <ul id="fill-random-sublinks" class="sub-menu" style="display: none; ">
                      <li>
                        <a href='javascript:void(0);' class="fill-random" data-percent="10" >
                          <span>- 10%</span>
                        </a>
                      <li>
                        <a href='javascript:void(0);' class="fill-random" data-percent="20" >
                          <span>- 20%</span>
                        </a>
                      <li>
                        <a href='javascript:void(0);' class="fill-random" data-percent="30" >
                          <span>- 30%</span>
                        </a>
                      <li>
                        <a href='javascript:void(0);' class="fill-random" data-percent="40" >
                          <span>- 40%</span>
                        </a>
                      <li>
                        <a href='javascript:void(0);' class="fill-random" data-percent="50" >
                          <span>- 50%</span>
                        </a>
                    </ul>
                    </div>
                  </li>

                  <li>
                     <div class="menu-primary-navigation">
                    <a href='javascript:void(0);' id='coursing' class="plus-icon">
                      <span>Coursing</span>
                    </a>
                    <ul class="sub-menu" style="display: none; ">
                      <li>
                        <a href='javascript:void(0);' class="coursing" data-coursing="standard" >
                          <span>- Standard Coursing</span>
                        </a>
                      <li>
                        <a href='javascript:void(0);' class="coursing" data-coursing="running" >
                          <span>- Soldier Coursing</span>
                        </a>
                      <li>
                        <a href='javascript:void(0);' class="coursing" data-coursing="headers" >
                          <span>- Headers</span>
                        </a>
                    </ul>
                     </div>
                  </li>
                    <li>
                    <a href='javascript:void(0);' class='reset-mortor' >
                      <span>Reset Mortor</span>
                    </a>
                  </li>
                </ul>

              </li>
              <li class="has-sub">
                <a href="#"><span><i class="fa fa-th"></i> Products</span></a>
                <ul style="display: none;">
                  <li><a href="#"><span>menu 1</span></a></li>
                  <li><a href="#"><span>menu 2</span></a></li>
                </ul>
              </li>
              <li class='has-sub'>
                <a href='#'>
                  <span><i class="fa fa-question-circle"></i> Help</span>
                </a>
                <ul>
                  <li>
                    <a href='#'><span>Help Topics</span></a>
                  </li>
                  <li>
                    <a href='#'><span>About Masonry Designer</span></a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<a id="bring-back-toolbar" class="pull-right hide bring-back-toolbar">
<button id="btnTop"><i class="fa fa-chevron-up"></i> </button>
</a>

<div class="sepreater-window"></div>
<!-- Left panel -->
<div class="hiddenDiv" id="leftpanelDiv">
<!-- Nav tabs -->
  <ul class="nav nav-tabs left-tabs" role="tablist">
    <li class="active">
      <a href="#manufacturers" id="manufacturers_list_tab" class="tabs" role="tab" data-toggle="tab">
        Manufacturers
      </a>
    </li>
    <li>
      <a href="#manufacturer_prodcuts" id="manufacturers_prodcuts_list_tab" class="tabs" role="tab" data-toggle="tab">
        Products
      </a>
    </li>
  </ul>
  <!-- Tab panes -->
  <div class="tab-content">
    <div class="tab-pane active" id="manufacturers">
      <div class="accordion innerContainer" id="manufacturers_list">
      </div>
    </div>
    <div class="tab-pane" id="manufacturer_prodcuts">
      <div class="accordion innerContainer" id="manufacturers_prodcuts_list">
      </div>
    </div>
  </div>
</div>
<!-- Begin page content -->
<div class="container-fluid" >
  <div class="row">
    <div  id="wall" class="col-sm-12 overflow-auto" >
      <div class="scale" id="full-wall" >
      </div>
      <ul id="AIMenu" class="contextMenu">
        <li><a href="#fillRow">Fill Row</a></li>
        <li><a href="#fillEven">Fill Even</a></li>
        <li><a href="#staggerRowNone" class="select-stagger-right-click" data-stagger="0">Stagger None</a></li>
        <li><a href="#staggerRowHalf" class="select-stagger-right-click" data-stagger="2">Stagger Half</a></li>
        <li><a href="#staggerRowOneThird" class="select-stagger-right-click" data-stagger="3">Stagger One Third</a></li>
        <li>
          <a href="#set-1" class="select-stagger-right-click" data-stagger="2">
            Set 1
          </a>
        </li>
        <li>
          <a href="#set-2" class="select-stagger-right-click" data-stagger="2">
            Set 2
          </a>
        </li>
        <li>
          <a href="#set-3" class="select-stagger-right-click" data-stagger="2">
            Set 3
          </a>
        </li>
        <li>
          <a href="#set-4" class="select-stagger-right-click" data-stagger="2">
            Set 4
          </a>
        </li>
        <li>
          <a href="#set-5" class="select-stagger-right-click" data-stagger="2">
            Set 5
          </a>
        </li>
        <li>
          <a href="#set-6" class="select-stagger-right-click" data-stagger="2">
            Set 6
          </a>
        </li>
        <li>
          <a href="#set-7" class="select-stagger-right-click" data-stagger="2">
            Set 7
          </a>
        </li>
        <li>
          <a href="#set-8" class="select-stagger-right-click" data-stagger="2">
            Set 8
          </a>
        </li>
        <li>
          <a href="#set-9" class="select-stagger-right-click" data-stagger="2">
            Set 9
          </a>
        </li>
        <li>
          <a href="#set-10" class="select-stagger-right-click" data-stagger="2">
            Set 10
          </a>
        </li>
        <li>
          <a href="#set-11" class="select-stagger-right-click" data-stagger="2">
            Set 11
          </a>
        </li>
        <li>
          <a href="#set-12" class="select-stagger-right-click" data-stagger="2">
            Set 12
          </a>
        </li>
        <li>
          <a href="#set-13" class="select-stagger-right-click" data-stagger="2">
            Set 13
          </a>
        </li>
        <li>
          <a href="#set-14" class="select-stagger-right-click" data-stagger="2">
            Set 14
          </a>
        </li>
        <li>
          <a href="#set-15" class="select-stagger-right-click" data-stagger="2">
            Set 15
          </a>
        </li>
        <li>
          <a href="#set-16" class="select-stagger-right-click" data-stagger="2">
            Set 16
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>
<div class="footer">
  <div class="container-fluid">
    <div class="row">
      <div  class="col-xs-9">
        <table class="table ">
          <tr>
            <td>
              <a href="">
                <img src="../assets/images/accurate-image/acme-tilestone-logo.png"/>
              </a>
            </td>
            <td>
              <a href="">
                <img src="../assets/images/accurate-image/american-tilestone-logo.png"/>
              </a>
            </td>
            <td>
              <a href="">
                <img src="../assets/images/accurate-image/featherlite-logo.png"/>
              </a>
            </td>
            <td>
              <a href="">
                <img src="../assets/images/accurate-image/ibg-logo.png"/>
              </a>
            </td>
            <td>
              <a href="">
                <img src="../assets/images/accurate-image/texasquerries-logo.png"/>
              </a>
            </td>
          </tr>
        </table>
      </div>
      <div  class="col-xs-3">
        <ul class="social-icon-list">
          <li><a href=""> <i class="fa fa-facebook-square"></i></a></li>
          <li><a href=""> </a></li>
          <li><a href=""><i class="fa fa-instagram"></i> </a></li>
          <li><a href=""> <i class="fa fa-pinterest-square"></i></a></li>
          <li><a href=""><i class="fa fa-twitter-square"></i> </a></li>
          <li>
            <button type="submit" class="btnBottom">
              <i class="fa fa-chevron-up test" ></i>
            </button>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- bottom property content panel -->
<div class="bottom-panel">
  <button type="submit" class="btnBottom" id="bottom_panel_button">
    <i class="fa fa-chevron-up test" ></i>
  </button>
  <div id="bottom-container">
    <div class="row">
      <div class="col-xs-11">
        <div class="product-property-cont">
          <h2> Product Property</h2>
          <p>LoreumLoreum ipsum dummy text.Loreum ipsum dummy text.Loreum ipsum
            dummy text.Loreum ipsum dummy text.Loreum  ipsum dummy text.
            ipsum dummy text.
          </p>
          <div class="row">
            <div class="col-xs-3">
              <strong>Material(s)</strong>
              <p>Abita springs</p>
            </div>
            <div class="col-xs-3">
              <strong>Size</strong>
              <p>Builder special</p>
            </div>
            <div class="col-xs-3">
              <strong>Color Family</strong>
              <p>Red, Browns</p>
            </div>
            <div class="col-xs-3">
              <strong>Manufacturer</strong>
              <p>ACME Brick</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-1">
        <button class="popup-icon show-popup" data-showpopup="1" style="display:none;">
          <i class="fa fa-ellipsis-v"></i>
        </button>
      </div>
    </div>
  </div>
</div>

<div class="overlay-bg">
  <div class="overlay-content popup1" >
  <div   id="lightbox-content">
  </div>
  <button class="close-btn"><i class="fa fa-times"></i></button>
</div>
<div id="full-wall-copy"></div>
</div>
<!-- Core JavaScript -->

<script type="text/javascript">
  var myScroll;
  function loaded() {
    myScroll = new iScroll('wrapper');
  }

  document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);

  document.addEventListener('DOMContentLoaded', loaded, false);

</script>