<div class="my-form-divs role-mgmt-box">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
             <?php echo $utility_obj->get_page_name($pageURL,2);?>
            </h3>
        </div>
        <?php echo form_open_multipart($pageURL, array('id' => 'userFrm', 
            'method' => 'post' ));?>
            <?php echo $utility_obj->get_flash_message();?>
            <div class="box-body">
                <div class="form-group">
                	<label for="role_name">
                	 <?php 
                    echo t('Role Name');
                    echo mr();
                   ?>
                	 </label>
                    <?php echo form_input($data = array(
			              'name'        => 'role_name',
                          'value'   => isset($_POST['role_name']) ? 
                           trim($_POST['role_name']) :
                           trim($resultSet['role_name']),  
			              'id'          => 'role_name',
                          'tabindex'    => 1,
                          'maxlength'   => 50,   			              
			              'placeholder' => t('Role Name'),
			              'class'       => 'form-control',
			            )
           			   );?>
                 </div>
                 <div class="form-group">
                	<label for="role_code">
                	 <?php 
                    echo t('Role Code');
                    echo mr();
                   ?>
                	 </label>
                    <?php echo form_input($data = array(
			              'name'        => 'role_code',
                          'value'   => isset($_POST['role_code']) ? 
                           trim($_POST['role_code']) :
                           trim($resultSet['role_code']),  
			              'id'          => 'role_code',
                          'tabindex'    => 2,
                          'maxlength'   => 20,   			              
			              'placeholder' => t('Role Code'),
			              'class'       => 'form-control',
			            )
           			   );?>
                 </div>
                 <?php
                 $isActive = isset($_POST['is_active']) ? trim($_POST['is_active']) : 1;
                 $c1 = $c2 = FALSE;
                 $isActive == 1 ? $c1 = true : $c2 = true;
                 $data = array(
                    'name' => 'is_active',
                    'id' => 'is_active',
                    'value' => '1',
                    'checked' => $c1,
                    'class' => 'form_control',
                    'tabindex' => 3
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