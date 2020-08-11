import Token from './Token';
import AppStorage from './AppStorage';

class User{
    responseAfterLogin(res){
        const access_token = res.data.access_token;
        const username = res.data.name;

        if(Token.isValid(access_token)){
            AppStorage.store(access_token, username);
        }
    }

    hasToken(){
        const storedToken = AppStorage.getToken();
        if(storedToken) {
            return Token.isValid(storedToken) ? true: false;
        }
    }

    islLoggedIn(){
        return this.hasToken();
    }

    getUserName(){
        if(this.islLoggedIn()){
            return AppStorage.getUser();
        }
    }

    getUserID(){
        if(this.islLoggedIn()){
            const payload = Token.payload(AppStorage.getToken());
            return payload.sub;
        }
    }


}

export default User = new User();