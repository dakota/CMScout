<?php
<<<<<<< HEAD
echo $rss->header();
=======
echo $this->Rss->header();
>>>>>>> cake1.3/1.3

if (!isset($channel)) {
	$channel = array();
}
if (!isset($channel['title'])) {
	$channel['title'] = $title_for_layout;
}

<<<<<<< HEAD
echo $rss->document(
	$rss->channel(
=======
echo $this->Rss->document(
	$this->Rss->channel(
>>>>>>> cake1.3/1.3
		array(), $channel, $content_for_layout
	)
);
?>