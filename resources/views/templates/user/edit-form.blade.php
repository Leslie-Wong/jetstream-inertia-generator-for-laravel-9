@php
    $hasCheckbox = true;
    $hasSelect = false;
    $hasTextArea = false;
    $hasInput = false;
    $hasDate = false;
    $hasPassword = false;
@endphp
<template>
    <jig-tabs :class="`border-none`" nav-classes="bg-secondary-300 rounded-t-lg border-b-4 border-primary">
        <template #nav>
            <jig-tab-link @activate="activeTab=$event" :active-classes="tabActiveClasses" :tab-controller="activeTab"
                          tab="basic-info">@{{__("Basic Info")}}
            </jig-tab-link>
            <jig-tab-link @activate="activeTab=$event" :active-classes="tabActiveClasses" :tab-controller="activeTab"
                          tab="assign-roles">Assign Roles
            </jig-tab-link>
        </template>
        <template #content>
            <jig-tab name="basic-info" :tab-controller="activeTab">
                <form {{'@Submit'}}.prevent="updateModel">
                @foreach($columns as $col)
@if($col['type'] === 'date' )@php $hasDate = true; echo "\r";@endphp
                    <div class=" sm:col-span-4">
                        <jet-label for="{{$col['name']}}" value="{{$col['label']}}" />
                        <jig-datepicker
                            class="w-full"
                            id="{{$col['name']}}"
                            name="{{$col['name']}}"
                            v-model="form.{{$col['name']}}"
                            data-date-format="Y-m-d"
                            :data-alt-input="true"
                            data-alt-format="l M J, Y"
                            :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.{{$col['name']}}}"
                        ></jig-datepicker>
                        <jet-input-error :message="form.errors.{{$col['name']}}" class="mt-2" />
                    </div>
@elseif($col['type'] === 'time')@php $hasDate = true;echo "\r"; @endphp
                    <div class=" sm:col-span-4">
                        <jet-label for="{{$col['name']}}" value="{{$col['label']}}" />
                        <jig-datepicker class="w-full"
                                        data-date-format="H:i"
                                        :data-alt-input="true"
                                        data-alt-format="h:i K"
                                        data-default-hour="9"
                                        :data-enable-time="true"
                                        :data-no-calendar="true"
                                        name="{{$col['name']}}"
                                        v-model="form.{{$col['name']}}"
                                        id="{{$col['name']}}"
                                        :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.{{$col['name']}}}"
                        ></jig-datepicker>
                        <jet-input-error :message="form.errors.{{$col['name']}}" class="mt-2" />
                    </div>
@elseif($col['type'] === 'datetime')@php $hasDate = true;echo "\r"; @endphp
                    <div class=" sm:col-span-4">
                        <jet-label for="{{$col['name']}}" value="{{$col['label']}}" />
                        <jig-datepicker class="w-full"
                                        data-date-format="Y-m-d H:i:s"
                                        :data-alt-input="true"
                                        data-alt-format="l M J, Y at h:i K"
                                        data-default-hour="9"
                                        :data-enable-time="true"
                                        name="{{$col['name']}}"
                                        v-model="form.{{$col['name']}}"
                                        id="{{$col['name']}}"
                                        :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.{{$col['name']}}}"
                        ></jig-datepicker>
                        <jet-input-error :message="form.errors.{{$col['name']}}" class="mt-2" />
                    </div>
@elseif($col['type'] === 'boolean')@php $hasCheckbox = true; echo "\r"; @endphp
                    <div class=" sm:col-span-4">
                        <jet-label for="{{$col['name']}}" value="{{$col['label']}}" />
                        <jet-checkbox class="p-2" type="checkbox" id="{{$col['name']}}" name="{{$col['name']}}" :checked="form.{{$col['name']}}" v-model="form.{{$col['name']}}"
                                      :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.{{$col['name']}}}"
                        ></jet-checkbox>
                        <jet-input-error :message="form.errors.{{$col['name']}}" class="mt-2" />
                    </div>
