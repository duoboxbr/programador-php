<template>
    <div class="col-md-12">
        <Breadcrumb :home="home" :model="breadcrumbItems" class="p-0">
            <template #item="{ item, props }">
                <router-link v-if="item.route" v-slot="{ href, navigate }" :to="item.route" custom>
                    <a :href="href" v-bind="props.action" @click="navigate">
                        <span :class="[item.icon, 'text-color']" />
                        <span class="text-primary font-semibold">{{ item.label }}</span>
                    </a>
                </router-link>
                <a v-else :href="item.url" :target="item.target" v-bind="props.action">
                    <span class="text-color">{{ item.label }}</span>
                </a>
            </template>
        </Breadcrumb>

        <hr>
    </div>
</template>

<script>
import Breadcrumb from 'primevue/breadcrumb';

export default {
    components: {
      Breadcrumb,
    },
    props: ['breadcrumbItems'],
    data() {
        return {
            home: {
                icon: 'pi pi-home',
                route: '/'
            },
        }
    }
}
</script>

<style>

</style>