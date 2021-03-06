$(document).ready(function(){

  // Toggle Products List
  $("#products_toggle").click(function(){
    var productList = $(this).data("toggle");
    $(productList).toggle();
  });

  // Toggle Mortars List
  $("#mortars_toggle").click(function(){
    var mortarList = $(this).data("toggle");
    $(mortarList).toggle();
  });

  // Toggle Brick Types List
  $("#bricks_type_toggle").click(function(){
    var brickTypeList = $(this).data("toggle");
    $(brickTypeList).toggle();
  });

  // Toggle Brick Types List
  $("#bricks_toggle").click(function(){
    var bricksList = $(this).data("toggle");
    $(bricksList).toggle();
  });

  $(document).on("click", "a.product", function(){
    if(!$(this).parent().hasClass("active")){
      $("a.product").parent().removeClass("active");
      var product = $(this);
      product.parent().addClass("active");
      AccurateImage.renderProductData(parseInt(product.data("product_index") ) );
    }
  });

  $(document).on("click", "a.mortar", function(){
    if(!$(this).parent().hasClass("active")){

      $("a.mortar").parent().removeClass("active");
      var mortar = $(this);
      mortar.parent().addClass("active");

      // set this to selected mortar in accurate image module
      AccurateImage.setSelectedMortar(parseInt(mortar.data("mortar_index") ) );
    }

  });

  $(document).on("click", "a.brick-type", function(){
    if(!$(this).parent().hasClass("active")){

      $("a.brick-type").parent().removeClass("active");
      var brickType = $(this);
      brickType.parent().addClass("active");

      // Show the bricks of the selected brick type
      AccurateImage.setSelectedBrickType(parseInt(brickType.data("brick_type_index") ) );
      AccurateImage.renderBricks(parseInt(brickType.data("brick_type_index") ) );
    }

  });

  $(document).on("click", "a.brick", function(){
    if(!$(this).parent().hasClass("active")){
      $("a.brick").parent().removeClass("active");
      var brick = $(this);
      brick.parent().addClass("active");

      AccurateImage.setSelectedBrick(parseInt(brick.data("brick_index") ) );
    }
  });

  $(document).on("click", "a.coursing", function(){
    var coursing = $(this).data("coursing");
    AccurateImage.setSelectedCoursing(coursing);
  });

  $(document).on("click", "a.select-wall-type", function(){
    var wallDimension = $(this).data("wall_type");
    AccurateImage.selectedWallDimesions = wallDimension;
    AccurateImage.drawDefaultWall();
    AccurateImage.pushChangeToUndoRedoStack();
  });

  $(document).on("click", "span.item", function(){
    if($("#AIMenu").is(":visible")){
      return;
    }

    AccurateImage.fillMortarItem($(this));
    // AccurateImage.fillBrickItem($(this));
    AccurateImage.fillCoursing($(this));
    AccurateImage.setRandomBrick($(this));
    AccurateImage.enableContextMenu();

    AccurateImage.pushChangeToUndoRedoStack();
  });

  $(document).on("click", "a#save_as_image", function(){
    AccurateImage.saveAsImage();
  });

  $(document).on("click", "a.zoom", function(){
    var scale = parseInt($(this).data("zoom"));
    AccurateImage.zoomWallBy(scale);
  });

  $(document).on("click", "a.select-stagger", function(){
    var stagger = parseInt($(this).data("stagger"));
    AccurateImage.staggerWallBy(stagger);
    AccurateImage.pushChangeToUndoRedoStack();
  });

  $(document).on("click", "a#undo", function(){
    AccurateImage.undo();
  });

  $(document).on("click", "a#redo", function(){
    AccurateImage.redo();
  });

  $(document).ready(function(){
    $("form#customWallForm").submit(function(){
      var wallDimension = $("#x").val() + "x" + $("#y").val();
      AccurateImage.selectedWallDimesions = wallDimension;
      AccurateImage.drawDefaultWall();
      AccurateImage.pushChangeToUndoRedoStack();
      return false;
    });
  });

});