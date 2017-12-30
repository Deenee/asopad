<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Client Auth</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
                            <link href = "{{ asset('css/app.css') }}" rel = "stylesheet" >
    
</head>
<body>
    
<div id="app">
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
                <br>

				<div class="panel-heading">Manage Clients.</div>

				<div class="panel-body">
					<passport-clients></passport-clients>
                    <passport-authorized-clients></passport-authorized-clients>
                    <passport-personal-access-tokens></passport-personal-access-tokens>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>