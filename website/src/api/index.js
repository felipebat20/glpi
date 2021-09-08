import axios from 'axios';

const fetchLogin = async (user) => {
    const  response  = await axios.post('http://localhost:8000/api/session/store', user);
    return response;
};


export {
    fetchLogin,
}