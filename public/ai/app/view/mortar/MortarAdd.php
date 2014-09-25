<div class="my-form-divs size-mgmt-box">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
             <?php echo $utility_obj->get_page_name($page_url,2);?>
            </h3>
        </div>
        <?php echo form_open_multipart($page_url, array('id' => 'mortarFrm',
            'method' => 'post' ));?>
            <?php echo $utility_obj->get_flash_message();?>
            <div class="box-body">
                <div class="form-group">
                	<label for="name">
                	 <?php
                    echo t('Mortar Name');
                    echo mr();
                   ?>
                	 </label>
                    <?php echo form_input($data = array(
			              'name'        => 'name',
                          'value'   => isset($_POST['name']) ?
                           trim($_POST['name']) :
                           trim($result_set['name']),
			              'id'          => 'name',
                          'tabindex'    => 1,
                          'maxlength'   => 100,
			              'placeholder' => t('Mortar Name'),
			              'class'       => 'form-control',
						  'required'    => 'required',
			            )
           			   );?>
                 </div>
				  <div class="form-group">
                	<label for="image_path">
                	 <?php
                    echo t('Image');
                   ?>
                	</label>
                    <span class="btn btn-primary fileinput-button">
                        <span><?php
                         echo t('Select & Upload File');?>
                         </span>
							<?php echo form_upload($data = array(
								'name'=> 'image_path',
								'value'   => '',
								'id'          => 'image_path',
								'tabindex'    => 2,
								'placeholder' => t('Mortar image')
						   )
						);?>
					</span>
                 </div>
				 <div class="form-group">
                	<label for="thickness">
                	 <?php
                    echo t('Thickness');
					echo mr();
                   ?>
                	 </label>
                    <?php echo form_input($data = array(
			              'name'		=> 'thickness',
                          'value'		=> isset($_POST['thickness']) ?
                           trim($_POST['thickness']) :
                           trim($result_set['thickness']),
			              'id'          => 'thickness',
                          'tabindex'    => 3,
                          'maxlength'   => 11,
			              'placeholder' => t('Thickness'),
			              'class'       => 'form-control',
						  'required'    => 'required',
			            )
           			   );?>
                 </div>
				 <div class="form-group">
                	<label for="thickness_unit">
                	 <?php
                    echo t('Thickness Unit');
					echo mr();
                   ?>
                	 </label>
                    <?php echo form_input($data = array(
			              'name'        => 'thickness_unit',
                          'value'		=> isset($_POST['thickness_unit']) ?
                           trim($_POST['thickness_unit']) :
                           trim($result_set['thickness_unit']),
			              'id'          => 'thickness_unit',
                          'tabindex'    => 4,
                          'maxlength'   => 50,
			              'placeholder' => t('Thickness Unit'),
			              'class'       => 'form-control',
						  'required'    => 'required',
			            )
           			   );?>
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
                        'id = "manufacturer_id" tabindex ="5"
                        class = "form-control" required'
                        );
                    ?>
                </div>
                 <?php
                 $is_active = isset($_POST['is_active']) ? trim($_POST['is_active']) : 1;
                 $c1 = $c2 = FALSE;
                 $is_active == 1 ? $c1 = true : $c2 = true;
                 $data = array(
                    'name' => 'is_active',
                    'id' => 'is_active',
                    'value' => '1',
                    'checked' => $c1,
                    'class' => 'form_control',
                    'tabindex' => 6
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
                            <?php echo form_radio($data);?>
                            &nbsp;<?php echo t('Yes');?>
               			</label>
           			</div>
           			<div class="radio">
                    	<label>
                            <?php
                            $data['value'] = 0;
                            $data['checked'] = $c2;
                            $data['tabindex'] = 4;
                            echo form_radio($data);?>
                            &nbsp;<?php echo t('No');?>
               			</label>
           			</div>
           			<div class="cb"></div>
                 </div>
            </div>
            <div class="box-footer">
                <button class="btn btn-primary" name="submit" value="submit"
                 type="submit" tabindex="5"><?php echo t('Save');?>
                </button>
                 <button class="btn btn-primary" name="clsSubmit"
                value="clsSubmit" type="button" onclick="closeFancyBoxParent()"
                tabindex="6"><?php echo t('Close');?>
                </button>
            </div>
        <?php echo form_close();?>
    </div>
</div>