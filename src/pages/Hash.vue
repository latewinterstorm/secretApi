<template>
<div class="p-grid h-100">
    <div class="p-col-6 p-offset-3 p-shadow-4 p-p-5 p-mt-6">
        <div class="card">
            <div class="p-fluid">
                <h2>Get Secret</h2>
                <form @submit.prevent="submitHash(!v$.$invalid)">
                    <div class="p-field p-text-left">
                        <label for="secret">Hash</label>
                        <InputText id="secret" type="text" v-model="v$.hash.$model" :class="{'p-invalid':v$.hash.$invalid && submitted}" placeholder="Paste hash here" />
                        <small v-if="(v$.hash.$invalid && submitted) || v$.hash.$pending.$response" class="p-error">Hash field is required</small>
                    </div>
                    <div class="p-m-2">
                        <RadioButton id="header1" class="p-mx-2" name="header" value="application/json" v-model="acceptHeader" />
                    <label for="header1">application/json</label>
                        <RadioButton id="header2" class="p-mx-2" name="header" value="application/xml" v-model="acceptHeader" />
                    <label for="header2">application/xml</label>
                    </div>
                    <div class="p-field">
                        <Button class="p-mb-2" label="Get Secret" :onclick="submitHash"/>
                        <Button class="p-mt-2 p-button-outlined" label="Back" @click="$router.push('/')" />
                    </div>
                    {{hashResponse}}
                </form>
            </div>
        </div>
    </div>
</div>

</template>

<script>

import useVuelidate from '@vuelidate/core'
import { required } from '@vuelidate/validators'

export default {
    name: "Secret",
    setup () {
        return { v$: useVuelidate() }
    },
    data() {
        return {
                hash: "",
                submitted: false,
                acceptHeader: 'application/json',
                hashResponse: ''
            }
    },
    methods: {
        submitHash(isFormValid) {
            this.submitted = true;

            if (!isFormValid) {
                return;
            }

            this.axios
            .get("http://vrd.lws.nhely.hu/api/secret/" + this.hash, {headers: {'Accept': this.acceptHeader }})
            .then((resp) => {
                this.hashResponse = resp.data
            });
        },
    },
    validations() {
        return {
            hash: {
                required
            },
        }
    }
}
</script>