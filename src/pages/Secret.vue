<template>
<div class="p-grid h-100">
                <Toast />

    <div class="p-col-6 p-offset-3 p-shadow-4 p-p-5 p-mb-6">
        <div class="card">
            <div class="p-fluid">
                <h2>Sshhh... It's a Secret</h2>
                <form @submit.prevent="submitSecret(!v$.$invalid)">
                    <div class="p-field p-text-left">
                        <label for="secret">Secret</label>
                        <InputText id="secret" type="text" v-model="v$.secret.$model" :class="{'p-invalid':v$.secret.$invalid && submitted}" placeholder="Your secret goes here" />
                        <small v-if="(v$.secret.$invalid && submitted) || v$.secret.$pending.$response" class="p-error">Secret is required</small>
                    </div>
                    <div class="p-field p-text-left">
                        <label for="expireAfterViews">Number of possible views</label>
                        <InputNumber id="expireAfterViews" showButtons :min="0" v-model="v$.expireAfterViews.$model" :class="{'p-invalid':v$.expireAfterViews.$invalid && submitted}" />
                        <small v-if="(v$.expireAfterViews.$invalid && submitted) || v$.expireAfterViews.$pending.$response" class="p-error">Number of possible views must be minimum 1</small>
                    </div>
                    <div class="p-field p-text-left">
                        <label for="expireAfter">Expiration (in minutes)</label>
                        <InputNumber id="expireAfter" showButtons :min="0" v-model="v$.expiresAt.$model" :class="{'p-invalid':v$.expiresAt.$invalid && submitted}" />
                        <small v-if="(v$.expiresAt.$invalid && submitted) || v$.expiresAt.$pending.$response" class="p-error">Expiration must be 0 or a positive number</small>
                    </div>
                    <div class="p-field">
                        <Button class="p-mb-2" label="Submit Secret" @click="submitSecret"/>
                        <Button class="p-mt-2 p-button-outlined" label="Get Secret" @click="$router.push('/hash')" />
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>

</template>

<script>

import useVuelidate from '@vuelidate/core'
import { required, minValue } from '@vuelidate/validators'
import VueAxios from 'vue-axios'

export default {
    name: "Secret",
    setup () {
        return { v$: useVuelidate() }
    },
    data() {
        return {
                secret: "",
                expireAfterViews: 1,
                expiresAt: 0,
                submitted: false,
            }
    },
    methods: {
        submitSecret(isFormValid) {
            this.submitted = true;

            if (!isFormValid) {
                return;
            }
            let data = {
                "secret": this.secret,
                "expireAfterViews": this.expireAfterViews,
                "expiresAt": this.expiresAt
            }
            this.axios
            .post("http://vrd.lws.nhely.hu/api/secret", data)
            .then(
                this.secret = "",
                this.expireAfterViews = 1,
                this.expiresAt = 0,
                this.submitted = false,
                alert("Secret Saved!")
            );
        },
    },
    validations() {
        return {
            secret: {
                required
            },
            expireAfterViews: {
                required,
                minValue: minValue(1)
            },
            expiresAt: {
                required,
                minValue: minValue(0)
            }
        }
    }
}
</script>