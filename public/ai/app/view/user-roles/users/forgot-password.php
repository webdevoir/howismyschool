<div class="login-content-box">
  <div class="welcome-text-box">
      <div class="welcome-heading"><?php echo t('Welcome to');?>
        <?php echo SITE_NAME;?></div>
        <div class="welcome-text">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
          eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
          ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
          aliquip ex ea commodo consequat. Duis aute irure dolor in
          reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
          pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
          culpa qui officia deserunt mollit anim id est laborum.
        </div>
        <div class="text-seperator"></div>
        <div class="access-warning">
          <div class="warning-heading"><?php echo t('Unauthorized Access Warning');?></div>
            <ul>
              <li><?php echo t('Access to this computer is prohibited
				unless authorized.');?></li>
                <li><?php echo t('Accessing programs or data unrelated
				to your job is prohibited.');?></li>
            </ul>
        </div>
    </div>
    <div class="login-box">
      <div class="login-form forget-form">
          <div class="sign-in"><?php echo t('Forgot Password');?></div>
          <?php
			echo $utility_obj->get_flash_message();
		   ?>
          <?php echo form_open(URL . ''.FORGOT_PASSWORD_LINK,
    array('id' => 'forgotform', 'method' => 'post' ))?>
            <div class="forgot-form-row">
            	<table width="100%" cellspacing="0" cellpadding="0" border="0">
            		<tbody>
            			<tr>
            				<td><label><?php echo t('Username/email id');?></label></td>
            				<td>:</td>
            				<td><?php echo form_input($data = array(
	              'name'        => 'username',
	              'id'          => 'userId',
	              'value'   => $userName2,
            	  'maxlength' => 100
	            )
   			   );?></td>
            			</tr>
            			<tr>
            				<td colspan="3"><button type="submit" class="forgot-btn">
              <?php echo t('Send Password Reset Link');?></button></td>
            			</tr>
            		</tbody>
            	</table>
            </div>


               <?php
             echo link_create(t('Login'),
             array('href'=>'login',
             'class'=>'forgot-password'));
            ?>

            <?php echo form_close();?>
        </div>
    </div>
    <div class="cb"></div>
</div>