<h1><?php echo $title; ?></h1>
<h3>Author: <?php echo $info->username; ?></h3><span> | Posted on :<?php echo date('jS M Y, h:i:s A', $info->posted_on) ; ?></span>
<p><?php echo $info->text; ?></p>

<div id="comments">
<h4>User Comments</h4>
<?php if($comments == NULL) : ?>

		<p>Be the first to comment! </p>

<?php else : ?>

	<?php foreach($comments as $comment) : ?>
		
		<p> "<?php echo $comment->comment; ?>"</p>
		-
		<span id="username"><?php echo $comment->username; ?></span>,
		<span id="date"> Posted on <?php echo date('jS M Y, h:i:s A', $comment->posted_on) ; ?></span>
	<?php endforeach ; ?>

<?php endif ; ?>


</div>

<?php if($this->ion_auth->logged_in()) : ?>

<h3>Comment</h3>
<?php 

echo form_open('news/'.$slug);

echo form_textarea('commentText');
echo form_error('commentText', '<span class="error"></span>');

echo '<p>';
echo form_submit('commentSubmit', 'Post');
echo '</p>';

echo form_close();



?>


<?php else :?>

<a href="<?php echo base_url(); ?>auth/login">Comment</a>

<?php endif; ?>