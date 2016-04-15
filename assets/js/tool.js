function ObjectEmpty(obj) {
    var flag = true;
    if(typeof obj === 'object' && !(obj instanceof Array)){
        for (var property in obj){
            flag = false;
            break;
        }
    }
    return flag;
}