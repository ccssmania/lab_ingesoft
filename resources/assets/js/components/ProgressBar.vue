
<template>
    <div>
        <h5>Barra de progreso</h5>
        <b-progress :value="progress" :max="100" :precision="2" show-progress animated class="mb-3"></b-progress>
    </div>
</template>

<script>

    export default {
        props: ['progress'],
    }
</script>