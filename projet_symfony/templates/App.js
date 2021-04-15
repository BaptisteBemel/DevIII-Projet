import React from 'react';
import Calendrier from '../src/React-pages/Calendrier';
import { Route, Link } from 'react-router-dom';
import Calendrier from './NavBar';

function App() {
    console.log("bite");
    return (
        <div className="App">
            <Calendrier />
            <Route exact path="/calendrier" component={Calendrier} />
        </div>
    );
}

export default App;