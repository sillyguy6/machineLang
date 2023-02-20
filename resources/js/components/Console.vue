<template>
    <div id="console_main" class="d-flex flex-column p-2 justify-content-around align-items-center">
            <div class="w-100 p-2">
                <span class="p-0 m-0">Console</span>
                <button class="btn btn-info" v-on:click="clear">clear</button>
            </div>
                <p style="white-space: pre-line;" class=" p-2 m-0 w-100 h-100 overflow-auto text-white bg-dark">{{ message }}</p>
        </div>







    </div>
</template>


<script>


var $ = require("jquery");

export default {

    data: function () {
        return {
            message: ''
        }
    },

    created() {
        Event.$on('clg', (data) => {
            this.log(data)
        })
    },

    methods: {
        toMemHex(hex) {
            return hex.toUpperCase().padStart(2, '0');
        },

        address(index) {
            return this.toMemHex(index.toString(16))
        },

        listID(index) {
            return 'mem_' + this.toMemHex(index.toString(16))
        },

        clear(){
            this.message = ''
        },

        log(data){
            this.message += ">> " + data + "\n"
        }


    },

}
</script>

<style>#console_main {
    border-style: dashed;
    border-width: 4px;
    border-color: gray;
}</style>
