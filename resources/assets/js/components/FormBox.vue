
<template>
    
	<div class="col-md-5 text-left">
		<button class="add btn btn-primary" type="button" @click="addNew"><i class="material-icons">add</i></button>
	</div>
</template>

<script>
    export default {
        methods: {
            addNew() {
                this.$emit('add_');
            },
        }    
    }
</script>