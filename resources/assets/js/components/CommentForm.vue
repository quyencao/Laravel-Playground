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
        props: ['comment_id'],
        data() {
           return {
               comment: ''
           }
        },
        methods: {
            addComment() {
                if(this.comment !== '') {
                    axios.post('/add/comment', { comment: this.comment, parent_id: this.comment_id })
                        .then((res) => {
                            console.log(res);
                        })
                }
            }
        }
    }
</script>

<style>

</style>