<h1>Create News</h1>
<p>Enter a Title and Create a news!</p>
<?php 

echo form_open('main/create_news');
echo '<p><span class="required">*</span><br/>';
echo form_input($news_title);

echo form_error('news_title', '<span class="error"></span>');
echo '</p>';

echo '<p><span class="required">*</span><br/>';
echo form_textarea($news_body);

echo form_error('news_body', '<span class="error"></span>');
echo '</p>';

echo form_submit('submit', 'Create');
echo form_close();

?>
<span class="required">*</span> Required Fields