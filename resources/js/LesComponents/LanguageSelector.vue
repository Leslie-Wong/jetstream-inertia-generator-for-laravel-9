<template>

        <jet-dropdown align="right" class="w-12" :width="28" :open="true">
            <template #trigger>
                <button
                    class="flex text-sm transition duration-150 ease-in-out border-2 border-transparent rounded-full  focus:outline-none focus:border-gray-300"
                >
                    <span v-bind:class="[{'fi': true}, selectable_locale ? 'fi-' + selectable_locale : '']"></span>
                </button>
            </template>

            <template #content>
                <loop v-for="lang in langs" v-bind:key="lang" >
                    <jet-dropdown-link v-if="lang != selectable_locale"
                    :href="route('language',lang)"
                    >
                        <span v-bind:class="[{'fi': true}, lang ? 'fi-' + lang : '']"></span><span>{{ lang.toUpperCase()}}</span>
                    </jet-dropdown-link>
                </loop>
            </template>
        </jet-dropdown>
</template>

<script>
import Loop from '@/LesComponents/Loop.vue'
import JetDropdown from "@/Jetstream/Dropdown.vue";
import JetDropdownLink from "@/Jetstream/DropdownLink.vue";

export default {
    data() {
        return {langs:['cn', 'gb', 'hk']}
    },
    components: {
        Loop,
        JetDropdown,
        JetDropdownLink
    },
    computed: {
        selectable_locale() {
            return this.$page.props.locale
        }
    },
}
</script>
