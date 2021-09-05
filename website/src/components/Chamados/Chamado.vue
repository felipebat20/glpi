<template>
    <div class="container-fluid  h-100 ">
        <div class="panel form-group col-12 mx-auto  rounded-3 py-3 my-5">
            <h1 class="text-center">Cadastro de Incidente</h1>
            <form action="#" method="POST" class="col-11 mx-auto" @submit.prevent="handleSubmit">
                <div class="row form-group">
                    <div class="col-9 row">
                        <div class="form-group text-left row my-3">
                            <label for="usuario" class="pt-2">
                                Título:
                            </label>
                            <input type="text" v-model="title" class="form-control d-inline-block" placeholder="Digite o título do chamado aqui">
                        </div>
                        <div class="form-group text-left row my-3">
                            <label for="descrição" class="pt-2">
                                Descrição:
                            </label>
                            <textarea class="form-control" v-model="description"></textarea>
                        </div>
                        <div class="form-group text-left row my-3">
                            <label for="descrição" class="pt-2">
                                Anexos:
                            </label>
                                <input type="file" accept="image/*" @change="uploadImage($event)" id="file-input" class="custom-file-input">
                        </div>
                    <div class="col-3">
                        
                    </div>
                    
                    </div>
                    <div class="col-3">
                        <label for="nivel">Nível</label>
                        <select name="nivel" v-model="selectedPriority" class="form-select">
                            <option value="0" selected>Selecione</option>
                            <option v-for="(item, index) in priority" :key="index" :value="item.value">{{ item.text }}</option>
                        </select>
                    </div>
                    <div class="col-9 d-flex flex-row justify-content-between my-4">
                        <a @click="$router.go(-1)" class="btn btn-warning px-5">Voltar</a>
                        <button type="submit" class="btn btn-success px-5">Criar chamado</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {

    data() {
        return{
            priority: [
                {value: 1, text: 'Sem gravidade'},
                {value: 2, text: 'Pouco grave'},
                {value: 3, text: 'Grave'},
                {value: 4, text: 'Muito Grave'},
                {value: 5, text: 'Extremamente Grave'},
            ],

            title: "",
            description: "",
            anexo: '',
            selectedPriority: 0,
            call: () => {},
            user: () => {},
        }
       
    },

    mounted(){
        if (localStorage.getItem("user")) {
        this.user = JSON.parse(localStorage.getItem("user"));
        }

        if (!this.user) {
        this.$router.push({ name: "login" });
        }
    },

    methods: {
        uploadImage(event) {
            const URL = '../assets/upload'; 

            let data = new FormData();
            data.append('name', 'my-picture');
            data.append('file', event.target.files[0]); 

            let config = {
            header : {
                'Content-Type' : 'image/png'
            }
            }

            this.$http.put(
            URL, 
            data,
            config
            ).then(
            response => {
                console.log('image upload response > ', response)
            }
        )
        },

        handleSubmit(){
            this.call = {
                title: this.title,
                description: this.description,
                severity: this.selectedPriority,
                filepath: this.anexo,
                user_id: this.user.id,
            } 
            this.$http.post('http://localhost:8000/api/call/store', this.call)
                .then(response => {
                    console.log(response.data, this.call);
                    this.$router.go(-1);
                })
                .catch( err => {
                    console.log(err);
                });
        },

        backRoute() {
            this.$router.go(-1);
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
</style>