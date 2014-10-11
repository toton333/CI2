<h1><?php echo lang('edit_user_heading');?></h1>
<p><?php echo lang('edit_user_subheading');?></p>


<?php echo form_open(uri_string());?>
      <p>
            <?php echo '<span class="required">*</span>'.lang('edit_user_username_label', 'username');?> <br />
            <?php echo form_input($username);?>
            <?php echo form_error('username', '<span class="error">', '</span>'); ?>
      </p>

      <p>
            <?php echo '<span class="required">*</span>'.lang('edit_user_email_label', 'email');?> <br />
            <?php echo form_input($email);?>
            <?php echo form_error('email', '<span class="error">', '</span>'); ?>
      </p>

      <p>
            <?php echo lang('edit_user_fname_label', 'first_name');?> <br />
            <?php echo form_input($first_name);?>
            <?php echo form_error('first_name', '<span class="error">', '</span>'); ?>
      </p>

      <p>
            <?php echo lang('edit_user_lname_label', 'last_name');?> <br />
            <?php echo form_input($last_name);?>
            <?php echo form_error('last_name', '<span class="error">', '</span>'); ?>
      </p>

      <p>
            <?php echo lang('edit_user_company_label', 'company');?> <br />
            <?php echo form_input($company);?>
            <?php echo form_error('company', '<span class="error">', '</span>'); ?>
      </p>

      <p>
            <?php echo lang('edit_user_phone_label', 'phone');?> <br />
            <?php echo form_input($phone);?>
            <?php echo form_error('phone', '<span class="error">', '</span>'); ?>
      </p>

      <p>
            <?php echo lang('edit_user_password_label', 'password');?> <br />
            <?php echo form_input($password);?>
            <?php echo form_error('password', '<span class="error">', '</span>'); ?>
      </p>

      <p>
            <?php echo lang('edit_user_password_confirm_label', 'password_confirm');?><br />
            <?php echo form_input($password_confirm);?>
            <?php echo form_error('password_confirm', '<span class="error">', '</span>'); ?>
      </p>

      <?php if ($this->ion_auth->is_admin()): ?>

          <h3><?php echo lang('edit_user_groups_heading');?></h3>
          <?php echo form_error('groups[]', '<span class="error">', '</span>'); ?>
          <?php foreach ($groups as $group):?>
              <label class="checkbox">
              <?php
                  $gID=$group['id'];
                  $checked = null;
                  $item = null;
                  foreach($currentGroups as $grp) {
                      if ($gID == $grp->id) {
                          $checked= ' checked="checked"';
                      break;
                      }
                  }
              ?>
              <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
              <?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>
              </label>
          <?php endforeach?>

      <?php endif ?>

      <?php echo form_hidden('id', $user->id);?>
      <?php echo form_hidden($csrf); ?>

      <p><?php echo form_submit('submit', lang('edit_user_submit_btn'));?></p>

<?php echo form_close();?>
<span class="required">*</span> Required Fields.
