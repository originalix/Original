var React = require('react');
var MyButton = require('./MyButton');

var MyButtonController = React.createClass({
    createNewItem: function (event) {
        console.log('Hello world');
    },

    render: function () {
        return  <MyButton
            // items={this.state.items}
            onClick={this.createNewItem}
        />;
    }
});

module.exports = MyButtonController;
