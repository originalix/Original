var React = require('react');
var ListStore = require('../stores/ListStore');
var ButtonActions = require('../actions/ButtonActions');
var MyButton = require('./MyButton');

var MyButtonController = React.createClass({
    getInitialState: function () {
        return {
            items: ListStore.getAll()
        };
    },

    componentDidMount: function () {
        console.log('Did Mount');
        ListStore.addChangeListener(this._onChange);
    },
    
    componentWillUnmount: function () {
        console.log('Will Unmount');
        ListStore.removeChangeListener(this._onChange);
    },

    _onChange: function () {
        this.setState({
            items: ListStore.getAll()
        });
    },
    
    createNewItem: function (event) {
        console.log('Hello world');
        console.log(this.state.items);
    },

    render: function () {;
        return  <MyButton
            items={this.state.items}
            onClick={this.createNewItem}
        />;
    }
});

module.exports = MyButtonController;
