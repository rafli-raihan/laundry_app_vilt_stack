<script setup lang="ts">
import ServiceController from '@/actions/App/Http/Controllers/ServiceController';
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { service_index } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Form, Head } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';
import { Textarea } from '@/components/ui/textarea'


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Penambahan Layanan',
        href: '/services/register',
    },
];
</script>

<template>

    <Head title="Register" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-7">
            <Link :href="service_index().url">
            <Button variant="outline" class="absolute top-4 left-4">
                Back to list
            </Button>
            </Link>
            <Form v-bind="ServiceController.store.form()"
                :reset-on-success="['password', 'password_confirmation']" v-slot="{ errors, processing }"
                class="flex flex-col gap-6 max-w-md">
                <div class="grid gap-6">
                    <div class="grid gap-2">
                        <Label for="service_name">Name</Label>
                        <Input id="service_name" type="text" required autofocus :tabindex="1" autocomplete="name" name="service_name"
                            placeholder="Full name" />
                        <InputError :message="errors.service_name" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="desc">Deskripsi</Label>
                        <Textarea id="desc" type="text" required :tabindex="2" autocomplete="description" name="description"
                            />
                        <InputError :message="errors.description" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="price">Harga</Label>
                        <Input id="price" type="number" required autofocus :tabindex="1" autocomplete="price"
                            name="price" placeholder="" />
                        <InputError :message="errors.price" />
                    </div>

                    <Button type="submit" class="mt-2 w-full" tabindex="5" :disabled="processing"
                        data-test="register-user-button">
                        <LoaderCircle v-if="processing" class="h-4 w-4 animate-spin" />
                        Tambahkan Layanan
                    </Button>
                </div>
            </Form>
        </div>
    </AppLayout>
</template>
