import React, { Component } from 'react';
import axios from 'axios';
import { render } from 'react-dom';
import "../utils";
import * as ReactBootStrap from "react-bootstrap"

class GetEleveData extends Component {
    constructor(props) {
        super(props)

        this.state = {
            date_rdv: '',
            statut: 'libre',
            matiere: ''
        }
    }


    changeHandler = (e) => {
        this.setState({ [e.target.name]: e.target.value })
    }

    submitHandler = e => {
        e.preventDefault()
        axios.get('/api/dispo/user', this.state)
            .then(response => {
                this.renderTable(response.data)
            })
    }

    componentDidMount() {
        window.addEventListener('load', this.submitHandler);
    }    

    renderTable(données) {
        let table = gid("trAffichageUser");
        for(let donnee of données) {
            table.innerHTML += "<tr><td class='bg-white'>" + donnee["dateRdv"] + "</td><td class='bg-white'>" + donnee["matiere"] + "</td></tr>"
        }
    }

    
    render() {
        return (
            <div>
                <div>
                <h3 style={{fontFamily: 'rockwell', fontSize: '150%', marginBottom: '1%', marginTop: "5%"}}>Plages horaire réservés : </h3>
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Heure</th>
                                <th scope="col">Matiere</th>
                            </tr>
                        </thead>
                        <tbody id='trAffichageUser'>
                        </tbody>
                    </table>
                    <div id="msg"></div>
                    <div id="messageErreur"></div>
                </div>
            </div>
        )
    }
}
export default GetEleveData;

function gid(id) {
    return document.getElementById(id);
}