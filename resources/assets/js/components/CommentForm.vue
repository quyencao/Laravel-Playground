<template>
    <div class="well">
        <h4>Leave a Comment:</h4>
        <form role="form">
            <div class="form-group">
                <textarea class="form-control" rows="3" v-model="comment"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" @click.prevent="addComment">Submit</button>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['comment_id', 'sendComment'],
        data() {
           return {
               comment: ''
           }
        },
        methods: {
            addComment() {
                if(this.comment !== '') {
                    if(this.comment_id !== 0) {
                        axios.post('/add/comment', {comment: this.comment, parent_id: this.comment_id})
                            .then((res) => {
                                this.sendComment(this.comment);
                                this.comment = '';
                            });
                    } else {
                        axios.post('/add/comment', {comment: this.comment, parent_id: 0})
                            .then((res) => {
                                this.comment = '';
                                this.getComments();
                            });
                    }
                }
            }
        }
    }
</script>

<style>

</style>