import Vue from 'vue';

/**
 * We will use a Vue instance as an event bus ❤
 * It will let components messaging each other using a simple object.
 */
let vueInstance = new Vue();

export default {
    /**
     * Emits an event
     *
     * @param {string} event
     * @param {object|null} data
     * return Vue
     */
    emit(event, data = null) {
        return vueInstance.$emit(event, data);
    },

    /**
     * Listen to an event
     *
     * @param {string} event
     * @param {function} callback
     * return Vue
     */
    on(event, callback) {
        return vueInstance.$on(event, callback);
    },

    /**
     * Stops listening to an event.
     * It removes the callback. If no callback is provided, every event handler associated to the event will be removed
     *
     * @param {string} event
     * @param {function|null} callback
     * @returns Vue
     */
    off(event, callback = null) {
        return vueInstance.$off(event, callback)
    }
}