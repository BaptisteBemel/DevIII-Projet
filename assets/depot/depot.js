import React from 'react';
import ReactDOM from 'react-dom';
import 'bootstrap/dist/css/bootstrap.min.css';
import DepotProf from './prof';

const App = () => {
    if(document.getElementById("depot").dataset.id == "true"){
        return (
            <div>
                <DepotProf />
            </div>
        )
    }
    else{
        return (
            <div>
            </div>
        )
    }
}

ReactDOM.render(<App />, document.getElementById("depot"));