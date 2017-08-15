<template>
    <div>
        <comment-form comment_id="0" :sendComment="getComments"></comment-form>
        <template v-for="rootComment in comments">
            <comment :name="rootComment.username" :comment="rootComment.comment" :comment_id="rootComment.id" :getComments="getComments">
                <child-comment :comments="rootComment.comments" :getComments="getComments"></child-comment>
            </comment>
        </template>
    </div>
</template>

<script>
    import Comment from './Comment.vue'

    export default {
        components: {
            comment: Comment
        },
        data() {
            return {
                comments: []
            }
        },
        mounted() {
            this.getComments();
        },
        methods: {
            getComments() {
                axios.get('/get/comments')
                    .then((resp) => {
                        this.comments = resp.data;
                    });
            }
        }
    }
</script>

<style>

</style>