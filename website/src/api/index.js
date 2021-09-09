import axios from 'axios';

const fetchLogin = async (user) => {
    const  response  = await axios.post('http://localhost:8000/api/session/store', user);

    return response;
};

const getGithubAvatar = async (username) => {
    const response =  await axios.get(`https://api.github.com/users/${username}`);
    return response;
};

const fetchCalls = async(id, user_type) => {
    let response = await axios.get(`http://localhost:8000/api/${user_type}/${id}/calls`);
    return response;
}


export {
    fetchLogin,
    getGithubAvatar,
    fetchCalls,
}