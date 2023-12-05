const mongoose = require('mongoose');

const itemSchema = new mongoose.Schema({
    item_name: String,
    category_name: String,
    brand_name: String,
    price: Number,
    image_url: String
});

module.exports = mongoose.model('Item', itemSchema);
