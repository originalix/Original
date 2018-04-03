import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
// import App from './components/App/App';
import registerServiceWorker from './registerServiceWorker';
import { BrowserRouter as Router, Link, Route } from 'react-router-dom';

// ReactDOM.render(<App/>, document.getElementById('root'));

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
      <Route path="/tacos" component={Tacos}/>
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

class Tacos extends React.Component {
  
  render() {
    let match = this.props.match;
    return (
      <div>
        <h1><Link to={`${match.url}/carnitas`}>Carnitas</Link></h1>
        <Route path={match.url + '/carnitas'}
          component={Carnitas} 
        />
        <Route
          exact
          path={match.url}
          render= {() => <div></div>}
        />
      </div>
    );
  }
}

const Carnitas = () => (
  <div>
    <h1>Carnitas</h1>
  </div>
);

ReactDOM.render((
  <Router>
    <App />
  </Router>
), document.getElementById('root'));
registerServiceWorker();


