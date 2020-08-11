class AppStorage {
    storeToken(token){
        localStorage.setItem('token', token);
    }
    storeUser(user){
        localStorage.setItem('user', user);
    }

    store(token, user){
        this.storeToken(token);
        this.storeUser(user);
    }
}

export default AppStorage = new AppStorage();