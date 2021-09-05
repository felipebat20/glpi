<template>
  <div class="container-fluid h-100">
    <div class="panel form-group col-12 mx-auto rounded-3 py-3 my-3 h-100">
      <div class="row px-4 d-flex justify-content-center">
        <img
          src="./glpiprincipal.png"
          class="img-fluid d-inline-block col-3"
          alt=""
        />
        <h1 class="d-inline-block text-center col-6 pt-3">
          Bem vindo ao GLPI.
        </h1>
        <div class="col-3">
            <div class="text-end">
                <img :src="avatar_url" class="avatar d-inline-block" alt="">
                <span class="d-block">{{ user.name }}<i class="fas fa-user-edit mx-2"></i></span>
            </div>
        </div>
      </div>

      <div class="col-12 px-4 ">
        <form action="#" method="POST" class="form-group">
          <div class="form-header col-10 d-flex flex-row justify-content-between">
            <div class="form-group col-4">
              <label for="filter">Campo</label>
              <div class="d-flex justify-content-center">
                <select
                  name="filter"
                  id="filter"
                  class="form-select"
                  v-model="filter"
                  @click="checkFilter"
                >
                  <option selected value="0">Selecione</option>
                  <option
                    v-for="(option, index) in options"
                    :key="index"
                    :value="option.value"
                  >
                    {{ option.text }}
                  </option>
                </select>

                <button
                  type="button"
                  class="btn btn-outline-dark pt-1 px-2.5 pb-0"
                  @click="changeOrder"
                >
                  <i
                    :class="[ascending ? 'fas fa-sort-up' : 'fas fa-sort-down']"
                  ></i>
                </button>
              </div>
            </div>
            <div class="col-6">
              <div class="input-group">
                <label for="search" class="col-12">Pesquisa</label>
                <input
                  type="text"
                  id="search"
                  name="search"
                  class="form-control"
                  aria-label="Recipient"
                />
                <div class="input-group-append">
                  <span class="input-group-text p-0">
                    <a href="#" class="btn btn-primary" id="basic-addon-2"
                      ><i class="fas fa-search"></i
                    ></a>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>

      <div class="row px-4">
        <div class="tabela col-10">
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
            <tfoot></tfoot>
            <tbody>
              <tr v-for="(call, index) in calls" :key="index" :id="tr+index" @click="selectItem(index, call)">
                <td>DT 00{{ call.id }}</td>
                <td>{{ moment(call.created_at).format("L") }}</td>
                <td>{{ call.title }}</td>
                <td>{{ call.name }}</td>
                <td>{{ getPriority(call.gut) }}</td>
                <td>{{ call.gut }}</td>
                <td>{{ getStatus(call.status) }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="lateral col-2">
          <router-link to="/admin/users" class="btn btn-outline-secondary m-2 w-100">
            <i class="fas fa-users"></i> Usuários
          </router-link>

          <router-link
            class="btn btn-outline-success m-2 w-100"
            to="/chamado"
          >
            <i class="fas fa-plus"></i> Novo
          </router-link>

          <a @click.stop.prevent="handleEditCall" class="btn btn-outline-primary m-2 w-100">
              <i class="fas fa-pencil-alt"></i> Alterar
          </a>

          <button type="button" class="btn btn-outline-danger m-2 w-100" @click="deleteCall()">
            <i class="fas fa-minus-circle"></i> Excluir
          </button>
          <router-link to="/" class="btn btn-outline-dark m-2 w-100"
            >Sair <i class="fas fa-sign-out-alt text-danger"></i
          ></router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import _ from "lodash";

export default {
  name: "AdminPanel",

  data() {
    return {
      calls: [],
      customUser: "",
      options: [
        { value: "id", text: "Código" },
        { value: "created_at", text: "Data" },
        { value: "title", text: "Descrição" },
        { value: "name", text: "Usuário" },
        { value: "gut", text: "Prioridade" },
        { value: "status", text: "Status" },
      ],

      filter: 0,
      status: ["A atribuir", "Em atendimento", "Finalizado"],
      user: () => {},
      ascending: true,
      order: "asc",
      avatar_url: '../../assets/img/defaultProfilePhoto.png',
      tr: 'tr',
      selectedCall: () => {},
    };
  },

  async mounted() {
    if (localStorage.getItem("user")) {
      this.user = JSON.parse(localStorage.getItem("user"));
    }

    if (!this.user) {
      this.$router.push({ name: "login" });
    }

    this.getCalls();

    await this.getAvatar();
  },

  methods: {
    getCalls() {
      this.$http
        .get("http://localhost:8000/api/calls")
        .then((response) => {
          this.calls = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    getAssignedTechCalls() {},

    getPriority(gut) {
      if (gut > 80) {
        return "Alta";
      }
      if (gut <= 40) {
        return "Baixa";
      }

      return "Media";
    },

    getStatus(status) {
      return this.status[status - 1];
    },

    async sortCalls() {
      await this.calls.forEach(this.removePreviousStyle);
      this.calls = _.orderBy(this.calls, this.filter, this.order);
    },

    checkFilter() {
      console.log("Olá");
      this.sortCalls();
    },

    changeOrder() {
      if (!this.ascending) {
        this.ascending = true;
        this.order = "desc";
      } else {
        this.ascending = false;
        this.order = "asc";
      }
      this.sortCalls();
    },

    async getAvatar(){
        await this.$http.get(`https://api.github.com/users/${this.user.username}`)
            .then( response => {
                if (response.status == 200 ){
                    this.avatar_url = response.data.avatar_url;
                } 
            })
            .catch( error => {
                console.log(error);
            });
    },

    async selectItem(index, call) {
        await this.calls.forEach(this.removePreviousStyle);
        const row = document.getElementById(this.tr+index);
        row.setAttribute('style', 'background: #777')
        this.selectedCall = call;
    },

    removePreviousStyle(element, index){
        var row = document.getElementById(this.tr+index);
        row.removeAttribute('style');

    },

    handleEditCall() {
        if (!this.selectedCall){
            return false;
        }

        this.saveCallInLocalStorage(this.selectedCall);
        return this.$router.push({name: 'EditarChamado', params: { call: this.selectedCall }});
    },

    saveCallInLocalStorage(call){
        localStorage.setItem('call', JSON.stringify(call));
    },

    deleteCall(){
        if(!this.selectedCall) {
            return;
        }

        this.$http.delete(`http://localhost:8000/api/call/${this.selectedCall.id}`)
            .then( response => {
                console.log(response.data);
                this.getCalls();
            })
            .catch(err => {
                console.log(err);
            });
    }
  },

  watch: {
    filter() {
      this.sortCalls();
    },
  },
};
</script>

<style scoped>
    .avatar {
        width: 40%;
        border-radius: 50%;
        margin-right: 0 ;
    }
</style>