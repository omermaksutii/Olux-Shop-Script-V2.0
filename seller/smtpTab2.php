<form id="smtpAdd">
<div class="row">
	<div class="form-group col-lg-3 ">
		<label for="host">Host/IP</label>
		<input type="text" name="host" id="host" class="form-control input-sm" placeholder="1.1.1.1" required="">
	</div>
</div>
<div class="row">
	<div class="form-group col-lg-3 ">
		<label for="login">Login</label>
		<input type="text" name="login" id="login" class="form-control input-sm" placeholder="admin" required="">
	</div>
	<div class="form-group col-lg-3 ">
		<label for="pass">Password</label>
		<input type="text" name="pass" id="pass" class="form-control input-sm" placeholder="abc123" required="">
	</div>
</div>
<div class="row">

<div class="col-md-6">
<table class="table ">
	<tbody><tr>
		<th>Port</th>
		<th>Price</th>
	</tr>
	<tr>
		<td>
			<select class="form-control input-sm" name="port" required="">
				<option selected="">25</option>
				<option>587</option>
				<option>2525</option>
				<option>26</option>
			</select>
		</td>
				<td><input placeholder="5" type="text" name="price" class="form-control input-sm" required=""></td>
	</tr>
</tbody></table>
</div>
<div class="form-group col-lg-10">
	<button type="submit" name="submit" class="btn btn-primary btn-md">Add  <span class="glyphicon glyphicon-indent-left"></span></button>
<input type="hidden" name="start" value="work" />

	</div>
</div>
</form>
<div class="row">
	<div class="well well-sm col-md-6"><b>[Response]</b><div id="result"></div></div>
</div>
<script type="text/javascript">
$("#smtpAdd").submit(function() {
  $('button').prop('disabled', true);
    $.ajax({
           type: "POST",
           url: 'smtpAdd.html',
           data: $("#smtpAdd").serialize(),
           success: function(data){
            $('button').prop('disabled', false);
            $("#result").html(data).show();
            var data = JSON.parse(data);
            if (data['result'] ==1){
				      $('#host').val('');
              $('#port').val('');
              $('#login').val('');
              $('#pass').val('');
            }
              $("#result").html(data['text']).show();
            }

});

    return false; // avoid to execute the actual submit of the form.
});
</script>