@elseif($col['type'] === 'text')@php $hasTextArea = true; echo "\r"; @endphp
                    <div class=" sm:col-span-4">
                        <jet-label for="{{$col['name']}}" value="{{$col['label']}}" />
                        <jig-textarea class="w-full" id="{{$col['name']}}" name="{{$col['name']}}" v-model="form.{{$col['name']}}"
                                      :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.{{$col['name']}}}"
                        ></jig-textarea>
                        <jet-input-error :message="form.errors.{{$col['name']}}" class="mt-2" />
                    </div>
@elseif($col['type'] === 'double'|| $col['type'] ==='integer')@php $hasInput = true; echo "\r";@endphp
                    <div class=" sm:col-span-4">
                        <jet-label for="{{$col['name']}}" value="{{$col['label']}}" />
                        <jet-input class="w-full" type="number" id="{{$col['name']}}" name="{{$col['name']}}" v-model="form.{{$col['name']}}"
                                   :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.{{$col['name']}}}"
                        ></jet-input>
                        <jet-input-error :message="form.errors.{{$col['name']}}" class="mt-2" />
                    </div>
@elseif($col['name'] === 'password') @php $hasInput = true; $hasPassword = true; echo "\r";@endphp
                    <div class=" sm:col-span-4">
                        <jet-label for="{{$col['name']}}" value="{{$col['label']}}" />
                        <jet-input class="w-full" type="password" id="{{$col['name']}}" name="{{$col['name']}}" v-model="form.{{$col['name']}}"
                                   :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.{{$col['name']}}}"
                        ></jet-input>
                        <jet-input-error :message="form.errors.{{$col['name']}}" class="mt-2" />
                    </div>
                    <div class=" sm:col-span-4">
                        <jet-label for="{{$col['name']}}_confirmation" value="Repeat {{$col['label']}}" />
                        <jet-input class="w-full" type="password" id="{{$col['name']}}_confirmation" name="{{$col['name']}}_confirmation" v-model="form.{{$col['name']}}_confirmation"
                                   :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.{{$col['name']}}_confirmation}"
                        ></jet-input>
                    </div>
@else @php $hasInput = true; echo "\r"; @endphp
                    <div class=" sm:col-span-4">
                        <jet-label for="{{$col['name']}}" value="{{$col['label']}}" />
                        <jet-input class="w-full" type="text" id="{{$col['name']}}" name="{{$col['name']}}" v-model="form.{{$col['name']}}"
                                   :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.{{$col['name']}}}"
                        ></jet-input>
                        <jet-input-error :message="form.errors.{{$col['name']}}" class="mt-2" />
                    </div>
