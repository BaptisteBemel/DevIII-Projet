/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../styles/app.css';

// start the Stimulus application

import '../bootstrap';

import "../comments/comments.js"

import React from 'react';
import ReactDOM from 'react-dom';

function gid(id) {
    return document.getElementById(id);
}

function App(){
    return (
        <div>
            <button onClick={testApi}>Ajouter des disponibilites</button>
        </div>
    )
}

export default App

function testApi() {
    let xhr = new XMLHttpRequest();
    xhr.open("get", '/api/ctrl', true);
    xhr.onload = function x() {
        console.log(xhr.responseText);
    }
    xhr.send();
}