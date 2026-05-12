<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage, router } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import { computed, reactive } from 'vue';

const page = usePage();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

const posts = computed(() => page.props.posts);

const currentFilter = computed(() => page.props.filter as string ?? 'all');

const setFilter = (filter: string) => {
    if (filter === 'my') {
        router.get(route('dashboard', { 'my-posts': 'true' }));
    } else {
        router.get(route('dashboard'));
    }
};

const form = reactive({
    body: '',
});

const submit = () => {
    router.post(route('posts.store'), form);
};

</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="flex gap-2">
                <button
                    @click="setFilter('all')"
                    :class="['px-4 py-2 rounded', currentFilter === 'all' ? 'bg-blue-500 text-white' : 'bg-gray-200 dark:bg-gray-700']"
                >
                    All Posts
                </button>
                <button
                    @click="setFilter('my')"
                    :class="['px-4 py-2 rounded', currentFilter === 'my' ? 'bg-blue-500 text-white' : 'bg-gray-200 dark:bg-gray-700']"
                >
                    My Posts
                </button>
            </div>
            <div>
                <form @submit.prevent="submit">
                    <textarea v-model="form.body" name="body" rows="10"></textarea>
                    <button type="submit">Submit</button>
                </form>
            </div>
            <div v-for="post in posts" :key="post.id">
                {{ post.body }} <span class="text-sm text-gray-500">— {{ post.user?.name }}</span>
            </div>
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
            </div>
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
                <PlaceholderPattern />
            </div>
        </div>
    </AppLayout>
</template>