@endif
            @endforeach
            @if (count($relations))
                @if(isset($relations['belongsTo']) && count($relations['belongsTo']))
                    @foreach($relations['belongsTo'] as $belongsTo)@php $hasSelect = true; echo "\r"; @endphp
                    <div class=" sm:col-span-4">
                        <jet-label for="{{$belongsTo['relationship_variable']}}" value="{{$belongsTo['related_model_title']}}" />
                        <infinite-select class="w-full" :per-page="15" :api-url="route('api.{{$belongsTo['related_route_name']}}.index')"
                                         id="{{$belongsTo['relationship_variable']}}" name="{{$belongsTo['relationship_variable']}}"
                                         v-model="form.{{$belongsTo['relationship_variable']}}" label="{{$belongsTo["label_column"]}}"
                                         :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.{{$belongsTo['relationship_variable']}}}"
                        ></infinite-select>
                        <jet-input-error :message="form.errors.{{$belongsTo['relationship_variable']}}" class="mt-2" />
                    </div>
                    @endforeach
                @endif
            @endif

                    <div class="mt-2 text-right">
                        <inertia-button type="Submit" class="bg-primary font-semibold text-white" :disabled="form.processing">@{{__("Submit")}}</inertia-button>
                    </div>
                </form>
            </jig-tab>
            <jig-tab name="assign-roles" :tab-controller="activeTab">
                <div class="my-2 border rounded-md p-3">
                    <h3 class="font-bold py-3 text-lg">Assign Roles</h3>
                    <hr>
                    <div class="p-2 mt-2 border rounded">
                        <div style="cursor: pointer" v-for="(role, idx) of form.assigned_roles" :key="idx"
                             class=" sm:col-span-4 px-10 flex border-b border-gray-100 justify-between py-3 items-center my-2">
                            <jet-label :for="role.name" class="inline-block  font-black text-xl"
                                       :value="role.title"/>
                            <jet-checkbox @change="toggleRole(role)" class="p-2 inline-block" type="checkbox"
                                          :id="role.name" :name="role.name" :checked="role.checked" v-model="role.checked"
                                          :class="{'border-red-500 sm:focus:border-red-300 sm:focus:ring-red-100': form.errors.assigned_roles}"
                            ></jet-checkbox>
                        </div>
                    </div>
                </div>
            </jig-tab>
        </template>
    </jig-tabs>
</template>

<script>
    import JetLabel from "@/Jetstream/Label.vue";
    import InertiaButton from "@/JigComponents/InertiaButton.vue";
    import JetInputError from "@/Jetstream/InputError.vue";
    import {useForm} from "@inertiajs/inertia-vue3";
    import JigTab from "@/JigComponents/JigTab.vue";
    import JigTabs from "@/JigComponents/JigTabs.vue";
    import JigTabLink from "@/JigComponents/JigTabLink.vue";

    @if($hasCheckbox)import JetCheckbox from "@/Jetstream/Checkbox.vue";
@endif
@if($hasDate)import JigDatepicker from "@/JigComponents/JigDatepicker.vue";
@endif
    @if($hasInput)import JetInput from "@/Jetstream/Input.vue";
@endif
    @if($hasTextArea)import JigTextarea from "@/JigComponents/JigTextarea.vue";
@endif
    @if($hasSelect)import InfiniteSelect from '@/JigComponents/InfiniteSelect.vue';
@endif

    export default {
        name: "Edit{{$modelPlural}}Form",
        props: {
            model: Object,
            roles: Object,
        },
        components: {
            InertiaButton,
            JetLabel,
            JetInputError,
            @if($hasInput)JetInput,
@endif
            @if($hasDate)JigDatepicker,
@endif
            @if($hasCheckbox)JetCheckbox,
@endif
            @if($hasTextArea)JigTextarea,
@endif
            @if($hasSelect)InfiniteSelect,
@endif

            JigTabLink,
            JigTabs,
            JigTab,
        },
        data() {
            return {
                form: useForm({
                    ...this.model,
                    assigned_roles: this.roles,
@if($hasPassword)
                    "password_confirmation": null,
@endif
                },{remember:false}),
                activeTab: 'basic-info',
                tabActiveClasses: "bg-primary font-bold text-secondary rounded-t-lg hover:bg-primary-500"
            }
        },
        mounted() {
        },
        computed: {
            flash() {
                return this.$page.props.flash || {}
            }
        },
        methods: {
            async updateModel() {
                this.form.put(this.route('admin.{{$modelRouteAndViewName}}.update',this.form.id),
                    {
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
            },
            async toggleRole(role) {
                const vm = this;
                axios.post(this.route('api.users.assign-role',this.form.id),{role: role}).then(res => {
                    this.{{'$'}}inertia.reload({preserveState: true});
                    this.displayNotification(__("success"),res.data.message)
                }).catch(err => {
                    this.displayNotification(__("success"),err.response?.data?.message || err.message || err)
                    vm.form.assigned_roles[role.name].checked = !role.checked;
                });
            }
        }
    }
</script>

<style scoped>

</style>
