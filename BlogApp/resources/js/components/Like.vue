<template>
    <div>
        <button type="button" class="btn btn-primary">いいね</button>
    </div>
</template>

<script>
    export default {
        props: ['postId'],
        
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
