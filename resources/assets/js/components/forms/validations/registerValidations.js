import {required, email, minLength, sameAs} from 'vuelidate/lib/validators';

export default {
    name: {
        required,
        minLength: minLength(3)
    },

    email: {
        required,
        email
    },

    password: {
        required,
        minLength: minLength(6)
    },

    password_confirmation: {
        required,
        sameAs: sameAs('password')
    }
}