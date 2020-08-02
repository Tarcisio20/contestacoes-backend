const mongoose = require('../Database')

const UserSchema = new mongoose.Schema({
    login: {
        type:String,
        require:true
    },
    password: {
        type:String,
        required:true,
        select:false
    }
})

const User = mongoose.model('User', UserSchema)

module.exports = User