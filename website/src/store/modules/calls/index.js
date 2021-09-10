import { fetchCalls } from '../../../api'

const getDefaultState = () => {
    return {
      calls: [],
    };
  };

  const state = getDefaultState();

  const getters = {
    getCalls: state => state.calls,
  };

  const actions = {
    resetCallsState: ({ commit }) => commit('reset_calls_state'),
    setCalls: async ({ commit }, { id, type }) => {
      const { data } = await fetchCalls(id, type);
      commit('newCalls', data)
    },
  };

  const mutations = {
    newCalls: (state, calls) => state.calls = calls,
    reset_calls_state: (state) => Object.assign(state, getDefaultState()),
  };

  export default {
    state,
    getters,
    actions,
    mutations,
  };