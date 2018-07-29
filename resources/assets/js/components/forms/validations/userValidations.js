import { required, minLength, email, sameAs } from 'vuelidate/lib/validators';

export default {
    default: {
        email: {
            required,
            email
        },

        name: {
            required,
            minLength: minLength(3)
        },

        password: {
            required,
            minLength: minLength(6)
        },

        password_confirmation: {
            required,
            sameAs: sameAs('password')
        }
    },

    admin: {
        email: {
            required,
            email
        },

        name: {
            required,
            minLength: minLength(3)
        },

        role_id: {
            required,
        },
    }
}