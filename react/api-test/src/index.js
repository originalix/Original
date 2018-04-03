import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
// import App from './components/App/App';
import registerServiceWorker from './registerServiceWorker';
import { BrowserRouter as Router, Link, Route } from 'react-router-dom';

// ReactDOM.render(<App/>, document.getElementById('root'));

class Carnitas extends React.Component {
  constructor(props) {
    super(props);
    alert('hello world');
  }
  
  render() {
    let match = this.props.match;
    console.log(match);
    return (
      <div>
        <h1>Carnitas</h1>
        <h3>{match.params.topicId}</h3>
        {/* <Route
          exact
          path={match.url}
          render={() => <h3>Please select a topic.</h3>}
        /> */}
        <Route
          exact
          path={match.url}
          render={() => <h3>Please select a topic.</h3>}
        />
    </div>
    );
  }
}

const App = () => (
  <Router>
    {/* here's a div */}
    <div>
      <ul>
        <li>
          <Link to="/tacos">Tacos</Link>
        </li>
      </ul>
      {/* here's a Route */}
      <Route exact path="/tacos" component={Tacos}/>
    </div>
  </Router>
)

// const Tacos = ({ match }) => (
//   <div>
//     <h1><Link to={`${match.url}/carnitas`}>Carnitas</Link></h1>
//     <Route path={match.url + '/carnitas'}
//       component={Carnitas} 
//     />
//   </div>
// );

const Topic = ({ match }) => (
  <div>
    <h3>{match.params.topicId}</h3>
    <Route
      exact
      path={match.url}
      render={() => <h3>Please select a topic.</h3>}
    />
  </div>
);

class Tacos extends React.Component {
  render() {
    let match = this.props.match;
    console.log(match);
    return (
      <div>
        <h1><Link to={`${match.url}/components`}>Carnitas</Link></h1>
        {/* <Route exact path={match.url + '/carnitas'}
          component={Carnitas} 
        /> */}
        <Route path={`${match.url}/:topicId`} component={Topic} />
        <Route
          exact
          path={match.url}
          render={() => <h3>Please select a topic.</h3>}
        />
        {/* <Route
          path={match.url}
          render= {() => <div></div>}
        /> */}
      </div>
    );
  }
}

ReactDOM.render((
  <Router>
    <App />
  </Router>
), document.getElementById('root'));
registerServiceWorker();


