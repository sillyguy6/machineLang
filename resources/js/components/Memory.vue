<template>
    <div id="memory_main" class="p-2">
        <span class="p-1 m-0" style="height: 5%;">Main Memory</span>

        <div class="row  m-0 p-0" style="height: 95%;">
            <div class="col-12 p-0 h-100 overflow-scroll" id="memory_scroll" >
                <ul class="list-group list-group-flush" >

                    <li v-for="(value, index) in memory.memory" class="list-group-item bg-transparent d-flex justify-content-around" :id="listID(index)">
                        <button class="bg-white">{{ address(index) }}</button>
                        <button class="bg-white">{{ value }}</button>
                    </li>
                </ul>

            </div>
        </div>



        <!-- <span class="p-1 m-0" >Main Memory</span>

        <div class="row  m-0 p-0" style="height: 100%;">
            <div class="col-12 p-0 h-100 overflow-scroll" id="memory_scroll" >
                <ul class="list-group list-group-flush" >

                    <li v-for="(value, index) in memory.memory" class="list-group-item bg-transparent d-flex justify-content-around" :id="listID(index)">
                        <button class="bg-white">{{ address(index) }}</button>
                        <button class="bg-white">{{ value }}</button>
                    </li>
                </ul>

            </div>
        </div> -->



    </div>
</template>


<script>


var $ = require("jquery");

export default {

    props: ['mem'],
    data: function () {
        return {
            memory: this.mem,
        }
    },

    created() {
        // let AST = parse('abcd\nafff')
        // console.log(AST)
        Event.$on('scroll', (id) => {
            var id = '#mem_' + this.toMemHex(id)
            let ele = $('#memory_scroll ' + id)
            console.log(ele[0])
            let offset= $('#memory_scroll')[0].getBoundingClientRect().top - document.body.getBoundingClientRect().top

            offset = ele[0].offsetTop - offset

            $('#memory_scroll').animate({
                scrollTop: offset
            }, 500);
        })

        // Event.$on('update_mem', (id) => {

        // })
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
        }

    },

}
</script>

<style>
#memory_main {
    border-style: dashed;
    border-width: 4px;
    border-color: gray;
}
</style>
