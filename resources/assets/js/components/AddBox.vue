
<template>
	<div class="form-group">
		<div v-for="lessons in new_" ref="" class="row">
			<div class="col-md-6">
				
				<label class="control-label">Nombre</label>
				<input name="lessons[]" type="text"  class="form-control selectProducts " >
			</div>
			<div class="col-md-6">
				<label class="control-label">Descripción</label>
				<input type="text"  class="form-control "   name="descriptions[]">
			</div>
		</div>
	</div>
</template>

<script>
  export default {
	props: ['new_'],
  };
</script>