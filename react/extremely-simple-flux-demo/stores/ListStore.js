var EventEmitter = require('events').EventEmitter;
var assign = require('object-assign');

var ListStroe = assign({}, EventEmitter.prototype, {
    items: [],

    getAll: function () {
        return this.items;
    },

});

module.exports = ListStroe;
