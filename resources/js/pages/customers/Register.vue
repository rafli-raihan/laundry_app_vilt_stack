<script setup lang="ts">
import CustomerController from '@/actions/App/Http/Controllers/CustomerController';
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { customers_index } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Form, Head } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { Textarea } from '@/components/ui/textarea'


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Penambahan Layanan',
        href: '/customers/register',
    },
];
</script>

<template>

    <Head title="Tambahkan Pelanggan" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-7">
            <Link :href="customers_index().url">
            <Button variant="outline" class="absolute top-4 left-4">
                Back to list
            </Button>
            </Link>
            <Form v-bind="CustomerController.store.form()"
                :reset-on-success="['password', 'password_confirmation']" v-slot="{ errors, processing }"
                class="flex flex-col gap-6 max-w-md">
                <div class="grid gap-6">
                    <div class="grid gap-2">
                        <Label for="customer_name">Name</Label>
                        <Input id="customer_name" type="text" required autofocus :tabindex="1" autocomplete="name" name="customer_name"
                            placeholder="Full name" />
                        <InputError :message="errors.customer_name" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="phone">No. Telp</Label>
                        <Input id="phone" type="text" required :tabindex="2" autocomplete="description" name="phone"
                            />
                        <InputError :message="errors.phone" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="address">Alamat</Label>
                        <Textarea id="address" type="text" required autofocus :tabindex="1" autocomplete="address"
                            name="address" placeholder="" />
                        <InputError :message="errors.address" />
                    </div>

                    <Button type="submit" class="mt-2 w-full" tabindex="5" :disabled="processing"
                        data-test="register-user-button">
                        <LoaderCircle v-if="processing" class="h-4 w-4 animate-spin" />
                        Tambahkan <P></P>
                    </Button>
                </div>
            </Form>
        </div>
    </AppLayout>
</template>
