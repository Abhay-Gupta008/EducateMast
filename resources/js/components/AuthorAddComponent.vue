<template>
    <div>
        <div class="form-group">
            <label class="col-md-2 col-form-label text">Add an Author:</label>

            <div class="col-md-10">
                <input class="col-md-10 text" v-model="username" type="text" @change="searchUser">
            </div>
        </div>
        <div class="col-md-3 pointer ml-3 btn btn-primary mb-2 d-block" v-for="user in users" @click="AddAdmin(user.username)">{{ user.username }}</div>
        <div class="col-md-12 text" v-if="authorAdded">Author Added</div>
        <div class="col-md-12 text" v-if="alreadyAuthor">The given user is an author already.</div>
        <div class="col-md-12 text" v-if="usersEmpty">No search results.</div>
    </div>
</template>

<script>
    export default {
        name: 'author-add-component',
        mounted() {
            console.log('Component mounted.')
        },

        props: ['token'],

        data: function() {
          return {
              usersEmpty: false,
              username: null,
              users : {},
              authorAdded: false,
              alreadyAuthor: false,
            }
        },

        methods: {
            searchUser() {
                axios.post('/api/users/search/'+this.username+'?api_token='+this.token).then(response => {
                    this.usersEmpty = false
                    this.authorAdded = false
                    this.alreadyAuthor = false
                    this.users = response.data
                    if (response.data.length == 0) {
                        this.usersEmpty = true
                    }
                }).catch(err => {
                    console.log(err)
                });
            },

            AddAdmin(username) {
                console.log(username)
                axios.post('/admin/add/author/'+username).then(response => {
                    console.log(response)
                    this.username = null
                    this.users = {}
                    this.authorAdded = true
                }).catch(err => {
                    if (err.response.status === 406) {
                        this.username = null
                        this.users= {}
                        this.alreadyAuthor = true
                    }
                })
            }
        }

    }
</script>
<style>
    .pointer {
        cursor: pointer !important;
    }

    .text {
        cursor: text !important;
    }
</style>
