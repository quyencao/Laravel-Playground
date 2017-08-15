<template>
    <div>
        <template v-for="childComment in comments">
            <comment :name="childComment.username" :comment="childComment.comment" :comment_id="childComment.id" :getComments="getComments">
                <child-component v-if="childComment.comments.length !== 0" :comments="childComment.comments" :getComments="getComments"></child-component>
            </comment>
        </template>
    </div>
</template>

<script>
    export default {
        name: 'child-component',
        props: ['comments', 'getComments']
    }
</script>