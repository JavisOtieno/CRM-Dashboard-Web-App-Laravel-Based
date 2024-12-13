<script>
// import SidebarNew from '@/Pages/Sidebarnew.vue';
import { Head } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3'; // Make sure @inertiajs/vue3 is installed
import { Link } from '@inertiajs/vue3';
import LoggedoutWrapper from '../LoggedoutWrapper.vue';
import { ref } from 'vue';

export default {
  components: { Link, LoggedoutWrapper},
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
methods: {
    resetAlerts() {
        this.alertMessage = '';
        this.alertStatus = '';
    },
},
  setup(props) {
    // Initialize form state with useForm

    const form = useForm({
      email: '',
    });

    // Reactive variable for modal alert message
    const alertMessage = ref('');
    const alertStatus = ref('');

    
    
    
    const submitForm = () => {
      form.post('/forgot-password', {
        onSuccess: () => {
            form.reset('email');
            // alert("Email sent successfully")
            alertMessage.value = 'Email sent successfully'; // Update alert message
            alertStatus.value = 'success';

        },
        // onSuccess: () => alert('Login successful!'),
        onError: (errors) => {
            // Handle errors here
            // You can customize the error message as per your needs
            const errorMessages = Object.values(errors).flat().join(', ');
            // alert(`Error(s): ${errorMessages}`);
            alertMessage.value = `Error(s): ${errorMessages}`;
            alertStatus.value = 'failure';

        },
      });
    };

    

    return { form, submitForm, alertMessage, alertStatus };


    
  },
};
</script>

<template>
<LoggedoutWrapper :alert-message="alertMessage" :alert-status="alertStatus"  @reset-alerts="resetAlerts">
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Forgot Password
                </h1>

                <p class="text-lg font-semibold leading-tight tracking-tight text-gray-500 md:text-lg dark:text-white">
                    Just type in your email and we will send you a link to reset your password
                </p>
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
                    
                    
                    <!-- <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button> -->

                    <button type="submit" 
                    :disabled="form.processing"
                    class="w-full text-white bg-primary-600 hover:bg-primary-700
                     focus:ring-4 focus:outline-none focus:ring-primary-300 
                     font-medium rounded-lg text-sm px-5 py-2.5 text-center
                      dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-600">
                      Submit</button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Sign In Instead? <Link :href="route('login')"  
                        class="font-medium text-primary-600 hover:underline dark:text-primary-500">
                        Sign in</Link>
                    </p>
                </form>
            </div>
        </div>
      </LoggedoutWrapper>
  </template>