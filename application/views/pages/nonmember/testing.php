<?php echo form_open(base_url()."testing");?>

  <p>
    
    <?php echo form_input('test');?>
  </p>

  <p><?php echo form_submit('submit', 'Submit');?></p>

<?php echo form_close();?>