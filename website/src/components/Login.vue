<template>
  <div class="container-fluid h-100">
    <div class="panel form-group col-4 mx-auto rounded-3 py-3 mt-5">
      <div class="col mx-auto text-center my-3">
        <img src="../img/glpilogo.png" class="img-responsive" alt="Logo GLPI" />
      </div>

      <div class="col-10 mx-auto my-3">
        <input
          type="text"
          class="form-control"
          v-model="user.username"
          placeholder="Usuário"
        />
      </div>
      <div class="col-10 mx-auto my-3">
        <input
          type="password"
          class="form-control"
          v-model="user.password"
          placeholder="Senha"
          @keypress.enter="handleSubmit()"
        />
      </div>
      <div class="col-10 mx-auto my-4 d-flex justify-content-center">
        <button class="btn btn-success col-4 mx-auto" @click="handleSubmit()">
          Entrar
        </button>

        <router-link to="/cadastro" class="btn btn-secondary col-4 mx-auto"
          >Cadastrar</router-link
        >
      </div>
    </div>
  </div>
</template>

<script>

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
      handleSubmit() {
          if(this.user.username == ''){
                return;
            }

            console.log(this.user)

            this.$http.post('http://localhost:8000/api/session/store', this.user)
            .then( response => {
                if (response.status == 200 ){
                    if (response.data.usertype == 2) {
                        return this.$router.push({name: 'principal', params: { user: response.data }});
                    }

                    if (response.data.usertype == 3) {
                        return this.$router.push({name: 'admin', params: { user: response.data }});
                    }

                    this.$router.push({name: 'principal', params: { user: response.data }});
                } 
            })
            .catch( error => {
                console.log(error);
            });
      }
  }
};
</script>

<style scoped>
</style>