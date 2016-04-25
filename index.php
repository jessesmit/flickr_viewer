<!doctype html>
<html lang='en'>
<head>
	<title>Flickr Viewer</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="styles/flickrViewer.css" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.css" crossorigin="anonymous">

</head>
<body>
	<div class='container'>
		<h1>Flickr Viewer</h1>
		<div class='row'>

<?php require_once('views/tagInput.html') ?>
			
		</div>
		<div class='row'>
<?php 

	require_once('views/flickrViewer.php');
	require_once('models/flickr.php');
	require_once('controllers/flickrViewerController.php');

	$flickrModel = new Flickr();
	$flickrViewerController = new FlickrViewerController($flickrModel);
	
	if (isset($_GET['action'])) $flickrViewerController->{$_GET['action']}($_POST);

	$flickrViewerView = new FlickrViewerView($flickrModel);
	echo $flickrViewerView->output();

?>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-2.2.3.min.js" integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="   crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.js" crossorigin="anonymous"></script>
	<script>$('.fv-tag-input').tagsInput({'width':'83%', 'height':'46px', 'defaultText': 'Enter tags to search Flickr by.'});</script>
</body>
</html>