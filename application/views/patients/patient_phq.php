<div class="card">
	<article class="card-body">
		<?php 
            echo validation_errors();  
			//echo form_open('patients/update_phq');
			echo form_open('phq_form',array( 'id' => 'phq_form'));
        ?>
		<div class="form-row">
            <?php 
            $patient_phq = $this->patient_phq_model->get_patient_phq($patient_id);
            echo form_hidden('patient_id',$patient_id);

            foreach ($patient_phq as $item): 
            ?>
			<div class="form-group col-md-6">
				<label>
					<?php echo $item['question'] ?>
				</label>
			</div> <!-- form-group end.// -->
			<div class="form-group col-md-6">
				<div>
					<input type="radio" name="<?php echo $item['id'] ?>" value="0" <?php echo $item['value'] == '0' ? 'checked' : '' ?>>
					<label>Not at all</label>
				</div>
				<div>
					<input type="radio" name="<?php echo $item['id'] ?>" value="1" <?php echo $item['value'] == '1' ? 'checked' : '' ?>>
					<label>Several days</label>
				</div>
				<div>
					<input type="radio" name="<?php echo $item['id'] ?>" value="2" <?php echo $item['value'] == '2' ? 'checked' : '' ?>>
					<label>More than half the days</label>
				</div>
				<div>
					<input type="radio" name="<?php echo $item['id'] ?>" value="3" <?php echo $item['value'] == '3' ? 'checked' : '' ?>>
					<label>Nearly every day</label>
				</div>
			</div> <!-- form-group end.// -->
			<?php endforeach; ?>
		</div> <!-- form-row.// -->
		<div class="form-row">
			<!-- form-group end.// -->
			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-block"> Save </button>
			</div> <!-- form-group// -->
		</div>
		</form>
	</article>
</div>
<script>
		$('form#phq_form').submit(function (e) {

			var form = $(this);

			e.preventDefault();

			$.ajax({
				type: "POST",
				url: "<?php echo site_url('patients/update_phq'); ?>",
				data: form.serialize(), // <--- THIS IS THE CHANGE
				dataType: "html",
				success: function (data) {
					//$('#feed-container').prepend(data);
				},
				error: function () {
					alert("Error posting feed.");
				}
			});

		});
	</script>
