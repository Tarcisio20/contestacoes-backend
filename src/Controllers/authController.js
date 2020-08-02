const express = require('express')
const bcrypt = require('bcryptjs')
const jwt = require('jsonwebtoken')

const User = require('../Models/User')
const { use } = require('../routes')

const router = express.Router()

function generateToken(params = {}){
   return jwt.sign(params, process.env.SECRET, {
        expiresIn: 86400
    })
}

router.post('/authenticate', async (req, res)=> {
    const { email, password } = req.body

    const user = await User.findOne({ email }).select('+password')

    if(!user)
        return res.status(400).send({ error: 'User not found' })

    if(!await bcrypt.compare(password, user.password))
        return res.status(400).send({error:'Invalid password!'})

    use.password = undefined


    res.send({ user, token:generateToken({ id:user.id }) })

})

module.exports = app => app.use('/auth')