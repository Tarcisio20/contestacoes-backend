const mongoose = require('mongoose')

mongoose.connect(process.env.URL_API, { useMongoClient : true })
mongoose.Promise = global.Promise

module.exports = mongoose