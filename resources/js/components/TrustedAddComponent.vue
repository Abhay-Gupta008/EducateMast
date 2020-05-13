<template>
    <div>
        <div class="form-group">
            <label class="col-md-2 col-form-label text">Give Trusted Role to Someone:</label>

            <div class="col-md-10">
                <input class="col-md-10 text" v-model="username" type="text" @change="searchUser">
            </div>
        </div>
        <div class="col-md-3 pointer ml-3 btn btn-primary mb-2 d-block" v-for="user in users" @click="AddTrusted(user.username)">{{ user.username }}</div>
        <div class="col-md-12 text" v-if="trustedAdded">Trusted Role Added</div>
        <div class="col-md-12 text" v-if="alreadyTrusted">The given user is having the trusted role already.</div>
        <div class="col-md-12 text" v-if="usersEmpty">No search results.</div>
    </div>
</template>

<script>
    export default {
        name: 'trusted-add-component',
        mounted() {
            console.log('Component mounted.')
        },

        props: ['token'],

        data: function() {
          return {
              usersEmpty: false,
              username: null,
              users : {},
              trustedAdded: false,
              alreadyTrusted: false,
            }
        },

        methods: {
            searchUser() {
                axios.post('/api/users/search/'+this.username+'?api_token='+this.token).then(response => {
                    this.usersEmpty = false
                    this.trustedAdded = false
                    this.alreadyTrusted = false
                    this.users = response.data
                    if (response.data.length == 0) {
                        this.usersEmpty = true
                    }
                }).catch(err => {
                    console.log(err)
                });
            },

            AddTrusted(username) {
                console.log(username)
                axios.post('/api/admin/add/trusted/'+username+'?api_token='+this.token).then(response => {
                    console.log(response)
                    this.username = null
                    this.users = {}
                    this.trustedAdded = true
                }).catch(err => {
                    if (err.response.status === 406) {
                        this.username = null
                        this.users= {}
                        this.alreadyTrusted = true
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
