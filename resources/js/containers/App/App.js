import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import TodosList from '../TodosList/TodosList';

export default class App extends Component {
    render() {
        return (
            <div className="container">
              <TodosList />
            </div>
        );
    }
}

if (document.getElementById('app')) {
    ReactDOM.render(<App />, document.getElementById('app'));
}