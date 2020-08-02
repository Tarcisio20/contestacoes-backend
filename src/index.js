const express = require('express')
const morgan = require('morgan')
const bodyParser = require('body-parser')

const app = express()

app.use(bodyParser.json())
app.use(bodyParser.urlencoded({ extended : true }))
app.use(morgan('dev'))
app.use(require('./routes'))

require('./Controllers/authController')(app)
require('./Controllers/projectController')(app)

app.listen(3000)