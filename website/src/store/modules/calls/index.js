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
    // setUserProperties: ({ commit }, calls) => commit('newUserProperties', calls),
    // resetUserState: ({ commit }) => commit('reset_user_state'),
    setCalls: async ({ commit }, { id, type }) => {
      const { data } = await fetchCalls(id, type);
      commit('newCalls', data)
    },
  };

  const mutations = {
    newCalls: (state, calls) => state.calls = calls,
    // reset_user_state: (state) => Object.assign(state, getDefaultState()),
  };

  export default {
    state,
    getters,
    actions,
    mutations,
  };