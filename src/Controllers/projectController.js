const express = require('express')
const router = require('express').Router()

router.get('/', (res, req)=> {

})

module.exports = app => app.use('/projects', router)