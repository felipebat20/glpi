<template>
    <div class="container-fluid  h-100 ">
        <div class="panel form-group col-12 mx-auto  rounded-3 py-3 my-5">
            <h1 class="text-center">
                Atualizar chamado
            </h1>
            <form action="#" method="POST" class="col-11 mx-auto" @submit.prevent="handleSubmit">
                <div class="row form-group">
                    <div class="col-9 row">
                        <div class="form-group text-left row my-3">
                            <label
                                for="usuario"
                                class="pt-2"
                            >
                                Título:
                            </label>

                            <input
                                type="text"
                                v-model="getCall.title"
                                disabled
                                class="form-control d-inline-block"
                                placeholder="Digite o título do chamado aqui"
                            >
                        </div>
                        <div class="form-group text-left row my-3">
                            <label
                                for="descrição"
                                class="pt-2"
                            >
                                Descrição:
                            </label>

                            <textarea
                                class="form-control"
                                v-model="getCall.description"
                            />
                        </div>
                        <div class="form-group text-left row my-3">
                            <label
                                for="descrição"
                                class="pt-2"
                            >
                                Anexos:
                            </label>

                            <img
                                :src="getCall.filepath"
                                alt=""
                            >
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="col-12">
                            <label for="nivel">
                                Gravidade
                            </label>

                            <select
                                name="nivel"
                                v-model="getCall.severity"
                                class="form-select"
                            >
                                <option
                                    value="0"
                                    selected
                                >
                                    Selecione
                                </option>

                                <option
                                    v-for="(item, index) in severity"
                                    :key="index"
                                    :value="item.value"
                                >
                                    {{ item.text }}
                                </option>
                            </select>
                        </div>
                        <div class="col-12 my-3">
                            <label for="nivel">
                                Urgência
                            </label>

                            <select
                                name="nivel"
                                v-model="getCall.urgency"
                                class="form-select"
                            >
                                <option
                                    value="0"
                                    selected
                                >
                                    Selecione
                                </option>

                                <option
                                    v-for="(item, index) in urgency"
                                    :key="index"
                                    :value="item.value"
                                >
                                    {{ item.text }}
                                </option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="nivel">
                                Tendência
                            </label>

                            <select
                                name="nivel"
                                v-model="getCall.trend"
                                class="form-select"
                            >
                                <option
                                    value="0"
                                    selected
                                >
                                    Selecione
                                </option>

                                <option
                                    v-for="(item, index) in trend"
                                    :key="index"
                                    :value="item.value"
                                >
                                    {{ item.text }}
                                </option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label
                                for="nivel"
                                class="col-12 mt-5"
                                id="techlabel"
                            >
                                Atribuir ao técnico
                            </label>

                            <select
                                name="nivel"
                                v-model="selectedTech"
                                class="form-select"
                            >
                                <option
                                    value="0"
                                    selected
                                >
                                    Selecione
                                </option>

                                <option
                                    v-for="(tech, index) in techs"
                                    :key="index"
                                    :value="tech.id"
                                >
                                    {{ tech.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-9 d-flex flex-row justify-content-between my-4">
                        <a
                            @click="$router.go(-1)"
                            class="btn btn-warning px-5"
                        >
                            Voltar
                        </a>

                        <button
                            type="submit"
                            class="btn btn-success px-5"
                        >
                            Atualizar chamado
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import severity from '../../static/severity';
import urgency from '../../static/urgency';
import trend from '../../static/trend';
export default {
    name: 'EditarChamado',

    props: {

    },

    data() {
        return {
            user: () => {},
            urgency,
            trend,
            severity,
            techs: [],
            selectedTech: 0,
        }
    },

    computed: {
        ...mapGetters(['getCall', 'getUser']),
    },

    mounted() {
        if (!this.getUser) {
            this.$router.push({ name: "login" });
        }

        // if (localStorage.getItem("call")) {
        //     this.call = JSON.parse(localStorage.getItem("call"));
        // }

        if (!this.getCall) {
            this.$router.go(-1);
        }

        // this.selectedTech = this.call.technician_id;

        this.getTechs();
    },

    methods: {
        async getTechs(){
            await this.$http.get('http://localhost:8000/api/technicians')
                .then(response => {
                    this.techs = response.data;
                })
                .catch(err => {
                    console.log(err);
                });
        },

        handleSubmit(){
            // let gut = 0;
            // if((this.call.severity * this.call.urgency * this.call.trend) != 0) {
            //     gut = this.call.severity * this.call.urgency * this.call.trend;
            // }

            // this.call.technician_id = this.selectedTech;
            // this.call.gut = gut;

            // if (this.call.status < 2) {
            //     this.call.status = 2;
            // }

            // this.$http.put(`http://localhost:8000/api/call/${this.call.id}`, this.call)
            //     .then(response => {
            //         console.log(response.data, this.call);
            //         this.$router.go(-1);
            //     })
            //     .catch( err => {
            //         console.log(err);
            //     });
        }
    }
}
</script>

<style scoped>
label {
    display: flex;
    width:20%;
}

input, textarea{
    width: 80%;
}

textarea{
    height: 100px;
    resize: none;
    overflow-y: auto;
}

.custom-file-input {
    border: 1px red solid;
    background: white;
    padding: 0;
}

input#file-upload-button{
    padding: 0;
}

#techlabel {
    width: 100%;
}
</style>