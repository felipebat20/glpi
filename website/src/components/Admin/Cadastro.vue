<template>
    <div class="container-fluid h-100">

        <div class="panel form-group col-6 mx-auto my-3  rounded-3 p-4">
            <div class="col mx-auto text-center my-3">
                <img src="../../assets/img/glpilogo.png" class="img-fluid" alt="Logo GLPI">
            </div>
            <div class="row mx-auto my-3  text-end align-items-center">
                <label for="nome" class="col-3 p-0 ">Nome:</label>
                <div class="col-9">
                    <input type="text" v-model="user.name" class="form-control" name="nome">
                </div>
            </div>
            <div class="row mx-auto my-3  text-end align-items-center">
                <label for="" class="col-3 p-0 ">Usuário:</label>
                <div class="col-9">
                    <input type="text"  v-model="user.username" class="form-control">
                </div>
            </div>
            <div class="row mx-auto my-3  text-end align-items-center">
                <label for="" class="col-3 p-0 ">Senha:</label>
                <div class="col-9">
                    <input type="password"  v-model="user.password" class="form-control" :class="[parsedPassword ? '' : 'border border-danger']">
                </div>
            </div>
            <div class="row mx-auto my-3  text-end align-items-center">
                <label for="" class="col-3 p-0 ">Repita senha:</label>
                <div class="col-9">
                    <input type="password" @blur="sameAsPassword" v-model="confirm_password" class="form-control" :class="[parsedPassword ? '' : 'border border-danger']">
                    <span v-if="!parsedPassword" class="d-block text-danger text-start">As senhas não coincidem.</span>
                </div>
            </div>
            <div class="row mx-auto my-3  text-end align-items-center">
                <label for="" class="col-3 p-0 ">Tipo:</label>
                <div class="col-9">
                    <select v-model="user.user_type" class="form-select" aria-label="Default select example">
                        <option selected>Selecione uma opção</option>
                        <option v-for="(option, index) in options" :key="index" :value="option.value">{{ option.text }}</option>
                    </select>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-end">
                <div class="col-9 px-3 d-flex justify-content-between">
                    <button
                        @click="backRoute"
                        class="btn btn-danger col-5"
                    >
                        Voltar
                    </button>

                    <button
                        class="btn btn-primary col-5"
                        @click="handleSubmit()"
                    >
                        Cadastrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Cadastro',
    data () {
        return {
            user: {
                name: '',
                username: '',
                password: '',
                usertype: '',
            },
            options: [
                { text: 'Usuário', value: 'user' },
                { text: 'Técnico', value: 'technician' },
                { text: 'Admin', value: 'admin' },
            ],    
            confirm_password: '',
            parsedPassword: true,
        }
    },

    methods: {
        handleSubmit(){
            if(this.user.name == ''){
                return;
            }
            if (this.parsedPassword === false){
                return '';
            }
            
            this.$http.post(`http://localhost:8000/api/user/store`, this.user)
            .then( response => {
                if (response.status == 201 ){
                    this.$router.go(-1);
                } 
            })
            .catch( error => {
                console.log(error);
            });
        },

        setUserType(value){
            this.usertype = value;
        },
        
        sameAsPassword(){
            console.log(this.user.password, this.confirm_password);
            if (this.user.password === this.confirm_password){
                return this.parsedPassword = true;
            }
            console.log(this.parsedPassword);

            this.parsedPassword = false;
        },

        checkuser(){
            if (this.user.usertype === 1){
                return 'user';
            }

            if (this.user.usertype === 2) {
                return 'technician'
            }
        },

        backRoute() {
            this.$router.go(-1);
        }
    },

    watch: {
        confirm_password() {
            this.sameAsPassword();
        }
    },
}

</script>