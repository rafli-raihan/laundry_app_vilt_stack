<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard, acc_register, acc_index, acc_edit, acc_delete } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import Button from '@/components/ui/button/Button.vue';
import {
    Table,
    TableBody,
    TableCaption,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Daftar Akun Pengguna',
        href: acc_index().url,
    },
];

// ini buat strukturin data user props dari controller
const userProps = defineProps<{
    users: Array<{
        id: number;
        name: string;
        email: string;
        id_level: string;
    }>;
}>();
</script>

<template>

    <Head title="Akun Pengguna" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="relative min-h-[100vh] flex-1 border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
            <Link :href="acc_register().url">
            <Button variant="outline" class="fixed top-4 right-4">Tambah Pengguna</Button>
            </Link>
            <Table>
                <!-- <TableCaption></TableCaption> -->
                <TableHeader>
                    <TableRow>
                        <TableHead class="w-min text-center">
                            No. ID
                        </TableHead>
                        <TableHead class="text-center">Nama</TableHead>
                        <TableHead class="text-center">Email</TableHead>
                        <TableHead class="text-center">Level (Role)</TableHead>
                        <TableHead></TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="user in userProps.users" :key="user.id">
                        <TableCell class="text-center">{{ user.id }}</TableCell>
                        <TableCell class="text-center">{{ user.name }}</TableCell>
                        <TableCell class="text-center">{{ user.email }}</TableCell>
                        <TableCell class="text-center">{{ user.id_level }}</TableCell>
                        <TableCell class="flex gap-2">
                            <Link :href="acc_edit(user.id).url">
                                <Button variant="default" size="sm" class="">Edit</Button>
                            </Link>
                            <Link :href="acc_delete(user.id).url">
                                <Button variant="ghost" size="sm" class="hover:text-red-400">Delete</Button>
                            </Link>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div>
    </AppLayout>
</template>
