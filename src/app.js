const express = require('express')
const bodyParser = require('body-parser')

const app = express()
const router = express.Router()

// Carregar rotas
const indexRoute = require('./Routes/index-route')
const productRoute = require('./Routes/products-route')

app.use(bodyParser.json())
app.use(bodyParser.urlencoded({ extended : false }))


app.use('/', indexRoute)
app.use('/products', productRoute)


module.exports = app