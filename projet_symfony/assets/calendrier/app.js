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
import PostApiDispo from './component/PostApiDispo';
import ReactDOM from 'react-dom';


function GID(id) {
    return document.getElementById(id);
}

function App(){
    return (
        <div className='container'>
            <PostApiDispo />
        </div>
    )
}

export default App

function getData() {
    let xhr = new XMLHttpRequest();
    xhr.open("get", "/api/ctrl", true);
    xhr.onload = function get() {
        let data = JSON.parse(xhr.responseText);
        let gid = GID("tableAffichage");
        for(let info of data) {
            gid.innerHTML += "<tr><td>" + info["dateRdv"] + "</td><td>12:00</td><td>" + info["matiere"] + "</td><td>" + info["statut"] + "</td></tr>";
        }
    }
    xhr.send();
}
getData();