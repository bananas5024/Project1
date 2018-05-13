<?php
session_start();
?>
<!doctype html>
<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script type="text/javascript" src="js/recordsActions.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <title>Hello, world!</title>
    <style type="text/css">
    #container {
    width: 100%;
    		margin: auto;
    	}
    	.padd {
    padding-top: 15px;
    	}
    	#messages-list {
    		max-height: 95vh;
    		overflow: auto;
    	}
    </style>
  </head>
  <body>
	    <div id="container" class="row">
	    	<div class="col-md-4 col-sm-12 col-xs-12" >
	    		<form method="post" action="post.php">
		    		<div class="row">
			    		<div id="textarea" class="text col-xs-12 col-sm-8 col-md-12 padd">
		    				<textarea name="text" class="form-control" rows="8" id="message"></textarea>
			    		</div>
			    		<div id="login-form" class="login col-xs-12 col-sm-4 col-md-12 padd">
			    			<div class="form-group">
				    			<label for="email">Email</label>
				    			<input name="email" type="email" class="form-control" id="email">
				    		</div>
			    			<div class="form-group">
				    			<label for="password">Password</label>
				    			<input name="password" type="password" class="form-control" id="password">
				    		</div>
				    		<button type="submit" class="btn btn-primary btn-block">Submit</button>
                            <div id="messages" style="color: red">
                                <?php
                                echo $_SESSION['error-message'];
                                $_SESSION['error-message'] = '';
                                ?>
                            </div>
			    		</div>
		    		</div>
	    		</form>
	    	</div>

	    	<div class="col-md-8 col-sm-12 col-xs-12 padd">
	    			<div id="messages-list" class="list-group">
	    				<div class="list-group-item">
	    					<div>author</div>
	    					<div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
	    				</div>

	    			</div>
	    		</div>
	    	</div>
        <script>
            initRecords();
        </script>
  	</body>
</html>