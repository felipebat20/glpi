<template>
    <div class="container-fluid  h-100 ">

        <div class="panel form-group col-10 mx-auto  rounded-3 py-3 my-5 h-75">
            <div class="row px-4 d-flex justify-content-center">
                <h1 class="d-inline-block text-center col-10">Bem vindo ao GLPI, {{ user.name }}</h1>
            </div>

            <div class="col-12 px-4">
                <form action="#" method="POST" class="form-group">
                    <div class="form-header row col-10">
                        <div class="form-group col-3">
                            <label for="filter">Campo</label>
                            <select name="filter" id="filter" class="form-select  col-12">
                                <option selected>Selecione</option>
                                <option value="1">Código</option>
                                <option value="2">Data</option>
                                <option value="3">Descrição</option>
                                <option value="4">Usuário</option>
                                <option value="5">Prioridade</option>
                                <option value="6">Nível</option>
                                <option value="7">Status</option>
                            </select>
                        </div>
                        <div class="col-6 ">
                            <div class="input-group">
                                <label for="search" class="col-12">Pesquisa</label>
                                <input type="text" id="search" name="search" class="form-control" aria-label="Recipient">
                                <div class="input-group-append">
                                    <span class="input-group-text p-0">
                                        <a href="#" class="btn btn-primary" id="basic-addon-2"><i
                                                class="fas fa-search"></i></a>
                                    </span>
                                </div>
                            </div>

                        </div>

                        <div class="refresh col-3 position-relative align">
                            <a class="btn btn-primary d-inline-block position-absolute bottom-0 ">Atualizar</a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="row px-4">
                <div class="tabela col-10 ">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Data</th>
                                <th>Descrição</th>
                                <th>Usuário</th>
                                <th>Prioridade</th>
                                <th>GUT</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tfoot>

                        </tfoot>
                        <tbody>
                            <tr v-for="(call, index) in calls" :key="index">
                                    <td>{{call.id}}</td>
                                    <td>{{moment(call.created_at).format('L')}}</td>
                                    <td>{{ call.title }}</td>
                                    <td>{{ call.name }}</td>
                                    <td>{{ getPriority(call.gut) }}</td>
                                    <td>{{ call.gut}}</td>
                                    <td>{{ getStatus(call.status) }}</td>

                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="lateral col-2">
                    <button class="btn btn-outline-success m-2 w-100"><i class="fas fa-plus"></i> Novo</button>
                    <a class="btn btn-outline-primary m-2 w-100" href="./chamado.html"><i class="fas fa-pencil-alt"></i>
                        Alterar</a>
                    <button class="btn btn-outline-danger m-2 w-100"><i class="fas fa-minus-circle"></i>
                        Excluir</button>
                    <router-link to="/" class="btn btn-outline-dark m-2 w-100">Sair <i class="fas fa-sign-out-alt text-danger"></i></router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'AdminPanel',

    data (){
        return {
            calls: [],
            customUser: '',
        }
    },

    props: {
        user: {
            type: Object,
            default: () => {},
        }
    },

    mounted() {
        if (!this.user){
            this.$router.push({ name: 'login' })
        }

        if (this.user.usertype == 2){
            this.getAssignedTechCalls();
        }
        this.getCalls();
    },

    methods: {
        getCalls(){
            this.$http.get('http://localhost:8000/api/calls')
            .then( response => {
                this.calls = response.data;
            })
            .catch( error => {
                console.log(error);
            });
        },

        getAssignedTechCalls() {

        },

        getPriority(gut){
            if (gut > 80 ){

                return "Alta";
            }
            if(gut<= 40){

                return "Baixa";
            }

            return "Media";
        },

        getStatus(status){
            if (status === 1){
                return "Em aberto";
            }
            if (status === 2){
                return "Em atendimento";
            }
            if (status === 3){
                return "Finalizado"
            }
        }
    }
}
</script>