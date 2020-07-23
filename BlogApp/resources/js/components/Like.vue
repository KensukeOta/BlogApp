<template>
    <div>
        <button type="button" class="btn btn-primary" v-on:click="submit(postId)">like</button>
    </div>
</template>

<script>
    export default {
        props: ['postId', 'userId'],

        methods: {
            submit(postId) {
                let url = `/api/posts/${postId}/like`

                axios.post(url, {
                    user_id: this.userId
                })
                .then(response => {

                })
                .catch(error => {
                    alert(error)
                });
            }
        }
    }
</script>
