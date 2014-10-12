<h1><?php echo $title; ?></h1>

<?php foreach($info as $row) : ?>

	<h2><?php echo ucfirst($row->title); ?></h2>
	<h3>Author: <?php echo $row->username; ?></h3><span> | Posted on :<?php echo date('jS M Y, h:i:s A', $row->posted_on) ; ?></span>
	<p><?php echo $row->text; ?></p>
	<a href="news/<?php echo $row->slug; ?>">Read More</a>

<?php endforeach; ?>