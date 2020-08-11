import Token from './Token';
import AppStorage from './AppStorage';

class User{
    responseAfterLogin(res){
        const access_token = res.data.access_token;
        const username = res.data.name;

        //console.log(access_token,username);

        if(Token.isValid(access_token)){
            AppStorage.store(access_token, username);
        }
    }

    hasToken(){
        const storedToken = localStorage.getItem('token');
        console.log('got token using hasToken Method');
        if(storedToken) {
            return Token.isValid(storedToken) ? true : false;
        }
        return false;
    }

    isLoggedIn(){
        console.log('is logged in called')
        return this.hasToken();
    }

    getUserName(){
        if(this.islLoggedIn()){
            return localStorage.getItem('user');
        }
    }

    getUserID(){
        if(this.islLoggedIn()){
            const payload = Token.payload(localStorage.getItem('token'));
            return payload.sub;
        }
    }

    clearStore(){
        console.log('clear store');
        localStorage.removeItem('token');    
        localStorage.removeItem('user');    
    }

}

export default User = new User();