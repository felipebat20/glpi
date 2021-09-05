<template>
  <div class="container-fluid h-100">
    <div class="panel form-group col-12 mx-auto rounded-3 py-3 my-3 h-100">
      <div class="row px-4 d-flex justify-content-center">
        <img
          src="..\..\assets\glpiprincipal.png"
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
                <th>Nome</th>
                <th>Data de criação</th>
                <th>Nome de usuário</th>
                <th>Última atualização</th>
                <th>Função</th>
              </tr>
            </thead>
            <tfoot></tfoot>
            <tbody>
              <tr v-for="(user, index) in users" :key="index" :id="tr+index" @click="selectItem(index, user)">
                <td>{{ user.name }}</td>
                <td>{{ moment(user.created_at).format("L") }}</td>
                <td>{{ user.username }}</td>
                <td>{{ moment(user.updated_at).format("L") }}</td>
                <td>{{ role[user.usertype - 1] }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="lateral col-2">
          <router-link
            class="btn btn-outline-success m-2 w-100"
            to="/admin/users/cadastro"
          >
            <i class="fas fa-plus"></i> Novo
          </router-link>

          <a @click.stop.prevent="handleEditUser" class="btn btn-outline-primary m-2 w-100">
              <i class="fas fa-pencil-alt"></i> Alterar
          </a>

          <button type="button" class="btn btn-outline-danger m-2 w-100" @click="deleteUser()">
            <i class="fas fa-minus-circle"></i> Excluir
          </button>
          <a
          href.stop.prevent="#"
          @click="backRoute"
          class="btn btn-outline-dark m-2 w-100"
            ><i class="fas fa-arrow-circle-left"></i> Voltar
          </a>
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
      users: [],
      customUser: "",
      options: [
        { value: "name", text: "Nome" },
        { value: "created_at", text: "Data de criação" },
        { value: "updated_at", text: "Última atualização" },
        { value: "usertype", text: "Função" },
      ],

      filter: 0,
      role: ["Usuário", "Técnico", "Admin"],
      user: () => {},
      ascending: true,
      order: "asc",
      avatar_url: '../../assets/img/defaultProfilePhoto.png',
      tr: 'tr',
      selectedUser: () => {},
    };
  },

  async mounted() {
    if (localStorage.getItem("user")) {
      this.user = JSON.parse(localStorage.getItem("user"));
    }

    if (!this.user) {
      this.$router.push({ name: "login" });
    }

    this.getUsers();

    await this.getAvatar();
  },

  methods: {
    getUsers() {
      this.$http
        .get("http://localhost:8000/api/users")
        .then((response) => {
          this.users = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    checkFilter() {
      console.log("Olá");
      this.sortUsers();
    },

    async sortUsers() {
      await this.users.forEach(this.removePreviousStyle);
      this.users = _.orderBy(this.users, this.filter, this.order);
    },

    changeOrder() {
      if (!this.ascending) {
        this.ascending = true;
        this.order = "desc";
      } else {
        this.ascending = false;
        this.order = "asc";
      }
      this.sortUsers();
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

    async selectItem(index, user) {
        await this.users.forEach(this.removePreviousStyle);
        const row = document.getElementById(this.tr+index);
        row.setAttribute('style', 'background: #777')
        this.selectedUser = user;
    },

    removePreviousStyle(element, index){
        var row = document.getElementById(this.tr+index);
        row.removeAttribute('style');

    },

    handleEditUser() {
        if (!this.selectedUser){
            return false;
        }
        
        this.saveSelectedUserInLocalStorage(this.selectedUser);
        // return this.$router.push({name: 'EditarUser', params: { selectedUser: this.selectedUser }});
    },

    deleteUser(){
        if(!this.selectedUser) {
            return;
        }

        this.$http.delete(`http://localhost:8000/api/user/${this.selectedUser.id}`)
            .then( response => {
                console.log(response.data);
                this.getUsers();
            })
            .catch(err => {
                console.log(err);
            });
    },

    backRoute() {
        this.$router.go(-1);
    }
  },

  watch: {
    filter() {
      this.sortUsers();
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