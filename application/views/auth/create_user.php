<h1>Registration Form</h1>
<p><?php echo lang('create_user_subheading');?></p>


<?php echo form_open("auth/create_user");?>

      <p>
            <?php echo '<span class="required">*</span>'.lang('create_user_username_label', 'username');?> <br />
            <?php echo form_input($username);?>
            <?php echo form_error('username', '<span class="error">', '</span>'); ?>
      </p>

      <p>
            <?php echo lang('create_user_fname_label', 'first_name');?> <br />
            <?php echo form_input($first_name);?>
            <?php echo form_error('firs_tname', '<span class="error">', '</span>'); ?>
      </p>

      <p>
            <?php echo lang('create_user_lname_label', 'last_name');?> <br />
            <?php echo form_input($last_name);?>
            <?php echo form_error('last_name', '<span class="error">', '</span>'); ?>
      </p>

      <p>
            <?php echo lang('create_user_company_label', 'company');?> <br />
            <?php echo form_input($company);?>
            <?php echo form_error('company', '<span class="error">', '</span>'); ?>
      </p>

      <p>
            <?php echo '<span class="required">*</span>'.lang('create_user_email_label', 'email');?> <br />
            <?php echo form_input($email);?>
            <?php echo form_error('email', '<span class="error">', '</span>'); ?>
      </p>

      <p>
            <?php echo lang('create_user_phone_label', 'phone');?> <br />
            <?php echo form_input($phone);?>
            <?php echo form_error('phone', '<span class="error">', '</span>'); ?>
      </p>

      <p>
            <?php echo '<span class="required">*</span>'.lang('create_user_password_label', 'password');?> <br />
            <?php echo form_input($password);?>
            <?php echo form_error('password', '<span class="error">', '</span>'); ?>
      </p>

      <p>
            <?php echo '<span class="required">*</span>'.lang('create_user_password_confirm_label', 'password_confirm');?> <br />
            <?php echo form_input($password_confirm);?>
            <?php echo form_error('password_confirm', '<span class="error">', '</span>'); ?>
      </p>


      <p><?php echo form_submit('submit', lang('create_user_submit_btn'));?></p>

<?php echo form_close();?>
<span class="required">*</span> Required Fields.
