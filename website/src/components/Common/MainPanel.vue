<template>
    <div class="panel card my-3">
      <div class="card-title p-3 pb-0">
        <h3>
          Chamados
        </h3>
      </div>

      <hr />

      <div>
        <CallFilter />

        <div class="row px-4">
          <CallTable />
          <div class="lateral col-2">
            <router-link v-if="isAdmin" to="/admin/users" class="btn btn-outline-secondary m-2 w-100">
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
          </div>
        </div>
      </div>

    </div>
</template>

<script>
import orderBy from "lodash/_baseOrderBy";
import CallTable from '../Chamados/CallTable.vue';
import CallFilter from '../Chamados/CallFilter.vue';
import { mapGetters, mapActions } from 'vuex';

export default {
  name: "MainPanel",
  components: {
    CallTable,
    CallFilter,
  },

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
      user: () => {},
      ascending: true,
      order: "asc",
      avatar_url: '../../assets/img/defaultProfilePhoto.png',
      selectedCall: () => {},
    };
  },

  computed: {
    ...mapGetters([
      'getUser',
      'getCalls'
    ]),
    isAdmin () {
        return this.getUser.type == 'admin';
    },

    isTechnician() {
        return this.getUser.type == 'technician';
    }
  },

  mounted() {
    this.$nextTick(function () {
      if (!this.getUser.name) {
        this.$router.push({ name: "login" });
      }
        this.setCalls(this.getUser);
    });

  },

  methods: {
    ...mapActions(['setCalls']),

    getAssignedTechCalls() {},

    async sortCalls() {
      await this.calls.forEach(this.removePreviousStyle);
      this.calls = orderBy(this.calls, this.filter, this.order);
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
  },

  watch: {
    filter() {
      this.sortCalls();
    },
  },
};
</script>

<style scoped>

</style>