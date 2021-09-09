import { getGithubAvatar, fetchLogin } from '../../../api';
import router from '../../../router';

const getDefaultState = () => {
    return {
      user: {
          name: '',
          type: '',
          username: '',
          avatar_url: '',
      },
    };
  };

  const state = getDefaultState();

  const getters = {
    getUser: state => state.user,
    getShowModal: state => state.modal.show_modal,
  };

  const actions = {
    setUserProperties: ({ commit }, props) => commit('newUserProperties', props),
    setUserFromLocalStorage: ({ commit }, user) => commit('newUser', user),
    resetUserState: ({ commit }) =>{
      localStorage.removeItem('user');
      commit('reset_user_state');
    },
    setUserState: async ({ commit, dispatch }, user) => {
      let { data } = await fetchLogin(user);
      let { data:{ avatar_url } } = await getGithubAvatar(user.username);

      const newUser = {
        ...data,
        avatar_url
      }
      localStorage.setItem('user', JSON.stringify(newUser));
      commit('newUser', newUser);

      dispatch(router.push('/home'))
    },
  };

  const mutations = {
    newUser: (state, user) => {
      const { name, user_type, username, avatar_url } = user;
      state.user = {
        ...state.user,
        name: name ? name : state.user.name,
        type: user_type ? user_type : state.user.user_type,
        username: username ? username : state.user.username,
        avatar_url: avatar_url ? avatar_url : state.user.avatar_url,
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