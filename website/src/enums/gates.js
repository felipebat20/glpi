export default [
    function isAdmin (user) {
        return user_type == 'admin';
    },

    function isTechnician(user) {
        return user_type == 'technician';
    }
]