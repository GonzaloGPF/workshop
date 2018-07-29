<style>
    .InfoBlock {
        border: solid 1px rgba(0,0,0,0.1);
        border-top: none;
        padding: 0.5em;
        margin: 1em 2px;
    }

    .InfoBlock > .InfoBlock__Title {
        font: 1em normal;
        margin: -1em -0.5em 0;
        font-weight: 400;
        font-size: 1.1em;
    }

    .InfoBlock > .InfoBlock__Title > span {
        float: left;
    }

    .InfoBlock > .InfoBlock__Title:before {
        border-top: solid 1px rgba(0,0,0,0.1);
        content: ' ';
        float: left;
        margin: 0.5em 2px 0 -1px;
        width: 0.75em;
    }

    .InfoBlock > .InfoBlock__Title:after {
        border-top: solid 1px rgba(0,0,0,0.1);
        content: ' ';
        display: block;
        height: 1.5em;
        left: 2px;
        margin: 0 1px 0 0;
        overflow: hidden;
        position: relative;
        top: 0.5em;
    }

    .InfoBlock__Content {
        padding: 0 1em 1em 1em;;
    }
</style>
<template>
    <div class="InfoBlock">
        <h1 class="InfoBlock__Title">
            <span v-text="title"/>
        </h1>
        <div class="InfoBlock__Content">
            <slot/>
        </div>
    </div>
</template>
<script>
export default {
    props: ['title'],

    data(){
        return {

        }
    }
}
</script>