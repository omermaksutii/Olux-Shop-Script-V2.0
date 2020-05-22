
<form id="tutorialAdd">
<div class="row">
	<div class="form-group col-lg-3 ">
		<label for="lead_link">Download link</label>
		<input type="text" name="link" class="form-control input-sm" placeholder="https://anonfiles.com/file/sdfa9eebab0c1247828f06ddb98280" required="">
	</div>
    <div class="form-group col-lg-3 ">
    <label for="lead_number">Tutorial name</label>
    <input type="text" name="tutoname" class="form-control input-sm" placeholder="Tutorial Name" required="">
  </div>
</div>
<div class="row">
  <div class="form-group col-lg-3 ">
    <label for="lead_about">Description</label>
    <input type="text" name="infos" class="form-control input-sm" placeholder="Undetected ,new style etc.." required="">
  </div>
    <div class="form-group col-lg-3 ">
    <label for="lead_country">Price</label>
		<td><input placeholder="5" type="text" name="price" class="form-control input-sm" required=""></td>

  </div>
</div>

<div class="row">

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
$("#tutorialAdd").submit(function() {
  $('button').prop('disabled', true);
    $.ajax({
           type: "POST",
           url: 'tutorialAdd.html',
           data: $("#tutorialAdd").serialize(),
           success: function(data){
            $('button').prop('disabled', false);
            $("#result").html(data).show();
            var data = JSON.parse(data);
            if (data['result'] ==1){
				      $('#link').val('');
              $('#tutoname').val('');
              $('#infos').val('');
            }
            $("#result").html(data['text']).show();
            }

});

    return false; // avoid to execute the actual submit of the form.
});
</script>