<template>
    <div>
        <button v-if="!liked" type="button" class="btn btn-primary" v-on:click="like(postId)">like</button>
        <button v-else type="button" class="btn btn-primary" v-on:click="unlike(postId)">liked</button>
    </div>
</template>

<script>
    export default {
        props: ['postId', 'userId', 'defaultLiked'],
        data() {
            return {
                liked: false,
            };
        },
        created() {
            this.liked = this.defaultLiked
        },
        
        methods: {
            like(postId) {
                let url = `/api/posts/${postId}/like`

                axios.post(url, {
                    user_id: this.userId
                })
                .then(response => {
                    this.liked = true
                })
                .catch(error => {
                    alert(error);
                });
            },  
            unlike(postId) {
                let url = `/api/posts/${postId}/unlike`

                axios.post(url, {
                    user_id: this.userId
                })
                .then(response => {
                    this.liked = false
                })
                .catch(error => {
                    alert(error);
                });
            }
        }
    }
</script>
