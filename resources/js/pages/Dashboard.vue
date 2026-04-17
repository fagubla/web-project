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
    {
        title: 'My Posts',
        href: '/settings/profile',
    },
    {
        title: 'My Posts2',
        href: '/settings/profile',
    }
];

const posts = computed(() => page.props.posts);

const form = reactive({
    body: '',
});

const submit = () => {
    // router.post('/posts.store', form);
    router.post(route('posts.store'), form);
};

</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <a href="/dashboard?my-posts=true">My Posts</a>
            <div>
                <form @submit.prevent="submit">
                    <textarea v-model="form.body" name="body" rows="10"></textarea>
                    <button type="submit">Submit</button>
                </form>
            </div>
            <div v-for="post in posts" :key="post.id"> {{ post.body }} {{ post.user.name }}</div>
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
