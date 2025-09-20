<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard, acc_register } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import PlaceholderPattern from '../../components/PlaceholderPattern.vue';
import Button from '@/components/ui/button/Button.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];
</script>

<template>
    <Head title="Akun Pengguna" />

    <AppLayout :breadcrumbs="breadcrumbs">
            <div
                class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border"
            >
                <Link :href="acc_register().url">
                    <Button
                        variant="outline"
                        class="absolute top-4 right-4">Tambah Pengguna</Button>
                </Link>
            </div>
    </AppLayout>
</template>
