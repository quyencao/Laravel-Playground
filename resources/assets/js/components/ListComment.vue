<template>
    <div>
        <template v-for="rootComment in comments">
            <comment :name="rootComment.username" :comment="rootComment.comment" :comment_id="rootComment.id">
                <child-comment :comments="rootComment.comments"></child-comment>
            </comment>
        </template>
    </div>
</template>

<script>
    import Comment from './Comment.vue'

    export default {
        props: ['comments'],
        components: {
            comment: Comment
        },
        mounted() {
            console.log(this.comments);
        }
    }
</script>

<style>

</style>