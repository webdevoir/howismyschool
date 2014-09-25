<?php
if($noRecords){
    ?>
<div class="errordiv">
<?php echo t("No records found");?>
</div>
<?php
return;
}
?>
<div class="my-form-divs size-mgmt-box-edit">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                <?php echo $utility_obj->get_page_name($page_url,2);?>
            </h3>
        </div>
        <?php echo form_open_multipart($page_url, array('id' => 'productFrm',
                'method' => 'post' ));?>
        <?php echo $utility_obj->get_flash_message();?>

        <?php //Size Edit Section ?>
        <div class="col-md-6">
            <div class="box-body">
                <div class="form-group">
                <div class="form-group">
                    <label for="name">
                        <?php
    			            echo t('Name');
                            echo mr();
                        ?>
    			    </label>
        			<?php echo form_input($data = array(
            				'name'        => 'name',
            				'value'       => isset($_POST['name']) ?
            				trim($_POST['name']) :
            				trim($result_set['name']),
            				'id'          => 'name',
            				'tabindex'    => 1,
            				'maxlength'   => 255,
            				'placeholder' => t('Name'),
            				'class'       => 'form-control',
            				'required'    => 'required',
            				)
        			    );
                    ?>
    		    </div>

                <div class="form-group">
                    <label for="product_number">
                        <?php
                            echo t('Product Number');
                            echo mr();
                        ?>
                    </label>
                    <?php echo form_input($data = array(
                            'name'			=> 'product_number',
                            'value'			=> isset($_POST['product_number']) ?
                            trim($_POST['product_number']) :
                            trim($result_set['product_number']),
                            'id'			=> 'product_number',
                            'tabindex'		=> 2,
                            'maxlength'		=> 50,
                            'placeholder'	=> t('Product Number'),
                            'class'       	=> 'form-control',
                            'required'    	=> 'required',
                            )
                        );
                    ?>
                </div>

                <div class="form-group">
                    <label for="description">
                        <?php
                            echo t('Description');
                        ?>
                    </label>
                    <?php echo form_input($data = array(
                            'name'		=> 'description',
                            'value'		=> isset($_POST['description']) ?
                            trim($_POST['description']) :
                            trim($result_set['description']),
			                'id'          => 'description',
                            'tabindex'    => 3,
                            'maxlength'   => 255,
                            'placeholder' => t('description'),
                            'class'       => 'form-control',
                            )
                        );
                    ?>
                </div>

                <div class="form-group">
                    <label for="catalog">
                        <?php
                            echo t('Catalog');
                        ?>
                    </label>
                    <?php echo form_input($data = array(
  			                'name'        => 'catalog',
                            'value'		  => isset($_POST['catalog']) ?
                            trim($_POST['catalog']) :
                            trim($result_set['catalog']),
                            'id'          => 'catalog',
                            'tabindex'    => 4,
                            'maxlength'   => 255,
  			                'placeholder' => t('Catalog'),
  			                'class'       => 'form-control',
      			            )
             			);
                    ?>
                </div>

                <div class="form-group">
                    <label for="length">
                        <?php
                            echo t('Length');
                            echo mr();
                        ?>
                	</label>
                    <?php echo form_input($data = array(
			                'name'        => 'length',
                            'value'		  => isset($_POST['length']) ?
                            trim($_POST['length']) :
                            trim($result_set['length']),
			                'id'          => 'length',
                            'tabindex'    => 5,
                            'maxlength'   => 11,
			                'placeholder' => t('Length'),
			                'class'       => 'form-control',
						    'required'    => 'required',
			                )
           			    );
                    ?>
                </div>

                <div class="form-group">
                	<label for="breadth">
                	    <?php
                            echo t('Breadth');
					        echo mr();
                        ?>
                	</label>
                    <?php echo form_input($data = array(
			                'name'        => 'breadth',
                            'value'		  => isset($_POST['breadth']) ?
                            trim($_POST['breadth']) :
                            trim($result_set['breadth']),
			                'id'          => 'breadth',
                            'tabindex'    => 6,
                            'maxlength'   => 11,
			                'placeholder' => t('Breadth'),
			                'class'       => 'form-control',
						    'required'    => 'required',
			                )
           			    );
                    ?>
                </div>

				<div class="form-group">
                	<label for="width">
                	    <?php
                            echo t('Width');
					        echo mr();
                        ?>
                	</label>
                    <?php echo form_input($data = array(
			                'name'        => 'width',
                            'value'       => isset($_POST['width']) ?
                            trim($_POST['width']) :
                            trim($result_set['width']),
			                'id'          => 'width',
                            'tabindex'    => 7,
                            'maxlength'   => 11,
			                'placeholder' => t('Width'),
			                'class'       => 'form-control',
						    'required'    => 'required',
			                )
           			    );
                    ?>
                </div>

				<div class="form-group">
                	<label for="dimension_unit">
                	    <?php
                            echo t('Dimension Unit');
					        echo mr();
                        ?>
                    </label>
                    <?php echo form_input($data = array(
			                    'name'        => 'dimension_unit',
                                'value'		    => isset($_POST['dimension_unit']) ?
                                trim($_POST['dimension_unit']) :
                                trim($result_set['dimension_unit']),
			                    'id'          => 'dimension_unit',
                                'tabindex'    => 8,
                                'maxlength'   => 11,
			                    'placeholder' => t('Dimension Unit'),
			                    'class'       => 'form-control',
						        'required'    => 'required',
			                )
           			    );
                    ?>
                </div>

                <div class="form-group">
                    <label for="leed_distance">
                        <?php
                            echo t('Leed Distance');
                        ?>
                    </label>
                    <?php echo form_input($data = array(
                            'name'        => 'leed_distance',
                            'value'       => isset($_POST['leed_distance']) ?
                            trim($_POST['leed_distance']) :
                            trim($result_set['leed_distance']),
                            'id'          => 'leed_distance',
                            'tabindex'    => 9,
                            'maxlength'   => 255,
                            'placeholder' => t('Leed Distance'),
                            'class'       => 'form-control',
                            )
                        );
                    ?>
                </div>

                <div class="form-group">
                    <label for="recommended_cleaning">
                        <?php
                            echo t('Recommended Cleaning');
                        ?>
                    </label>
                    <?php echo form_input($data = array(
                            'name'        => 'recommended_cleaning',
                            'value'       => isset($_POST['recommended_cleaning']) ?
                            trim($_POST['recommended_cleaning']) :
                            trim($result_set['recommended_cleaning']),
                            'id'          => 'recommended_cleaning',
                            'tabindex'    => 10,
                            'maxlength'   => 100,
                            'placeholder' => t('Recommended Cleaning'),
                            'class'       => 'form-control',
                            )
                        );
                    ?>
                </div>

                <div class="form-group">
                    <label for="astm_type">
                        <?php
                            echo t('ASTM Type');
                        ?>
                    </label>
                    <?php echo form_input($data = array(
                            'name'        => 'astm_type',
                            'value'       => isset($_POST['astm_type']) ?
                            trim($_POST['astm_type']) :
                            trim($result_set['astm_type']),
                            'id'          => 'astm_type',
                            'tabindex'    => 11,
                            'maxlength'   => 50,
                            'placeholder' => t('ASTM Type'),
                            'class'       => 'form-control',
                            )
                        );
                    ?>
                </div>

                <div class="form-group">
                    <label for="master_format_2010">
                        <?php
                            echo t('Master Format');
                        ?>
                    </label>
                    <?php echo form_input($data = array(
                            'name'        => 'master_format_2010',
                            'value'       => isset($_POST['master_format_2010']) ?
                            trim($_POST['master_format_2010']) :
                            trim($result_set['master_format_2010']),
                            'id'          => 'master_format_2010',
                            'tabindex'    => 12,
                            'maxlength'   => 100,
                            'placeholder' => t('Master Format'),
                            'class'       => 'form-control',
                            )
                        );
                    ?>
                </div>

                <div class="form-group">
                    <label for="astm_specification">
                        <?php
                            echo t('ASTM Specification');
                        ?>
                    </label>
                    <?php echo form_input($data = array(
                            'name'        => 'astm_specification',
                            'value'       => isset($_POST['astm_specification']) ?
                            trim($_POST['astm_specification']) :
                            trim($result_set['astm_specification']),
                            'id'          => 'astm_specification',
                            'tabindex'    => 13,
                            'maxlength'   => 30,
                            'placeholder' => t('ASTM Specification'),
                            'class'       => 'form-control',
                            )
                        );
                    ?>
                </div>

                <div class="form-group">
                    <label for="test_date">
                        <?php
                            echo t('Test Date');
                        ?>
                    </label>
                    <?php echo form_input($data = array(
                            'name'        => 'test_date',
                            'value'       => isset($_POST['test_date']) ?
                            trim($_POST['test_date']) :
                            trim($result_set['test_date']),
                            'id'          => 'test_date',
                            'tabindex'    => 14,
                            'maxlength'   => 30,
                            'placeholder' => t('Test Date in \'0000-00-00\' format'),
                            'class'       => 'form-control',
                            )
                        );
                    ?>
                </div>

                <div class="form-group">
                    <label for="efflorescence">
                        <?php
                            echo t('Efflorescence');
                        ?>
                    </label>
                    <?php echo form_input($data = array(
                            'name'        => 'efflorescence',
                            'value'       => isset($_POST['efflorescence']) ?
                            trim($_POST['efflorescence']) :
                            trim($result_set['efflorescence']),
                            'id'          => 'efflorescence',
                            'tabindex'    => 15,
                            'placeholder' => t('Efflorescence'),
                            'class'       => 'form-control',
                            )
                        );
                    ?>
                </div>

                <div class="form-group">
                    <label for="percent_void">
                        <?php
                            echo t('Percent Void');
                        ?>
                    </label>
                    <?php echo form_input($data = array(
                            'name'        => 'percent_void',
                            'value'       => isset($_POST['percent_void']) ?
                            trim($_POST['percent_void']) :
                            trim($result_set['percent_void']),
                            'id'          => 'percent_void',
                            'tabindex'    => 16,
                            'maxlength'   => 10,
                            'placeholder' => t('Percent Void'),
                            'class'       => 'form-control',
                            )
                        );
                    ?>
                </div>

                <div class="form-group">
                    <label for="min_thickness_of_face_shells">
                        <?php
                            echo t('Min Thickness of Face Shells');
                        ?>
                    </label>
                    <?php echo form_input($data = array(
                            'name'        => 'min_thickness_of_face_shells',
                            'value'       => isset($_POST['min_thickness_of_face_shells']) ?
                            trim($_POST['min_thickness_of_face_shells']) :
                            trim($result_set['min_thickness_of_face_shells']),
                            'id'          => 'min_thickness_of_face_shells',
                            'tabindex'    => 17,
                            'maxlength'   => 30,
                            'placeholder' => t('Min Thickness of Face Shells'),
                            'class'       => 'form-control',
                            )
                        );
                    ?>
                </div>

                <div class="form-group">
                    <label for="equivalent_web_thickness">
                        <?php
                            echo t('Equivalent Web Thickness');
                        ?>
                    </label>
                    <?php echo form_input($data = array(
                            'name'        => 'equivalent_web_thickness',
                            'value'       => isset($_POST['equivalent_web_thickness']) ?
                            trim($_POST['equivalent_web_thickness']) :
                            trim($result_set['equivalent_web_thickness']),
                            'id'          => 'equivalent_web_thickness',
                            'tabindex'    => 18,
                            'maxlength'   => 10,
                            'placeholder' => t('Equivalent Web Thickness'),
                            'class'       => 'form-control',
                            )
                        );
                    ?>
                </div>

                <div class="form-group">
                    <label for="recycled_content_percent">
                        <?php
                            echo t('Recycled Content Percent');
                        ?>
                    </label>
                    <?php echo form_input($data = array(
                            'name'        => 'recycled_content_percent',
                            'value'       => isset($_POST['recycled_content_percent']) ?
                            trim($_POST['recycled_content_percent']) :
                            trim($result_set['recycled_content_percent']),
                            'id'          => 'recycled_content_percent',
                            'tabindex'    => 19,
                            'maxlength'   => 12,
                            'placeholder' => t('Recycled Content Percent'),
                            'class'       => 'form-control',
                            )
                        );
                    ?>
                </div>

                <div class="form-group">
                    <label for="qty_per_sf">
                        <?php
                            echo t('Qty Per SF');
                        ?>
                    </label>
                    <?php echo form_input($data = array(
                            'name'        => 'qty_per_sf',
                            'value'       => isset($_POST['qty_per_sf']) ?
                            trim($_POST['qty_per_sf']) :
                            trim($result_set['qty_per_sf']),
                            'id'          => 'qty_per_sf',
                            'tabindex'    => 20,
                            'maxlength'   => 12,
                            'placeholder' => t('Qty Per SF'),
                            'class'       => 'form-control',
                            )
                        );
                    ?>
                </div>

                <div class="form-group">
                    <label for="product_water_absorption_types">
                        <?php
                            echo t('Product Water Absorption Types');
                        ?>
                    </label>
                    <?php echo form_input($data = array(
                            'name'        => 'product_water_absorption_types',
                            'value'       => isset($_POST['product_water_absorption_types']) ?
                            trim($_POST['product_water_absorption_types']) :
                            trim($result_set['product_water_absorption_types']),
                            'id'          => 'product_water_absorption_types',
                            'tabindex'    => 21,
                            'maxlength'   => 255,
                            'placeholder' => t('Product Water Absorption Types'),
                            'class'       => 'form-control',
                            )
                        );
                    ?>
                </div>

                <div class="form-group">
                    <label for="weight_pounds">
                        <?php
                            echo t('Weight Pounds');
                        ?>
                    </label>
                    <?php echo form_input($data = array(
                            'name'        => 'weight_pounds',
                            'value'       => isset($_POST['weight_pounds']) ?
                            trim($_POST['weight_pounds']) :
                            trim($result_set['weight_pounds']),
                            'id'          => 'weight_pounds',
                            'tabindex'    => 22,
                            'maxlength'   => 12,
                            'placeholder' => t('Weight Pounds'),
                            'class'       => 'form-control',
                            )
                        );
                    ?>
                </div>

                <div class="form-group">
                    <label for="compressive_strength_psi">
                        <?php
                            echo t('Compressive Strength PSI');
                        ?>
                    </label>
                    <?php echo form_input($data = array(
                            'name'        => 'compressive_strength_psi',
                            'value'       => isset($_POST['compressive_strength_psi']) ?
                            trim($_POST['compressive_strength_psi']) :
                            trim($result_set['compressive_strength_psi']),
                            'id'          => 'compressive_strength_psi',
                            'tabindex'    => 23,
                            'maxlength'   => 20,
                            'placeholder' => t('Compressive Strength PSI'),
                            'class'       => 'form-control',
                            )
                        );
                    ?>
                </div>

                <div class="form-group">
                    <label for="specifications">
                        <?php
                            echo t('Specifications');
                        ?>
                    </label>
                    <?php echo form_input($data = array(
                            'name'        => 'specifications',
                            'value'       => isset($_POST['specifications']) ?
                            trim($_POST['specifications']) :
                            trim($result_set['specifications']),
                            'id'          => 'specifications',
                            'tabindex'    => 24,
                            'maxlength'   => 255,
                            'placeholder' => t('Specifications'),
                            'class'       => 'form-control',
                            )
                        );
                    ?>
                </div>

                <div class="form-group">
                    <label for="manufacturer_id">
                        <?php
                            echo t('Manufacturer');
                            echo mr();
                        ?>
                    </label>
                    <?php echo form_dropdown(
                        'manufacturer_id',
                        $manufacturers_array,
                        $selected_manufacturer,
                        'id = "manufacturer_id" tabindex ="25"
                        class = "form-control" required'
                        );
                    ?>
                </div>

                <div class="form-group">
                    <label for="size_id">
                        <?php
                            echo t('Size');
                            echo mr();
                        ?>
                    </label>
                    <?php echo form_dropdown(
                        'size_id',
                        $size_array,
                        $selected_size,
                        'id = "size_id" tabindex ="26"
                        class = "form-control" required'
                        );
                    ?>
                </div>

                <div class="form-group">
                    <label for="plant_id">
                        <?php
                            echo t('Plant');
                            echo mr();
                        ?>
                    </label>
                    <?php echo form_dropdown(
                        'plant_id',
                        $plant_array,
                        $selected_plant,
                        'id = "plant_id" tabindex ="27"
                        class = "form-control" required'
                        );
                    ?>
                </div>

                <div class="form-group">
                    <label for="texture_id">
                        <?php
                            echo t('Texture');
                            echo mr();
                        ?>
                    </label>
                    <?php echo form_dropdown(
                        'texture_id',
                        $texture_array,
                        $selected_texture,
                        'id = "texture_id" tabindex ="28"
                        class = "form-control" required'
                        );
                    ?>
                </div>

                <div class="form-group">
                    <label for="color_id">
                        <?php
                            echo t('Color');
                            echo mr();
                        ?>
                    </label>
                    <?php echo form_dropdown(
                        'color_id',
                        $color_array,
                        $selected_color,
                        'id = "color_id" tabindex ="29"
                        class = "form-control" required'
                        );
                    ?>
                </div>

                <div class="form-group">
                    <label for="image_path">
                        <?php
                            echo t('Product Logo Image');
                        ?>
                    </label>
                    <div id="siteLogoContainer">
                        <?php
                            if( !empty($logo_image_name) && file_exists($image_physical_path.'/'.$logo_image_name) ) {
                        ?>
                        <img src="<?php echo $image_url_path;?>/<?php echo $logo_image_name;?>?id=<?php echo rand();?>"
                        title="<?php echo t('Product logo image');?>" />
                        <?php
                            }
                        ?>
                        <input type="hidden" name="old_logo_image" id="old_logo_image"
                        value="<?php echo $logo_image_name; ?>" />
                    </div>

                    <span class="btn btn-primary fileinput-button">
                        <span><?php echo t('Select & Upload File');?></span>
                        <?php echo form_upload($data = array(
                                'name'        => 'image_path',
                                'value'       => '',
                                'id'          => 'image_path',
                                'tabindex'    => 30,
                                'placeholder' => t('Product logo image')
                                )
                            );
                        ?>
                    </span>
                </div>

                <div class="form-group">
                    <label for="variant_image">
                        <?php
                            echo t('Product Variant Image');
                        ?>
                    </label>
                    <div id="siteVariantContainer">
                        <?php
                            if(!empty($variant_image_name) &&
                            file_exists($image_physical_path.'/'.$variant_image_name)){
                        ?>
                        <a href=
                        "<?php echo $image_url_path;?>/<?php echo $variant_image_name;?>?id=<?php echo rand();?>"
                        title="<?php echo t('Product variant image');?>" target="_blank">
                            <?php echo $variant_image_name;?>
                        </a>
                        <?php
                            }
                        ?>
                        <input type="hidden" name="old_variant_image" id="old_variant_image"
                        value="<?php echo $variant_image_name; ?>" />
                    </div>

                    <span class="btn btn-primary fileinput-button">
                        <span><?php echo t('Select & Upload File');?></span>
                        <?php echo form_upload($data = array(
                                'name'        => 'variant_image',
                                'value'       => '',
                                'id'          => 'variant_image',
                                'tabindex'    => 31,
                                'placeholder' => t('Product variant image')
                                )
                            );
                        ?>
                    </span>
                </div>

                <?php
                    $isActive = isset($_POST['is_active']) ? trim($_POST['is_active'])
                    : $result_set['is_active'];
                    $c1 = $c2 = FALSE;
                    $isActive == 1 ? $c1 = true : $c2 = true;
                    $data = array(
                        'name'	=> 'is_active',
                        'id'		=> 'is_active',
                        'value'	=> '1',
                        'checked' => $c1,
                        'class'	=> 'form_control',
                        'tabindex'=> 31
                    );
                ?>
                <div class="form-group radioInline">
                    <label>
                        <?php
                            echo t('Active');
                            echo mr();
                        ?>
                    </label>
                    <div class="radio">
                        <label>
                            <?php echo form_radio($data);?> &nbsp;
                            <?php echo t('Yes');?>
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <?php
                                $data['value'] = 0;
                                $data['checked'] = $c2;
                                $data['tabindex'] = 4;
                                echo form_radio($data);
                            ?>
                            &nbsp;
                            <?php echo t('No');?>
                        </label>
                    </div>
                    <div class="cb"></div>
                </div>
                </div>

                <button class="btn btn-primary save-btn" name="submit" value="submit"
                type="submit" tabindex="5">
                <?php echo t('Save');?>
                </button>
                <button class="btn btn-primary" name="clsSubmit" value="clsSubmit"
                type="button" onclick="closeFancyBoxParent()" tabindex="6">
                <?php echo t('Close');?>
                </button>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
  var maxHeight = 220;
  $(".slimDiv").each(function(){
    if($(this).height() > maxHeight){
      $(this).slimscroll({
        height: maxHeight+"px",
        alwaysVisible: true,
        size: '10px',
    	railVisible: true,
    	railColor: '#222',
    	railOpacity: 0.3,
    	wheelStep: 10,
    	allowPageScroll: false,
    	disableFadeOut: true
      });
      $(this).css('height',parseInt(maxHeight-20));
    }
  });
  if($('#menuAccordion')){
     $( "#menuAccordion" ).accordion({
       heightStyle: "content",//no auto height
       collapsible : true
     });
  }
});
</script>
