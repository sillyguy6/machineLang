<template>
    <div class="h-100">

        <div class="h-100" v-show="isEditor">
            <div class="p-3" style="height: 80%;">
                <!-- <div class="row h-100">
                                <div class="col-10  h-100 p-3">

                                </div>
                            </div> -->
                <textarea type="text" v-model="instructions" class="form-control h-100" placeholder="write instructions..."></textarea>
                <div class="text-danger">{{ parseError }}</div>
            </div>
            <div style="height: 20%;" class="d-flex justify-content-center align-items-center">

                <button class="btn btn-success" v-on:click="inject">Inject To Main Memory</button>
            </div>
        </div>


        <div class="h-100 p-0" v-show="!isEditor">
            <div class=" " style="height: 60%;">
                <div class="row h-100 m-0 p-3">
                    <div class="col-6  h-100 p-0">
                        <cpu :style="{ height: 100 + '%' }" :cpu_prop="cpu"></cpu>
                    </div>
                    <div class="col-2 h-100 d-flex flex-column justify-content-center  align-items-center p-0">
                        <span>{{ log }}</span>
                        <div class="w-100 bg-secondary" style="height: 3px;"></div>
                    </div>
                    <div class="col-4  h-100 p-0">
                        <memory :mem="memory" :style="{ height: 100 + '%' }"></memory>
                    </div>
                </div>

            </div>
            <div style="height: 40%;">

                <div class="row h-100 m-0 p-0">
                    <div class="col-6 p-0  ">

                        <div class="col-12 p-0 h-50 d-flex align-items-center justify-content-evenly">
                            <button class="btn btn-primary" v-show="showStepBtn" v-on:click="step">step</button>
                            <button class="btn btn-secondary" v-show="showRunBtn" v-on:click="run">run</button>
                            <button class="btn btn-success" v-on:click="switchEditor">editor</button>
                        </div>

                        <div class="col-12 p-0 h-50 d-flex align-items-center justify-content-center">

                            <button class="btn btn-danger" v-on:click="resetPC">Reset Program Counter</button>

                        </div>


                    </div>
                    <div class="col-2 h-100 p-1 d-flex flex-column justify-content-center align-items-center">
                        <label for="" class="form-label">Go To Address : </label>
                        <input type="text" class="form-control" v-on:keyup.enter="scroll" v-model="lid">
                        <div class="text-danger" v-show="goToError">{{ goToError }}</div>
                    </div>
                    <div class="col-4 h-100 p-2 ">
                        <console class="h-100"></console>
                    </div>
                </div>

            </div>
        </div>




    </div>
</template>


<script>
const { parse, Memory, Cpu } = require('my-parser')

export default {
    data() {
        return {
            memory: null,
            cpu: null,
            parseError: null,
            isEditor: false,
            instructions: '',
            lid: '',
            goToError: null,
            log: '',
            isFetched : false,
            showRunBtn : true,
            showStepBtn : true,
        }
    },
    created() {
        this.memory = new Memory()
        this.cpu = new Cpu(this.memory)
    },

    methods: {
        switchEditor() {
            // console.log('injected')
            this.isEditor = true
        },

        inject() {
            try {
                let AST = parse(this.instructions)
                this.memory.fillMemFromAST(AST)
                this.isEditor = false
                this.update_mem()
            } catch (e) {
                this.parseError = 'parsing error!'
            }
        },

        update_mem(){
            this.memory.memory = [...this.memory.memory]
        },

        scroll() {
            if (this.isGotoAddressValid()) {
                this.goToError = null

                Event.$emit('scroll', this.lid)
            }
            else {
                this.goToError = 'must be 00-FF'
            }

        },
        step() {
            this.showRunBtn = false
            try {
                if(this.isFetched){
                    this.log = 'one instruction executed'
                    this.cpu.execute(this.handlePrintInstru)
                    this.update_mem()
                }
                else{
                    this.cpu.fetch()
                    this.log = 'one instruction fetched'
                }

            }
            catch (e) {
                // console.log('pc reach end');
                if (e.message == 'halt') {
                    alert('program halt!')
                }
                else if (e.message == 'pc_end') {
                    alert('program counter reach end, click reset to run')
                    this.isFetched = true
                }
            }
            this.isFetched = !this.isFetched
            this.cpu.register_unit.registers = [...this.cpu.register_unit.registers]

        },

        handlePrintInstru(rnum, value){
            Event.$emit('clg', 'reg ' + rnum + ' : '+ value)
        },

        run() {
            this.showRunBtn = false
            try {
                this.cpu.resetPC()
                this.cpu.process(this.handlePrintInstru)

            }
            catch (e) {
                alert(e.message)

            }

            this.update_mem()

            this.isFetched = false


            this.cpu.register_unit.registers = [...this.cpu.register_unit.registers]

        },

        resetPC() {
            this.cpu.resetPC()
            this.showRunBtn = true
            this.log = ""
        },


        isGotoAddressValid() {
            return /^[A-Fa-f0-9]{2}$/.test(this.lid)

        }
    },

}
</script>
