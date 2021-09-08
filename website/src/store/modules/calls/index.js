const getDefaultState = () => {
    return {
      calls: {},
    };
  };

  const state = getDefaultState();

  const getters = {
    getCalls: state => state.user,
  };

  const actions = {
    setUserProperties: ({ commit }, calls) => commit('newUserProperties', calls),
    resetUserState: ({ commit }) => commit('reset_user_state'),
    setUserState: ({ commit }, user) => commit('newUser', user),
  };

  const mutations = {
    newUser: (state, user) => {
      const { name, user_type, username } = user;
      state.user = {
        ...state.user,
        name: name ? name : state.user.name,
        type: user_type ? user_type : state.user.user_type,
        username: username ? username : state.user.username,
      }
    },
    reset_user_state: (state) => Object.assign(state, getDefaultState()),
  };

  export default {
    state,
    getters,
    actions,
    mutations,
  };