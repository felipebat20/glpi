<template>
    <div class="container-fluid  h-100 ">
        <div class="panel form-group col-12 mx-auto  rounded-3 py-3 my-5">
            <h1 class="text-center">Cadastro de Incidente</h1>
            <form action="#" method="POST" class="col-11 mx-auto">
                <div class="row form-group">
                    <div class="col-9 row">
                        <div class="form-group text-left row my-3">
                            <label for="usuario" class="pt-2">
                                Título:
                            </label>
                            <input type="text" class="form-control d-inline-block" placeholder="Digite o título do chamado aqui">
                        </div>
                        <div class="form-group text-left row my-3">
                            <label for="descrição" class="pt-2">
                                Descrição:
                            </label>
                            <textarea class="form-control"></textarea>
                        </div>
                        <div class="form-group text-left row my-3">
                            <label for="descrição" class="pt-2">
                                Anexos:
                            </label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                    <div class="col-3">
                        
                    </div>
                    <div class="col-3">
                        <label for="nivel">Nível</label>
                        <select name="nivel" id="nivel" class="form-select">
                            <option value="0" selected>Selecione</option>
                            <option value="1">Nível 1</option>
                            <option value="2">Nível 2</option>
                            <option value="3">Nível 3</option>
                            <option value="4">Nível 4</option>
                            <option value="5">Nível 5</option>
                        </select>
                    </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>


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
</style>