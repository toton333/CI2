<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
</head>
<body>
	<div id="message"><?php echo $message; ?></div>
	<a href="<?php echo base_url(); ?>">HOME</a>
	<a href="<?php echo base_url(); ?>page/about">ABOUT</a>
	<a href="<?php echo base_url(); ?>news">NEWS</a>
	<?php if(! $this->ion_auth->logged_in()) : ?>
	<a href="<?php echo base_url(); ?>auth/login">LOGIN</a>
	<?php else : ?>
	<a href="<?php echo base_url(); ?>auth/edit_user/<?php echo $this->ion_auth->user()->row()->id; ?>">Hello, <?php echo $this->ion_auth->user()->row()->username; ?></a>
	<?php if($this->ion_auth->is_admin()): ?>
	<a href="<?php echo base_url(); ?>auth">DASHBOARD</a>
	<?php endif; ?>
	<a href="<?php echo base_url(); ?>auth/logout">LOGOUT</a>
	
	<?php endif; ?>

