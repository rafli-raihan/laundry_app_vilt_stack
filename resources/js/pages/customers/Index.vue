<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard, customers_index, customers_register, customers_edit, customers_delete } from '@/routes';
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
        title: 'Daftar Pelanggan',
        href: customers_index().url,
    },
];

// ini buat strukturin data user props dari controller
const customerProps = defineProps<{
    customers: Array<{
        id: number;
        customer_name: string;
        phone: string;
        address: string;
    }>;
}>();

function handleDelete(customerId: number) {
    if (confirm('Are you sure you want to delete this customer?')) {
        // Redirect to the delete route
        router.visit(customers_delete(customerId).url, {
            method: 'delete',
        });
    }
}
</script>

<template>

    <Head title="Daftar Layanan" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div
            class="relative min-h-[100vh] flex-1 border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
            <Link :href="customers_register().url">
            <Button variant="outline" class="fixed top-4 right-4">Tambah Pelanggan</Button>
            </Link>
            <Table>
                <!-- <TableCaption></TableCaption> -->
                <TableHeader>
                    <TableRow>
                        <TableHead class="w-min text-center">
                            No. ID
                        </TableHead>
                        <TableHead class="text-center">Nama</TableHead>
                        <TableHead class="text-center">No. Telp</TableHead>
                        <TableHead class="text-center">Alamat</TableHead>
                        <TableHead></TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="customer in customerProps.customers" :key="customer.id">
                        <TableCell class="text-center">{{ customer.id }}</TableCell>
                        <TableCell class="text-center">{{ customer.customer_name }}</TableCell>
                        <TableCell class="text-center">{{ customer.phone }}</TableCell>
                        <TableCell class="text-center">{{ customer.address }}</TableCell>
                        <TableCell class="flex gap-2">
                            <Link :href="customers_edit(customer.id).url">
                            <Button variant="default" size="sm" class="">Edit</Button>
                            </Link>
                            <Button @click="handleDelete(customer.id)" variant="ghost" size="sm" class="hover:text-red-400">Delete</Button>
                        </TableCell>
                    </TableRow>
                </TableBody>
            </Table>
        </div>
    </AppLayout>
</template>
