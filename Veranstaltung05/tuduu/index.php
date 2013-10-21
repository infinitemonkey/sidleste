<?php
	error_reporting(E_ALL);
	ini_set("display_errors", 1);

	require_once 'inc/database.inc';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>tuduu - Stefan Sidler - ZHAW</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
	<link href="css/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet">
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	<script src="js/jquery-1.7.2.min.js"></script>
	<script src="js/jquery.ui.1.8.20.custom.min.js"></script>
	<script src="js/jquery.tmpl.min.js"></script>
    <script src="js/jquery.ui.datepicker-de-CH.js"></script>
    <script src="js/date.js"></script>
	<script src="bootstrap/js/bootstrap.js"></script>	
	<script src="js/scripts.js"></script>
</head>
<body>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="./">tuduu</a>
                <div class="nav-collapse">
                    <ul class="nav">
                        <li class="active"><a href="./">Home</a></li>
                        <li><a href="#about" data-toggle="modal">About</a></li>
                        <li><a href="#contact" data-toggle="modal">Contact</a></li>
                    </ul>
                </div>
                <!--/.nav-collapse -->
            </div>
        </div>
    </div>
    <div class="container" id="container">
        <div class="content" id="content">
            <div class="page-header">
                <h1><img src="http://placehold.it/150x70&text=tuduu-logo" /> <small>a simple tasklist</small></h1>
            </div>

            <form id="newTaskForm" class="well form-inline">
            <fieldset>
                <div class="control-group input-append">
			        <label class="control-label" for="prio">Prio:</label>
			        <select class="input-small" id="prio" name="prio">
				        <option value="low">low</option>
				        <option value="medium" selected="selected">medium</option>
				        <option value="high">high</option>
			        </select>
                </div>

                <div class="control-group input-append">
                    <label class="control-label" for="task">Task:</label>
			        <input type="text" class="input-xlarge" id="task" name="task"/>
                </div>

                <div class="control-group input-append">
			        <label class="control-label" for="date">Date:</label>
			        <input type="text" class="input-xlarge" id="date" name="date"/>
                </div>

                <button type="submit" id="addTask" class="btn btn-primary pull-right"><i class="icon-plus icon-white"></i> Add task</button>
		    </fieldset>
            </form>

        <div id="about" class="modal hide fade">
				<div class="modal-header">
					<button class="close" data-dismiss="modal">x</button>
					<h3>About</h3>
				</div>
				<div class="modal-body">
                    <h1>Salam aleikum!</h1>
                    <br />
                    <p>Eine Projektarbeit von <a href="mailto:sidleste@students.zhaw.ch">Stefan Sidler</a><br /><br />ZHAW 2013</p>
				</div>
				<div class="modal-footer">
					<a href="#" class="btn btn-success" data-dismiss="modal">Close</a>
				</div>
		</div>

		<div id="contact" class="modal hide fade">
			<form id="contactForm" class="form-horizontal">
				<div class="modal-header">
					<button class="close" data-dismiss="modal">x</button>
					<h3>Contact</h3>
				</div>
				<div class="modal-body">
					<fieldset>
						<div class="control-group">
							<label class="control-label" for="name">Name</label>
							<div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-user"></i></span><input type="text" class="input-xlarge" id="name" />
                                </div>
								<p class="help-block">Your name</p>
							</div>
						</div>
                        <div class="control-group">
							<label class="control-label" for="text">E-Mail</label>
							<div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-envelope"></i></span><input type="text"  class="input-xlarge" id="mail" />
                                </div>
								<p class="help-block">Your mail</p>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="text">Message</label>
							<div class="controls">
                                <div class="input-prepend">
                                    <span class="add-on"><i class="icon-pencil"></i></span><textarea class="input-xlarge" rows="3" id="message"></textarea>
                                </div>
								<p class="help-block">Your message</p>
							</div>
						</div>
					</fieldset>
				</div>
				<div class="modal-footer">
					<a href="#" class="btn" data-dismiss="modal">Close</a>
					<input type="submit" class="btn btn-primary" value="Send" />
				</div>
			</form>
		</div>

		<table id="tasks" class="table table-bordered table-striped">
			<thead>
				<tr>
                    <td width="30"></td>
                    <th width="30">Prio</th>
					<th>Name</th>
					<th width="130">Datum</th>
					<th width="30"></th>
				</tr>
			</thead>
			<tbody id="tasksContent">
				<tr>
					<td colspan="5"><span class="label label-warning">Oops, no tasks found! :'(</span></td>
				</tr>
			</tbody>
		</table>
		<script id="taskTemplate" type="text/x-jQuery-tmpl">
			<![CDATA[
			<tr>
                <td>{{if done == 'true'}}{{else}}<span class="btn btn-success" data-obj-id="${id}"><i class="icon-ok-sign icon-white"></i></span>{{/if}}</td>
				<td class="{{if done == 'true'}}strike centered{{else}}centered{{/if}}"><span class="label {{if prio == 'low'}}label-success{{/if}} {{if prio == 'medium'}}label-warning{{else}}label-important{{/if}}">${prio}</span></td>
				<td{{if done == 'true'}} class="strike"{{/if}}><span class="prio-${prio}">${task}</span></td>
				<td{{if done == 'true'}} class="strike"{{/if}}><span class="prio-${prio}">${date}</span></td>
				<td><span class="btn btn-danger" data-obj-id="${id}"><i class="icon-remove-sign icon-white"></i></span></td>
			</tr>
			]]>
		</script>
        </div>
        <footer class="footer">
		    &copy; 2013 - <a href="mailto:sidleste@students.zhaw.ch">Stefan Sidler</a> - ZHAW
	    </footer>
    </div>
    <!-- /container -->
</body>
</html>