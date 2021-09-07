<template>
          <div class="col-12 px-4 ">
        <form
          action="#"
          method="POST"
          class="form-group"
        >
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
</template>

<script>
export default {
  name: 'CallFilter',
  data() {
    return {
      options: [
        { value: "id", text: "Código" },
        { value: "created_at", text: "Data" },
        { value: "title", text: "Descrição" },
        { value: "name", text: "Usuário" },
        { value: "gut", text: "Prioridade" },
        { value: "status", text: "Status" },
      ],
      filter: 0,
      ascending: true,
      order: "asc",
      avatar_url: '../../assets/img/defaultProfilePhoto.png',
    };
  },
  methods: {
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
  }
}
</script>