const getDefaultState = () => {
    return {
      user: {
          name: '',
          type: '',
          username: '',
      },

      calls: [],
      call: {},
    };
  };

  const state = getDefaultState();

  const getters = {
    getUser: state => state.user,
    getShowModal: state => state.modal.show_modal,
  };

  const actions = {
    setUserProperties: ({ commit }, props) => commit('newUserProperties', props),
    // setUserState: ({ commit }) => commit('reset_user_state'),
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
    newShowModal: (state, show_modal)=> state.modal.show_modal = show_modal,
    reset_user_state: (state) => Object.assign(state, getDefaultState()),
    newModalProperties: (state, props) => {
      const {
        name = '',
        type = '',
        username = '',
      } = props;

      state.modal = {
        ...state.modal,
        name: name ? name : state.modal.name,
        type: type ? type : state.modal.type,
        username: username ? username : state.modal.username,
      };
    }
  };

  export default {
    state,
    getters,
    actions,
    mutations,
  };