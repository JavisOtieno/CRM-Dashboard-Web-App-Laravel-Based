<script>
// import SidebarNew from '@/Pages/Sidebarnew.vue';
import { Head } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3'; // Make sure @inertiajs/vue3 is installed
import { Link } from '@inertiajs/vue3';

export default {
  components: { Link },
//   components: { SidebarNew },
//   props: {
//     location: {
//       type: Object,
//       required: true, // Ensure the seller data is passed as a prop
//     },
//     accounts: {
//       type: Array,
//       default: () => [],
//     },
//   },
props: {

    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
},

  setup(props) {
    // Initialize form state with useForm


    const form = useForm({
        token: props.token,
        email: props.email,
        password: '',
        password_confirmation: '',
    });
    
    const submitForm = () => {
    form.post(route('password.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
        onSuccess: () => {
            form.reset('email');
            alert("Password reset successfully")
        },
        onError: (errors) => {
            // Handle errors here
            // You can customize the error message as per your needs
            const errorMessages = Object.values(errors).flat().join(', ');
            alert(`Error(s): ${errorMessages}`);
        },
    });

  
    };

    return { form, submitForm };


    
  },
};
</script>

<template>
<section class="bg-defaultbackground-50 dark:bg-defaultbackground-900" >
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
            <img class="w-40 h-8 mr-2" src="/images/logo-rtms.png" alt="logo">
            <!-- CRMTest     -->
        </a>
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Reset Password
                </h1>
                <form class="space-y-4 md:space-y-6" @submit.prevent="submitForm" >
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" v-model="form.email" name="email" id="email" 
                        class="bg-gray-50 border border-gray-300 text-gray-900 
                        rounded-lg focus:ring-primary-600 focus:border-primary-600 
                        block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 
                        dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500
                         dark:focus:border-blue-500" placeholder="Email" required>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" name="password" id="password" v-model="form.password"
                        placeholder="Password" class="bg-gray-50 border border-gray-300 
                        text-gray-900 rounded-lg focus:ring-primary-600 
                        focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 
                        dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                        dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>
                    <div>
                        <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                         v-model="form.password_confirmation"
                        placeholder="Confirm Password" class="bg-gray-50 border border-gray-300 
                        text-gray-900 rounded-lg focus:ring-primary-600 
                        focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 
                        dark:border-gray-600 dark:placeholder-gray-400 dark:text-white 
                        dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                    </div>
                    <div class="flex items-center justify-between">
                        <!-- <div class="flex items-start">
                            <div class="flex items-center h-5">
                              <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" >
                            </div>
                            <div class="ml-3 text-sm">
                              <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                            </div>
                        </div> -->
                        
                    </div>
                    <!-- <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button> -->

                    <button type="submit" 
                    :disabled="form.processing"
                    class="w-full text-white bg-primary-600 hover:bg-primary-700
                     focus:ring-4 focus:outline-none focus:ring-primary-300 
                     font-medium rounded-lg text-sm px-5 py-2.5 text-center
                      dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-600">
                      Reset Password</button>
                    
                </form>
            </div>
        </div>
    </div>
  </section>
  </template>