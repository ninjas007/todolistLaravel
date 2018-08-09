<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Ajax ToDo List</title>
		<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	</head>
	<body>
		<br>
		<div class="container">
			<div class="row">
				<div class="col-lg-offset-3 col-lg-6">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Panel title <a href="#" class="pull-right" id="addNew" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></h3>
						</div>
						<div class="panel-body" id="items">
							<ul class="list-group">
								@foreach($items as $item)
								<input type="hidden" id="itemId" value="{{$item->id}}">
								<li class="list-group-item ourItem" data-toggle="modal" data-target="#myModal">{{$item->item}}</li>
								@endforeach()
							</ul>
						</div>
					</div>
				</div>
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class="modal-title" id="title">Add New Item</h4>
							</div>
							<div class="modal-body">
								<input type="hidden" id="id" >
								<p><input type="text" placeholder="Write Item Here" id="addItem" class="form-control"></p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-warning" id="delete" data-dismiss="modal" style="display: none;">Delete</button>	
								<button type="button" class="btn btn-primary" id="saveChanges" style="display: none;">Save changes</button>
								<button type="button" class="btn btn-primary" id="addButton" data-dismiss="modal">Add Item</button>
							</div>
							</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
							</div><!-- /.modal -->
						</div>
					</div>
					
					{{csrf_field()}}
					<script
					src="https://code.jquery.com/jquery-3.3.1.min.js"
					integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
					crossorigin="anonymous"></script>
					<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
					<script>
						$(document).ready(function() {
							$(document).on('click', '.ourItem', function(event) {
									const text = $(this).text();
									const id = $(this).find('#itemId').val();
									$('#title').text('Edit Item');
									$('#addItem').val(text);
									$('#delete').show('400');
									$('#saveChanges').show('400');
									$('#addButton').hide('slow/400/fast');
									$('#id').val(id);
									console.log(id);
								});

							$(document).on('click', '#addNew', function(event) {
								$('#title').text('Add New Item');
								$('#addItem').val("");
								$('#delete').hide('400');
								$('#saveChanges').hide('400');
								$('#addButton').show('slow/400/fast');
							});

							$('#addButton').click(function(event) {
								const text = $('#addItem').val();
								// parameter pertama adalah tujuan / path filenya
								// parameter kedua adalah objek text 
								$.post('list', {'text': text, '_token':$('input[name=_token]').val()}, function(data) {
									$('#items').load(location.href + ' #items');
								});
							});

							$('#delete').click(function(event) {
								var id = $('#id').val();
								$.post('delete', {'id': id, '_token':$('input[name=_token]').val()}, function(data) {
									$('#items').load(location.href + ' #items');
									console.log(data);
								});
							});
						});
					</script>
				</body>
			</html>