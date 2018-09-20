<template>
    <md-card>
        <div class="md-layout">
            <div class="md-layout-item md-xlarge-size-20 md-medium-size-33 md-small-size-100">
                <img id="platform-logo" src="/graphics/platform-logo.svg" />
            </div>
            <div class="md-layout-item md-xlarge-size-80 md-medium-size-67 md-small-size-100">
                <md-card-header>
                    <h1>Sign in</h1>
                </md-card-header>
                <md-card-content>
                    <p>Please <router-link to="register">register here</router-link> if you haven't already.</p>
                    <form>
                        <md-field>
                            <label for="email">E-mail:</label>
                            <md-input name="email" id="email" type="email" v-model="email"></md-input>
                        </md-field>
                        <md-field>
                            <label for="password">Password:</label>
                            <md-input name="password" id="password" type="password" v-model="password"></md-input>
                        </md-field>
                    </form>
                </md-card-content>
                <md-card-actions>
                    <md-button class="md-raised md-accent">Forgot password?</md-button>
                    <md-button class="md-raised md-primary" @click="login">Sign in</md-button>
                </md-card-actions>
            </div>
        </div>
    </md-card>
</template>

<script>
    export default {
        name: "LoginComponent",
        data(){
            return {
                email: "",
                password: ""
            }
        },
        methods: {
            login() {
                console.log("LOGGING IN!");
                this.$store.dispatch("login", {
                    email: this.email,
                    password: this.password
                }).then(() => this.$router.push("/"));
            }
        }
    }
</script>

<style scoped>
    #platform-logo {
        width: 200px;
        display: block;
        margin: auto;
        padding-top: 20px;
    }
</style>
