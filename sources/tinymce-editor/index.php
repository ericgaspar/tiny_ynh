<?php
include_once 'config/Database.php';
include_once 'class/Post.php';
$database = new Database();
$db = $database->getConnection();
$posts = new Post($db);
include('inc/header.php');
?>
<title>coderszine.com: Demo TinyMCE Editor with Ajax, PHP & MySQL</title> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="tinymce/tinymce.min.js"></script>
<script src="js/tinymce_editor.js"></script>
<script src="https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js"></script>
<?php include('inc/container.php'); ?>
<div class="container">	
	<div class="row">	
		<h2>TinyMCE Editor with Ajax, PHP & MySQL</h2>		
		<div id="postLsit">		
		<?php
		$result = $posts->getPost();
		while ($post = $result->fetch_assoc()) {			
			$date = date_create($post['created']);
		?>
			<article class="row">
				<div class="col-md-2 col-sm-2 hidden-xs">
				  <figure class="thumbnail">
					<img class="img-responsive" src="images/user-avatar.png" />
					<figcaption class="text-center"><?php echo ucwords($post['user']); ?></figcaption>
				  </figure>
				</div>
				<div class="col-md-10 col-sm-10">
				  <div class="panel panel-default arrow left">
					<div class="panel-body">
					  <header class="text-left">
						<div class="comment-user"><i class="fa fa-user"></i> By: <?php echo $post['user']; ?></div>
						<time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> <?php echo date_format($date, 'd M Y H:i:s'); ?></time>
					  </header>
					  <div class="comment-post">
						<p>
						<?php echo $post['message']; ?>
						</p>
					  </div>
					  <p class="text-right"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> reply</a></p>
					</div>
				  </div>
				</div>
			</article>		
		<?php }	?>
		</div>		

		<form id="posts" name="posts" method="post">
			<textarea name="message" id="message"></textarea><br>	
			<input type="hidden" name="action" id="action" value="save" />
			<button type="submit" id="save" name="save" class="btn btn-info saveButton">Save</button>
		</form>		
		
	</div>
	
	<div id="postHtml" class="hidden">					
		<article class="row">
			<div class="col-md-2 col-sm-2 hidden-xs">
			  <figure class="thumbnail">
				<img class="img-responsive" src="images/user-avatar.png" />
				<figcaption class="text-center">USERNAME</figcaption>
			  </figure>
			</div>
			<div class="col-md-10 col-sm-10">
			  <div class="panel panel-default arrow left">
				<div class="panel-body">
				  <header class="text-left">
					<div class="comment-user"><i class="fa fa-user"></i> By: USERNAME</div>
					<time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> POSTDATE</time>
				  </header>
				  <div class="comment-post">
					<p>
					POSTMESSAGE
					</p>
				  </div>
				  <p class="text-right"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> reply</a></p>
				</div>
			  </div>
			</div>
		</article>		
	</div>		
		
</div>
<?php include("inc/footer.php"); ?>