<h1><?php echo $title; ?></h1>

<?php foreach($info as $row) : ?>

	<h3><?php echo ucfirst($row->title); ?></h3>
	<p><?php echo $row->text; ?></p>
	<a href="news/<?php echo $row->slug; ?>">Read More</a>

<?php endforeach; ?>