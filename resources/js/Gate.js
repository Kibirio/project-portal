export default class Gate{
    constructor(user){
        this.user = user;
    }

    isAdmin(){
        return this.user.type === 'admin';
    }

    isStudent(){
        return this.user.type === 'student';
    }

    isSupervisor(){
        return this.user.type === 'supervisor';
    }
    
    isAdminOrSupervisor(){
        if (this.user.type === 'admin' || this.user.type === 'supervisor')
        return true;
    }
}