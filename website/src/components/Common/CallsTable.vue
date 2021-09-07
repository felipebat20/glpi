<template>
    <div class="tabela col-10">
        <div
            class="col-12 text-left bg-white p-2 border border-secondary rounded my-1"
            v-for="(call, index) in calls"
            :key="index" :id="tr+index"
        >
        <div class="row">
            <div class="col-3">
                <div>
                    <small class="text-muted">
                        Código
                    </small>
                </div>

                <div>
                    <p>
                        DT 00{{ call.id }}
                    </p>
                </div>
            </div>
            <div class="col-3">
                <div>
                    <small class="text-muted">
                        Data
                    </small>
                </div>

                <div>
                    <p>
                        {{ moment(call.created_at).format("L") }}
                    </p>
                </div>
            </div>
            <div class="col-2">
                <div>
                    <small class="text-muted">
                        Descrição
                    </small>
                </div>

                <div>
                    <p>
                        {{ call.title }}
                    </p>
                </div>
            </div>
            <div class="col-2">
                <div>
                    <small class="text-muted">
                        Usuário
                    </small>
                </div>

                <div>
                    <p>
                        {{ call.name }}
                    </p>
                </div>
            </div>
            <div class="col-2 d-flex aling-items-center">
                <div class="col-12">
                    <button @click="handleEditCall(call)" class="btn btn-block btn-outline-primary w-100">
                        <i class="far fa-eye"></i> Ver
                    </button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-3">
                <div>
                    <small class="text-muted">
                        GUT
                    </small>
                </div>

                <div>
                    <p class="mb-0">
                        {{ call.gut }}
                    </p>
                </div>
            </div>

            <div class="col-3">
                <div>
                    <small class="text-muted">
                        Prioridade
                    </small>
                </div>

                <div>
                    <p class="mb-0">
                        {{ getPriority(call.gut) }}
                    </p>
                </div>
            </div>

            <div class="col-4">
                <div>
                    <small class="text-muted">
                        Status
                    </small>
                </div>

                <div>
                    <p class="mb-0">
                        {{ getStatus(call.status) }}
                    </p>
                </div>
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-outline-danger w-100" @click="deleteCall()">
                    <i class="fas fa-minus-circle" /> Excluir
                </button>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
// import { mapActions } from 'vuex';

export default {
    name: 'CallsTable',
    props: {
        calls: {
            type: Array,
            default: () => [],
        },
    },

    data() {
        return {
            status: ["A atribuir", "Em atendimento", "Finalizado"],
            tr: 'tr',
        };
    },

    methods: {
        // ...mapActions(['set']),
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

        handleEditCall(call) {
            this.saveCallInLocalStorage(call);

            return this.$router.push({name: 'EditarChamado', params: { call }});
        },
    },
};
</script>