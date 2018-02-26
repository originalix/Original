import PropTypes from 'prop-types';

class Greeting extends React.Component {
    render() {
      return (
        <h1>Hello, {this.props.name}</h1>
      );
    }
  }
  
  Greeting.propTypes = {
    name: PropTypes.string
  };

ReactDOM.render(
    <Greeting />,
    document.getElementById('root')
);

