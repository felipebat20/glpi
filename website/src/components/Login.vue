<template>
  <div class="col-12">
    <div class="panel form-group col-12 col-md-5 col-lg-4 col-xl-5 col mx-auto rounded-3 py-3 my-5">
      <div class="col-10 mx-auto text-center my-3">
        <img src="../assets/img/glpilogo.png" class="img-responsive" alt="Logo GLPI" />


        <div class="row my-3">
          <input
            type="text"
            class="form-control"
            v-model="user.username"
            placeholder="Usuário"
          />
        </div>

      <div class="row my-3">
        <input
          type="password"
          class="form-control"
          v-model="user.password"
          placeholder="Senha"
          @keypress.enter="handleSubmit()"
        />
      </div>

      <div class="row my-4 justify-content-between">
        <button class="btn btn-success col-5" @click="handleSubmit()">
          Entrar
        </button>

        <router-link to="/cadastro" class="btn btn-secondary col-5"
          >Cadastrar</router-link
        >
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from 'vuex';

export default {
  name: "Login",

  data() {
    return {
      user: {
        username: "",
        password: "",
      },
    };
  },

  methods: {
    ...mapActions([
      'setUserState',
    ]),
    async handleSubmit() {
      this.setUserState(this.user);
    },

  }
};
</script>