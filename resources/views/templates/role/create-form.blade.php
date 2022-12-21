<template>
    <form class="w-full" {{'@'}}Submit.prevent="storeModel">
        <div class=" sm:col-span-4">
            <jet-label class="required" for="title" value="Title" />
            <jet-input class="w-full" type="text" id="title" name="title" v-model="form.title"
                       :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.title}"
            ></jet-input>
            <jet-input-error :message="form.errors.title" class="mt-2" />
        </div>

        <div class="mt-2 text-right">
            <inertia-button type="Submit" class="bg-success font-semibold disabled:opacity-25" :disabled="form.processing">@{{__("Submit")}}</inertia-button>
        </div>
    </form>
</template>

<script>
    import JetInput from "@/Jetstream/Input.vue";
    import JetLabel from "@/Jetstream/Label.vue";
    import InertiaButton from "@/JigComponents/InertiaButton.vue";
    import JetInputError from "@/Jetstream/InputError.vue"
    import {useForm} from "@inertiajs/inertia-vue3";
    export default {
        name: "Create{{$modelPlural}}Form",
        components: {
            InertiaButton,
            JetInputError,
            JetLabel,
            JetInput,

        },
        data() {
            return {
                form: useForm({
                    title: null,
                }, {remember: false}),
            }
        },
        mounted() {
        },
        computed: {
            flash() {
                return this.{{'$'}}page.props.flash || {}
            }
        },
        methods: {
            async storeModel() {
                this.form.post(this.route('admin.roles.store'),{
                    onSuccess: res => {
                        if (this.flash.success) {
                            this.{{'$'}}emit(__("success"),__(this.flash.success));
                        } else if (this.flash.error) {
                            this.{{'$'}}emit(__("success"),__(this.flash.error));
                        } else {
                            this.{{'$'}}emit(__("success"),__("Unknown server error."))
                        }
                    },
                    onError: res => {
                        this.{{'$'}}emit(__("success"),__("A server error occurred"));
                    }
                },{remember: false, preserveState: true})
            }
        }
    }
</script>

<style scoped>

</style>
