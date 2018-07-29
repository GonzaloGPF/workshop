import {required, email, minLength} from 'vuelidate/lib/validators';

export default {
    email: {
        required,
        email
    },

    password: {
        required,
        minLength: minLength(6)
    }
}