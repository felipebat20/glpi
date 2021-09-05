const getDefaultState = () => {
    return {
      user: {
          name: '',
          tipo: '',
          username: '',
      }
    };
  };

  const state = getDefaultState();

  const getters = {
    getUser: state => state.user,
    getShowModal: state => state.modal.show_modal,
  };

  const actions = {
    setUserProperties: ({ commit }, props) => commit('newUserProperties', props),
    setUserState: ({ commit }) => commit('reset_user_state'),
  };

  const mutations = {
    newMultipleContentLines: (state, lines)=> state.modal.content_has_multiple_lines = lines,
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