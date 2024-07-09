<template>
    <div class="flex justify-center">
        <nav class="flex items-center space-x-1">
            <Link
                v-for="link in links"
                :key="link.url"
                :href="link.url"
                v-html="link.label"
                :class="{
                    'text-gray-500': !link.url,
                    'font-bold': link.active,
                }"
                class="px-3 py-2 rounded-md border border-gray-300"
            ></Link>
        </nav>
    </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";

export default {
    props: {
        links: Array,
    },
    components: {
        Link,
    },
};
</script>
