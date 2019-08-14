<template>
    <div class="container">
        <div class="columns">
            <div class="column is-4">
                <div class="card mt-5">
                    <div class="card-content">
                        <form @submit.prevent="update_id ? update_data(update_id) : create_data()">
                            <div class="content">
                                <h2 class="title is-4 has-text-centered" v-if="!update_id">Add Contact</h2>
                                <h2 class="title is-4 has-text-centered" v-else>Update Contact</h2>
                                <div class="field">
                                    <label class="label">Name</label>
                                    <div class="control">
                                        <input v-model="contact.name" class="input is-rounded is-primary" type="text" placeholder="e.g Alex Smith" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Email</label>
                                    <div class="control">
                                        <input v-model="contact.email" class="input is-rounded is-primary" type="email" placeholder="e.g. alexsmith@gmail.com" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <label class="label">Phone</label>
                                    <div class="control">
                                        <input v-model="contact.phone" class="input is-rounded is-primary" type="text" placeholder="e.g. +91 999999999" required>
                                    </div>
                                </div>
                                <div class="control mt-4">
                                    <button type="submit" class="button is-fullwidth is-rounded is-primary" v-if="!update_id">Add Contact</button>
                                    <div class="columns" v-else>
                                        <div class="column">
                                            <button type="submit" class="button is-fullwidth is-rounded is-primary">Update Contact</button>
                                        </div>
                                        <div class="column">
                                            <button type="submit" class="button is-fullwidth is-rounded is-danger" @click.prevent="set_create">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="column is-8">
                <div class="card mt-5">
                    <div class="card-content">
                        <h2 class="title is-4 has-text-centered">Contacts</h2>
                        <div class="columns is-multiline">
                            <div class="column is-6" v-for="item in contacts_list">
                                <article class="message">
                                    <div class="message-header">
                                        <p>{{ item.name }}</p>
                                    </div>
                                    <div class="message-body">
                                        <div>Name: <strong>{{ item.name }}</strong></div>
                                        <div>Email: <strong>{{ item.email }}</strong></div>
                                        <div>Phone: <strong>{{ item.phone }}</strong></div>
                                        <div class="mt-3">
                                            <span class="tag is-rounded is-primary"><a href="" @click.prevent="set_update(item.id)">Update</a></span>
                                            <span class="tag is-rounded is-danger"><a href="" @click.prevent="delete_contact(item.id)">Delete</a></span>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            update_id: null,
            contacts_list: null,
            contact: {
                name: '',
                email: '',
                phone: ''
            }
        }
    },
    methods: {
        update_data(id){
            axios.patch(window.location.href + `api/contact/${id}`, this.contact).then(response => {
                this.contacts_list = this.contacts_list.map(contact => {
                    if(contact.id == response.data.id){
                        return response.data
                    }
                    return contact;
                });
                this.clear_form();
            })
        },
        clear_form() {
            this.contact.name = '';
            this.contact.email = '';
            this.contact.phone = '';
        },
        create_data() {
            axios.post(window.location.href + 'api/contact/store', this.contact).then(response => {
                this.contacts_list.unshift(response.data);
                this.clear_form();
            });
        },
        set_update(id) {
            this.update_id = id;
            axios.get(window.location.href + `api/contact/${id}`).then(response => {
                this.contact = response.data;
            })
        },
        delete_contact(id) {
            axios.delete(window.location.href + `api/contact/${id}`).then(response => {
                this.contacts_list = this.contacts_list.filter(contact => {
                    return contact.id !== id;
                });
            });
        },
        set_create() {
            this.update_id = null;
        }
    },
    created() {
        axios.get(window.location.href + 'api/contacts').then(response => {
            this.contacts_list = response.data;
        })
    }
}

</script>
<style>
.tag a {
    text-decoration: none !important;
}

</style>
