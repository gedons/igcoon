<template>
	<div>
		<button class="btn btn-light ml-4"  @click="likeUser" v-text="buttonText">Like</button>
	</div>
</template>

<script>
	 export default {
        props: ['userId', 'liker'],


        mounted() {
            console.log('Component mounted.')
        },

        data: function () {
            return {
                status: this.liker,
            }
        },

        methods: {
            likeUser() {
                //go to the follow route
                axios.post('/like/' + this.userId)
                .then(response => {
                    this.status = ! this.status;
                })
                .catch(errors => {
                    if (errors.response.status == 401) {
                        window.location = '/login';
                    }
                });
            }
        },

        computed : {
            buttonText() {
                return (this.status) ? 'Dislike' : 'Like';
            }
        }
    }
</script>