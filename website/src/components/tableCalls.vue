<template>

        <div class="tabela col-10 ">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Data</th>
                        <th>Descrição</th>
                        <th>Usuário</th>
                        <th>Prioridade</th>
                        <th>Nível</th>
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
                            <td>Nivel 1</td>
                            <td>{{ call.status }}</td>

                    </tr>
                </tbody>
            </table>
        </div>

</template>

<script>
export default {
    name: 'CallTable',

    data() {
        return {

        }
    },

    props: {
        calls: {
            type: Array,
            default: () => {},
        }
    }
}
</script>