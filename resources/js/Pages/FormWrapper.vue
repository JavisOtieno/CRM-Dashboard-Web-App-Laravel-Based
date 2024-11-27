<template>
    <SidebarNew />

    <div class="p-4 sm:ml-64">
        <div class="flex">
            <div class="mr-4 pr-6 pl-6 w-full md:w-3/4 lg:w-2/3 p-4 bg-white border-gray-200 border-dashed rounded-lg 
            dark:border-gray-700 mt-14">

                <slot></slot>

            </div>
            <Help />
        </div>
    </div>

</template>

<script>
import SidebarNew from '@/Pages/Sidebarnew.vue';
import Help from '@/Pages/Help.vue';

export default {
    name: 'TableWrapper',
    components: {
        SidebarNew,
        Help
    },
};
</script>