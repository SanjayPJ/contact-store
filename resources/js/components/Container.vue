<template>
    <div class="container">
        <div class="columns">
            <div class="column is-4">
                <div class="card mt-5">
                    <div class="card-content">
                        <div class="content">
                            <h2 class="title is-4 has-text-centered">Add Contact</h2>
                            <div class="field">
                                <label class="label">Name</label>
                                <div class="control">
                                    <input class="input is-rounded is-primary" type="text" placeholder="e.g Alex Smith" required>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Email</label>
                                <div class="control">
                                    <input class="input is-rounded is-primary" type="email" placeholder="e.g. alexsmith@gmail.com" required>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Phone</label>
                                <div class="control">
                                    <input class="input is-rounded is-primary" type="text" placeholder="e.g. +91 999999999" required>
                                </div>
                            </div>
                            <div class="control mt-4">
                                <button class="button is-fullwidth is-rounded is-primary">Add Contact</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column is-8">
                <div class="card mt-5">
                    <div class="card-content">
                        <h2 class="title is-4 has-text-centered">Contacts</h2>
                        <div class="columns is-multiline">
                            <div class="column is-6" v-for="item in 1">
                                <article class="message">
                                    <div class="message-header">
                                        <p>Alex Smith</p>
                                    </div>
                                    <div class="message-body">
                                        <div>Name: <strong>Alex Smith</strong></div>
                                        <div>Email: <strong>alexsmith@gmail.com</strong></div>
                                        <div>Phone: <strong>+91 999999999</strong></div>
                                        <div class="mt-3">
                                            <span class="tag is-rounded is-primary"><a href="">Update</a></span>
                                            <span class="tag is-rounded is-danger"><a href="">Delete</a></span>
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
export default {
    mounted() {
        console.log('Component mounted.')
    }
}
</script>

<style> 
.tag a{
    text-decoration: none !important;
}
</style>