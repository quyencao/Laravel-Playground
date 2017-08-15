<template>
    <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" src="http://placehold.it/64x64" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading"> {{ name }}
                <small>August 25, 2014 at 9:30 PM</small>
            </h4>
                {{ comment }}
            <div>
                <a href="">Like</a>
                <a @click.prevent="show = !show">Reply</a>
                <comment-form v-if="show" :comment_id="comment_id" :sendComment="sendComment"></comment-form>
            </div>
            <slot>
            </slot>
        </div>

    </div>
</template>

<script>
    export default {
        name: 'comment',
        data() {
            return {
                show: false
            }
        },
        props: ['name', 'comment', 'comment_id', 'getComments'],
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            sendComment(comment) {
                this.show = false;
                this.getComments();
            }
        }
    }
</script>
