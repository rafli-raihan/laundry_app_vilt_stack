<script setup lang="ts">
import RegisteredUserController from '@/actions/App/Http/Controllers/Auth/RegisteredUserController';
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { acc_index } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Form, Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Ubah Akun Pengguna',
        href: '/accounts/{user}/edit',
    },
];

const userProps = defineProps<{
    user: {
        id: number;
        name: string;
        email: string;
        id_level: number;
    };
}>();


// const levels = defineProps<{
//     levels: Array<{
//         id: number;
//         name: string;
//     }>;
// }>();

// ini buat declare formnya klo mau pake formHelper inertia, biar pas edit ada isinya
// const forms = useForm({
//     id_level: existingUser.user.id_level,
//     name: existingUser.user.name,
//     email: existingUser.user.email,
//     password: '',
//     password_confirmation: '',
// });

// const handleSubmit = () => {
//     RegisteredUserController.update(existingUser.user).submit(forms);
// };
</script>

<template>

    <Head title="Register" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-7">
            <Link :href="acc_index().url">
            <Button variant="outline" class="absolute top-4 left-4">
                Back to list
            </Button>
            </Link>
            <Form v-bind="RegisteredUserController.update.form(userProps.user)"
                :reset-on-success="['password', 'password_confirmation']" v-slot="{ errors, processing }"
                class="flex flex-col gap-6 max-w-md">
                <div class="grid gap-6">
                    <div class="grid gap-2">
                        <Label for="name">Name</Label>
                        <Input v-model="userProps.user.name" id="name" type="text" required autofocus :tabindex="1" autocomplete="name" name="name"
                            placeholder="Full name" />
                        <InputError :message="errors.name" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="email">Email address</Label>
                        <Input v-model="userProps.user.email" id="email" type="email" required :tabindex="2" autocomplete="email" name="email"
                            placeholder="email@example.com" />
                        <InputError :message="errors.email" />
                    </div>

                    <!-- <div class="grid gap-2">
                        <Label for="password">Password</Label>
                        <Input id="password" type="password" required :tabindex="3" autocomplete="new-password"
                            name="password" placeholder="Password" />
                        <InputError :message="errors.password" />
                    </div>

                    <div class="grid gap-2">
                        <Label for="password_confirmation">Confirm password</Label>
                        <Input id="password_confirmation" type="password" required :tabindex="4"
                            autocomplete="new-password" name="password_confirmation" placeholder="Confirm password" />
                        <InputError :message="errors.password_confirmation" />
                    </div> -->

                    <div class="grid gap-2">
                        <Label for="id_level">Level</Label>
                        <Input v-model="userProps.user.id_level" id="id_level" type="number" required autofocus :tabindex="1" autocomplete="name"
                            name="id_level" placeholder="Ntar ganti dropdown ini buat pilih" />
                        <InputError :message="errors.id_level" />
                    </div>

                    <Button type="submit" class="mt-2 w-full" tabindex="5" :disabled="processing"
                        data-test="register-user-button">
                        <LoaderCircle v-if="processing" class="h-4 w-4 animate-spin" />
                        Ubah Akun
                    </Button>
                </div>
            </Form>
        </div>
    </AppLayout>
</template>
