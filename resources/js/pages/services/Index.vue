<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard, service_index, service_register, service_edit, service_delete } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router } from '@inertiajs/vue3';
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
        title: 'Daftar Layanan',
        href: service_index().url,
    },
];

// ini buat strukturin data user props dari controller
const serviceProps = defineProps<{
    services: Array<{
        id: number;
        service_name: string;
        description: string;
        price: number;
    }>;
}>();

function handleDelete(serviceId: number) {
    if (confirm('Are you sure you want to delete this user?')) {
        // Redirect to the delete route
        router.visit(service_delete(serviceId).url, {
            method: 'delete',
        });
    }
}
</script>

<template>

    <Head title="Akun Layanan" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="relative min-h-[100vh] flex-1 border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
            <Link :href="service_register().url">
            <Button variant="outline" class="fixed top-4 right-4">Tambah Layanan</Button>
            </Link>
            <Table>
                <!-- <TableCaption></TableCaption> -->
                <TableHeader>
                    <TableRow>
                        <TableHead class="w-min text-center">
                            No. ID
                        </TableHead>
                        <TableHead class="text-center">Nama</TableHead>
                        <TableHead class="text-center">Deskripsi</TableHead>
                        <TableHead class="text-center">Harga</TableHead>
                        <TableHead></TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="service in serviceProps.services" :key="service.id">
                        <TableCell class="text-center">{{ service.id }}</TableCell>
                        <TableCell class="text-center">{{ service.service_name }}</TableCell>
                        <TableCell class="text-center">{{ service.description }}</TableCell>
                        <TableCell class="text-center">Rp. {{ service.price }}</TableCell>
                        <TableCell class="flex gap-2">
                            <Link :href="service_edit(service.id).url">
                            <Button variant="default" size="sm" class="">Edit</Button>
                            </Link>
                            <Button @click="handleDelete(service.id)" variant="ghost" size="sm" class="hover:text-red-400">Delete</Button>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div>
    </AppLayout>
</template>
