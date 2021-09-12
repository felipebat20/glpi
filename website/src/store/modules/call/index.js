const getDefaultState = () => {
    return {
      call: {
          id: '',
          user_id: '',
          technician_id: '',
          action_id: '',
          title: '',
          description: '',
          filepath: '',
          status: '',
          severity: '',
          urgency: '',
          trend: '',
          gut: '',
          completed_at: '',
          created_at: '',
          updated_at: '',
      },
    };
  };

  const state = getDefaultState();

  const getters = {
    getCall: state => state.call,
  };

  const actions = {
    resetStates: ({ commit }) => commit('reset_call_state'),
    setCall: async ({ commit }, call) => commit('newCall', call)
  };

  const mutations = {
    newCall: (state, call) => {
        const {
            id,
            user_id,
            technician_id,
            action_id,
            title,
            description,
            filepath,
            status,
            severity,
            urgency,
            trend,
            gut,
            completed_at,
            created_at,
            updated_at
        } = call;

        state.call = {
            ...state.call,
            id: id ? id : state.call.id,
            user_id: user_id ? user_id : state.call.user_id,
            technician_id: technician_id ? technician_id : state.call.technician_id,
            action_id: action_id ? action_id : state.call.action_id,
            title: title ? title : state.call.title,
            description: description ? description : state.call.description,
            filepath: filepath ? filepath : state.call.filepath,
            status: status ? status : state.call.status,
            severity: severity ? severity : state.call.severity,
            urgency: urgency ? urgency : state.call.urgency,
            trend: trend ? trend : state.call.trend,
            gut: gut ? gut : state.call.gut,
            completed_at: completed_at ? completed_at : state.call.completed_at,
            created_at: created_at ? created_at : state.call.created_at,
            updated_at: updated_at ? updated_at : state.call.updated_at,
        };
    },
    reset_call_state: (state) => Object.assign(state, getDefaultState()),
  };

  export default {
    state,
    getters,
    actions,
    mutations,
  };